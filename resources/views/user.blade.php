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

@section('title-page')My Profile
@endsection

@section('content')
<main>
	<div class='container'>
		<div class="col-md-8 col-md-offset-2">
			<div id="alert-area">
			</div>
			{{--Profile--}}
			<div class="profile">
				<div class="card text-center">
					<div class="card-header mb-3 amber montserrat text-center" style="background-color:#323739">
						{{$user->name}}
					</div>
					<div class="card-block row">
						<div class="col-xs-6 col-md-6 profile-info">
							<div class="profile-title">
								<span class="card-title montserrat">Email</span>
							</div>
							<div class="profile-content">
								{{$user->email}}
							</div>
						</div>
						<div class="col-xs-6 col-md-6 profile-info">
							<div class="profile-title">
								<span class="card-title montserrat">Role</span>
							</div>
							<div class="profile-content">
								{{$user->role}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8 col-md-offset-2">
			<h3>{{$table_title}}</h3>
			<table class="table table-hover">
			  	<tr>
				    <th>Title</th>
				    <th>Deadline</th> 
				    <th>Status</th>
			  	</tr>
			  	@foreach($projects as $project)
					<tr>
						<td><a href="/project/{{$project->id}}">{{$project->title}}</a></td>
						<td>{{$project->deadline}}</td> 
						@if($user->role == 'programmer')
							<td>{{$project->status}}</td>
						@else
							<td>
								<select id="change-status" data-id="{{$project->id}}" required>
									<option value="Open" {{isset($project->status) && $project->status=='Open'? 'selected':''}}>Open</option>
									<option value="In Progress" {{isset($project->status) && $project->status=='In Progress'? 'selected':''}}>In Progress</option>
									<option value="Closed" {{isset($project->status) && $project->status=='Closed'? 'selected':''}}>Closed</option>
								</select>
							</td>
						@endif
					</tr>
				@endforeach
			</table>
		</div>
	</div>
</main>
@endsection