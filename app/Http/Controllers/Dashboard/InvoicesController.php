<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\invoices;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\commande;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        
        $orders = Order::whereHas('client', function($q) use ($request){
            return $q->where('name', 'like', '%' . $request->search . '%');
        })->latest()->paginate(10);
        return view('dashboard.invoices.index',compact('orders'));
        //return view('dashboard.invoices.index');
    }

    public function products(Order $order){
        $products = $order->products;
        return view('dashboard.invoices._products',compact('products','order'));
    }

    /**
     * Show the form for creating a new resource.gybthèjç
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,Client $client)
    {
        //
        //$client = Client::all();
        //$product = Product::all();
        ///$categories = Category::with('products')->get();
       // return view('dashboard.invoices.create', compact('categories', 'product'));

       //return 
            
             $orders = $client->orders()->with('products')->latest()->get();
             $categories = Category::with('products')->get();
             return view('dashboard.invoices.create', compact('client', 'categories','orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    


    public function store(Request $request,Client $client)
    {

     return $client;
        
        //  $request->validate([
        //     'products'      =>  'required|array',
        //  ]);
   
           
        //  $this->attach_order($request , $Product );
        
        //  session()->flash('success', __('site.add_successfully'));
        // // return redirect()->back();
        //  return view('dashboard.invoices');



     // return redirect()->route('dashboard.invoices.index');
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show(invoices $invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(invoices $invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, invoices $invoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(invoices $invoices)
    {
        //
    }


    private function attach_order($request, $product){

        //$order  =   $product->invoices()->create([]);
      // $order->products()->attach($request->Product);
       //  $total_price    = 0;
        
            foreach($request->products as $id=>$quantity){
                $product    = Product::where('id',$id)->first();
                 

                $product->update([
                    'stock' =>  $product->stock - $quantity['quantity'],
                ]);
            }
        
    }
}
