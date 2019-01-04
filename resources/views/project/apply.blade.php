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

@section('title-page')Apply Project
@endsection

@section('content')
<div class="bg-content"></div>
<div class="content-app">
	<div class="row no-margin">
		<div class="col-md-6 col-md-offset-3">
			<div class="card bg-transparent">
		  		<div class="card-block">
		    		<!-- Form Apply Project -->
		    		<form action="" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="row row-form">
                                <div class="col-md-12">
                                    <textarea onkeyup="AutoGrowTextArea(this)" style="overflow:hidden" class="form-control motask-input" name="motive" value='{{isset($project->specification_desc)? $project->specification_desc:""}}' required placeholder="Motive*"></textarea>
                                </div>
                            </div>
                            
                            <div class="row row-form">
                                <div class="col-md-12">
                                    <textarea onkeyup="AutoGrowTextArea(this)" style="overflow:hidden" class="form-control motask-input" name="questions" value='{{isset($project->specification_desc)? $project->specification_desc:""}}' required placeholder="Question*"></textarea>
                                </div>
                            </div>
                            {{-- <center><button type="submit" class="btn btn-primary transparent motask-button btn-lg">
                                <i class="fa fa-paper-plane" aria-hidden="true"></i> {{$action=='create'? 'Post Project':'Update Project'}}
                            </button></center> --}}
                        </div>
                    </form>
		  		</div>
			</div>
		</div>
	</div>
</div>
@endsection