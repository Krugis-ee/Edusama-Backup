<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo half_logo">
       <a href="{{route('superadmin_home')}}" class="app-brand-link">
          <span class="app-brand-logo demo">
          <a href="{{route('superadmin_home')}}"><img src="{{ asset('assets/logo/edusamanewlogo.png')}}" class="main-logo" id="full_logo" width="170" height="52" alt="Edusama"></a>
          <a href="{{route('superadmin_home')}}"><img src="{{ asset('assets/favicon/favicon.jpg')}}" class="main-logo" id="half_logo" width="50" height="auto" alt="Edusama"></a>
          </span>
          <!-- <span class="app-brand-text demo menu-text fw-bold">Vuexy</span> -->
       </a>
       <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
       <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
       <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
       </a>
    </div>
    <!-- <div class="menu-inner-shadow"></div> -->
    <ul class="menu-inner py-1">
       <li class="menu-item">
          <a href="{{route('superadmin_home')}}" class="menu-link">
             <i class="menu-icon tf-icons ti ti-smart-home"></i>
             <div data-i18n="Dashboard">Dashboard</div>
             <div class="badge bg-primary rounded-pill ms-auto">5</div>
          </a>
       </li>
	   <li class="menu-item <?php if((Request::url() === route('organization_add')) || (Request::url() === route('organization_list'))) { echo 'active'; } ?>">
          <a href="{{route('organization_list')}}" class="menu-link">
             <i class="menu-icon fa-solid fa-building"></i>
             <div data-i18n="Dashboard">Organisation</div>
             
          </a>
       </li>
	   <li class="menu-item <?php if((Request::url() === route('user_add_get')) || (Request::url() === route('user_index'))) { echo 'active'; } ?>">
          <a href="{{route('user_index')}}" class="menu-link">
             <i class="menu-icon fa-solid fa-user-tie"></i>
             <div data-i18n="Dashboard">Admin</div>
             
          </a>
       </li>
       <li class="menu-item">
          <a href="{{ route('superadmin_logout') }}" class="menu-link">
             <i class="menu-icon fa-solid fa-lock"></i>
             <div data-i18n="Site Config">Logout</div>
          </a>
       </li>
    </ul>
 </aside>
