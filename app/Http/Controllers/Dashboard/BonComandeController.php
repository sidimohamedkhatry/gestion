<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\BonComande;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BonComandeController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('dashboard.bon.index');

       

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        // $client  = Client::all();
        // $orders = $client->orders()->with('products')->latest()->get();
        $categories = Category::with('products')->get();
        return view('dashboard.bon.orders.create', compact('categories'));
        

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
        $request_data = $request->all();

        
        BonComande::create($request_data);

       session()->flash('success', __('site.add_successfully'));
        return redirect()->route('dashboard.sidi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BonComande  $bonComande
     * @return \Illuminate\Http\Response
     */
    public function show(BonComande $bonComande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BonComande  $bonComande
     * @return \Illuminate\Http\Response
     */
    public function edit(BonComande $bonComande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BonComande  $bonComande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BonComande $bonComande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BonComande  $bonComande
     * @return \Illuminate\Http\Response
     */
    public function destroy(BonComande $bonComande)
    {
        //
    }
}
