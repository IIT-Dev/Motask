@extends('layouts.app')

@section('style')
<style>
	body {
		background: url('../img/bg-post-project.jpg') center center/cover no-repeat fixed;
        width: 100%;
        left: 0;
        top: 0;
	}
	.bg-content {
        position: fixed;
        background-color: rgba(10,0,0,0.8);
        z-index: -1;
        height: 100%;
        width: 100%;
        left: 0;
        top: 0;
    }
    .heading h1 {
		color: #ffffff;
	}
</style>
@endsection

@section('title-page')Post Project
@endsection

@section('content')
<div class="bg-content"></div>
<div class="content-app">
	<div class="row no-margin">
		<div class="col-md-6 col-md-offset-3">
			<div class="card bg-transparent">
		  		<div class="card-block">
		    		<!-- Form Post Project -->
		    		@include('project.form')
		  		</div>
			</div>
		</div>
	</div>
</div>
@endsection
