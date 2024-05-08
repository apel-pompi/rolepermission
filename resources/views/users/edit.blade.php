@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">{{__('Users')}}</div><br>
					<div class="col-md-1"><a href="{{url('users')}}" class="btn btn-info">Back</a></div>
					<form action="{{route('users.update',$user->id)}}" method="post">
						@csrf
						@METHOD('PUT')
						<div class="card-body">
							<div class="form-group">
								@if($errors->any())
									<div class="alert alert-danger">Error<br>
										<ul>
											@foreach($errors->all() as $error)
											   <li>{{$error}}</li>
											@endforeach()
										</ul>
									</div>
								@endif
							</div>
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{$user->name}}">
							</div>
							<div class="form-group">
								<label for="name">Email</label>
								<input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" value="{{$user->email}}">
							</div>
							<div class="form-group">
								<label for="name">Password</label>
								<input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
							</div>
							<div class="form-group">
								<label for="permission">Roles</label>
								@foreach($roles as $item)
								<p>
									<input type="checkbox" name="roles[]" value="{{$item->name}}" id="roles_id_{{$item->id}}" class="form-input-check" {{$user->hasRole($item->name) ? 'checked' : ''}}>
									<label for="roles_id_{{$item->id}}">{{$item->name}}</label>
								</p>
								@endforeach
							</div>
						</div>
						<div class="card-footer">
							<input type="submit" class="btn btn-primary" value="Save">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection()