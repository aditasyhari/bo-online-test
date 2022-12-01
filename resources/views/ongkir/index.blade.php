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
        Data Ongkir Provinsi
    </h2>
</div>

<!-- BEGIN: Datatable -->
<div class="intro-y datatable-wrapper box p-5 mt-5">
    <table id="table-data" class="table table-report table-report--bordered display datatable w-full">
        <thead>
            <tr>
                <th class="border-b-2 whitespace-no-wrap">#</th>
                <th class="border-b-2 whitespace-no-wrap">NAMA</th>
                <th class="border-b-2 whitespace-no-wrap">ONGKIR</th>
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
                Update Ongkir
            </h2>
        </div>
        <div class="w-full">
            <form class="bg-white rounded px-8 pt-6 pb-8 mb-4" id="form-edit-data">
                <div class="mb-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2" id="label-provinsi">
                        
                    </label>
                    <input type="text" class="text-number input w-full border mt-2" placeholder="Rp " id="ongkir" name="ongkir"> 
                </div>
                <div class="flex items-center">
                    <input type="hidden" name="id" id="provinsi-id">
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
<script src="{{ asset('js/ongkir.js'. '?time=' . date("Ymdhisu")) }}"></script>
@endsection