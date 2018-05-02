@extends('layouts.app')

@section('style')
<style>
    body {
        background-color: #eee;
    }
    .heading {
        background: url('../img/bg-green.jpg') no-repeat;
        min-height: 200px;
        background-size: cover;
        background-position: center center;
    }
</style>
@endsection

@section('title-page')
	Manage Users
@endsection

@section('content')
<main>
	<div class='container'>
		<div class="col-md-8 col-md-offset-2">
			<div id="alert-area">
			</div>
			<div class="col-md-6 col-md-offset-3">
				<form action="/admin" method="get">
					<div id="search-input">
						<div class="input-group">
							<input type="text" class="form-control" name="nim" placeholder="NIM Mahasiswa">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit" onsubmit=""><i class="fa fa-search"></i></button>
							</span>
						</div>
					</div>
				</form>
			</div><!-- /.col-lg-6 -->
			<div class="user-list">
				<table class="table table-hover">
				  	<tr>
					    <th>Email</th>
					    <th>Name</th> 
					    <th class="text-center">Role</th>
				  	</tr>
				  	@foreach($users as $user)
						<tr>
							<td><a href="/user/{{$user->id}}">{{$user->email}}</a></td>
							<td>{{$user->name}}</td> 
							<td class="text-center">
									<select id="change-role" data-id="{{$user->id}}" required>
										<option value="admin" {{ $user->role=='admin'? 'selected':''}}>Admin</option>
										<option value="project_manager" {{ $user->role=='project_manager'? 'selected':''}}>Project Manager</option>
										<option value="programmer" {{ $user->role=='programmer'? 'selected':''}}>Programmer</option>
									</select>
							</td>
						</tr>
					@endforeach
				</table>
			</div>
		</div>

	</div>
</main>
@endsection