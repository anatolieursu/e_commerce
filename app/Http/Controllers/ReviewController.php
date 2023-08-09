<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewsHandle;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create($id, ReviewsHandle $request) {
        if($this->checkAuthorization($id)) {
            Review::create([
               "product_id" => $id,
               "user_id" => Auth::user()->id,
               "review" => $request->review,
               "stars" => $request->stars,
                "name" => Auth::user()->name
            ]);
            return redirect()->back();
        } else {
            return redirect()->route("welcome");
        }
    }
    private function checkAuthorization($product_id) {
        if(count(Order::where("product_id", $product_id)->where("user_id", Auth::user()->id)->where("status", "paid")->get()) > 0) {
            return true;
        } else {
            return false;
        }
    }
}
