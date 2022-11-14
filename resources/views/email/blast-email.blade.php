@extends('layouts.main')

@section('title') Blast Email Back Office @endsection

@section('css')
@endsection

@section('breadcrumb')
<div class="-intro-x breadcrumb mr-auto hidden sm:flex">
    <a href="javascript:;" class="">Application</a> 
    <i data-feather="chevron-right" class="breadcrumb__icon"></i> 
    <a href="javascript:;" class="breadcrumb">Blast</a>
    <i data-feather="chevron-right" class="breadcrumb__icon"></i> 
    <a href="" class="breadcrumb--active">Email</a>
</div>
@endsection

@section('content')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Blast Email
    </h2>
</div>
<div class="intro-y box px-5 pt-5 mt-5">
    <div class="nav-tabs flex flex-col sm:flex-row justify-center lg:justify-start"> 
        <a data-toggle="tab" data-target="#token" href="javascript:;" class="py-4 sm:mr-8 active">Token</a> 
        <a data-toggle="tab" data-target="#result" href="javascript:;" class="py-4 sm:mr-8">Hasil Olimpiade</a> 
        <a data-toggle="tab" data-target="#info" href="javascript:;" class="py-4 sm:mr-8">Info</a> 
        <a data-toggle="tab" data-target="#other" href="javascript:;" class="py-4 sm:mr-8">Lainnya</a> 
    </div>
</div>
<div class="intro-y tab-content mt-5">
    <div class="tab-content__pane active" id="token">
        <div class="grid grid-cols-12 gap-6">
            <div class="intro-y box col-span-12 lg:col-span-6">
                <div class="flex items-center p-5 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">
                        List Email
                    </h2>
                </div>
                <form id="form-blast-token">
                    <div class="p-5">
                        <textarea data-feature="basic" class="summernote" name="email" id="email" placeholder="input email"></textarea>
                    </div>
                </div>

                <div class="intro-y box col-span-12 lg:col-span-6">
                    <div class="flex items-center p-5 border-b border-gray-200">
                        <h2 class="font-medium text-base mr-auto">
                            Form
                        </h2>
                    </div>
                    <div class="p-5">
                        <div> 
                            <label>Token</label> 
                            <input type="text" class="input w-full border mt-2" placeholder="input token" id="token" name="token"> 
                        </div> 
                        <button type="button" id="btn-submit-token" class="button bg-theme-1 text-white mt-5">Kirim</button> 
                    </form>
                    </div>
                </div>
        </div>
    </div>

    <div class="tab-content__pane" id="result">
        <div class="grid grid-cols-12 gap-6">
            <div class="intro-y box col-span-12 lg:col-span-6">
                <div class="flex items-center p-5 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">
                        List Email
                    </h2>
                </div>
                <form id="form-blast-result">
                    <div class="p-5">
                        <textarea data-feature="basic" class="summernote" name="email" id="email" placeholder="input email"></textarea>
                    </div>
                </div>

                <div class="intro-y box col-span-12 lg:col-span-6">
                    <div class="flex items-center p-5 border-b border-gray-200">
                        <h2 class="font-medium text-base mr-auto">
                            Form
                        </h2>
                    </div>
                    <div class="p-5">
                        <div> 
                            <label>Grub</label> 
                            <select name="grub" id="grub" class="input w-full border mt-2" required>
                                <option value="SD" selected>SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                            </select>
                        </div> 
                        <div class="mt-3"> 
                            <label>Nama Olimpiade</label> 
                            <input type="text" class="input w-full border mt-2" placeholder="nama olimpiade" id="olimpiade" name="olimpiade"> 
                        </div> 
                        <div class="mt-3"> 
                            <label>Link</label> 
                            <input type="text" class="input w-full border mt-2" placeholder="input link hasil olimpiade" id="link" name="link"> 
                        </div> 
                        <button type="button" id="btn-submit-result" class="button bg-theme-1 text-white mt-5">Kirim</button> 
                    </form>
                    </div>
                </div>
        </div>
    </div>

</div>
@endsection

@section('js')
<script src="{{ asset('js/blast-email.js') }}"></script>
@endsection