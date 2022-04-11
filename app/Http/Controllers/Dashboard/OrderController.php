<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Sidi;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\status;
use Illuminate\Support\Facades\DB;
use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\Exportable;



class OrderController extends Controller
{
    public function index(Request $request){
        $client = Client::all();
         $order = Order::all();
         $orders = Order::whereHas('client', function($q) use ($request){
            return $q->where('num_fa',   'like',  '%' . $request->search . '%');
        })->when($request->client_id , function($q) use ($request){

            return $q->where('client_id',$request->client_id);

        })->latest()->paginate(10);
        // dd($orders);
        

           if($orders){
          
            $sales_data = Order::select(
                DB::raw('SUM(total_price) as Total')
            )->get();

           }
        
        return view('dashboard.orders.index',compact('orders', 'sales_data', 'order'));
        
    }

    public function products(Order $order){
        $products = $order->products;
        return view('dashboard.orders._products',compact('products','order'));
    }
     

    public function show($id)

    {
        // $order = Order::where('id', $d)->first();
        // return view('orders.statut_update', compact('order'));
        // //
    }

    
    

    public function destroy(Order $order){

        foreach($order->products as $product){
            $product->update([
                'stock' =>$product->stock + $product->pivot->quantity,
                
            ]);
        }
        
        
        

        $order->delete();
        session()->flash('success', __('site.delete_successfully'));
        return redirect()->route('dashboard.orders.index'); 
    }
    


    public function export() 
    {
       
        return \Excel::download(new OrderExport, 'order.xlsx');
    }



}
