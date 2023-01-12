@extends('layouts.main')

@section('title') Dashboard @endsection

@section('css')
@endsection

@section('breadcrumb')
<div class="-intro-x breadcrumb mr-auto hidden sm:flex">
    <a href="" class="">Application</a> 
    <i data-feather="chevron-right" class="breadcrumb__icon"></i> 
    <a href="" class="breadcrumb--active">Dashboard</a>
</div>
@endsection

@section('content')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
        <!-- BEGIN: General Report -->
        <div class="col-span-12 mt-8">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    General Report
                </h2>
                <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="gift" class="report-box__icon text-theme-10"></i> 
                                <!-- <div class="ml-auto">
                                    <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="33% Higher than last month"> 33% <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                </div> -->
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">{{ number_format($userClaim, 0, ",", ".") }}</div>
                            <div class="text-base text-gray-600 mt-1">User Claim</div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="check-circle" class="report-box__icon text-theme-11"></i> 
                                <!-- <div class="ml-auto">
                                    <div class="report-box__indicator bg-theme-6 tooltip cursor-pointer" title="2% Lower than last month"> 2% <i data-feather="chevron-down" class="w-4 h-4"></i> </div>
                                </div> -->
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">{{ $olimpiade }}</div>
                            <div class="text-base text-gray-600 mt-1">Olimpiade Selesai</div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="monitor" class="report-box__icon text-theme-12"></i> 
                                <!-- <div class="ml-auto">
                                    <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="12% Higher than last month"> 12% <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                </div> -->
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">{{ $mapel }}</div>
                            <div class="text-base text-gray-600 mt-1">Mapel Olimpiade</div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <div class="report-box zoom-in">
                        <div class="box p-5">
                            <div class="flex">
                                <i data-feather="users" class="report-box__icon text-theme-9"></i> 
                                <!-- <div class="ml-auto">
                                    <div class="report-box__indicator bg-theme-9 tooltip cursor-pointer" title="22% Higher than last month"> 22% <i data-feather="chevron-up" class="w-4 h-4"></i> </div>
                                </div> -->
                            </div>
                            <div class="text-3xl font-bold leading-8 mt-6">{{ number_format($users, 0, ",", ".") }}</div>
                            <div class="text-base text-gray-600 mt-1">Total User</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: General Report -->
        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    User
                </h2>
                <!-- <a href="" class="ml-auto text-theme-1 truncate">See all</a>  -->
            </div>
            <div class="intro-y box p-5 mt-5">
                <canvas class="mt-3" id="grub-chart" height="280"></canvas>
                <div class="mt-8">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-theme-11 rounded-full mr-3"></div>
                        <span class="truncate">SD</span> 
                        <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                        <span class="font-medium xl:ml-auto">{{ $persentGrub['sd'] }}%</span> 
                    </div>
                    <div class="flex items-center mt-4">
                        <div class="w-2 h-2 bg-theme-1 rounded-full mr-3"></div>
                        <span class="truncate">SMP</span> 
                        <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                        <span class="font-medium xl:ml-auto">{{ $persentGrub['smp'] }}%</span> 
                    </div>
                    <div class="flex items-center mt-4">
                        <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
                        <span class="truncate">SMA</span> 
                        <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                        <span class="font-medium xl:ml-auto">{{ $persentGrub['sma'] }}%</span> 
                    </div>
                    <div class="flex items-center mt-4">
                        <div class="w-2 h-2 bg-theme-12 rounded-full mr-3"></div>
                        <span class="truncate">UNIVERSITAS</span> 
                        <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                        <span class="font-medium xl:ml-auto">{{ $persentGrub['universitas'] }}%</span> 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Claim
                </h2>
                <!-- <a href="" class="ml-auto text-theme-1 truncate">See all</a>  -->
            </div>
            <div class="intro-y box p-5 mt-5">
                <canvas class="mt-3" id="claim-chart" height="280"></canvas>
                <div class="mt-8">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-theme-8 rounded-full mr-3"></div>
                        <span class="truncate">Paket A</span> 
                        <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                        <span class="font-medium xl:ml-auto">{{ $persentPaket['a'] }}%</span> 
                    </div>
                    <div class="flex items-center mt-4">
                        <div class="w-2 h-2 bg-theme-8 rounded-full mr-3"></div>
                        <span class="truncate">Paket B</span> 
                        <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                        <span class="font-medium xl:ml-auto">{{ $persentPaket['b'] }}%</span> 
                    </div>
                    <div class="flex items-center mt-4">
                        <div class="w-2 h-2 bg-theme-8 rounded-full mr-3"></div>
                        <span class="truncate">Paket C</span> 
                        <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                        <span class="font-medium xl:ml-auto">{{ $persentPaket['c'] }}%</span> 
                    </div>
                    <div class="flex items-center mt-4">
                        <div class="w-2 h-2 bg-theme-8 rounded-full mr-3"></div>
                        <span class="truncate">Paket D</span> 
                        <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                        <span class="font-medium xl:ml-auto">{{ $persentPaket['d'] }}%</span> 
                    </div>
                    <div class="flex items-center mt-4">
                        <div class="w-2 h-2 bg-theme-8 rounded-full mr-3"></div>
                        <span class="truncate">Paket Bonus</span> 
                        <div class="h-px flex-1 border border-r border-dashed border-gray-300 mx-3 xl:hidden"></div>
                        <span class="font-medium xl:ml-auto">{{ $persentPaket['bonus'] }}%</span> 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-6 mt-8">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Top User Claim
                </h2>
            </div>
            <div class="mt-5">
                @foreach($topUserClaim as $ut)
                <div class="intro-y">
                    <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                        <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden">
                            <img alt="SD" src="{{ asset('images/profile.png') }}">
                        </div>
                        <div class="ml-4 mr-auto">
                            <div class="font-medium">{{ $ut->user_firstname }}</div>
                            <div class="text-gray-600 text-xs">{{ $ut->total }}x claim</div>
                        </div>
                        <div class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium">Rp {{ number_format($ut->total_money, 0, ",", ".") }}</div>
                    </div>
                </div>
                @endforeach
                <!-- <a href="" class="intro-y w-full block text-center rounded-md py-4 border border-dotted border-theme-15 text-theme-16">View More</a>  -->
            </div>
        </div>
    </div>
    <div class="col-span-12 xxl:col-span-3 xxl:border-l border-theme-5 -mb-10 pb-10">
        <div class="xxl:pl-6 grid grid-cols-12 gap-6">
            <!-- BEGIN: Transactions -->
            <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3 xxl:mt-8">
                <div class="intro-x flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Terakhir Daftar
                    </h2>
                </div>
                <div class="mt-5">
                    @foreach($latestUser as $u)
                    <div class="intro-x">
                        <div class="box px-5 py-3 mb-3 flex items-center zoom-in">
                            <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                <img alt="SD" src="{{ asset('images/profile.png') }}">
                            </div>
                            <div class="ml-4 mr-auto">
                                <div class="font-medium">{{ $u->user_firstname }}</div>
                                <div class="text-gray-600 text-xs">{{ $u->user_regdate }}</div>
                            </div>
                            <div class="text-theme-9">{{ $u->grup_nama }}</div>
                        </div>
                    </div>
                    @endforeach


                    <!-- <a href="" class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 text-theme-16">View More</a>  -->
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('js')
<script>
if ($('#grub-chart').length) {
    var _grub = $('#grub-chart')[0].getContext('2d');

    var myPieChart = new Chart(_grub, {
      type: 'pie',
      data: {
        labels: ["SMP", "SMA", "SD", "UNIVERSITAS"],
        datasets: [{
          data: {{ $chartGrub }},
          backgroundColor: ["#FF8B26", "#FFC533", "#285FD3", "#FFD700"],
          hoverBackgroundColor: ["#FF8B26", "#FFC533", "#285FD3", "#FFD700"],
          borderWidth: 5,
          borderColor: "#fff"
        }]
      },
      options: {
        legend: {
          display: false
        }
      }
    });
}

if ($('#claim-chart').length) {
    var _claim = $('#claim-chart')[0].getContext('2d');

    var myDoughnutChart = new Chart(_claim, {
      type: 'doughnut',
      data: {
        labels: ["PAKET A", "PAKET B", "PAKET C", "PAKET D", "PAKET BONUS"],
        datasets: [{
          data: {{ $chartPaket }},
          backgroundColor: ["#FF8B26", "#FFC533", "#285FD3", "#00FFFF", "#FFD700"],
          hoverBackgroundColor: ["#FF8B26", "#FFC533", "#285FD3", "#00FFFF", "#FFD700"],
          borderWidth: 5,
          borderColor: "#fff"
        }]
      },
      options: {
        legend: {
          display: false
        },
        cutoutPercentage: 60
      }
    });
}
</script>
@endsection