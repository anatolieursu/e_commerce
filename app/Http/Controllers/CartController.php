<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CartController extends Controller
{
    public function addToCart($productName) {
        $productId = Products::where("name", $productName)->first()->id;
        if($productId == null) {
            return new NotFoundHttpException;
        } else {
            $cart = Cart::create([
               "user_id" => Auth::user()->id,
               "product_id" => $productId
            ]);
            return redirect()->back();
        }
    }
    public function deleteFromCart(Request $request) {
        Cart::where("user_id", Auth::user()->id)->where("product_id", $request->productID)->delete();
        return redirect()->back();
    }
}
