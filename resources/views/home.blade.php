@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h3>{{ get_greetings(). auth()->user()->name }}</h3>
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
                        <div class="col-md-6">
                            //
                        </div>
                        <div class="col-md-6">
                            //
                        </div>
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