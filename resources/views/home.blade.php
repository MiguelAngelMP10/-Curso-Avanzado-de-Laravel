@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                        <table class="table table-light border">
                            <tbody>
                                @foreach ($rating as $fila )
                                <tr>
                                    <td>{{ $fila->id }}</td>
                                    <td>{{ $fila->score }}</td>
                                    <td>{{ $fila->rateable_type }}</td>
                                    <td>{{ $fila->rateable_id }}</td>
                                    <td>{{ $fila->qualifier_type }}</td>
                                    <td>{{ $fila->qualifier_id }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
