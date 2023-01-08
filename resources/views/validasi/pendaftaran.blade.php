@extends('layouts.main')

@section('title') Validasi Pendaftaran - Back Office @endsection

@section('css')
@endsection

@section('breadcrumb')
<div class="-intro-x breadcrumb mr-auto hidden sm:flex">
    <a href="javascript:;" class="">Application</a> 
    <i data-feather="chevron-right" class="breadcrumb__icon"></i> 
    <a href="javascript:;" class="breadcrumb">Validasi</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i> 
    <a href="" class="breadcrumb--active">Pendaftaran</a>
</div>
@endsection

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Validasi Pendaftaran <br>
        <small>Berikut list peserta yang sudah divalidasi.</small>
    </h2>
</div>
<div class="mt-5 mb-2">
    <div class="flex-none">
        <select class="select2 select-filter-grub" id="select-filter-grub">
            <option selected value="" disabled>Pilih Grub</option>
            <option value="">Semua</option>
            @foreach($grub as $t)
            <option value="{{ $t->grup_id }}">{{ $t->grup_nama }}</option>
            @endforeach
        </select>
        <select class="select2 select-filter-olimpiade" id="select-filter-olimpiade">
            <option selected value="" disabled>Pilih Olimpiade</option>
            <option value="">Semua</option>
        </select>
        <button class="button w-100 inline-block bg-theme-5 text-white" id="btn-pilih" disabled>Tampilkan</button>
    </div>
</div>

<hr>

<div class="mt-5">
    <a href="javascript:;" class="button w-100 inline-block bg-theme-1 text-white" data-toggle="modal" data-target="#modal-validasi" id="btn-tambah" disabled>Tambah / Validasi Peserta</a>
</div>

<div class="modal" id="modal-validasi">
    <div class="modal__content modal__content--xl p-10 relative"> 
        <a data-dismiss="modal" href="javascript:;" class="absolute right-0 top-0 mt-3 mr-3"> 
            <i data-feather="x" class="w-8 h-8 text-gray-500"></i> 
        </a>
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Tambah Peserta ke Olimpiade</h2>
            <!-- <button class="button border items-center text-gray-700 hidden sm:flex">
                <i data-feather="file" class="w-4 h-4 mr-2"></i> Download Docs 
            </button> -->
            <div class="dropdown relative sm:hidden">
                <a class="dropdown-toggle w-5 h-5 block" href="javascript:;">
                    <i data-feather="more-horizontal" class="w-5 h-5 text-gray-700"></i>
                </a>
                <!-- <div class="dropdown-box mt-5 absolute w-40 top-0 right-0 z-20">
                    <div class="dropdown-box__content box p-2">
                        <a href="javascript:;" class="flex items-center p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">
                            <i data-feather="file" class="w-4 h-4 mr-2"></i> Download Docs 
                        </a>
                    </div>
                </div> -->
            </div>
        </div>
        <form id="form-validasi">
        <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
            <div class="col-span-12 sm:col-span-6">
                <label>Email</label>
                <input type="email" class="input w-full border mt-2 flex-1" id="modal-email" name="email" placeholder="adit.asyhari16@gmail.com" required>
                <span class="text-red-700 mt-2" id="check-user" >Akun tidak ada</span>
            </div>
            <div class="col-span-12 sm:col-span-6">
                <label>Grub</label>
                <select class="input w-full border mt-2 flex-1" id="modal-grub" required>
                    <option selected disabled>Pilih Grub</option>
                    @foreach($grub as $t)
                        <option value="{{ $t->grup_id }}">{{ $t->grup_nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 sm:col-span-6"> 
                <label>Pilih Olimpiade</label>
                <div class=" mt-2" id="modal-olimpiade">
                    <span class="text-red-700">Pilih grub terlebih dahulu</span>
                </div>
            </div>
            <!-- <div class="col-span-12 sm:col-span-6">
                <label>Subject</label>
                <input type="text" class="input w-full border mt-2 flex-1" placeholder="Important Meeting">
            </div>
            <div class="col-span-12 sm:col-span-6">
                <label>Has the Words</label>
                <input type="text" class="input w-full border mt-2 flex-1" placeholder="Job, Work, Documentation">
            </div>
            <div class="col-span-12 sm:col-span-6">
                <label>Doesn't Have</label>
                <input type="text" class="input w-full border mt-2 flex-1" placeholder="Job, Work, Documentation">
            </div>
            <div class="col-span-12 sm:col-span-6">
                <label>Size</label>
                <select class="input w-full border mt-2 flex-1">
                    <option>10</option>
                    <option>25</option>
                    <option>35</option>
                    <option>50</option>
                </select>
            </div> -->
        </div>
        <div class="px-5 py-3 text-right border-t border-gray-200">
            <button type="submit" class="button w-20 bg-theme-5 text-white" id="btn-validasi" disabled>Validasi</button>
        </div>
        </form>
    </div>
</div>


<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
    <table id="table-data" class="table table-report table-report--bordered display datatable w-full">
        <thead>
            <tr>
                <th class="border-b-2 whitespace-no-wrap">#</th>
                <th class="border-b-2 whitespace-no-wrap">OLIMPIADE</th>
                <th class="border-b-2 whitespace-no-wrap">NAMA</th>
                <th class="border-b-2 whitespace-no-wrap">EMAIL</th>
                <th class="border-b-2 whitespace-no-wrap">GRUB</th>
                <th class="border-b-2 whitespace-no-wrap">SEKOLAH</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

@endsection

@section('js')
<script src="{{ asset('js/validasi-pendaftaran.js'. '?time=' . date("Ymdhisu")) }}"></script>
@endsection