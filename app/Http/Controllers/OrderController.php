<?php

namespace App\Http\Controllers;

use App\Http\Requests\RefillRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Ingredient;
use App\Models\Order;
use Illuminate\Support\Facades\Request;

class OrderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        if($order = Order::add($request->products)) {
            Ingredient::calculate($order->product);
        }

        return response()->json($order);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function refill(RefillRequest $request)
    {
        return response()->json(Ingredient::refill($request->only('ingredient', 'amount')));
    }

}
