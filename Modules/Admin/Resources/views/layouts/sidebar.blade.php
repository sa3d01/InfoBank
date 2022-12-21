<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="{{auth('admin')->user()->avatar}}" alt="" class="avatar-md mx-auto rounded-circle">
            </div>
            <div class="mt-3">
                <a href="#" class="text-dark font-weight-medium font-size-16">{{auth('admin')->user()->name}}</a>
                <p class="text-body mt-1 mb-0 font-size-13">Admin</p>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-selection-marker"></i>
                        <span>Brands</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.brand.index')}}">Brands</a></li>
                        <li><a href="{{route('admin.brand_owner.index')}}">Brand Owner</a></li>
                        <li><a href="{{route('admin.brand.create')}}">Add Brand</a></li>
                        <li><a href="{{route('admin.brand_owner.create')}}">Add Brand Owner</a></li>
                        <li><a href="{{route('admin.employee.index')}}">Employee</a></li>
                        <li><a href="{{route('admin.slider.index')}}">Slider</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-cart-plus"></i>
                        <span>Order</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{route('admin.order.index')}}">Orders</a>
                        </li>
                    </ul>
                </li>
                <li class="menu-title">settings</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-set-center"></i>
                        <span>Locations</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{route('admin.location.index')}}">Locations</a>
                        </li>
                       <li>
                            <a href="{{route('admin.location.create')}}">Add Location</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-qrcode-scan"></i>
                        <span>Promo Code</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{route('admin.promo_code.index')}}">Promo Codes</a>
                        </li>
                       <li>
                            <a href="{{route('admin.promo_code.create')}}">Add Promo Code</a>
                        </li>
                    </ul>
                </li>




            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
