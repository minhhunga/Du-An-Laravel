<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB; 
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use Intervention\Image\Facades\Image;


class ProductController extends Controller
{
    public function product(){
        return view('Frontend.product.myproduct');
    }

    public function getAdd(){
        $cate = Category::all(); 
        $brand = Brand::all(); 
        return view('Frontend.product.add', compact('cate', 'brand'));
        
    }

    public function postAdd(ProductRequest $request)
{
    $product = new Product();
    $product->id_user = Auth::user()->id;
    $product->name = $request->input('name');
    $product->price = $request->input('price');
    $product->id_category = $request->input('category');
    $product->id_brand = $request->input('brand');
    $product->sale = $request->input('sale');
    $product->detail = $request->input('detail');
    $product->save();

    $data = [];
    if ($request->hasfile('img')) {
        foreach ($request->file('img') as $image) {
            $name = $image->getClientOriginalName();
            $name_2 = "hinh50_" . $image->getClientOriginalName();
            $name_3 = "hinh200_" . $image->getClientOriginalName();

            $path = public_path('upload/product/' . $name);
            $path2 = public_path('upload/product/' . $name_2);
            $path3 = public_path('upload/product/' . $name_3);

            Image::make($image->getRealPath())->save($path);
            Image::make($image->getRealPath())->resize(50, 70)->save($path2);
            Image::make($image->getRealPath())->resize(200, 300)->save($path3);

            $data[] = $name;
        }
    }

    // Lưu đường dẫn của hình ảnh vào cùng bản ghi Product
    $product->img = json_encode($data);
    $product->save();

    // Chuyển hướng sau khi hoàn thành
    return redirect()->route('myproduct')->with("success", "Cập nhật thành công");
}

    public function create()
    {
        $getProducts = Product::find(1)->toArray();
        $getArrImage = json_decode($getProducts['img'], true);
        return view('frontend.product.create', compact('getArrImage'));
    }

    public function showproduct() {
        $products = Product::all();
        return view('Frontend.product.myproduct', compact('products'));
    }

    public function editproduct($id){
        $edit=Product::find($id);
        $cate = Category::all();
        $brand = Brand::all();
        return view('Frontend.product.edit', compact('edit', 'cate', 'brand'));
    }

    public function updateproduct(ProductRequest $request, $id){
        $editproduct=Product::find($id);
        $editproduct->update([
            'name'=>$request->input('name'),
            'price'=>$request->input('price'),
            'category'=>$request->input('category'),
            'brand'=>$request->input('brand'),
            'sale'=>$request->input('sale'),
            'img'=>$request->input('img'),
            'detail'=>$request->input('detail'),
        ]);
        return redirect()->route('myproduct')->with("success","Cập nhật thành công");
    }

    public function deleteProduct($id){
        Product::destroy($id);
        return redirect()->route('myproduct');
    }

    public function search(Request $request){

        $search = $request->input('search');
        // Sử dụng SQL LIKE để tìm kiếm theo tên
        $products = Product::where('name', 'like', '%' . $search . '%')->get();
        return view('Frontend.product.search', compact('products', 'search'));
    }

    public function searchAdvanced(Request $request){
        $name = $request->input('name');
        $category = $request->input('category');
        $brand = $request->input('brand');
        $price = $request->input('price');
        $query = Product::query();
        $categorys = Category::all();
        $brands = Brand::all();

        if ($name) {
            $query->where('name', 'LIKE', '%' . $name . '%');
        }
        if ($category) {
            $query->where('id_category', $category);
        }
        if ($brand) {
            $query->where('id_brand', $brand);
        }
         if ($price) {
        // Tách giá trị của khoảng giá thành mảng
            $priceArray = explode('-', $price);
        // Lọc sản phẩm theo khoảng giá tiền
            $query->whereBetween('price', [$priceArray[0], $priceArray[1]]);
        }
        $products = $query->paginate(10);

        return view('Frontend.product.search-advanced', compact('products', 'categorys', 'brands'));
    }

    public function searchPrice(Request $request){
        $minPrice = $request->minPrice;
        $maxPrice = $request->maxPrice;
        //dd($minPrice, $maxPrice);
        $products = Product::whereBetween('price', [$minPrice, $maxPrice])->get();

        return response()->json(['products' => $products]);
    }


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
