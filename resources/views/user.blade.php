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
				@if ($user->line == '-')
					<div id="alertdiv" class="alert alert-warning"><a class="close" data-dismiss="alert">×</a><span>Please fill in your Line ID before applying</span></div>
				@endif
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
					<div class="card-block row">
						<div class="col-xs-6 col-md-6 profile-info">
							<div class="profile-title">
								<span class="card-title montserrat">Line</span>
							</div>
							<div class="profile-content">
								{{$user->line}}
							</div>
						</div>
						<div class="col-xs-6 col-md-6 profile-info">
							<div class="profile-title">
								<span class="card-title montserrat">Phone</span>
							</div>
							<div class="profile-content">
								{{$user->phone}}
							</div>
						</div>
					</div>
					<div class="card-block row">
						<div class="col-xs-6 col-md-6 profile-info">
							<div class="profile-title">
								<span class="card-title montserrat">LinkedIn</span>
							</div>
							<div class="profile-content">
								{{$user->linkedin}}
							</div>
						</div>
						<div class="col-xs-6 col-md-6 profile-info">
							<div class="profile-title">
								<span class="card-title montserrat">Git</span>
							</div>
							<div class="profile-content">
								{{$user->git}}
							</div>
						</div>
					</div>
				</div>
				<div>
					<center><a href="{{url('/user/'.Auth::user()->id).'/edit'}}" class="btn btn-primary dark-grey motask-button">Edit Profile</a></center>
				</div>
			</div>
		</div>
		@if($user->role!= 'programmer')
			<div class="col-md-8 col-md-offset-2">
				<h3>Opened Projects</h3>
				@if($projectsOpened->isEmpty())
					<h5><i>You don't have any Opened Projects</i></h5><br>
				@else
				<h5>(Open the project detail page to see list of applicants)</h5>
				<table class="table table-hover">
					<tr>
						<th>Title</th>
						<th></th>
						<th>Status</th>
						<th>Applicants</th>
						<th>Notes</th>
					</tr>
					@foreach($projectsOpened as $project)
						<tr>
							<td><a href="/project/{{$project->id}}">{{$project->title}}</a></td>
							<td>
								<a href="/project/edit?id={{$project->id}}">
									<i class="fa fa-edit" aria-hidden="true"></i>&nbsp;
								</a>
							</td>
							<td>
								<select id="change-status" data-id="{{$project->id}}" required>
									<option value="Open" {{isset($project->status) && $project->status=='Open'? 'selected':''}}>Open</option>
									<option value="In Progress" {{isset($project->status) && $project->status=='In Progress'? 'selected':''}}>In Progress</option>
									<option value="Done" {{isset($project->status) && $project->status=='Done'? 'selected':''}}>Done</option>
									<option value="Canceled" {{isset($project->status) && $project->status=='Canceled'? 'selected':''}}>Canceled</option>
								</select>
							</td>
							<td>{{$project->applicants}}</td>
							<td>{{$project->notes}}</td>			
						</tr>
					@endforeach
				</table>
				@endif
			</div>
			<div class="col-md-8 col-md-offset-2">
			&nbsp;
				<h3>In Progress & Closed Projects</h3>
				@if($projectsUnOpened->isEmpty())
					<h5><i>You don't have any In Progress or Closed Projects</i></h5><br>
				@else
				<table class="table table-hover">
					<tr>
						<th>Title</th>
						<th></th>
						<th>Status</th>
						<th>Programmers</th>
						<th>Notes</th>		
					</tr>
					@foreach($projectsUnOpened as $project)
						<tr>
							<td><a href="/project/{{$project->id}}">{{$project->title}}</a></td>
							<td>
								<a href="/project/edit?id={{$project->id}}">
									<i class="fa fa-edit" aria-hidden="true"></i>&nbsp;
								</a>
							</td>
							<td>
								<select id="change-status" data-id="{{$project->id}}" required>
									<option value="Open" {{isset($project->status) && $project->status=='Open'? 'selected':''}}>Open</option>
									<option value="In Progress" {{isset($project->status) && $project->status=='In Progress'? 'selected':''}}>In Progress</option>
									<option value="Done" {{isset($project->status) && $project->status=='Done'? 'selected':''}}>Done</option>
									<option value="Canceled" {{isset($project->status) && $project->status=='Canceled'? 'selected':''}}>Canceled</option>
								</select>
							</td>
							<td>{{$project->applicants}}</td>
							<td>{{$project->notes}}</td>			
						</tr>
					@endforeach
				</table>
				@endif
			</div>
		@endif
		<div class="col-md-8 col-md-offset-2">
		&nbsp;
			<h3>Applied Projects</h3>
			@if($applied->isEmpty())
				<h5><i>You haven't applied any projects yet.</i></h5>
			@else
				<table class="table table-hover">
					<tr>
					<th>Date</th>
					<th>Title</th>
					<th>Status</th>
					<th>Project Manager</th>
					<th>Questions</th>
					</tr>
					@foreach($applied as $app)
						<tr>
							<td>{{date('j M y - g.i', strtotime($app->created_at))}}</td>
							<td><a href="/project/{{$app->project_id}}">{{$app->project_title}}</a></td>
							<td>{{$app->status}}</td>
							<td>{{$app->manpro}}</td>
							<td>{{$app->questions}}</td>
						</tr>
					@endforeach
				</table>
			@endif
		</div>
	</div>
</main>
@endsection