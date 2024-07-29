<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateProfileRequest; 

class CountryController extends Controller
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
        $data=country::all();

        return view('admin.country.list', compact('data'));

    }
    public function getCountry(){
        return view('admin.country.add');
    }
    public function postCountry(UpdateProfileRequest $request){
        $country = new Country();
        $country->name = $request->input('name');
        $country->save();

        return redirect()->route('admin/country');
    }
    public function deleteCountry($id){
        Country::destroy($id);

        return redirect()->route('admin/country');
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
