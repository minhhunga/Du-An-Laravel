<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateProfileRequest;

class BrandController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    } 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=brand::all();

        return view('admin.brand.list', compact('data'));

    }
    public function getBrand(){
        return view('admin.category.add');
    }
    public function postBrand(UpdateProfileRequest $request){
        $brand = new Brand();
        $brand->name = $request->input('name');
        $brand->save();

        return redirect()->route('admin/brand');
    }
    public function deleteBrand($id){
        Brand::destroy($id);

        return redirect()->route('admin/brand');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
