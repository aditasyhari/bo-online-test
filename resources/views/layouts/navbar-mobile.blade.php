<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="Logo" class="w-6" src="{{ asset('source/dist/images/logo.svg') }}">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-theme-24 py-5 hidden">
        <li>
            <a href="{{ url('dashboard') }}" class="menu menu--active">
                <div class="menu__icon"> <i data-feather="home"></i> </div>
                <div class="menu__title"> Dashboard </div>
            </a>
        </li>
        <li>
            <a href="{{ url('claim') }}" class="side-menu {{ (request()->is('claim*')) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                <div class="side-menu__title"> User Claim </div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="menu {{ (request()->is('setting*')) ? 'menu--active menu--open' : '' }}">
                <div class="menu__icon"> <i data-feather="box"></i> </div>
                <div class="menu__title"> Setting <i data-feather="chevron-down" class="menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{ url('/setting/user-bo') }}" class="menu {{ (request()->is('setting/user-bo*')) ? 'menu--active' : '' }}">
                        <div class="menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="menu__title"> User BO</div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/setting/user-cbt') }}" class="menu {{ (request()->is('setting/user-cbt*')) ? 'menu--active' : '' }}">
                        <div class="menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="menu__title"> User CBT</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>