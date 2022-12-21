<header id="page-topbar">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-right">
                <div class="dropdown d-none d-lg-inline-block ml-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <i class="mdi mdi-fullscreen"></i>
                    </button>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="{{auth('admin')->user()->avatar}}" alt="Header Avatar">
                        <span class="d-none d-xl-inline-block ml-1">{{auth('admin')->user()->name}}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        <a class="dropdown-item" href="{{route('admin.profile')}}"><i class="bx bx-user font-size-16 align-middle mr-1"></i> حسابي</a>
{{--                        <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle mr-1"></i> المحفظة</a>--}}
{{--                        <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="bx bx-wrench font-size-16 align-middle mr-1"></i> الإعدادت</a>--}}
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('admin.logout') }}" class="dropdown-item text-danger" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i>
                            خروج
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </div>
                </div>
            </div>
            <div>
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="{{route('admin.home')}}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{asset('media/images/logo.jpeg')}}" class="rounded-circle" alt="" height="40">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('media/images/logo.jpeg')}}" class="rounded-circle" alt="" height="50">
                        </span>
                    </a>

                    <a href="{{route('admin.home')}}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{asset('media/images/logo.jpeg')}}" class="rounded-circle" alt="" height="50">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('media/images/logo.jpeg')}}" class="rounded-circle" alt="" height="50">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect" id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

                <!-- App Search-->
                <form class="app-search d-none d-lg-inline-block">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="bx bx-search-alt"></span>
                    </div>
                </form>

            </div>

        </div>
    </div>
</header>
