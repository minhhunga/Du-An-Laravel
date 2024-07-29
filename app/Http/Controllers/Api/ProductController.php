<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB; 
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\Api\productAddRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public $successStatus = 200;
    
    // 
    public function productHome(){
        $getProductHome = Product::orderBy('id')->limit(6)->get()->toArray();
        return response()->json([
            'response' => 'success',
            'data' => $getProductHome
        ], $this->successStatus);
    }
    public function detail($id)
    {
        $products = Product::all();
        return response()->json([
            'response' => 'success',
            'data' => $products
        ], $this->successStatus);
       
    }
    public function store(productAddRequest $request) {
        $data = $request->all();
        
        if($request->hasfile('file')){
            $imageUpload = $this->uploadImageToDirectory($request->file('file')); 
            $data['image']= json_encode($imageUpload); 
        }
       
       
        
        $data['id_category'] = $data['category'];
        $data['id_brand'] = $data['brand'];
        //$data['company_profile'] = $data['company'];
        //$data['id_user'] = Auth::id();

        if ($product = Product::create($data)) {
            // if($request->hasfile('file')){
            //     $this->uploadImageToDirectory($request->file('file'));  
            // }
            return response()->json([
                'response' => 'success',
                'data' => $product
            ], $this->successStatus);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
   

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
