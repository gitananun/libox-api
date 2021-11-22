@extends('layouts.statistic')

@section('content')
    <table class="pure-table pure-table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Record</th>
                <th>Statisticable</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stats as $stat)
                <tr>
                    <td>{{ $stat->id }}</td>
                    <td>{{ $stat->type }}</td>
                    <td>{{ $stat->record }}</td>
                    <td>{{ $stat->statisticable_id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
