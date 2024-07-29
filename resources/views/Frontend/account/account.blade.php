@extends('Frontend.layout.master')
@section('content')
	<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Account</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							
							
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
							
						</div><!--/category-products-->
					
						
					</div>

				</div>
				
				<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Update user</h2>
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
						<form action="#" method="POST">
							@csrf
							<input name="name" type="text" placeholder="Name" value="{{Auth::user()->name;}}" >
							<input name="email" type="email" placeholder="Email Address" value="{{Auth::user()->email;}}" >
							<input name="password" type="password" placeholder="Password" value="{{Auth::user()->password;}}">
							<input name="phone" type="text" placeholder="Phone" value="phone">
							 <input type="file" placeholder=" ">
							<button type="submit" class="btn btn-default">
							Signup</button>
						</form>
					</div>
					</div>
				</div>
@endsection