<div class="col-sm-3">   
<div class="left-sidebar">
	<h2>Category</h2>
	<div class="panel-group category-products" id="accordian"><!--category-productsr-->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
						<span class="badge pull-right"><i class="fa fa-plus"></i></span>
						Sportswear
					</a>
				</h4>
			</div>
			<div id="sportswear" class="panel-collapse collapse">
				<div class="panel-body">
					<ul>
						<li><a href="#">Nike </a></li>
						<li><a href="#">Under Armour </a></li>
						<li><a href="#">Adidas </a></li>
						<li><a href="#">Puma</a></li>
						<li><a href="#">ASICS </a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordian" href="#mens">
						<span class="badge pull-right"><i class="fa fa-plus"></i></span>
						Mens
					</a>
				</h4>
			</div>
			<div id="mens" class="panel-collapse collapse">
				<div class="panel-body">
					<ul>
						<li><a href="#">Fendi</a></li>
						<li><a href="#">Guess</a></li>
						<li><a href="#">Valentino</a></li>
						<li><a href="#">Dior</a></li>
						<li><a href="#">Versace</a></li>
						<li><a href="#">Armani</a></li>
						<li><a href="#">Prada</a></li>
						<li><a href="#">Dolce and Gabbana</a></li>
						<li><a href="#">Chanel</a></li>
						<li><a href="#">Gucci</a></li>
					</ul>
				</div>
			</div>
		</div>
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordian" href="#womens">
						<span class="badge pull-right"><i class="fa fa-plus"></i></span>
						Womens
					</a>
				</h4>
			</div>
			<div id="womens" class="panel-collapse collapse">
				<div class="panel-body">
					<ul>
						<li><a href="#">Fendi</a></li>
						<li><a href="#">Guess</a></li>
						<li><a href="#">Valentino</a></li>
						<li><a href="#">Dior</a></li>
						<li><a href="#">Versace</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a href="#">Kids</a></h4>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a href="#">Fashion</a></h4>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a href="#">Households</a></h4>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a href="#">Interiors</a></h4>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a href="#">Clothing</a></h4>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a href="#">Bags</a></h4>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a href="#">Shoes</a></h4>
			</div>
		</div>
	</div><!--/category-products-->

	<div class="brands_products"><!--brands_products-->
		<h2>Brands</h2>
		<div class="brands-name">
			<ul class="nav nav-pills nav-stacked">
				<li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
				<li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
				<li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
				<li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
				<li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
				<li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
				<li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
			</ul>
		</div>
	</div><!--/brands_products-->
	
	<div class="price-range"><!--price-range-->
		<h2>Price Range</h2>
		<div class="well text-center">
			 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
			 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
		</div>
	</div><!--/price-range-->
	
	<div class="shipping text-center"><!--shipping-->
		<img src="{{ asset('frontend/images/home/shipping.jpg') }}" alt="" />
	</div><!--/shipping-->

</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
    $(".slider.slider-horizontal").on("click", function(clickEvt){
        var tooltip = $(".tooltip-inner").text();
        var values = tooltip.split(':');
        var minPrice = parseInt(values[0]);
        var maxPrice = parseInt(values[1]);
        console.log(minPrice, maxPrice);
        $.ajax({
            url: "{{ route('search-price') }}",
            method: 'GET',
            data: {
                minPrice: minPrice,
                maxPrice: maxPrice,
            },
            success: function(response) {
                // Xử lý kết quả từ server
                console.log(response);
                
                var html = "";
                response.products.forEach(function(item) {
                    var img = JSON.parse(item['img']);
                    var firstImage = img[0] ? img[0] : "noimg";
                    html += `
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href=""><img width="200px" src="{{ asset('upload/product/') }}/${firstImage}" alt=""></a>
                                        <h2>${item.price}</h2>
                                        <p>${item.name}</p>
                                        <a href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                    </div>
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>${item.price}</h2>
                                            <p>${item.name}</p>
                                            <a href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Xem sản phẩm</a>
                                            <a href="" id="${item.id}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    `;
                });
                $('.features_items').html(html); // Đặt nội dung vào phần tử hiển thị sản phẩm
            },
            error: function(error) {
                console.error(error);
            }
        });
    });
});


</script>
