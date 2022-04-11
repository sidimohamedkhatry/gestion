<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\sidi;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Client;


class SidiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::all();
        $client = Client::all();
        $orders = Order::whereHas('client', function($q) use ($request){
            return $q->where('name', 'like', '%' . $request->search . '%');
        })->latest()->paginate(10);

        return view('dashboard.sidi.index',compact('orders', 'products'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sidi  $sidi
     * @return \Illuminate\Http\Response
     */
    public function show(sidi $sidi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sidi  $sidi
     * @return \Illuminate\Http\Response
     */
    public function edit(sidi $sidi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sidi  $sidi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sidi $sidi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sidi  $sidi
     * @return \Illuminate\Http\Response
     */
    public function destroy(sidi $sidi)
    {
        //
    }
}
