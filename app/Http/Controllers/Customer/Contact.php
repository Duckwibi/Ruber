<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Contact extends Controller{
    public function contactPage(): mixed{
        return view("Customer.Contact")->with(["title" => "Contact Page"]);
    }

    public function sendContact(): mixed{

        $validator = Validator::make(
            request()->all(),
            [
                "name" => ["bail", "required", "string", "max:255"],
                "email" => ["bail", "required", "string", "max:255"],
                "message" => ["bail", "required", "string", "max:2000"]
            ]
        );
        if($validator->stopOnFirstFailure()->fails()){
            return response()->json([
                "message" => $validator->errors()->first()
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $contact = new \App\Models\Contact();
        $contact->name = request()->name;
        $contact->email = request()->email;
        $contact->message = request()->message;
        $contact->createdDate = date("Y-m-d H:i:s");
        $contact->save();

        return response()->json([
            "message" => "Sended successfully!"
        ])->withHeaders(["Content-type" => "application/json"]);
    }
}
