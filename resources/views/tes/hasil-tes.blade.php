@extends('layouts.main')

@section('title') Hasil Tes - Back Office @endsection

@section('css')
@endsection

@section('breadcrumb')
<div class="-intro-x breadcrumb mr-auto hidden sm:flex">
    <a href="javascript:;" class="">Application</a> 
    <i data-feather="chevron-right" class="breadcrumb__icon"></i> 
    <a href="javascript:;" class="breadcrumb">Data Tes</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i> 
    <a href="" class="breadcrumb--active">Hasil Tes</a>
</div>
@endsection

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Hasil Tes <br>
        <small>Pilih mapel olimpiade terlebih dahulu.</small>
    </h2>
</div>
<!-- <div class="grid grid-rows-1 grid-flow-col gap-4">
    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-1 text-white"> <i data-feather="info" class="w-6 h-6 mr-2"></i><span id="total-valid"> 0 Data Valid (Rp 0) </span></div>
    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-6 text-white"> <i data-feather="info" class="w-6 h-6 mr-2"></i><span id="total-reject"> 0 Data Reject </span></div>
    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-7 text-white"> <i data-feather="info" class="w-6 h-6 mr-2"></i><span id="total-pending"> 0 Data Pending (Rp 0) </span></div>
</div> -->
<div class="mt-5">
    <!-- <div class="flex-none w-1/5">
        <button class="button w-100 inline-block bg-theme-1 text-white" onclick="exportExcel()">Export Excel</button>
    </div> -->
    <div class="">
        <select class="select2 select-filter-order" id="select-filter-order">
            <option value="" disabled>Urutkan</option>
            <option value="tertinggi" selected>Nilai Tertinggi</option>
            <option value="terendah">Nilai Terendah</option>
            <option value="nama">Nama</option>
        </select>
        <select class="select2 select-filter-tes" id="select-filter-tes">
            <option selected value="" disabled>Pilih Mapel Olimpiade</option>
            @foreach($tes as $t)
                <option value="{{ $t->tes_id }}">{{ $t->tes_nama }}</option>
            @endforeach
        </select>
        <button class="button w-100 inline-block bg-theme-5 text-white" id="btn-pilih" disabled>Tampilkan</button>
    </div>
    <div class="flex-none w-1/5 mr-3">
    </div>
</div>

<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
    <table id="table-data" class="table table-report table-report--bordered display datatable w-full">
        <thead>
            <tr>
                <th class="border-b-2 whitespace-no-wrap">OLIMPIADE</th>
                <th class="border-b-2 whitespace-no-wrap">NAMA</th>
                <th class="border-b-2 whitespace-no-wrap">NO.HP</th>
                <th class="border-b-2 whitespace-no-wrap">SEKOLAH</th>
                <th class="border-b-2 whitespace-no-wrap">KOTA/KAB</th>
                <th class="border-b-2 whitespace-no-wrap">PROVINSI</th>
                <th class="border-b-2 whitespace-no-wrap">NILAI</th>
                <th class="border-b-2 whitespace-no-wrap">MEDALI</th>
                <th class="border-b-2 whitespace-no-wrap">GRADE</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

@endsection

@section('js')
<script src="{{ asset('js/hasil-tes.js'. '?time=' . date("Ymdhisu")) }}"></script>
@endsection