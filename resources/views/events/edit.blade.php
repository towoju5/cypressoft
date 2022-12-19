@extends('adminlte::page')

@section('title', 'Edit Event')

@section('content_header')
    <h3>{{ get_greetings() . auth()->user()->name }}</h3>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('error')
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit {{ $event->title }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('event.update', $event->id) }}" enctype="multipart/form-data" method="post"
                            id="eventForm">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="event_title">Event Title</label>
                                    <input type="text" value="{{ $event->title }}" name="event_title" id="event_title"
                                        class="form-control">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="event_title">Event User</label>
                                            <select name="user_id" id="user_id" class="form-control">
                                                <option value="" disabled selected> -- Select User --</option>
                                                <option @if ($event->user_id == 0) selected @endif value="0">
                                                    All Users </option>
                                                @foreach ($users as $k => $user)
                                                    <option @if ($event->user_id == $user->id) selected @endif
                                                        value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="event_image">Event Image</label>
                                            <input type="file" name="event_image" id="event_image"
                                                value="{{ $event->image }}" class="form-control">
                                            <div class="text-center" id="imgPreview">
                                                <img id="blah" height="80px" class="pt-2" src="{{ $event->image }}"
                                                    alt="your image" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="event_start">Event Start Date</label>
                                            <input type="date" name="event_start" value="{{ $event->start }}"
                                                id="event_start" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="event_end">Event End Date</label>
                                            <input type="date" name="event_end" value="{{ $event->end }}"
                                                id="event_end" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="event_description">Event Description</label>
                                    <textarea name="event_description" id="event_description" class="summernote">
                                        {{ $event->description }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
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
        $(document).ready(function() {
            $('.summernote').summernote({
                placeholder: 'Please Provide Event Description',
                tabsize: 2,
            });
            event_image.onchange = evt => {
                $("#imgPreview").show()
                const [file] = event_image.files
                if (file) {
                    blah.src = URL.createObjectURL(file)
                }
            }
        })


        $(".alert").delay(1000).slideUp(200, function() {
            $(this).alert('close');
        });
    </script>
@stop
