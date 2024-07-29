<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Member;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MemberRequest;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function cart()
    {
         $cartProducts = session()->get('cart-product');
        return view('frontend.cart.cart-product', compact('cartProducts'));
    }

    public function addCart(Request $request)
    {
        $id = $request->id;
        
        if (!Session::has('cart-product')) {
            Session::put('cart-product', []);
        }

        // Kiểm tra xem sản phẩm với ID đã cho có trong giỏ hàng chưa
        if (Session::has('cart-product.' . $id) && Session::get('cart-product.' . $id)['id'] == $id) {
            $row = Session::get('cart-product.' . $id);
            $row['qty'] = $row['qty'] + 1;
            Session::put('cart-product.' . $id, $row);
        } else {
            // Lấy thông tin sản phẩm từ cơ sở dữ liệu
            $product = DB::table('product')->where('id', $id)->first();

            if ($product) {
                $product->qty = 1;
                Session::put('cart-product.' . $id, (array) $product);
            }
        }

            return Session::get('cart-product');
    }

    public function updateCart(Request $request) {
        // Lấy thông tin sản phẩm và số lượng từ request
        $productId = $request->input('productId');
        $quantity = $request->input('quantity');

        // Lấy danh sách sản phẩm từ session
        $cartProducts = session()->get('cart-product');
        $totalPrice = 0;

        // Tìm kiếm sản phẩm trong giỏ hàng và cập nhật số lượng
        foreach ($cartProducts as &$product) {
            if ($product['id'] == $productId) {
                // Cập nhật số lượng sản phẩm
                $product['qty'] = $quantity;

                // Tính lại giá trị subtotal
                $price = str_replace("$", '', $product['price']);
                $price = (float) $price;
                $subtotal = $price * $product['qty'];
                // Cộng vào tổng giá trị
                $totalPrice += $subtotal;

                break;
            }
    }

    // Cập nhật lại giỏ hàng trong session
    session()->put('cart-product', $cartProducts);

    // Trả về kết quả
    return response()->json(['success' => true, 'cartProducts' => $cartProducts, 'totalPrice' => $totalPrice]);
}

    public function deleteCart(Request $request) {

            $productId = $request->input('productId');
            // Thực hiện logic xóa sản phẩm khỏi giỏ hàng ở đây
            $cart = session('cart-product', []);

            if (isset($cart[$productId])) {
                unset($cart[$productId]);
                session(['cart-product' => $cart]);
            }

            return response()->json(['success' => true]);
    
    }

    public function checkout(){
         $cartProducts = session('cart-product', []);
        return view('Frontend.cart.checkout', compact('cartProducts'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function postRegister(MemberRequest $request){
        $member=new Member();
        $member->name=$request->input('name');
        $member->email=$request->input('email');
        $member->password=$request->input('password');
         $member->phone=$request->input('phone');
         
          $member->level = 0;
         
         if ($member['password']) {
            $member['password'] = bcrypt($member['password']);
        }else{
            $member['password'] = $member->password;
        }
        $member->save();
        return redirect()->route('Registerr');   
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
