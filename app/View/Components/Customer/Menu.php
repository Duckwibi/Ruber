<?php

namespace App\View\Components\Customer;

use App\Models\Blog;
use Closure;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Menu extends Component{

    public $menus;
    public $blogs;
    public function __construct(){
    }

    public function render(): mixed{

        $this->menus = \App\Models\Menu::where("level", 1)->orderBy("order")
        ->with([
            "menuLevel2s" => function(Builder $query): void{
                $query->orderBy("order")->with([
                    "menuLevel3s" => function(Builder $query): void{
                        $query->orderBy("order")->with("blogCategory");
                    }
                ]);
            }
        ])->get();

        $this->blogs = Blog::orderByDesc("createdDate")->limit(3)->withCount("blogComments")->get();

        return view("components.customer.menu");
    }
}
