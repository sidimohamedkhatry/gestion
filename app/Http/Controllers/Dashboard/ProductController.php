<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::when($request->search,function($q) use ($request){

            return $q->where( 'num_produitt', 'like', '%' . $request->search . '%');

        })->when($request->category_id , function($q) use ($request){

            return $q->where('category_id',$request->category_id);

        })->latest()->paginate(10);
        return view('dashboard.products.index',compact('products','categories'));   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products,name',
            'category_id' => 'required',
            'purches_price' => 'required|unique:products,purches_price',
            'num_produitt'     => 'required|unique:products,num_produitt',
            //'sale_price' => 'required',
            'stock' => 'required',
            
        ]);


      
        $request_data = $request->all();

        if ($request->image) {
            Image::make($request->image)->resize(40, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/product_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }

       Product::create($request_data);

       session()->flash('success', __('site.add_successfully'));
        return redirect()->route('dashboard.products.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|unique:products,name,'.$product->id,
            'category_id' => 'required',
            'purches_price' => 'required',
            'num_produitt' => 'required',
            // 'sale_price' => 'required',
            'stock' => 'required',
        ]);

        $request_data = $request->all();
        if ($request->image) {
            if ($product->image != 'defualt.png') {
                Storage::disk('public_uploads')->delete('/product_images/' . $product->image);
            }

            Image::make($request->image)->resize(40,null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/product_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }
        
        $product->update($request_data);
        session()->flash('success', __('site.edit_successfully'));
        return redirect()->route('dashboard.products.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->image != 'defualt.png') {
            Storage::disk('public_uploads')->delete('/product_images/' . $product->image);
        }
      

        $product->delete();
        session()->flash('success', __('site.delete_successfully'));
        return redirect()->route('dashboard.products.index'); 
    }



    public function export() 
    {
       
       return \Excel::download(new ProductExport, 'Produit.xlsx');
       // return (new ProductExport)->download('invoices.pdf', \Maatwebsite\Excel\Excel::MPDF);

    }
}
