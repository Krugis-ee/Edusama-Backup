<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo half_logo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <?php
                $user_id = session()->get('loginId');
                $org_id = App\Models\User::getOrganizationId($user_id);
                $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
                $org_name = App\Models\Organization::getOrgNameById($org_id);
                $org_color = App\Models\Organization::getOrgColorByID($org_id);
                ?>

                <?php
                if (isset($org_logo)) { ?>
                    <a href="{{route('dashboard')}}"><img src="{{ asset('assets/img/organization_logo/'.$org_logo)}}" class="main-logo" id="full_logo" width="170" height="52" alt="{{$org_name}}"></a>
                    <!-- <a href="{{route('dashboard')}}"><img src="{{ asset('assets/img/organization_logo/'.$org_logo)}}" class="main-logo" id="half_logo" width="50" height="auto" alt="{{$org_name}}"></a></span> -->
            </span>
        <?php } else { ?>
            <a href="{{route('dashboard')}}"><img src="{{ asset('assets/img/edusama_newlogo.png')}}" class="main-logo" id="full_logo" width="170" height="52" alt="{{$org_name}}"></a>
            <!-- <a href="{{route('dashboard')}}"><img src="{{ asset('assets/img/edusama_newlogo.png')}}" class="main-logo" id="half_logo" width="50" height="auto" alt="{{$org_name}}"></a></span> -->
        <?php } ?>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>
    <!-- <div class="menu-inner-shadow"></div> -->
    <ul class="menu-inner py-1">
        <li class="menu-item <?php if ((Request::url() === route('teacher_dashboard'))) {
                                    echo 'active';
                                } ?>">
            <a href="{{route('teacher_dashboard')}}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboard">Dashboard</div>
                <div class="badge bg-primary rounded-pill ms-auto">5</div>
            </a>
        </li>
        <li class="menu-item <?php if ((Request::url() === route('my_profile_teacher'))) {
                                    echo 'active';
                                } ?>">
            <a href="{{ route('my_profile_teacher') }}" class="menu-link">
                <i class="menu-icon icon_resize tf-icons ti ti-user-circle"></i>
                <div data-i18n="My Profile">My Profile</div>
            </a>
        </li>
        <!-- <li class="menu-item">
            <a href="my_payments.html" class="menu-link">
                <i class="menu-icon tf-icons ti ti-cash-banknote"></i>
                <div data-i18n="My Profile">My Payments</div>
            </a>
        </li> -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text" data-i18n="Academy Section">Academy Section</span>
        </li>
        <li class="menu-item">
            <a href="" class="menu-link">
                <i class="menu-icon icon_resize tf-icons ti ti-chalkboard"></i>
                <div data-i18n="Classrooms">Classrooms</div>
            </a>
        </li>
        <li class="menu-item <?php if ((Request::url() === route('teacher_attendance'))) {
                                    echo 'active';
                                } ?>">
            <a href="{{ route('teacher_attendance') }}" class="menu-link">
                <i class="menu-icon icon_resize tf-icons ti ti-calendar-exclamation"></i>
                <div data-i18n="Student Attendance">Student Attendance</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="" class="menu-link">
                <i class="menu-icon icon_resize tf-icons ti ti-device-audio-tape"></i>
                <div data-i18n="Recorded Live Classes">Recorded Live Classes</div>
            </a>
        </li>
        <li class="menu-item <?php if ((Request::url() === route('video_course'))) {
                                    echo 'active';
                                } ?>">
            <a href="{{ route('video_course') }}" class="menu-link">
                <i class="menu-icon icon_resize tf-icons ti ti-brand-zoom"></i>
                <div data-i18n="Video Courses">Video Courses</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="" class="menu-link">
                <i class="menu-icon icon_resize tf-icons ti ti-stack-push"></i>
                <div data-i18n="Materials">Materials</div>
            </a>
        </li>
        <li class="menu-item <?php if ((Request::url() === route('teacher_assignment'))) {
                                    echo 'active';
                                } ?>">
            <a href="{{ route('teacher_assignment') }}" class="menu-link">
                <i class="menu-icon icon_resize tf-icons ti ti-brand-stackoverflow"></i>
                <div data-i18n="Assignments">Assignments</div>
            </a>
        </li>
		<li class="menu-item <?php if ((Request::url() === route('teacher_assessment')) ) {
                                            echo 'active';
                                        } ?>">
            <a href="{{ route('teacher_assessment') }}" class="menu-link">
                <i class="menu-icon icon_resize tf-icons ti ti-text-caption"></i>
                <div data-i18n="Assessment"> Assessment</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="" class="menu-link">
                <i class="menu-icon icon_resize tf-icons ti ti-certificate"></i>
                <div data-i18n="Certificates">Certificates</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text" data-i18n="Support Section">Support Section</span>
        </li>
        <li class="menu-item">
            <a href="a" class="menu-link">
                <i class="menu-icon icon_resize tf-icons ti ti-help"></i>
                <div data-i18n="Help Desk">Help Desk</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="a" class="menu-link">
                <i class="menu-icon icon_resize tf-icons ti ti-settings"></i>
                <div data-i18n="Settings">Settings</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="a" class="menu-link">
                <i class="menu-icon icon_resize tf-icons ti ti-packages"></i>
                <div data-i18n="Modules">Modules</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('common_logout') }}" class="menu-link">
                <i class="menu-icon icon_resize tf-icons ti ti-home-move"></i>
                <div data-i18n="Logout">Logout</div>
            </a>
        </li>
    </ul>
</aside>
