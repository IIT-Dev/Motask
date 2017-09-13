@extends('layouts.app')

@section('style')
<style>
    .heading {
        background: url('../img/bg-project-specification.jpg') no-repeat;
        min-height: 480px;
        background-size: cover;
        background-position: top center;
    }
</style>
@endsection

@section('title-page')Project Specification
@endsection

@section('content')
<main>
    <div class="bg-orange content-specification">
        <div class="container lg-padding">
            <div class="row">
                <div class="form-group details">
                    <h2 class="h2-sm montserrat text-center">{{$project->title}}</h2>
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <span class="fa-stack fa-3x icon-details">
                                <i class="fa fa-square-o fa-stack-2x"></i>
                                <i class="fa fa-tags fa-stack-1x "></i>
                            </span> 
                            <h6>Category</h6>
                            <div class="bg-details bg-dark-grey amber">
                                <h5>{{$project->category}}</h5>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <span class="fa-stack fa-3x icon-details">
                                <i class="fa fa-square-o fa-stack-2x"></i>
                                <i class="fa fa-hourglass-half fa-stack-1x"></i>
                            </span> 
                            <h6>Deadline</h6>
                            <div class="bg-details bg-dark-grey amber">
                                <h5>{{date('j F Y', strtotime($project->deadline))}}</h5>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <span class="fa-stack fa-3x icon-details">
                                <i class="fa fa-square-o fa-stack-2x"></i>
                                <i class="fa fa-users fa-stack-1x"></i>
                            </span> 
                            <h6>Programmers</h6>
                            <div class="bg-details bg-dark-grey amber">
                                <h5>{{$project->total_programmer}}</h5>
                            </div>
                        </div>
                        <div class="col-md-3 text-center">
                            <span class="fa-stack fa-3x icon-details">
                                <i class="fa fa-square-o fa-stack-2x"></i>
                                <i class="fa fa-dollar fa-stack-1x"></i>
                            </span> 
                            <h6>Budget</h6>
                            <div class="bg-details bg-dark-grey amber">
                                <h5>{{$project->budget}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-justify">
                            <h4 class="montserrat">Description</h4>
                            <h5><a class="dark-grey" href="{{$project->specification_url}}" target="_blank">{{$project->specification_url}}</a></h5>
                        </div>
                    </div>
                    <div class="row text-center">
                        <!-- Delete Button -->
                        @can('delete', $project)
                        <a class="btn btn-primary red motask-button btn-lg" onclick='deleteProject({{$project->id}})'>
                            <span class="fa fa-trash fa-lg" aria-hidden="true"></span> Delete Project
                        </a>
                        @endcan
                        <!-- Edit Button -->
                        @can('update', $project)
                        <a class="btn btn-primary orange motask-button btn-lg" href='/project/edit?id={{$project->id}}'>
                            <span class="fa fa-edit fa-lg" aria-hidden="true"></span> Edit Project
                        </a>
                        @endcan
                        <!-- Take Button -->
                        <button type="submit" class="btn btn-primary blue motask-button btn-lg">
                            <span class="fa fa-plus fa-lg" aria-hidden="true"></span> Take Project
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection