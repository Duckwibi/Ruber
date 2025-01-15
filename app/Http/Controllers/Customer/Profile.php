<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\MyFunction\Utilities;
use DB;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Profile extends Controller{
    public function dashboardPage(): mixed{

        $customer = Auth::user();

        return view("Customer.Dashboard")->with([
            "title" => "Dashboard Page",
            "customer" => $customer
        ]);
    }

    public function orderListPage(): mixed{

        $orders = Order::where("customerId", Auth::id())
        ->joinSub(
            DB::table(
                OrderDetail::selectRaw("
                    order_detail.orderId,
                    (order_detail.price * order_detail.quantity) as subTotal
                "),
                "order_detail_with_sub_total"
            )
            ->groupBy("order_detail_with_sub_total.orderId")
            ->selectRaw("
                order_detail_with_sub_total.orderId,
                sum(order_detail_with_sub_total.subTotal) as total,
                count(order_detail_with_sub_total.orderId) as itemCount
            "),
            "order_detail_with_total",
            function(JoinClause $query): void{
                $query->on("order_detail_with_total.orderId", "order.id");
            }
        )
        ->selectRaw("
            `order`.*,
            (order_detail_with_total.total * (order.sale / 100)) as priceSale,
            (order_detail_with_total.total - order_detail_with_total.total * (order.sale / 100)) as totalAfterSale,
            order_detail_with_total.itemCount
        ")
        ->get();

        return view("Customer.OrderList")->with([
            "title" => "Order List Page",
            "orders" => $orders
        ]);
    }

    public function orderDetailListPage(): mixed{

        $validator = Validator::make(
            request()->all(),
            [
                "orderId" => ["bail", "required", "integer"]
            ]
        );
        if($validator->stopOnFirstFailure()->fails()){
            return redirect("/Customer/Error/NotFoundPage");
        }

        $orderId = (int)request()->orderId;
        if(
            Order::where("id", $orderId)
            ->where("customerId", Auth::id())
            ->count() == 0
        ){
            return redirect("/Customer/Error/NotFoundPage");
        }

        $orderDetails = OrderDetail::where("orderId", $orderId)
        ->selectRaw("
            order_detail.*,
            (price * quantity) as subTotal
        ")
        ->with("order")
        ->with("product")
        ->get();

        return view("Customer.OrderDetailList")->with([
            "title" => "Order Detail List Page",
            "orderDetails" => $orderDetails
        ]);
    }

    public function accountDetailPage(): mixed{

        $customer = Auth::user();

        return view("Customer.AccountDetail")->with([
            "title" => "Account Detail Page",
            "customer" => $customer
        ]);
    }

    public function updateAccountDetail(): mixed{

        $validator = Validator::make(
            request()->all(),
            [
                "firstName" => ["bail", "required", "string", "max:255"],
                "lastName" => ["bail", "required", "string", "max:255"],
                "name" => ["bail", "required", "string", "max:255"]
            ]
        );
        if($validator->stopOnFirstFailure()->fails()){
            return response()->json([
                "message" => $validator->errors()->first()
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $customer = Auth::user();
        $firstName = request()->firstName;
        $lastName = request()->lastName;
        $name = request()->name;
        if(
            Customer::where("name", "<>", $customer->name)
            ->where("name", $name)
            ->count() != 0
        ){
            return response()->json([
                "message" => "Name already exists!"
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $customer->firstName = $firstName;
        $customer->lastName = $lastName;
        $customer->name = $name;
        $customer->loginKey = Utilities::getRandomKey(64);
        $customer->save();

        return response()->json([
            "message" => "Updated successfully!",
            "success" => "/Customer/Authenticate/LoginPage"
        ])->withHeaders(["Content-type" => "application/json"]);
    }
}
