@extends('layouts.main')

@section('title') Generator E-Piagam - Back Office @endsection

@section('css')
@endsection

@section('breadcrumb')
<div class="-intro-x breadcrumb mr-auto hidden sm:flex">
    <a href="javascript:;" class="">Application</a> 
    <i data-feather="chevron-right" class="breadcrumb__icon"></i> 
    <a href="javascript:;" class="breadcrumb">Generator</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i> 
    <a href="" class="breadcrumb--active">Piagam</a>
</div>
@endsection

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Generate Piagam
    </h2>
</div>

<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y box col-span-12 lg:col-span-6 p-5">
        <form id="form-generate">
            <div class="grid grid-cols-1 gap-4 row-gap-5 mt-5">
                <div class="intro-y col-span-12 sm:col-span-3">
                    <div class="mb-2">Pilih Medali</div>
                    <select class="select2 w-full" id="medali" name="medali" required>
                        <option disabled selected>Pilih</option>
                        <option value="gold">Gold</option>
                        <option value="silver">Silver</option>
                        <option value="perunggu">Perunggu</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 row-gap-5 mt-5">
                <div class="intro-y col-span-12 sm:col-span-3">
                    <div class="mb-2">Pilih Nomor</div>
                    <select class="select2 w-full" id="nomor" name="nomor" required>
                        <option selected disabled>Pilih</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 row-gap-5 mt-5">
                <div class="intro-y col-span-12 sm:col-span-3">
                    <div class="mb-2">Pilih Provinsi</div>
                    <select class="select2 w-full" id="propinsi" name="propinsi" required>
                        <option selected disabled>Pilih</option>
                        @foreach($propinsi as $p)
                            <option value="{{ $p->nama_propinsi }}">{{ $p->nama_propinsi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 row-gap-5 mt-5">
                <div class="intro-y">
                    <div class="mb-2">Nama</div>
                    <input type="text" class="input w-full border flex-1" name="nama" id="nama" placeholder="Nama Lengkap" required>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 row-gap-5 mt-5">
                <div class="intro-y">
                    <div class="mb-2">Sekolah</div>
                    <input type="text" class="input w-full border flex-1" name="sekolah" id="sekolah" placeholder="Nama Sekolah" required>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 row-gap-5 mt-5">
                <div class="intro-y col-span-12 sm:col-span-3">
                    <div class="mb-2">Pilih Olimpiade</div>
                    <select class="select2 w-full" id="olimpiade" name="olimpiade" required>
                        <option disabled selected>Pilih</option>
                        <option value="English">English</option>
                        <option value="Mathematics">Mathematics</option>
                        <option value="Biology">Biology</option>
                        <option value="Chemistry">Chemistry</option>
                        <option value="Physics">Physics</option>
                        <option value="History">History</option>
                        <option value="Economy">Economy</option>
                        <option value="natural sciences">Natural Sciences</option>
                        <option value="Social Sciences">Social Sciences</option>
                    </select>
                </div>
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
<script src="{{ asset('js/generate-piagam.js'. '?time=' . date("Ymdhisu")) }}"></script>
@endsection