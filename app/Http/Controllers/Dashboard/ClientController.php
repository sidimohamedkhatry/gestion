<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\invoices;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        
        $clients = Client::when($request->search,function($q) use ($request){
            return $q->where('name', 'like', '%' . $request->search . '%')
            ->orWhere('phone', 'like', '%' . $request->search . '%');
        })->latest()->paginate(10);


        

        return view('dashboard.clients.index',compact('clients'));
        
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.clients.create');
        return view('dashboard.bon.create');
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
            'name' => 'required',
            'phone'=> 'required',
            'image' => 'image',
        ]);

        $request_data = $request->all();

        if ($request->image) {
            Image::make($request->image)->resize(40, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/client_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }

        Client::create($request_data);
        session()->flash('success', __('site.add_successfully'));
        return redirect()->route('dashboard.clients.index');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('dashboard.clients.edit' ,compact('client'));
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required',
            'phone'=> 'required',
            'image' => 'image'
        ]);

        $request_data = $request->all();
        if ($request->image) {
            if ($client->image != 'defualt.png') {
                Storage::disk('public_uploads')->delete('/client_images/' . $client->image);
            }

            Image::make($request->image)->resize(40,null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/client_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }
        
        $client->update($request_data);
         session()->flash('success', __('site.edit_successfully'));
        return redirect()->route('dashboard.clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {

        if ($client->image != 'defualt.png') {
            Storage::disk('public_uploads')->delete('/client_images/' . $client->image);
        }
         $client->delete();
        session()->flash('success', __('site.delete_successfully'));
        return redirect()->route('dashboard.clients.index'); 
    }
}
