{{--
    Shazkho'S CRUD Plugin - Create view
    ---------------------------------------
    Displays a form to create a single record. It works but must be modified to fit your needs.
    REQUIRES LARAVEL COLLECTIVE TO WORK AS INTENDED.

    IMPORTANT:  This view MUST be called using "renderCreate" function con controller. It can
                obviously be called directly, just be careful, some variables are dinamically created.

    File version:   0.2
    Author:         GeorgeShazkho<shazkho@gmail.com>

--}}

@extends('layouts.base_layout')

@section('title', $title)

@section('content')

    <h1 class="mt-5 mb-5">Creating new entry in '{{ $name }}'.</h1>

    {!! Form::open(['url' => route($name . '.store')]) !!}

    @foreach($columns as $columnName => $columnOptions)
        @if($columnOptions['writable'])
            <div class="form-group row">
                <label for="{{ $columnName }}" class="col-sm-2 col-form-label">{{ $columnOptions['alias'] }}</label>
                <div class="col-sm-6">
                    {{ call_user_func(['Form', $columnOptions['type']], $columnName, null, ['class' => 'form-control']) }}
                </div>
            </div>
        @endif
    @endforeach

    <div class="form-group row">
        <div class="col-sm-6 offset-sm-2">
            {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
        </div>
    </div>

    {!! Form::close() !!}

@endsection
