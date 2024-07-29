@extends('Frontend.layout.master')
@section('content')

<div class="col-sm-4">
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
</div>
@endsection