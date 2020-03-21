@extends('layouts.app')

@section('style')
<style>
    body {
        background-color: #eee;
    }
    .heading {
        background: url('../../img/bg-green.jpg') no-repeat;
        min-height: 200px;
        background-size: cover;
        background-position: center center;
    }
</style>
@endsection

@section('title-page')Edit Profile
@endsection

@section('content')
<main>
    <div class='container'>
        <div class="col-md-8 col-md-offset-2">
            <div id="alert-area">
            </div>
            {{--Edit Profile Form--}}
            @include('user.form');
        </div>
    </div>
</main>
@endsection