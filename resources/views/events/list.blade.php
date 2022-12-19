@extends('adminlte::page')

@section('title', 'All Events')

@section('content_header')
    <h3>{{ get_greetings() . auth()->user()->name }}</h3>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            {{-- <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
            </div>
        </div> --}}

            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Upcoming Events</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-inverse">
                                <thead class="thead-inverse">
                                    <tr>
                                        <th>Event Title</th>
                                        <th>Event Slug</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $k => $event)
                                        <tr>
                                            <td>{{ $k+1 }}</td>
                                            <td>{{ $event->title }}</td>
                                            <td>
                                                <a href="{{ route('event.edit', $event->id) }}">
                                                    <button class="btn btn-primary btn-rounded">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </a>

                                                <a href="{{ route('event.delete', $event->id) }}">
                                                    <button class="ml-1 btn btn-danger btn-rounded">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
    </script>
@stop
