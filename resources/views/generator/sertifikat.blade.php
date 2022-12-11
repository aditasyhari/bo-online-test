@extends('layouts.main')

@section('title') Generator Sertifikat - Back Office @endsection

@section('css')
@endsection

@section('breadcrumb')
<div class="-intro-x breadcrumb mr-auto hidden sm:flex">
    <a href="javascript:;" class="">Application</a> 
    <i data-feather="chevron-right" class="breadcrumb__icon"></i> 
    <a href="javascript:;" class="breadcrumb">Generator</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i> 
    <a href="" class="breadcrumb--active">Sertifikat</a>
</div>
@endsection

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Generate Sertifikat
    </h2>
</div>

<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y box col-span-12 lg:col-span-6 p-5">
        <form id="form-generate">
            <div class="grid grid-cols-1 gap-4 row-gap-5 mt-5">
                <div class="intro-y">
                    <div class="mb-2">Nama</div>
                    <input type="text" class="input w-full border flex-1" name="nama" id="nama" placeholder="Nama Lengkap" required>
                </div>
            </div>
            <div class="intro-y col-span-12 sm:col-span-3 mt-3">
                <div class="mb-2">Pilih Olimpiade</div>
                <select class="select2 w-full" id="olimpiade" name="olimpiade" required>
                    <option disabled selected>Pilih</option>
                    <option value="Indonesian Subject">Indonesian</option>
                    <option value="English Subject">English</option>
                    <option value="Mathematics Subject">Mathematics</option>
                    <option value="Biology Subject">Biology</option>
                    <option value="Chemistry Subject">Chemistry</option>
                    <option value="Physics Subject">Physics</option>
                    <option value="History Subject">History</option>
                    <option value="Geography Subject">Geography</option>
                    <option value="Economy Subject">Economy</option>
                    <option value="Sociology Subject">Sociology</option>
                    <option value="Natural Sciences Subject">Natural Sciences</option>
                    <option value="Social Sciences Subject">Social Sciences</option>
                </select>
            </div>
            <button type="submit" id="btn-generate" class="button bg-theme-1 text-white mt-5">Generate</button>
        </form>
    </div>
    <div class="intro-y box col-span-12 lg:col-span-6 p-5" id="result-generate">
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-1 text-white"> <i data-feather="info" class="w-6 h-6 mr-2"></i><span id="total-valid"> Hasil Generate Disini </span></div>
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('js/generate-sertifikat.js'. '?time=' . date("Ymdhisu")) }}"></script>
@endsection