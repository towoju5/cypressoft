@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h3>{{ get_greetings() . auth()->user()->name }}</h3>
@stop

@section('content')
    <div class="container">
        @include('error')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Upcoming Events</h3>
                    </div>
                    <div class="card-body">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- // modal --}}

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <form action="{{ route('event.post') }}" enctype="multipart/form-data" method="post" id="eventForm">
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
                            <label for="event_title">Event User</label>
                            <select name="user_id" id="user_id" class="form-control">
                                <option value="" disabled selected> -- Select User -- </option>
                                <option value="0"> All Users </option>
                                @foreach ($users as $k => $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="event_image">Event Image</label>
                            <input type="file" name="event_image" id="event_image" class="form-control">
                            <div class="text-center" id="imgPreview" style="display:none">
                                <img id="blah" height="80px" class="pt-2" src="#" alt="your image" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="event_start">Event Start Date</label>
                                    <input type="date" name="event_start" id="event_start" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="event_end">Event End Date</label>
                                    <input type="date" name="event_end" id="event_end" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div id="eventId" hidden>
                            <input type="hidden" name="event_id" value="" id="event_id">
                        </div>
                        <div class="form-group">
                            <label for="event_description">Event Description</label>
                            <textarea name="event_description" id="event_description" class="summernote"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="option" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">What will you like to do?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <button class="btn btn-primary btn-rounded">
                            <i class="fa fa-edit"></i>
                        </button>

                        <button onclick="delete" class="ml-1 btn btn-danger btn-rounded">
                            <i class="fa fa-trash"></i>
                        </button>
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
        $("#delete_event").hide();
        $("#imgPreview").hide()
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar')
            const calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'dayGridMonth,timeGridWeek,timeGridDay, AddEvent',
                    center: 'title',
                    right: 'prevYear,prev,next,nextYear'
                },
                customButtons: {
                    AddEvent: {
                        text: 'Add Event',
                        click: function() {
                            $("#imgPreview").hide()
                            $('#eventForm').trigger("reset")
                            $("#modelId").modal('show');
                        }
                    },
                },
                events: <?= $events ?>,
                eventClick: function(info) {
                    const data = info.event
                    console.log(data)
                    $("#event_title").val(data.title)
                    $("#event_start").val(data.start)
                    $("#event_end").val(data.end)
                    $("#event_id").val(data.id)
                    $("#imgPreview").show()
                    $("#blah").attr('src', data.extendedProps.image)
                    $("#event_description").val(data.extendedProps.event_description)
                    $("#delete_event").show();
                    $("#option").modal('show');
                },
            })
            calendar.render()
        })
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

        $(".alert").delay(1000).slideUp(200, function() {
            $(this).alert('close');
        });
    </script>
@stop
