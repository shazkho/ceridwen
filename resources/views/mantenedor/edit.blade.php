{{--
    Shazkho'S CRUD Plugin - Edit view
    ---------------------------------------
    Displays a form to edit an existing record. It works but must be modified to fit your needs.
    REQUIRES LARAVEL COLLECTIVE TO WORK AS INTENDED.

    IMPORTANT:  This view MUST be called using "renderEdit" function on controller. It can
                obviously be called directly, just be careful, some variables are dinamically created.

    File version:   0.1
    Author:         GeorgeShazkho<shazkho@gmail.com>

--}}

@extends('layouts.base_layout')

@section('title', $title)

@section('content')

    <h1 class="mt-5 mb-5">Editing entry in '{{ $name }}'.</h1>

    {!! Form::open(['url' => route($name . '.update', [$id]), 'method' => 'PUT']) !!}

    @foreach($columns as $columnName => $columnOptions)
        @if($columnOptions['writable'])
            <div class="form-group row">
                <label for="{{ $columnName }}" class="col-sm-2 col-form-label">{{ $columnOptions['alias'] }}</label>
                <div class="col-sm-6">
                    {{
                    call_user_func(
                    ['Form', $columnOptions['type']],
                    $columnName,
                    $data->$columnName,
                    ['class' => 'form-control'])
                    }}
                </div>
            </div>
        @endif
    @endforeach

    <div class="form-group row">
        <div class="col-sm-6 offset-sm-2">
            {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
        </div>
    </div>

    {!! Form::close() !!}

@endsection
