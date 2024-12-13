<?php

namespace App\Http\Controllers\Customer;

use App\Events\Customer\UpdateBlogComment;
use App\Http\Controllers\Controller;
use App\Mail\Customer\VerifyEmail;
use App\Models\Archive;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\Tag;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class Blog extends Controller{
    public function blogCategoryPage(): mixed{

        $validator = Validator::make(
            request()->all(),
            [
                "id" => ["bail", "required", "integer"],
                "titleLike" => ["bail", "sometimes", "required", "string"],
                "archiveId" => ["bail", "sometimes", "required", "integer"],
                "tagId" => ["bail", "sometimes", "required", "integer"],
                "currentPage" => ["bail", "sometimes", "required", "integer", "min:1"],
            ]
        );
        
        if($validator->stopOnFirstFailure()->fails()){
            return redirect("/Customer/Error/NotFoundPage");
        }

        $id = (int)request()->id;
        $blogCategory = BlogCategory::find($id);
        if(!isset($blogCategory)){
            return redirect("/Customer/Error/NotFoundPage");
        }

        $titleLike = request()->has("titleLike") ? "%" . request()->titleLike . "%" : null;

        $archiveId = request()->has("archiveId") ? (int)request()->archiveId : null;
        $archive = null;
        if(isset($archiveId)){
            $archive = Archive::find($archiveId);
            if(!isset($archive)){
                return redirect("/Customer/Error/NotFoundPage");
            }
        }

        $tagId = request()->has("tagId") ? (int)request()->tagId : null;
        $tag = null;
        if(isset($tagId)){
            $tag = Tag::find($tagId);
            if(!isset($tag)){
                return redirect("/Customer/Error/NotFoundPage");
            }
        }

        $blogsCount = \App\Models\Blog::where("blogCategoryId", $id)
        ->when(isset($titleLike), function(Builder $query) use($titleLike): void{
            $query->whereRaw("title like ?", [$titleLike]);
        })
        ->when(isset($archive), function(Builder $query) use($archive): void{
            $query->where("createdDate", "<", $archive->archiveDate);
        })
        ->when(isset($tag), function(Builder $query) use($tag): void{
            $query->whereHas("tags", function(Builder $query) use($tag): void{
                $query->where("tag.id", $tag->id);
            });
        })->count();
        
        $page = $blogsCount / 9.0;
        $page = $page - (int)$page == 0 ? $page : (int)$page + 1;
        $page = $page == 0 ? 1 : $page;
        $currentPage = request()->has("currentPage") ? (int)request()->currentPage : 1;
        $currentPage = $currentPage > $page ? $page : $currentPage;


        $blogs = \App\Models\Blog::where("blogCategoryId", $id)
        ->when(isset($titleLike), function(Builder $query) use($titleLike): void{
            $query->whereRaw("title like ?", [$titleLike]);
        })
        ->when(isset($archive), function(Builder $query) use($archive): void{
            $query->where("createdDate", "<", $archive->archiveDate);
        })
        ->when(isset($tag), function(Builder $query) use($tag): void{
            $query->whereHas("tags", function(Builder $query) use($tag): void{
                $query->where("tag.id", $tag->id);
            });
        })
        ->orderByDesc("createdDate")
        ->limit(9)->offset(($currentPage - 1) * 9)
        ->with("blogCategory")->withCount("blogComments")->get();


        return view("Customer.BlogCategory")->with([
            "title" => "Blog Category Page",
            "blogCategory" => $blogCategory,
            "blogs" => $blogs,
            "titleLike" => request()->titleLike,
            "archiveId" => $archiveId,
            "tagId" => $tagId,
            "page" => $page,
            "currentPage" => $currentPage,
        ]);
    }

    public function blogDetailPage(): mixed{
        
        $validator = Validator::make(
            request()->all(),
            [
                "id" => ["bail", "required", "integer"]
            ]
        );

        if($validator->stopOnFirstFailure()->fails()){
            return redirect("/Customer/Error/NotFoundPage");
        }

        $id = (int)request()->id;
        $blog = \App\Models\Blog::where("id", $id)
        ->with("blogCategory")
        ->withCount("blogComments")
        ->with("tags")
        ->with([
            "blogComments" => function(Builder $query): void{
                $query->orderByDesc("createdDate")->with("customer");
            }
        ])->first();

        if(!isset($blog)){
            return redirect("/Customer/Error/NotFoundPage");
        }

        $previousBlog = \App\Models\Blog::where("blogCategoryId", $blog->blogCategoryId)
        ->where("createdDate", "<", $blog->createdDate)
        ->orderByDesc("createdDate")
        ->limit(1)->first();

        $nextBlog = \App\Models\Blog::where("blogCategoryId", $blog->blogCategoryId)
        ->where("createdDate", ">", $blog->createdDate)
        ->orderBy("createdDate")
        ->limit(1)->first();

        $currentUser = Auth::check() ? Auth::user() : null;

        return view("Customer.BlogDetail")->with([
            "title" => "Blog Detail Page",
            "blog" => $blog,
            "previousBlog" => $previousBlog,
            "nextBlog" => $nextBlog,
            "currentUser" => $currentUser
        ]);
    }

    public function comment(): mixed{

        $validator = Validator::make(
            request()->all(),
            [
                "content" => ["bail", "required", "string", "max:1000"],
                "blogId" => ["bail", "required", "integer"]
            ]
        );

        if($validator->stopOnFirstFailure()->fails()){
            return response()->json([
                "message" => $validator->errors()->first()
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $blogId = request()->blogId;
        if(\App\Models\Blog::where("id", $blogId)->count() == 0){
            return response()->json([
                "message" => "Blog does not exist!"
            ])->withHeaders(["Content-type" => "application/json"]);
        }
        
        $blogComment = new BlogComment();
        $blogComment->content = request()->content;
        $blogComment->createdDate = date("Y-m-d H:i:s");
        $blogComment->blogId = $blogId;
        $customer = Auth::user();
        $customer->blogComments()->save($blogComment);

        UpdateBlogComment::dispatch($blogComment, $customer);

        return response()->json([
            "message" => "Posted successfully!"
        ])->withHeaders(["Content-type" => "application/json"]);
    }
}
