<?php

namespace App\View\Components\Customer;

use App\Models\Archive;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use Closure;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BlogSidebar extends Component{
    public $blogCategories;
    public $blogs;
    public $archives;
    public $tags;
    public function __construct(
        public $id,
        public $titleLike,
        public $archiveId,
        public $tagId
    ){}

    public function render(): View|Closure|string{

        $this->blogCategories = BlogCategory::withCount("blogs")->get();
        $this->blogs = Blog::where("blogCategoryId", $this->id)->limit(3)
        ->orderByDesc("createdDate")
        ->get();

        $this->archives = Archive::orderByDesc("archiveDate")->get();
        $this->tags = Tag::whereHas("blogs", function(Builder $query): void{
            $query->where("blog.blogCategoryId", $this->id);
        })->get();

        return view("components.customer.blog-sidebar");
    }
}
