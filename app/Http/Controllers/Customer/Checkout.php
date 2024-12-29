<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CouponCode;
use App\Models\Customer;
use App\Models\FailedPayment;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\MyFunction\Utilities;
use Closure;
use Exception;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class Checkout extends Controller{

    public function createOrderForOneProduct(): mixed{
        
        $validator = Validator::make(
            request()->all(),
            [
                "productId" => ["bail", "required", "integer"],
                "quantity" => ["bail", "required", "integer", "min:1"]
            ]
        );
        if($validator->stopOnFirstFailure()->fails()){
            return response()->json([
                "message" => $validator->errors()->first()
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $productId = (int)request()->productId;
        $product = Product::find($productId);
        if(!isset($product)){
            return response()->json([
                "message" => "Product does not exist!"
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $quantity = (int)request()->quantity;
        if($quantity > $product->quantity){
            return response()->json([
                "message" => "Order quantity exceeds product quantity!"
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $customer = Auth::user();
        $order = new Order();
        $order->createdDate = date("Y-m-d H:i:s");
        $order->isPaid = false;
        $order->isApproved = false;
        $order->isFromCart = false;
        $order->sale = 0;
        $order->firstName = "none";
        $order->lastName = "none";
        $order->phone = "none";
        $order->province = "none";
        $order->district = "none";
        $order->ward = "none";
        $order->street = "none";
        $order->note = "none";
        $order->paymentUrl = "none";
        $customer->orders()->save($order);
        $order->refresh();

        $order->products()->attach($product->id, [
            "quantity" => $quantity,
            "price" => $product->price - $product->price * ($product->sale / 100),
            "createdDate" => date("Y-m-d H:i:s")
        ]);

        return response()->json([
            "message" => "Please complete the payment process!",
            "success" => "/Customer/Checkout/CheckoutPage"
        ])->withHeaders(["Content-type" => "application/json"]);
    }

    public function createOrder(): mixed{

        $validator = Validator::make(
            request()->all(),
            [
                "couponCodeName" => ["bail", "sometimes", "required", "string"],
            ]
        );
        if($validator->stopOnFirstFailure()->fails()){
            return response()->json([
                "message" => $validator->errors()->first()
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $couponCodeName = request()->has("couponCodeName") ? request()->couponCodeName : null;
        $couponCode = null;
        if(isset($couponCodeName)){
            $couponCode = CouponCode::where("name", $couponCodeName)
            ->where("expiredDate", ">=", date("Y-m-d H:i:s"))
            ->first();

            if(!isset($couponCode)){
                return response()->json([
                    "message" => "Coupon code does not exist or expired!"
                ])->withHeaders(["Content-type" => "application/json"]);
            }
        }

        $customer = Auth::user();
        $carts = Cart::where("customerId", $customer->id)
        ->with([
            "product" => function(Builder $query): void{
                $query->selectRaw("
                    product.*,
                    (product.price - product.price * (product.sale / 100)) as priceAfterSale
                ");
            }
        ])
        ->get();

        if(count($carts) == 0){
            return response()->json([
                "message" => "Cart is empty!"
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        if(
            Cart::where("customerId", $customer->id)
            ->whereHas("product", function(Builder $query): void{
                $query->whereColumn("cart.quantity", ">", "product.quantity");
            })->count() != 0
        ){
            return response()->json([
                "message" => "Please update your cart!"
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $order = new Order();
        $order->createdDate = date("Y-m-d H:i:s");
        $order->isPaid = false;
        $order->isApproved = false;
        $order->isFromCart = true;
        $order->sale = isset($couponCode) ? $couponCode->sale : 0;
        $order->firstName = "none";
        $order->lastName = "none";
        $order->phone = "none";
        $order->province = "none";
        $order->district = "none";
        $order->ward = "none";
        $order->street = "none";
        $order->note = "none";
        $order->paymentUrl = "none";
        $customer->orders()->save($order);
        $order = $order->refresh();

        foreach($carts as $cart){
            $order->products()->attach($cart->productId, [
                "quantity" => $cart->quantity,
                "price" => $cart->product->priceAfterSale,
                "createdDate" => date("Y-m-d H:i:s")
            ]);
        }
        $customer->cartProducts()->sync([]);

        return response()->json([
            "message" => "Please complete the payment process!",
            "success" => "/Customer/Checkout/CheckoutPage"
        ])->withHeaders(["Content-type" => "application/json"]);
    }

    public function checkoutPage(): mixed{

        $customer = Auth::user();
        $order = Order::where("customerId", $customer->id)
        ->where("isApproved", false)->first();

        $orderDetails = OrderDetail::where("orderId", $order->id)
        ->orderByDesc("createdDate")
        ->selectRaw("
            order_detail.*,
            (price * quantity) as subTotal
        ")
        ->with("product")
        ->get();

        $subTotal = 0;
        foreach($orderDetails as $orderDetail){
            $subTotal += $orderDetail->subTotal;
        }

        $sale = $subTotal * ($order->sale / 100);
        $total = $subTotal - $sale;

        $provinces = Http::get("https://provinces.open-api.vn/api/p/")->object();
        
        return view("Customer.Checkout")->with([
            "title" => "Check Out Page",
            "order" => $order,
            "orderDetails" => $orderDetails,
            "subTotal" => $subTotal,
            "sale" => $sale,
            "total" => $total,
            "customer" => $customer,
            "provinces" => $provinces,
        ]);
    }

    public function order(): mixed{

        $validator = Validator::make(
            request()->all(),
            [
                "firstName" => ["bail", "required", "string", "max:255"],
                "lastName" => ["bail", "required", "string", "max:255"],
                "street" => ["bail", "required", "string", "max:1000"],
                "note" => ["bail", "sometimes", "required", "string", "max:1000"],
                "paymentMethod" => ["bail", "required", "integer", "min:1", "max:2"]
            ]
        );
        if($validator->stopOnFirstFailure()->fails()){
            return response()->json([
                "message" => $validator->errors()->first()
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $customer = Auth::user();
        $order = Order::where("customerId", $customer->id)
        ->where("isApproved", false)
        ->first();

        $orderDetails = OrderDetail::where("orderId", $order->id)
        ->selectRaw("
            order_detail.*,
            (price * quantity) as subTotal
        ")
        ->get();

        if(
            OrderDetail::where("orderId", $order->id)
            ->whereHas("product", function(Builder $query): void{
                $query->whereColumn("order_detail.quantity", ">", "product.quantity");
            })->count() != 0
        ){
            if($order->isFromCart){
                foreach($orderDetails as $orderDetail){
                    $customer->cartProducts()->attach($orderDetail->productId, [
                        "quantity" => $orderDetail->quantity,
                        "createdDate" => date("Y-m-d H:i:s")
                    ]);
                }
            }
            $order->delete();

            return response()->json([
                "message" => "Please update your cart!",
                "success" => "/Customer/Cart/CartPage"
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $province = Http::get("https://provinces.open-api.vn/api/p/search/", [
            "q" => request()->province
        ])->object()[0];
        $district = Http::get("https://provinces.open-api.vn/api/d/search/", [
            "q" => request()->district,
            "p" => $province->code
        ])->object()[0];
        $ward = Http::get("https://provinces.open-api.vn/api/w/search/", [
            "q" => request()->ward,
            "p" => $province->code,
            "d" => $district->code
        ])->object()[0];

        $order->firstName = request()->firstName;
        $order->lastName = request()->lastName;
        $order->phone = request()->phone;
        $order->province = $province->name;
        $order->district = $district->name;
        $order->ward = $ward->name;
        $order->street = request()->street;
        $order->note = request()->has("note") ? request()->note : "none";

        $paymentMethod = (int)request()->paymentMethod;
        if($paymentMethod == 1){

            if($order->paymentUrl == "none"){

                $subTotal = 0;
                foreach($orderDetails as $orderDetail){
                    $subTotal += $orderDetail->subTotal;
                }
                $sale = $subTotal * ($order->sale / 100);
                $total = $subTotal - $sale;

                $order->paymentUrl = $this->createVnpPayment(
                    Utilities::getRandomKey(16),
                    (string)Auth::id(),
                    round($total)
                );
            }
            $order->save();

            return response()->json([
                "message" => "Please complete the payment process!",
                "success" => $order->paymentUrl
            ])->withHeaders(["Content-type" => "application/json"]);
        }else{

            $order->isApproved = true;
            $order->save();

            foreach($orderDetails as $orderDetail){
                $product = Product::find($orderDetail->productId);
                $product->quantity -= $orderDetail->quantity;
                $product->save();
            }

            return response()->json([
                "message" => "Ordered successfully!",
                "success" => "/Customer/Cart/CartPage"
            ])->withHeaders(["Content-type" => "application/json"]);
        }

    }

    public function deleteOrder(){
        
        $customer = Auth::user();
        $order = Order::where("customerId", $customer->id)
        ->where("isApproved", false)
        ->first();

        if($order->isFromCart){
            $orderDetails = OrderDetail::where("orderId", $order->id)->get();

            foreach($orderDetails as $orderDetail){
                $customer->cartProducts()->attach($orderDetail->productId, [
                    "quantity" => $orderDetail->quantity,
                    "createdDate" => date("Y-m-d H:i:s")
                ]);
            }
        }
        $order->delete();

        return response()->json([
            "message" => "Deleted successfully!",
            "success" => "/Customer/Cart/CartPage"
        ])->withHeaders(["Content-type" => "application/json"]);
    }

    public function createVnpPayment(string|int $orderId, string $orderInfo, float $amount): mixed{
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/Customer/Checkout/VnpReturnUrl";
        $vnp_TmnCode = env("VNP_TmnCode"); //Mã website tại VNPAY 
        $vnp_HashSecret = env("VNP_HashSecret"); //Chuỗi bí mật
    
        $vnp_TxnRef = $orderId; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $orderInfo;
        $vnp_OrderType = "Ruper product bill";
        $vnp_Amount = $amount * 100;
        $vnp_Locale = "VN";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER["REMOTE_ADDR"];
        $vnp_ExpireDate = date("YmdHis", strtotime("+5 minutes"));  //Thời gian hết hạn
        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date("YmdHis"),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $vnp_ExpireDate
        ];
    
        if(isset($vnp_BankCode) && $vnp_BankCode != ""){
            $inputData["vnp_BankCode"] = $vnp_BankCode;
        }
        if(isset($vnp_Bill_State) && $vnp_Bill_State != ""){
            $inputData["vnp_Bill_State"] = $vnp_Bill_State;
        }
    
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach($inputData as $key => $value){
            if($i == 1){
                $hashdata .= "&" . urlencode($key) . "=" . urlencode($value);
            }else{
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . "&";
        }
    
        $vnp_Url = $vnp_Url . "?" . $query;
        if(isset($vnp_HashSecret)){
            $vnpSecureHash =   hash_hmac("sha512", $hashdata, $vnp_HashSecret);
            $vnp_Url .= "vnp_SecureHash=" . $vnpSecureHash;
        }

        return $vnp_Url;
    }

    public function vnpReturnUrl(): mixed{
        $vnp_SecureHash = request()->vnp_SecureHash;
        $inputData = [];
        foreach(request()->all() as $key => $value){
            if(substr($key, 0, 4) == "vnp_"){
                $inputData[$key] = $value;
            }
        }
        
        unset($inputData["vnp_SecureHash"]);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach($inputData as $key => $value){
            if($i == 1){
                $hashData = $hashData . "&" . urlencode($key) . "=" . urlencode($value);
            }else{
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac("sha512", $hashData, env("VNP_HashSecret"));
        if($secureHash == $vnp_SecureHash){
            if(request()->vnp_ResponseCode == "00"){
                
                $customerId = (int)$inputData["vnp_OrderInfo"];
                $customer = Customer::find($customerId);
                if(!isset($customer)){
                    return redirect("/Customer/Checkout/PaymentErrorPage");
                }
                
                $order = Order::where("customerId", $customer->id)
                ->where("isApproved", false)
                ->first();
                if(!isset($order)){
                    return redirect("/Customer/Checkout/PaymentErrorPage");
                }

                $orderDetails = OrderDetail::where("orderId", $order->id)->get();
                if(
                    OrderDetail::where("orderId", $order->id)
                    ->whereHas("product", function(Builder $query): void{
                        $query->whereColumn("order_detail.quantity", ">", "product.quantity");
                    })->count() != 0
                ){
                    if($order->isFromCart){
                        foreach($orderDetails as $orderDetail){
                            $customer->cartProducts()->attach($orderDetail->productId, [
                                "quantity" => $orderDetail->quantity,
                                "createdDate" => date("Y-m-d H:i:s")
                            ]);
                        }
                    }
                    $order->delete();

                    $failedPayment = new FailedPayment();
                    $failedPayment->createdDate = date("Y-m-d H:i:s");
                    $failedPayment->amount =  $inputData["vnp_Amount"];
                    $failedPayment->bankCode = $inputData["vnp_BankCode"];
                    $failedPayment->bankTranNo = $inputData["vnp_BankTranNo"];
                    $failedPayment->cardType = $inputData["vnp_CardType"];
                    $failedPayment->orderInfo = $inputData["vnp_OrderInfo"];
                    $failedPayment->payDate = $inputData["vnp_PayDate"];
                    $failedPayment->responseCode = $inputData["vnp_ResponseCode"];
                    $failedPayment->tmnCode = $inputData["vnp_TmnCode"];
                    $failedPayment->transactionNo = $inputData["vnp_TransactionNo"];
                    $failedPayment->transactionStatus = $inputData["vnp_TransactionStatus"];
                    $failedPayment->txnRef = $inputData["vnp_TxnRef"];
                    $failedPayment->isRefunded = false;
                    $customer->failedPayments()->save($failedPayment);

                    return redirect("/Customer/Checkout/PaymentErrorPage");
                }

                $order->isPaid = true;
                $order->isApproved = true;
                $order->save();

                foreach($orderDetails as $orderDetail){
                    $product = Product::find($orderDetail->productId);
                    $product->quantity -= $orderDetail->quantity;
                    $product->save();
                }

                return redirect("/Customer/Checkout/PaymentSuccessPage");
            } 
            else{
                return redirect("/Customer/Checkout/PaymentErrorPage");
            }
        }else{
            return redirect("/Customer/Error/NotFoundPage");
        }
    }

    public function paymentSuccessPage(): mixed{
        return view("Customer.PaymentSuccess");
    }
    public function paymentErrorPage(): mixed{
        return view("Customer.PaymentError");
    }
}
