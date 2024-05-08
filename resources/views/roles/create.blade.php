@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">{{__('Roles')}}</div><br>
					<div class="col-md-1"><a href="{{url('roles')}}" class="btn btn-info">Back</a></div>
					<form action="{{route('roles.store')}}" method="post">
						@csrf
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
								<input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
							</div>
							<div class="form-group">
								<label for="permission">Permission</label>
								@foreach($permission as $item)
								<p>
									<input type="checkbox" name="permissions[]" value="{{$item->id}}" id="permission_id_{{$item->id}}">
									<label for="permission_id_{{$item->id}}">{{$item->name}}</label>
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