<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Điều chỉnh các thẻ head nếu cần -->
</head>
<body>
	@foreach($data['cart-product'] as $product)
   		<p>Tên sản phẩm: {{ $product['name'] }}</p>
        <p>Số lượng: {{ $product['qty'] }}</p>
        <p>Giá: {{ $product['price'] }}</p>
         
        <hr>
	@endforeach
</body>
</html>