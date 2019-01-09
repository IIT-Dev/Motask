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
                            <h4 class="montserrat">Project Manager</h4>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-2">
                            <span class="fa-stack fa-3x icon-details">
                                <i class="fa fa-square-o fa-stack-2x"></i>
                                <i class="fa fa-user fa-stack-1x"></i>
                            </span> 
                        </div>
                        <div class="col-md-offset-1 col-lg-offset-0 col-md-9 col-lg-10">
                            <h6></h6>
                            <div class="bg-details bg-dark-grey amber">
                                @if ($project->manpro_id == null)
                                    <h5>There's no PM yet</h5>
                                @else
                                    <h5>{{$manpro->name}}</h5> 
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-justify">
                            <h4 class="montserrat">Description</h4>
                            <h5 class="dark-grey">
                                <?php echo nl2br($project->specification_desc); ?>
                            </h5>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12 text-justify">
                            <h4 class="montserrat">Contact Us</h4>
                            <h5 class="dark-grey">
                                Feel free to contact us if you are interested to get details of the project.
                                <br><b><i class="fa fa-envelope"></i>
                                @if ($project->manpro_id == null)
                                    {{$project->created_by}}
                                @else
                                    {{$manpro->email}}
                                @endif </b>
                            </h5>
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
                        <a href="/project/{{$project->id}}/apply" class="btn btn-primary blue motask-button btn-lg">
                            <span class="fa fa-plus fa-lg" aria-hidden="true"></span> Apply Project
                        </a>
                        <!-- Take As PM Button -->
                        @can('takeAsPM', $project)
                            @if ($project->manpro_id == null)
                                <button type="submit" class="btn btn-primary lightblue motask-button btn-lg">
                                    <span class="fa fa-plus fa-lg" aria-hidden="true"></span> Take As PM
                                </button>
                            @else
                                <button type="submit" class="btn btn-primary lightblue motask-button btn-lg" disabled>
                                    <span class="fa fa-plus fa-lg" aria-hidden="true"></span> Take As PM
                                </button>
                            @endif
                        
                        @endcan
                    </div>
                    <br><br>
                    <!-- List of Applicants -->
                    @if ($applicants != null)
                        @if ($applicants == 'None')
                            <h3>No applicants yet</h3>
                        @else
                            <div class="col-md-8 col-md-offset-2">
                                <h2>List of Applicants</h2>
                                <h5>click the name to check profile</h5>
                                <table class="table table-hover">
                                    <tr>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Motive</th>
                                        <th>Questions</th>
                                    </tr>
                                    @foreach($applicants as $ap)
                                        <tr>
                                            <td>{{date('j M y - g.i', strtotime($ap->created_at))}}</td>
                                            <td><a href="{{url('/user/'.$ap->applicant_id)}}">{{$ap->applicant_name}}</a></td>
                                            <td>{{$ap->motive}}</td>
                                            <td>{{$ap->questions}}</td>
                                        </tr>
                                    @endforeach
                                </table>                            
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
@endsection