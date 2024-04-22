<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\commande;
use App\Models\status;
use App\Models\Product;
use Illuminate\Http\Request;

class ClientOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        
       

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,Client $client)


    {   
       // return $client;
        $orders = $client->orders()->with('products')->latest()->get();
        $categories = Category::with('products')->get();
        return view('dashboard.clients.orders.create', compact('client', 'categories','orders'));
       // return view('dashboard.bon.orders.create', compact('client', 'categories','orders'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Client $client)
    {

         $this->attach_order($request , $client);
         session()->flash('success', __('site.add_successfully'));
        return redirect()->back();
       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request , Client $client, Order $order)

    {
        
        // $order  = client::with('oders')->where('id', $id)->first();
        // return view('dashboard.clients.orders.statut', compact('order'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client, Order $order)
    {
        $categories = Category::with('products')->get();
        $orders = $client->orders()->with('products')->where('client_id',$client->id)->latest()->get();
        return view('dashboard.clients.orders.edit',compact('order','client','categories','orders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , Client $client, Order $order)
    {
        $request->validate([
            'products'      =>  'required|array',
        ]);



        $this->detach_order($order);
        // dd('done delete');
        $this->attach_order($request,$client);

        session()->flash('success', __('site.edit_successfully'));
        return redirect()->route('dashboard.orders.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order, Client $client)
    {
        //
    }

    private function attach_order($request, $client){
        $order  =   $client->orders()->create([]);
        $order->products()->attach($request->products);
        $total_price    = 0;
        $num_fa ;
        $status ; 
      
        
        
    
            foreach($request->products as $id=>$quantity){
                $product    = Product::where('id',$id)->first();
                $total_price    +=  $product->purches_price * $quantity['quantity'];
                $num_fa =    $request->num_fa;
                $status = $request->status;

                $product->update([
                    'stock' =>  $product->stock - $quantity['quantity'],
                    
                ]);
            }
        $order->update([
            'total_price'   =>   $total_price,
             'num_fa'  => $num_fa,
             'status'   => $status
             
             
             
             
        ]);
    }


    private function detach_order($order){
           
        foreach($order->products as $product){
           
            $product->update([
                'stock' =>$product->stock + $product->pivot->quantity,
            
               
               
            ]);
            
        }
        $order->delete();
    }
}
