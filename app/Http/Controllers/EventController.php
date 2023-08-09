<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function create(EventRequest $request) {
        if(Auth::user()->admin) {
            Event::create([
               "product_id" => $request->id,
               "procentage" => $request->discount,
                "until" => $request->date
            ]);
            return redirect()->back();
        } else {
            return redirect()->route("welcome");
        }
    }
}
