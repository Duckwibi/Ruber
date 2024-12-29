<?php

namespace App\Http\Middleware\Customer;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class LocationVerify{
    public function handle(Request $request, Closure $next): mixed{

        $validator = Validator::make(
            request()->all(),
            [
                "province" => ["bail", "required", "string", "max:255"],
                "district" => ["bail", "required", "string", "max:255"],
                "ward" => ["bail", "required", "string", "max:255"]
            ]
        );
        if($validator->stopOnFirstFailure()->fails()){
            return response()->json([
                "message" => $validator->errors()->first()
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $provinces = Http::get("https://provinces.open-api.vn/api/p/search/", [
            "q" => request()->province
        ])->object();
        if(count($provinces) == 0){
            return response()->json([
                "message" => "Province does not exist!"
            ])->withHeaders(["Content-type" => "application/json"]);
        }
        $province = $provinces[0];
        if(strpos(strtoupper($province->name), strtoupper(request()->province)) === false){
            return response()->json([
                "message" => "Province does not exist!"
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $districts = Http::get("https://provinces.open-api.vn/api/d/search/", [
            "q" => request()->district,
            "p" => $province->code
        ])->object();
        if(count($districts) == 0){
            return response()->json([
                "message" => "District does not exist!"
            ])->withHeaders(["Content-type" => "application/json"]);
        }
        $district = $districts[0];
        if(strpos(strtoupper($district->name), strtoupper(request()->district)) === false){
            return response()->json([
                "message" => "District does not exist!"
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        $wards = Http::get("https://provinces.open-api.vn/api/w/search/", [
            "q" => request()->ward,
            "p" => $province->code,
            "d" => $district->code
        ])->object();
        if(count($wards) == 0){
            return response()->json([
                "message" => "Ward does not exist!"
            ])->withHeaders(["Content-type" => "application/json"]);
        }
        $ward = $wards[0];
        if(strpos(strtoupper($ward->name), strtoupper(request()->ward)) === false){
            return response()->json([
                "message" => "Ward does not exist!"
            ])->withHeaders(["Content-type" => "application/json"]);
        }

        return $next($request);
    }
}
