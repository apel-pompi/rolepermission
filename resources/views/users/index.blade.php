@extends('layouts.app')
@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">{{__('Users')}}</div>
					<div class="card-body">
						@session('success')
							<div class="alert alert-success" role="alert">
								{{$value}}
							</div>
						@endsession
						<a href="{{route('users.create')}}" class="btn btn-block btn-primary">Create</a>
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>Permission</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($user as $item)
								<tr>
									<td>{{$item->id}}</td>
									<td>{{$item->name}}</td>
									<td>
										<a href="{{route('users.edit',$item->id)}}" class="btn btn-block btn-primary">Edit</a>
										<a href="{{route('users.show',$item->id)}}" class="btn btn-block btn-success">Show</a>
										<form action="{{route('users.destroy',$item->id)}}" method="post">
											@csrf
											@METHOD('DELETE')
											<button class="btn btn-block btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
										</form>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection()