{{--
    Shazkho'S CRUD Plugin - Create view
    ---------------------------------------
    Displays a form to create a single record. It works but must be modified to fit your needs.
    REQUIRES LARAVEL COLLECTIVE TO WORK AS INTENDED.

    IMPORTANT:  This view MUST be called using "renderCreate" function con controller. It can
                obviously be called directly, just be careful, some variables are dinamically created.

    Plugin version:     0.1
    File version:       1.0
    Version date:       2019/06/03
    Laravel version:    5.8.*

--}}

@extends('layouts.base_layout')

@section('title', $title)

@section('content')

    <h1 class="mt-5 mb-4">Creating a single '{{ $resource }}'.</h1>

    {!! Form::open(['url' => route($resource . '.store')]) !!}



    {!! Form::close() !!}

@endsection
