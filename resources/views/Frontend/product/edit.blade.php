@extends('Frontend.layout.master')
@section('content')
    <div class="col-sm-3">
        <div class="left-sidebar">
            <h2>Account</h2>
            <div class="panel-group category-products" id="accordian">
                <!--category-productsr-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="#">account</a></h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title"><a href="{{ route('myproduct') }}">My product</a></h4>
                    </div>
                </div>
            </div>
            <!--/category-products-->
        </div>
    </div>
    <div class="col-sm-9">
        <div class="blog-post-area">
            <h2 class="title text-center">Create Products</h2>
            <div class="signup-form"><!--sign up form-->
                <h2>Update Product</h2>
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
                <form  method="POST">
                    @csrf
                    <input name="name" type="text" value="{{ $edit->name }}">
                    <input name="price" type="text" value="{{ $edit->price }}">
                    <select name="category" value="{{ $edit->category }}">
                        @foreach ($cate as $item)
                        
                            <option value="{{ $item->name }}">{{ $item->name }}</option>

                        @endforeach
                    </select>
                    <select name="brand" value="{{ $edit->brand }}">
                        @foreach ($brand as $item2)
                            <option value="{{ $item2->name }}">{{ $item2->name }}</option>
                        @endforeach
                    </select>
                    <select name="sale" id="sale">
                        <option value="0">New</option>
                        <option value="1">Sale</option>
                    </select>
                    <input id="selectsale" name="" type="text" placeholder="0">
                    <input type="file" name="img" value="{{ $edit->img }}">
                    <input name="detail" type="text" value="{{ $edit->detail }}">
                    <button type="submit" class="btn btn-default">Add Product</button>
                    
                </form>
            </div>
        </div>
    </div>


@endsection


