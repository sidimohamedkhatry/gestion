<?php

namespace App\Http\Controllers\Dashboard\Client;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\commande;
use App\Models\invoices;
use App\Models\Product;
use Illuminate\Http\Request;

class ClientComandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

       // return view('dashboard.invoices.index');

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,Client $client)
    {
        $orders = $client->orders()->with('products')->latest()->get();
        $categories = Category::with('products')->get();
        return view('dashboard.invoices.coma.orders.create', compact('client', 'categories','orders'));
        //return view('dashboard.bon.orders.create', compact('client', 'categories','orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Client $client)
    {
        // $request->validate([
        //     'products'      =>  'required|array',
        // ]);
       
        // $this->attach_order($request , $client );
        
        //  session()->flash('success', __('site.add_successfully'));
        
          return   $request;
           
        // return view('dashboard.invoices');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client, invoices $order)
    {
        //

        $request->validate([
            'products'      =>  'required|array',
        ]);

        $this->detach_order($order);
        // dd('done delete');
        $this->attach_order($request,$client);

        session()->flash('success', __('site.edit_successfully'));
        return redirect()->route('dashboard.invoices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function attach_order($request, $client){

        $order  =   $client->orders()->create([]);
        $order->products()->attach($request->products);
        $total_price    = 0;
        
            foreach($request->products as $id=>$quantity){
                $product    = Product::where('id',$id)->first();
                $total_price    +=  $product->purches_price * $quantity['quantity'];
                 

                $product->update([
                    'stock' =>  $product->stock - $quantity['quantity'],
                ]);
            }
        $order->update([
            'total_price'   =>   $total_price
        ]);
    }
}
