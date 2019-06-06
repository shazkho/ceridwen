{{--
    Shazkho'S CRUD Plugin - Index view
    ---------------------------------------
    Shows every register on database. It works but must be modified to fit your needs.
    REQUIRES LARAVEL COLLECTIVE TO WORK AS INTENDED.

    IMPORTANT:  This view MUST be called using "renderIndex" function con controller. It can
                obviously be called directly, just be careful, some variables are dinamically created.

    File version:   0.2
    Author:         GeorgeShazkho<shazkho@gmail.com>

--}}

@extends('layouts.base_layout')

@section('title', $title)

@section('content')

    <h1 class="mt-5 mb-4">
        Showing {{ $data->count() }} '{{ $name }}'.
        <a href="{{ route($name . '.create') }}" class="btn btn-outline-success btn-sm float-right">Create new</a>
    </h1>

    <table class="table table-sm">
        <thead>
        <tr>
        @foreach($columns as $columnName => $columnOptions)
            @if($columnOptions['show'])
                <th>{{ $columnOptions['alias'] }}</th>
            @endif
        @endforeach
            <th></th>
        </tr>
        </thead>
        <tbody>
        @if($data->count() == 0)
            <tr><td></td>
                <td><i>No register found.</i></td>
            </tr>
        @else
            @foreach($data as $row)
                <tr>
                    @foreach($columns as $columnName => $columnOptions)
                        @if($columnOptions['show'])
                            <td>{{ $row->$columnName }}</td>
                        @endif
                    @endforeach
                    <td>
                        {!! Form::open(['url' => route($name . '.destroy', [$row->id]), 'method' => 'DELETE']) !!}
                        <a href="{{ route($name . '.edit', [$row->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                        {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

@endsection
