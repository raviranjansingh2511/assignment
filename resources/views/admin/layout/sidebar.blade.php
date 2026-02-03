@php
$admin= Auth::guard('web')->user();


@endphp
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <li>
                    <a href="{{route('admin_dashboard')}}">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>

                
                <li>
                    <a href="{{route('admin')}}">
                        <i class="bx bx-file"></i>
                        <span key="t-dashboards">Admin</span>
                    </a>
                </li>
                 <li>
                    <a href="{{route('member')}}">
                        <i class="bx bx-file"></i>
                        <span key="t-dashboards">Member</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('short_url')}}">
                        <i class="bx bx-file"></i>
                        <span key="t-dashboards">Short Url</span>
                    </a>
                </li>


                
                
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->