<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProductsController extends Controller
{
    public function create(ProductRequest $request) {
        if(Auth::user()->admin) {
            $product = Products::create([
                "name" => $request->name,
                "description" => $request->description,
                "price" => $request->price,
                "image_path" => $this->storageImage($request)
            ]);
            return redirect()->route("dashboard");
        } else {
            return new NotFoundHttpException;
        }
    }
    private function storageImage($request)
    {
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $fileName = $request->name . '-' . uniqid() . '.' . $request->file('file')->extension();
            return $request->file->move(public_path("products_image"), $fileName);
        } else {
            throw new \Exception("Fișierul nu a fost încărcat corect.");
        }
    }

}
