<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Blog extends Controller{
    public function blogCategoryPage(): mixed{

        

        return view("Customer.BlogCategory")->with(["title" => "Blog Category Page"]);
    }
}
