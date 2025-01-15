<?php

namespace App\View\Components\Customer;

use App\Models\Blog;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ServiceBlog extends Component{
    public $blogs;
    public function __construct(){
    }
    public function render(): mixed{

        $this->blogs = Blog::where("isService", true)
        ->orderByDesc("createdDate")
        ->get();

        return view("components.customer.service-blog");
    }
}
