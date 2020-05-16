<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="backend" class=" waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span>Dashboards</span>
                    </a>
                </li>
                @php
                if(!empty(Auth::user())){
                  $Menu = new \App\Models\Backend\Menu;
                  echo $Menu->setMenu(Request::path());
                }
                @endphp
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span>Layouts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="backend/template/layouts-horizontal">Horizontal</a></li>
                        <li><a href="backend/template/layouts-light-sidebar">Light Sidebar</a></li>
                        <li><a href="backend/template/layouts-compact-sidebar">Compact Sidebar</a></li>
                        <li><a href="backend/template/layouts-icon-sidebar">Icon Sidebar</a></li>
                        <li><a href="backend/template/layouts-boxed">Boxed Width</a></li>
                        <li><a href="backend/template/layouts-preloader">Preloader</a></li>
                        <li><a href="backend/template/layouts-colored-sidebar">Colored Sidebar</a></li>
                    </ul>
                </li>
                <li>
                    <a href="backend/template" class=" waves-effect">
                        <i class="bx bx-file"></i>
                        <span>Template</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
