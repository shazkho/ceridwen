{{--
    Shazkho'S CRUD Plugin - Index view
    ---------------------------------------
    Shows every register on database. It works but must be modified to fit your needs.
    REQUIRES LARAVEL COLLECTIVE TO WORK AS INTENDED.

    IMPORTANT:  This view MUST be called using "renderIndex" function con controller. It can
                obviously be called directly, just be careful, some variables are dinamically created.

    Plugin version:     0.2
    File version:       1.0
    Version date:       2019/06/03
    Laravel version:    5.8.*

--}}

@extends('layouts.base_layout')

@section('title', $title)

@section('content')

    <h1 class="mt-5 mb-4">Showing {{ $data->count() }} '{{ $resource }}'.</h1>

    <table class="table table-sm">
        <thead>
        <tr>
        @foreach($columns as $columnName => $columnAlias)
            @if($columnAlias !== null)
                <th>{{ $columnAlias }}</th>
            @endif
        @endforeach
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
                @foreach($columns as $columnName => $columnAlias)
                    @if($columnAlias !== null)
                        <td>{{ $row->$columnName }}</td>
                    @endif
                @endforeach
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

@endsection
