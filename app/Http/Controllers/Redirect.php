<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Event;
use App\Models\Order;
use App\Models\Products;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
session_start();

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Redirect extends Controller
{
    public function index() {
        $allProducts = Products::all();
        $allNewProducts = [];
        foreach ($allProducts as $product) {
            $discount = 0;
            $eventForProduct = Event::where("product_id", $product->id)->first();
            if($eventForProduct) {
                $price = $product->price - ($product->price * $eventForProduct->procentage) / 100;
                $discount = $eventForProduct->procentage;
                $isEvent = true;
            } else {
                $price = $product->price;
                $isEvent = false;
            }
            $allNewProducts[] = [
                $product,
                "isEvent" => $isEvent,
                "realPrice" => $price,
                "discount" => $discount
            ];
        }
        return view("welcome", [
            "products" => $allNewProducts
        ]);
    }
    public function dashboard() {
        $yourOrders = Order::where("user_id", Auth::user()->id)->where("status", "paid")->get();
        $yourProducts = [];
        foreach ($yourOrders as $order) {
            $product_id = $order->product_id;
            $allInfoAboutYourProducts = Products::where("id", $product_id)->first();
            $yourProducts[] = [
                "product_id" => $product_id,
                "name" => $allInfoAboutYourProducts->name,
                "description" => $allInfoAboutYourProducts->description,
                "price" => $allInfoAboutYourProducts->price,
                "location" => $order->location,
                "completed" => $order->completed
            ];
        }
        return view("dashboard", [
            "products" => Products::all(),
            "yourProducts" => $yourProducts
        ]);
    }
    public function certainProduct($product_name) {
        $allInfo = Products::where("name", $product_name)->first();
        $allReviws = Review::where("product_id", $allInfo->id)->orderBy("id", "desc")->get();

        $theUserBoughtTheProduct = false;
        $allProductsByCurrentUser = Order::where("user_id", Auth::user()->id)->where("product_id", $allInfo->id)->where("status", "paid")->get();
        if(count($allProductsByCurrentUser) > 0) {
            $theUserBoughtTheProduct = true;
        }

        return view("certain_product", [
            "info" => $allInfo,
            "reviews" => $allReviws,
            "bought" => $theUserBoughtTheProduct
        ]);
    }
    public function toCart() {
        if(Auth::check()) {
            $allCarts = Cart::where("user_id", Auth::user()->id)->get();
            $products = [];
            foreach ($allCarts as $cart) {
                $product = Products::where("id", $cart->product_id)->first();
                $products[] = [
                    "name" => $product->name,
                    "description" => $product->description,
                    "price" => $product->price,
                    "image_path" => $product->image_path,
                    "id" => $product->id
                ];
            }
            $_SESSION["cart"] = $products;
            return view("cart", [
                "products" => $products
            ]);
        } else {
            return redirect()->route("login");
        }
    }
}
