<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\employe;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        //

        // $employe = DB::table('employes')->paginate(5);

        $employe = employe::when($request->search,function($q) use ($request){
            return $q->where('name', 'like', '%' . $request->search . '%')
            ->orWhere('salaire', 'like', '%' . $request->search . '%');
        })->latest()->paginate(5);
        

        return view('dashboard.employe.index', compact('employe'));
    }



    public function products($id){

        
        $employe = employe::where('id', $id)->first();
        return view('dashboard.employe._products',compact('employe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('dashboard.employe.create');
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

        if ($request->image) {
            Image::make($request->image)->resize(40, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/employe_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();
        }

        // if($request->reste){
            
        //     "reste" = $request->salaire - $request->avance
        // }
         
        employe::create($request_data);


        session()->flash('success', __('site.add_successfully'));
        return redirect()->route('dashboard.employe.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function show(employe $employe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function edit(employe $employe)
    {
        //

        return view('dashboard.employe.edit' ,compact('employe'));
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, employe $employe)
    {
        //
        $request_data = $request->all();

        if ($request->image) {
            if ($employe->image != 'defualt.png') {
                Storage::disk('public_uploads')->delete('/employe_images/' . $employe->image);
            }

            Image::make($request->image)->resize(40,null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/employe_images/' . $request->image->hashName()));

            $request_data['image'] = $request->image->hashName();

        }

        $employe->update($request_data);
        session()->flash('success', __('site.edit_successfully'));
       return redirect()->route('dashboard.employe.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function destroy(employe $employe)
    {
        //

        $employe->delete();
        session()->flash('success', __('site.delete_successfully'));
        return redirect()->route('dashboard.employe.index');
    }
}
