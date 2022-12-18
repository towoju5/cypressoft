@extends('adminlte::page')

@section('title', 'Dashboard')

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
                        <div class="row">
                            <form action="{{ route('event.post') }}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title">Add New Event</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="event_title">Event Title</label>
                                        <input type="text" name="event_title" id="event_title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="event_image">Event Image</label>
                                        <input type="file" name="event_image" id="event_image" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="event_start">Event Start Date</label>
                                        <input type="date" name="event_start" id="event_start" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="event_end">Event End Date</label>
                                        <input type="date" name="event_end" id="event_end" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="event_description">Event Description</label>
                                        <textarea name="event_description" id="event_description" class="summernote"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
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
    <script></script>
@stop
