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

@section('title-page')Projects
@endsection

@section('content')

    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-justified montserrat" role="tablist">
        <li role="presentation" class="active">
            <a href="#website" aria-controls="website" role="tab" data-toggle="tab">
                <i class="fa fa-html5 fa-lg" aria-hidden="true"></i>&nbsp; Website
            </a>
        </li>
        <li role="presentation">
            <a href="#mobile" aria-controls="mobile" role="tab" data-toggle="tab">
                <i class="fa fa-mobile fa-lg" aria-hidden="true"></i>&nbsp; Mobile
            </a>
        </li>
        <li role="presentation">
            <a href="#desktop" aria-controls="desktop" role="tab" data-toggle="tab">
                <i class="fa fa-desktop fa-lg" aria-hidden="true"></i>&nbsp; Desktop
            </a>
        </li>
        <li role="presentation">
            <a href="#others" aria-controls="others" role="tab" data-toggle="tab">
                <i class="fa fa-ellipsis-h fa-lg" aria-hidden="true"></i>&nbsp; Others
            </a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Tab Website -->
        <div role="tabpanel" class="tab-pane fade in active" id="website">
            <!-- Card -->
            <div class="container">
                <div class="row">
                    @if(count($projects) == 0)
                        <div class="text-center">
                            <img src="../img/stitch.png" style="width:220px"/>
                            <h1 class="oswald">Sorry, no available projects !!</h1>
                        </div>
                    @else
                        @foreach($projects as $project)
                            <div class="col-sm-4">
                                <div class="card text-center">
                                    <div class="card-head bg-black-grey amber montserrat">
                                        <h6>Project Deadline</h6>
                                    </div>
                                    <div class="card-header mb-3 amber montserrat text-center" style="background-color:#323739">
                                        <h5>{{date('M', strtotime($project->deadline))}}</h5>
                                        <h1 style="font-size: 3.5rem">{{date('j', strtotime($project->deadline))}}</h1>
                                        <h5>{{date('Y', strtotime($project->deadline))}}</h5>
                                    </div>    
                                    <div class="card-block">
                                        <h3 class="card-title montserrat">{{$project->title}}</h3>
                                        <h6 class="text-left">
                                            <span class="fa-stack fa-lg">
                                                <i class="fa fa-circle fa-stack-2x amber"></i>
                                                <i class="fa fa-user fa-stack-1x"></i>
                                            </span> Graciel
                                        </h6>
                                        <h6 class="text-left" style="line-height: 1.5">Proyek ini membutuhkan 
                                            <span style="font-weight:600;font-size: 1.2rem">{{$project->total_programmer}}</span> 
                                            orang programmer
                                        </h6>
                                        <a href="/project/{{$project->id}}" class="btn btn-primary dark-grey motask-button">Read More</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <!-- Tab Mobile -->
        <div role="tabpanel" class="tab-pane fade" id="mobile">
            <!-- Card -->
            <div class="container">
                <div class="row">
                    @if(count($projects) == 0)
                        <div class="text-center">
                            <img src="../img/stitch.png" style="width:220px"/>
                            <h1 class="oswald">Sorry, no available projects !!</h1>
                        </div>
                    @else
                        @foreach($projects as $project)
                            <div class="col-sm-4">
                                <div class="card text-center">
                                    <div class="card-head bg-black-grey amber montserrat">
                                        <h6>Project Deadline</h6>
                                    </div>
                                    <div class="card-header mb-3 amber montserrat text-center" style="background-color:#323739">
                                        <h5>{{date('M', strtotime($project->deadline))}}</h5>
                                        <h1 style="font-size: 3.5rem">{{date('j', strtotime($project->deadline))}}</h1>
                                        <h5>{{date('Y', strtotime($project->deadline))}}</h5>
                                    </div>    
                                    <div class="card-block">
                                        <h3 class="card-title montserrat">{{$project->title}}</h3>
                                        <h6 class="text-left">
                                            <span class="fa-stack fa-lg">
                                                <i class="fa fa-circle fa-stack-2x amber"></i>
                                                <i class="fa fa-user fa-stack-1x"></i>
                                            </span> Graciel
                                        </h6>
                                        <h6 class="text-left" style="line-height: 1.5">Proyek ini membutuhkan 
                                            <span style="font-weight:600;font-size: 1.2rem">{{$project->total_programmer}}</span> 
                                            orang programmer
                                        </h6>
                                        <a href="/project/{{$project->id}}" class="btn btn-primary dark-grey motask-button">Read More</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <!-- Tab Desktop -->
        <div role="tabpanel" class="tab-pane fade" id="desktop">
            <!-- Card -->
            <div class="container">
                <div class="row">
                    @if(count($projects) == 0)
                        <div class="text-center">
                            <img src="../img/stitch.png" style="width:220px"/>
                            <h1 class="oswald">Sorry, no available projects !!</h1>
                        </div>
                    @else
                        @foreach($projects as $project)
                            <div class="col-sm-4">
                                <div class="card text-center">
                                    <div class="card-head bg-black-grey amber montserrat">
                                        <h6>Project Deadline</h6>
                                    </div>
                                    <div class="card-header mb-3 amber montserrat text-center" style="background-color:#323739">
                                        <h5>{{date('M', strtotime($project->deadline))}}</h5>
                                        <h1 style="font-size: 3.5rem">{{date('j', strtotime($project->deadline))}}</h1>
                                        <h5>{{date('Y', strtotime($project->deadline))}}</h5>
                                    </div>    
                                    <div class="card-block">
                                        <h3 class="card-title montserrat">{{$project->title}}</h3>
                                        <h6 class="text-left">
                                            <span class="fa-stack fa-lg">
                                                <i class="fa fa-circle fa-stack-2x amber"></i>
                                                <i class="fa fa-user fa-stack-1x"></i>
                                            </span> Graciel
                                        </h6>
                                        <h6 class="text-left" style="line-height: 1.5">Proyek ini membutuhkan 
                                            <span style="font-weight:600;font-size: 1.2rem">{{$project->total_programmer}}</span> 
                                            orang programmer
                                        </h6>
                                        <a href="/project/{{$project->id}}" class="btn btn-primary dark-grey motask-button">Read More</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <!-- Tab Others -->
        <div role="tabpanel" class="tab-pane fade" id="others">
            <!-- Card -->
            <div class="container">
                <div class="row">
                    @if(count($projects) == 0)
                        <div class="text-center">
                            <img src="../img/stitch.png" style="width:220px"/>
                            <h1 class="oswald">Sorry, no available projects !!</h1>
                        </div>
                    @else
                        @foreach($projects as $project)
                            <div class="col-sm-4">
                                <div class="card text-center">
                                    <div class="card-head bg-black-grey amber montserrat">
                                        <h6>Project Deadline</h6>
                                    </div>
                                    <div class="card-header mb-3 amber montserrat text-center" style="background-color:#323739">
                                        <h5>{{date('M', strtotime($project->deadline))}}</h5>
                                        <h1 style="font-size: 3.5rem">{{date('j', strtotime($project->deadline))}}</h1>
                                        <h5>{{date('Y', strtotime($project->deadline))}}</h5>
                                    </div>    
                                    <div class="card-block">
                                        <h3 class="card-title montserrat">{{$project->title}}</h3>
                                        <h6 class="text-left">
                                            <span class="fa-stack fa-lg">
                                                <i class="fa fa-circle fa-stack-2x amber"></i>
                                                <i class="fa fa-user fa-stack-1x"></i>
                                            </span> Graciel
                                        </h6>
                                        <h6 class="text-left" style="line-height: 1.5">Proyek ini membutuhkan 
                                            <span style="font-weight:600;font-size: 1.2rem">{{$project->total_programmer}}</span> 
                                            orang programmer
                                        </h6>
                                        <a href="/project/{{$project->id}}" class="btn btn-primary dark-grey motask-button">Read More</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection