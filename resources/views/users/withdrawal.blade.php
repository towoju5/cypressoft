@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1></h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}
                    <a class="btn btn-outline-primary btn-sm float-right" href="#" data-toggle="modal" data-taget="#withdrawal">New Withdrawal</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Ticket Subject</th>
                                    <th>Ticket Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
{{-- Modals --}}
<x-adminlte-modal id="withdrawal" title="Let's Get You Started with Your Funds Withdrawal" theme="purple" icon="fas fa-download" size='lg' disable-animations>
    <form>
        @csrf
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="row form-group">
                    <label class="col-md-3" for="amount">Withdrawal Amount</label>
                    <input type="number" name="amount" class="form-control col-md-9" id="amount">
                </div>
                <div class="row form-group mt-3">
                    <label class="col-md-3" for="amount">Select Wallet</label>
                    <select name="wallet_type" id="wallet_type" class="form-control col-md-9">
                        <option value="BTC">BTC</option>
                        <option value="ETH">ETH</option>
                    </select>
                </div>
                <div class="row form-group mt-3">
                    <label class="col-md-3" for="address">Wallet Address</label>
                    <input type="address" name="address" class="form-control col-md-9" id="address">
                </div>
                <div class="row form-group mt-5 justify-content-center">
                    <button type="submit" class="btn btn-outline-primary btn-xm">Process Withdrawal</button>
                </div>
            </div>
        </div>
    </form>
</x-adminlte-modal>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
</script>
@stop