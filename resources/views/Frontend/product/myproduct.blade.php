@extends('Frontend.layout.master')
@section('content')
    <div class="col-sm-9">
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="id">Id</td>
                        <td class="name">Name</td>
                        <td class="image">Image</td>
                        <td class="price">Price</td>
                        <td class="quantity">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $item)
                        @php
                            $getArrImage = json_decode($item->img, true);
                        @endphp
                        <tr>
                            <td class="cart_id">
                                <p>{{ $item->id }}</p>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{ $item->name }}</a></h4>
                            </td>
                            <td class="cart_product">
                                @if (isset($getArrImage[0]))
                                    <a href=""><img width="200px" src="{{ asset('upload/product/' . $getArrImage[0]) }}" alt=""></a>
                                @endif
                            </td>
                            <td class="cart_price">
                                <p>{{ $item->price }}</p>
                            </td>
                            <td class="cart_edit">
                                <a href="{{ url('Frontend/product/edit/' . $item->id) }}">
                                    <button type="button" class="btn btn-fefault cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Sửa
                                    </button>
                                </a>
                            </td>
                            <td class="cart_delete">
                                <a href="{{ url('Frontend/product/delete/' . $item->id) }}">
                                    <button type="button" class="btn btn-fefault cart">
                                        <i class="fa fa-shopping-cart"></i>
                                        Xóa
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8">
                            <a href="{{ route('addproduct') }}">
                                <button type="button" class="btn btn-fefault cart">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add New
                                </button>
                            </a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
