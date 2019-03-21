@extends('include.header')
@section('content')

<div class="col-md-6 col-md-offset-3" style="padding-top: 150px;">
	<div class="panel panel-default">

		<div class="panel-heading">Register Member</div>
		<div class="panel-body">
			<form role="form" action="{{url('/doregis')}}" method="Post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			    <div class="form-group">
					<label for="exampleInputEmail1">Username</label>
					<input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Email address</label>
					<input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
				<a href="{{url('/login')}}" class="btn btn-default">Login</a>
			</form>
		</div>
	</div>
</div>
</div>

@endsection