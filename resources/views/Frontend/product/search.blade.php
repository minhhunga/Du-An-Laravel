@extends('Frontend.layout.master')
@section('content')
	<h1>Kết quả tìm kiếm của: '{{ $search }}'</h1>
    <div class="features_items"><!--features_items-->
        <h2 class="title text-center">Features Items</h2>
        @php
            $foundProducts = false; // Biến đếm để kiểm tra xem có sản phẩm nào khớp với từ khóa tìm kiếm hay không
        @endphp

        @foreach($products as $item)
            @php
                $getArrImage = json_decode($item->img, true);
            @endphp

            @if (isset($getArrImage[0]))
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <a href=""><img width="200px" src="{{ asset('upload/product/' . $getArrImage[0]) }}" alt=""></a>
                                <h2>{{ $item->price }}</h2>
                                <p>{{ $item->name }}</p>
                                <a href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                            <div class="product-overlay">
                                <div class="overlay-content">
                                    <h2>{{ $item->price }}</h2>
                                    <p>{{ $item->name }}</p>
                                    <a href="{{ route('product.detail', ['id' => $item->id]) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Xem sản phẩm</a>
                                    <a href="" id="{{ $item->id }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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
                @php
                    $foundProducts = true; // Đặt biến đếm thành true khi có sản phẩm được tìm thấy
                @endphp
                
            @endif
        @endforeach
        @if (!$foundProducts)
            <div class="text-center">Không tìm thấy sản phẩm nào.</div>
        @endif
    </div><!--features_items-->
@endsection
