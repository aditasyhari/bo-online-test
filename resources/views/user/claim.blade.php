@extends('layouts.main')

@section('title') Claim - Back Office @endsection

@section('css')
@endsection

@section('breadcrumb')
<div class="-intro-x breadcrumb mr-auto hidden sm:flex">
    <a href="javascript:;" class="">Application</a> 
    <i data-feather="chevron-right" class="breadcrumb__icon"></i> 
    <a href="javascript:;" class="breadcrumb">User</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i> 
    <a href="" class="breadcrumb--active">Claim</a>
</div>
@endsection

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Data Claim User
    </h2>
</div>

<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
    <table id="table-data" class="table table-report table-report--bordered display datatable w-full">
        <thead>
            <tr>
                <th class="border-b-2 text-center whitespace-no-wrap">#</th>
                <th class="border-b-2 whitespace-no-wrap">NAMA</th>
                <th class="border-b-2 whitespace-no-wrap">NO. WA</th>
                <th class="border-b-2 whitespace-no-wrap">EMAIL</th>
                <th class="border-b-2 whitespace-no-wrap">STATUS</th>
                <th class="border-b-2 whitespace-no-wrap">TOTAL</th>
                <th class="border-b-2 whitespace-no-wrap">BUKTI</th>
                <th class="border-b-2 whitespace-no-wrap"></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

@endsection

@section('js')
<script src="{{ asset('js/claim.js') }}"></script>
@endsection