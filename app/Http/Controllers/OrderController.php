<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

session_start();

class OrderController extends Controller
{
    public function checkoutStripe() {
        if(isset($_SESSION["cart"])) {
            $orderTitle = "";
            $totalPrice = 0;
            $theDescription = "";
            foreach ($_SESSION["cart"] as $product) {
                $productID = $product["id"];
                $orderTitle = $orderTitle . $product["name"] . " + ";
                $totalPrice += $product["price"];

                $productDescription = Products::where("id", $productID)->first()->description;
                $theDescription .= $productDescription . " ------\n";
            }
            $stripe = new \Stripe\StripeClient(env("PRIVATE_STRIPE"));

            $checkout_session = $stripe->checkout->sessions->create([
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $orderTitle,
                            'description' => $theDescription
                        ],
                        'unit_amount' => $totalPrice * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route("checkout.succes")."?session_id={CHECKOUT_SESSION_ID}",
                'cancel_url' => route("checkout.cancel"),
            ]);
            foreach ($_SESSION["cart"] as $order) {
                Order::create([
                    "product_id" => $order["id"],
                    "user_id" => Auth::user()->id,
                    "sessionID" => $checkout_session->id
                ]);
            }
            return redirect()->to($checkout_session->url);
        } else {
            return redirect()->route("cart");
        }
    }
    public function succes(Request $request) {
        \Stripe\Stripe::setApiKey(env("PRIVATE_STRIPE"));
        $sessionId = $request->get("session_id");

        try {
            $session = \Stripe\Checkout\Session::retrieve($sessionId);
            if(!$session) {
                throw new NotFoundHttpException;
            }
            $orders = Order::where("sessionID", $session->id)->where("status", "unpaid")->get();
            if(count($orders) == 0) {
                throw new NotFoundHttpException;
            }
            foreach ($orders as $order) {
                $order->status = "paid";
                $order->save();
            }
            session_destroy();
            return view("succes");
        } catch (\Exception $e) {
            throw new NotFoundHttpException;
        }
    }
    public function cancel() {

    }
}
