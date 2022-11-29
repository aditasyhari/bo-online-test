@extends('layouts.main')

@section('title') Valid E-Piagam - Back Office @endsection

@section('css')
@endsection

@section('breadcrumb')
<div class="-intro-x breadcrumb mr-auto hidden sm:flex">
    <a href="javascript:;" class="">Application</a> 
    <i data-feather="chevron-right" class="breadcrumb__icon"></i> 
    <a href="javascript:;" class="breadcrumb">User</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i> 
    <a href="" class="breadcrumb">Claim</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i> 
    <a href="" class="breadcrumb--active">Valid Claim Paket</a>
</div>
@endsection

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Data Valid Claim (SEMUA PAKET)
    </h2>
</div>
<!-- <div class="grid grid-rows-1 grid-flow-col gap-4">
    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-1 text-white"> <i data-feather="info" class="w-6 h-6 mr-2"></i><span id="total-valid"> 0 Data Valid (Rp 0) </span></div>
    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-6 text-white"> <i data-feather="info" class="w-6 h-6 mr-2"></i><span id="total-reject"> 0 Data Reject </span></div>
    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-7 text-white"> <i data-feather="info" class="w-6 h-6 mr-2"></i><span id="total-pending"> 0 Data Pending (Rp 0) </span></div>
</div> -->
<div class="mt-5 grid grid-cols-4 gap-4">
    <select class="select2 select-filter-grub" id="select-filter-grub">
        <option selected value="">Semua Grub</option>
        <option value="7">SD</option>
        <option value="5">SMP</option>
        <option value="6">SMA</option>
    </select>
    <select class="select2 select-filter-propinsi" id="select-filter-propinsi">
        <option selected value="">Semua Provinsi</option>
        @foreach($propinsi as $p)
            <option value="{{ $p->id_propinsi }}">{{ $p->nama_propinsi }}</option>
        @endforeach
    </select>
    <select class="select2 select-filter-paket" id="select-filter-paket">
        <option selected value="">Semua Paket</option>
        <option value="a">A - E-Piagam Penghargaan</option>
        <option value="b">B - Piagam Penghargaan dan Sertifikat Cetak</option>
        <option value="c">C - Piagam & Sertifikat Cetak + Medali</option>
        <option value="d">D - E-Piagam + Piagam & Sertifikat Cetak + Medali</option>
        <option value="bonus">BONUS - E-Piagam + Piagam & Sertifikat Cetak + Medali + Kaos + Topi + Tote Bag</option>
    </select>
    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 text-white"></div>
</div>
<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
    <table id="table-data" class="table table-report table-report--bordered display datatable w-full">
        <thead>
            <tr>
                <th class="border-b-2 whitespace-no-wrap">PAKET</th>
                <th class="border-b-2 whitespace-no-wrap">OLIMPIADE</th>
                <th class="border-b-2 whitespace-no-wrap">NAMA</th>
                <th class="border-b-2 whitespace-no-wrap">WA</th>
                <th class="border-b-2 whitespace-no-wrap">ALAMAT</th>
                <th class="border-b-2 whitespace-no-wrap">GRUB</th>
                <th class="border-b-2 whitespace-no-wrap">SEKOLAH</th>
                <th class="border-b-2 whitespace-no-wrap">PROVINSI</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

@endsection

@section('js')
<script src="{{ asset('js/claim-paket.js'. '?time=' . date("Ymdhisu")) }}"></script>
@endsection