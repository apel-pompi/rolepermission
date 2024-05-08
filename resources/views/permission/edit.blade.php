@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">{{__('Permission')}}</div><br>
					<div class="col-md-1"><a href="{{url('permission')}}" class="btn btn-info">Back</a></div>
					<form action="{{route('permission.update',$permission->id)}}" method="post">
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
								<input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{$permission->name}}">
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