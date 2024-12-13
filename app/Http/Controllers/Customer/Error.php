<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Error extends Controller{
    public function notFoundPage(): mixed{
        return view("Customer.NotFound")->with(["title" => "Not Found Page"]);
    }
}
