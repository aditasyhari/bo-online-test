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
                        <option value="juara-1-emas">Juara 1 Gold</option>
                        <option value="juara-2-silver">Juara 2 Silver</option>
                        <option value="juara-3-bronze">Juara 3 Bronze</option>
                        <option value="harapan-1-emas">Harapan 1 Gold</option>
                        <option value="harapan-2-silver">Harapan 2 Silver</option>
                        <option value="harapan-3-bronze">Harapan 3 Bronze</option>
                        <option value="peringkat-7">Peringkat 7</option>
                        <option value="peringkat-8">Peringkat 8</option>
                        <option value="peringkat-9">Peringkat 9</option>
                        <option value="peringkat-10">Peringkat 10</option>
                        <option value="medali-emas">Medali Emas</option>
                        <option value="medali-silver">Medali Silver</option>
                        <option value="medali-bronze">Medali Bronze</option>
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
                        <option value="Geography">Geography</option>
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