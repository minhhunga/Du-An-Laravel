<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateProfileRequest;

class CategoryController extends Controller
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
        $data=category::all();

        return view('admin.category.list', compact('data'));

    }
    public function getCategory(){
        return view('admin.category.add');
    }
    public function postCategory(UpdateProfileRequest $request){
        $category = new Category();
        $category->name = $request->input('name');
        $category->save();

        return redirect()->route('admin/category');
    }
    public function deleteCategory($id){
        Category::destroy($id);

        return redirect()->route('admin/cagory');
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
