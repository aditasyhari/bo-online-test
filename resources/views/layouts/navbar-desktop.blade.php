<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4">
        <img alt="Logo" class="w-6" src="{{ asset('source/dist/images/logo.svg') }}">
        <span class="hidden xl:block text-white text-lg ml-3"> Back<span class="font-medium">Office</span> </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
            <a href="{{ url('dashboard') }}" class="side-menu {{ (request()->is('dashboard*')) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                <div class="side-menu__title"> Dashboard </div>
            </a>
        </li>
        <li>
            <a href="{{ url('blast-email') }}" class="side-menu {{ (request()->is('blast-email*')) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-feather="mail"></i> </div>
                <div class="side-menu__title"> Blast Email </div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="side-menu {{ (request()->is('setting*')) ? 'side-menu--active side-menu--open' : '' }}">
                <div class="side-menu__icon"> <i data-feather="settings"></i> </div>
                <div class="side-menu__title"> Setting <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{ url('/setting/user-bo') }}" class="side-menu {{ (request()->is('setting/user-bo*')) ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> User BO </div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/setting/user-cbt') }}" class="side-menu {{ (request()->is('setting/user-cbt*')) ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> User CBT </div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>