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
            <a href="javascipt:;" class="side-menu {{ (request()->is('claim*')) ? 'side-menu--active side-menu--open' : '' }}">
                <div class="side-menu__icon"> <i data-feather="check-circle"></i> </div>
                <div class="side-menu__title"> User Claim <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{ url('claim-all') }}" class="side-menu {{ (request()->is('claim-all*')) ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> All </div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('claim-paket') }}" class="side-menu {{ (request()->is('claim-paket*')) ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Valid Claim Paket</div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('claim-epiagam') }}" class="side-menu {{ (request()->is('claim-epiagam*')) ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Valid E-Piagam </div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('claim-medali') }}" class="side-menu {{ (request()->is('claim-medali*')) ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Valid Medali </div>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascipt:;" class="side-menu {{ (request()->is('generator*')) ? 'side-menu--active side-menu--open' : '' }}">
                <div class="side-menu__icon"> <i data-feather="file"></i> </div>
                <div class="side-menu__title"> Generator <i data-feather="chevron-down" class="side-menu__sub-icon"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{ url('generator-piagam') }}" class="side-menu {{ (request()->is('generator-piagam*')) ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Piagam </div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('generator-sertifikat') }}" class="side-menu {{ (request()->is('generator-sertifikat*')) ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Sertifikat </div>
                    </a>
                </li>
            </ul>
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
                    <a href="{{ url('/setting/ongkir') }}" class="side-menu {{ (request()->is('setting/ongkir*')) ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Ongkir </div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/setting/paket') }}" class="side-menu {{ (request()->is('setting/paket*')) ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> Paket </div>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/setting/user-bo') }}" class="side-menu {{ (request()->is('setting/user-bo*')) ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> User BO </div>
                    </a>
                </li>
                <!-- <li>
                    <a href="{{ url('/setting/user-cbt') }}" class="side-menu {{ (request()->is('setting/user-cbt*')) ? 'side-menu--active' : '' }}">
                        <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                        <div class="side-menu__title"> User CBT </div>
                    </a>
                </li> -->
            </ul>
        </li>
    </ul>
</nav>