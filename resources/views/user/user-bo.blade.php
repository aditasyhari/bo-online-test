@extends('layouts.main')

@section('title') User Back Office @endsection

@section('css')
@endsection

@section('breadcrumb')
<div class="-intro-x breadcrumb mr-auto hidden sm:flex">
    <a href="javascript:;" class="">Application</a> 
    <i data-feather="chevron-right" class="breadcrumb__icon"></i> 
    <a href="javascript:;" class="breadcrumb">Setting</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i> 
    <a href="" class="breadcrumb--active">User BO</a>
</div>
@endsection

@section('content')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Data User
    </h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <a href="javascript:;" class="button w-full text-white bg-theme-1 shadow-md mr-2 btn-tambah-data" data-toggle="modal" data-target="#modal-tambah-data"> Tambah User</a>
    </div>
</div>

<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
    <table id="table-data" class="table table-report table-report--bordered display datatable w-full">
        <thead>
            <tr>
                <th class="border-b-2 text-center whitespace-no-wrap">#</th>
                <th class="border-b-2 whitespace-no-wrap">USERNAME</th>
                <th class="border-b-2 whitespace-no-wrap">NAMA</th>
                <th class="border-b-2 whitespace-no-wrap">KETERANGAN</th>
                <th class="border-b-2 whitespace-no-wrap">LEVEL</th>
                <th class="border-b-2 whitespace-no-wrap"></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<!-- modal tambah -->
<div class="modal" id="modal-tambah-data">
    <div class="modal__content modal__content--lg">
        <form id="form-tambah-data">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                <h2 class="font-medium text-base mr-auto">
                    Tambah User
                </h2>
            </div>
            <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                <div class="col-span-12 sm:col-span-12">
                    <label>Level User</label>
                    <select class="select2 w-full tambah-select-id_level" id="tambah-select-id_level" name="id_level">
                        <option selected disabled>Pilih Level User</option>
                        @foreach($level as $lvl)
                            <option value="{{ $lvl->level }}">{{ $lvl->keterangan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Nama</label>
                    <input type="text" class="input w-full border mt-2 flex-1" name="nama">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Username</label>
                    <input type="text" class="input w-full border mt-2 flex-1" name="username">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Keterangan</label>
                    <input type="text" class="input w-full border mt-2 flex-1" name="keterangan">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Password</label>
                    <input type="password" class="input w-full border mt-2 flex-1" name="password" id="password">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Konfirmasi Password</label>
                    <input type="password" class="input w-full border mt-2 flex-1" name="password_confirmation">
                </div>
            </div>
            <div class="px-5 py-3 text-right border-t border-gray-200">
                <input type="hidden" name="route" value="__simpanData" />
                <button type="button" data-dismiss="modal" class="button 2-48 border text-gray-700 mr-1 btn-tutup-modal">Batal</button>
                <button type="button" class="button 2-48 bg-theme-1 text-white btn-simpan-tambah-data" id="btn-simpan-tambah-data">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- modal edit -->
<div class="modal" id="modal-edit-data">
    <div class="modal__content">
        <form id="form-edit-data">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                <h2 class="font-medium text-base mr-auto">
                    Edit User
                </h2>
            </div>
            <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                <div class="col-span-12 sm:col-span-12">
                    <label>Level User</label>
                    <select class="select2 w-full edit-select-id_level" id="edit-select-id_level" name="id_level">
                        <option selected disabled>Pilih Level User</option>
                        @foreach($level as $lvl)
                            <option value="{{ $lvl->level }}">{{ $lvl->keterangan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>NIP</label>
                    <input type="text" class="input w-full border mt-2 flex-1 edit-nip" name="nip">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Username</label>
                    <input type="text" class="input w-full border mt-2 flex-1 edit-username" name="username">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Nama Lengkap</label>
                    <input type="text" class="input w-full border mt-2 flex-1 edit-nama_lengkap" name="nama_lengkap">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Email</label>
                    <input type="text" class="input w-full border mt-2 flex-1 edit-email" name="email">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Nomow WA/HP</label>
                    <input type="number" class="input w-full border mt-2 flex-1 edit-phone" name="phone">
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <label>Status User</label><br>
                    <input class="input input--switch border checkbox-edit-flag_status" type="checkbox" name="flag_status">
                </div>
            </div>
            <div class="px-5 py-3 text-right border-t border-gray-200">
                <input type="hidden" name="id_user" class="edit-userid" />
                <button type="button" data-dismiss="modal" class="button 2-48 border text-gray-700 mr-1 btn-tutup-modal">Batal</button>
                <button type="button" class="button 2-48 bg-theme-1 text-white btn-simpan-update-data" id="btn-simpan-update-data">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/user-bo.js') }}"></script>
@endsection