@extends('Frontend.layout.master')
@section('content')
		<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="name">Name</td>
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
                    	@if(session('cart-product'))
						@foreach(session('cart-product') as $product)
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
									<a class="cart_quantity_up" data-id="{{ $product['id'] }}" href=""> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{ $product['qty'] }}" autocomplete="off" size="2">
									<a class="cart_quantity_down" data-id="{{ $product['id']}}" href=""> - </a>
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
						@else
						    <p>Không có sản phẩm nào trong giỏ hàng.</p>
						@endif

					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>$59</span></li>
							<li>Eco Tax <span>$2</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span class="aaa">{{ $totalPrice }}$</span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="{{ route('checkout') }}">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
	<script type="text/javascript">
		$(document).ready(function(){
		    $('.cart_quantity_up').click(function(event){
		        event.preventDefault();

		        var productId = $(this).closest("tr").find(".cart_quantity_up").data('id');
		        var inputField = $(this).closest(".cart_quantity_button").find('.cart_quantity_input');
		        var currentValue = parseInt(inputField.val());
		        var newValue = currentValue + 1;
		        inputField.val(newValue);

		        var b=$(this).closest("tr").find('.cart_price').text();
	            var price = parseFloat(b.replace("$", ""));
	            var total=newValue*price;
	            var c=$(this).closest("tr").find(".cart_total .cart_total_price").text(total+"$");
	            var pricee =$(this).closest('tr').find('.cart_price p').text()
			    var priceee =parseFloat(pricee.replace("$", ""))
				var totall =$('.total_area span.aaa').text();
				var totalll=parseFloat(totall)
					totalll += priceee;
				$('.total_area span.aaa').text(totalll+'$');

		        $.ajax({
		            method: "POST",
		            url: "{{ route('update-cart') }}",
		            data: {
		                productId: productId,
		                quantity: newValue,
		                _token: "{{ csrf_token() }}"
		            },
		            success: function(response){
		                console.log('Sản phẩm đã được cập nhật thành công');

		            },
		            error: function(xhr, status, error) {
		                console.error('Lỗi khi cập nhật số lượng sản phẩm:', error);
		            }
		        });
		    });
	    $('.cart_quantity_down').click(function(event){
	        event.preventDefault();
	        var productId = $(this).closest("tr").find(".cart_quantity_down").data('id');
	        var inputField = $(this).closest(".cart_quantity_button").find('.cart_quantity_input');
	        var currentValue = parseInt(inputField.val());
	        var newValue = currentValue - 1;
	        inputField.val(newValue);

	        
	        var pricee =$(this).closest('tr').find('.cart_price p').text()
		    var priceee =parseFloat(pricee.replace("$", ""))
			var totall =$('.total_area span.aaa').text();
			var totalll=parseFloat(totall)
				totalll -= priceee;
			$('.total_area span.aaa').text(totalll+'$');
			if(newValue>=1){
				$.ajax({
		            method: "POST",
		            url: "{{ route('update-cart') }}",
		            data: {
		                productId: productId,
		                quantity: newValue,
		                _token: "{{ csrf_token() }}"
		            },
		            success: function(response){
		                console.log('Sản phẩm đã được cập nhật thành công');
		            },
		            error: function(xhr, status, error) {
		                console.error('Lỗi khi cập nhật số lượng sản phẩm:', error);
		            }
		        });
		    var b=$(this).closest("tr").find('.cart_price').text();
	        var price = parseFloat(b.replace("$", ""));
	        var total=newValue*price;
	        $(this).closest("tr").find(".cart_total .cart_total_price").text(total+"$");
			}else{
				$(this).closest("tr").remove();
				$.ajax({
		            method: "POST",
		            url: "{{ route('delete-cart') }}",
		            data: {
		                productId: productId,
		                quantity: newValue,
		                _token: "{{ csrf_token() }}"
		            },
		            success: function(response){
		                console.log('Sản phẩm đã được xóa thành công');
		            },
		            error: function(xhr, status, error) {
		                console.error('Lỗi khi xóa sản phẩm:', error);
		            }
		        });
			}	        
	   	});

	    $(".cart_quantity_delete").click(function(event){
	        event.preventDefault();
	        var productId = $(this).closest("tr").find(".cart_quantity_up").data('id'); // Lấy id của sản phẩm
	        var productRow = $(this).closest("tr");
	        var price=$(this).closest("tr").find(".cart_total .cart_total_price").text()
			    var pricee=parseFloat(price.replace("$", "")) 
	        // Gửi Ajax request để xóa sản phẩm
	        $.ajax({
	            method: "POST",
	            url: "{{ route('delete-cart') }}",
	            data: {
	                productId: productId,
	                _token: "{{ csrf_token() }}"
	            },
	            success: function(response){
	                console.log('Sản phẩm đã được xóa thành công');
	                productRow.remove();
	            },
	            error: function(xhr, status, error) {
	                console.error('Lỗi khi xóa sản phẩm:', error);
	            }
	        });

			    var total=$(".total_area span.aaa").text();
			    var totall=parseFloat(total);
			    	totall -= pricee;
			    $(".total_area span.aaa").text(totall+'$'); 
	    });
	});

	</script>
@endsection