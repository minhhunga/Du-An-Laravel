@extends('Frontend.layout.master')
@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->
			 @if(auth()->check())
                <!-- Nếu đã đăng nhập, ẩn form đăng nhập -->
            @else
            @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                {{session('success')}}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
		<div class="signup-form"><!--sign up form-->

		<h2>New User Signup!</h2>

		<form method="POST">
			@csrf
			<input type="text" name="name" placeholder="Name"/>
			<input type="email" name="email" placeholder="Email Address"/>
			<input type="password" name="password" placeholder="Password"/>
			<input type="text" name="phone" placeholder="Phone No"/>
			<input type="file" name="avatar" placeholder="Upload file"/>
			<label class="col-md-12">Message</label>
            <div class="col-md-12">
                <textarea rows="5" class="form-control form-control-line"></textarea>
            </div>
			<button type="submit" class="btn btn-default">Signup</button>
		</form>
	</div><!--/sign up form-->
			@endif

			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@php
                        	$totalPrice = 0;
                    	@endphp
						@foreach($cartProducts as $product)
						@php
	                            $getArrImage = json_decode($product['img'], true);
	                            $price = str_replace("$", '', $product['price']);
	                            $price = (float) $price;
	                            $subtotal = $price * $product['qty'];
	                            $totalPrice += $subtotal; // Thay đổi ở đây
	    
		                    @endphp
						<tr>
							<td class="cart_product">
								@if (isset($getArrImage[0]))
                                    <a href=""><img width="200px" src="{{ asset('upload/product/' . $getArrImage[0]) }}" alt=""></a>
                                @endif
							</td>
							<td class="cart_description">
								<h4><a href="">{{ $product['name'] }}</a></h4>
								<p>Web ID: {{ $product['id'] }}</p>
							</td>
							<td class="cart_price">
								<p>{{ $product['price'] }}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{ $product['qty'] }}" autocomplete="off" size="2">
									<a class="cart_quantity_down" href=""> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{ $subtotal }}$</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
							</td>
						</tr>

						@endforeach
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>$59</td>
									</tr>
									<tr>
										<td>Exo Tax</td>
										<td>$2</td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span>$61</span></td>
									</tr>

								</table>
								<a class="btn btn-default order" href="{{ route('sendemail') }}">Order</a>
							</td>

						</tr>
					</tbody>
				</table>
			</div>
			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div>
		</div>
	</section> <!--/#cart_items-->
@endsection