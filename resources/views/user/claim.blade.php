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
        Data Klaim User
    </h2>
</div>
<div class="grid grid-rows-1 grid-flow-col gap-4">
    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-1 text-white"> <i data-feather="info" class="w-6 h-6 mr-2"></i><span id="total-valid"> 0 Data Valid (Rp 0) </span></div>
    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-6 text-white"> <i data-feather="info" class="w-6 h-6 mr-2"></i><span id="total-reject"> 0 Data Reject </span></div>
    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-7 text-white"> <i data-feather="info" class="w-6 h-6 mr-2"></i><span id="total-pending"> 0 Data Pending (Rp 0) </span></div>
</div>
<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
    <table id="table-data" class="table table-report table-report--bordered display datatable w-full">
        <thead>
            <tr>
                <th class="border-b-2 whitespace-no-wrap">NAMA</th>
                <th class="border-b-2 whitespace-no-wrap">NO. WA</th>
                <th class="border-b-2 whitespace-no-wrap">EMAIL</th>
                <th class="border-b-2 whitespace-no-wrap">STATUS</th>
                <th class="border-b-2 whitespace-no-wrap">ITEM</th>
                <th class="border-b-2 whitespace-no-wrap">ONGKIR</th>
                <th class="border-b-2 whitespace-no-wrap">TOTAL</th>
                <th class="border-b-2 whitespace-no-wrap">BUKTI</th>
                <th class="border-b-2 whitespace-no-wrap"></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>


<!-- modal detail -->
<div class="modal" id="modal-detail-data">
    <div class="modal__content modal__content--xl pb-3">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">
                Detail Klaim
            </h2>
        </div>
        <div class="p-5">
            <table id="table-detail" class="table w-full">
                <thead>
                    <tr>
                        <th class="border-b-2 text-center whitespace-no-wrap">#</th>
                        <th class="border-b-2 whitespace-no-wrap">OLIMPIADE</th>
                        <th class="border-b-2 whitespace-no-wrap">HARGA</th>
                        <th class="border-b-2 whitespace-no-wrap">PAKET</th>
                        <th class="border-b-2 whitespace-no-wrap">KETERANGAN</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div class="w-full">
            <form class="bg-white rounded px-8 pt-6 pb-8 mb-4" id="form-edit-data">
                <!-- <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Tambah Item
                    </label>
                    <select class="select2 w-full shadow" id="add-claim" name="add_item[]" multiple="multiple" required>
                        
                    </select>
                </div> -->
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Alamat
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="detail-alamat" name="alamat" cols="30" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Catatan
                    </label>
                    <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="detail-note" name="note" cols="30" rows="3"></textarea>
                </div>
                <div class="flex items-center">
                    <input type="hidden" name="id" id="claim-id">
                    <button class="mr-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" id="btn-simpan-update-data">
                        Update
                    </button>
                    <button type="button" data-dismiss="modal" class="button 2-48 border text-gray-700 mr-1 btn-tutup-modal">Tutup</button>
                </div>
            </form>  
        </div>  
        
    </div>
</div>

@endsection

@section('js')
<script src="{{ asset('js/claim.js'. '?time=' . date("Ymdhisu")) }}"></script>
@endsection