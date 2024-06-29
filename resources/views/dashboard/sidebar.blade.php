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
                <?php } else { ?>
                    <a href="{{route('dashboard')}}"><img src="{{ asset('assets/img/edusama_newlogo.png')}}" class="main-logo" id="full_logo" width="170" height="52" alt="{{$org_name}}"></a>
                    <!-- <a href="{{route('dashboard')}}"><img src="{{ asset('assets/img/edusama_newlogo.png')}}" class="main-logo" id="half_logo" width="50" height="auto" alt="{{$org_name}}"></a></span> -->

                <?php } ?>
                <!-- <span class="app-brand-text demo menu-text fw-bold">Vuexy</span> -->
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>
    <!-- <div class="menu-inner-shadow"></div> -->
    <?php
    $user_id = session()->get('loginId');
    $user_role_id = App\Models\User::getRoleID($user_id);
    if ($user_role_id == 1) {
        $site_config = App\Models\User::getSiteConfigs($user_id);
        $stie_config_arr = explode(',', $site_config);
    }
    ?>

    <?php
    //for admin
    if ($user_role_id == 1) { ?>
        <ul class="menu-inner py-1">

            <li class="menu-item <?php if (Request::url() === route('dashboard')) {
                                        echo 'active';
                                    } ?>">
                <a href="{{ route('dashboard')}}" class="menu-link">
                    <i class="menu-icon icon_resize tf-icons ti ti-smart-home"></i>
                    <div data-i18n="Dashboard">Dashboard</div>
                    <!--div class="badge bg-primary rounded-pill ms-auto">5</div-->
                </a>
            </li>

            <li class="menu-item <?php if (Request::url() === route('my_profile_admin')) {
                                        echo 'active';
                                    } ?>">
                <a href="{{ route('my_profile_admin')}}" class="menu-link">
                    <i class="menu-icon icon_resize tf-icons ti ti-user-circle"></i>
                    <div data-i18n="My Profile">My Profile</div>
                </a>
            </li>


            <li class="menu-header small text-uppercase">
                <span class="menu-header-text" data-i18n="Academy Section">Academy Section</span>
            </li>
            <?php if (in_array('subjects', $stie_config_arr)) { ?>
                <li class="menu-item <?php if ((Request::url() === route('subject_index')) || (Request::url() === route('subject_add_get'))) {
                                            echo 'active';
                                        } ?>">
                    <a href="{{ route('subject_index') }}" class="menu-link">
                        <i class="menu-icon ti apm ti-section-sign"></i>
                        <div data-i18n="Subjects">Subjects</div>
                    </a>
                </li>
            <?php } ?>
            <?php if (in_array('departments', $stie_config_arr)) { ?>
                <li class="menu-item <?php if ((Request::url() === route('department_index')) || (Request::url() === route('department_add_get'))) {
                                            echo 'active';
                                        } ?>">
                    <a href="{{ route('department_index') }}" class="menu-link">
                        <i class="menu-icon ti apm ti-color-swatch"></i>
                        <div data-i18n="Departments">Departments</div>
                    </a>
                </li>
            <?php } ?>
            <?php if (in_array('classrooms', $stie_config_arr)) { ?>
                <li class="menu-item <?php if ((Request::url() === route('index_list')) || (Request::url() === route('class_room_add_get', 'manual_creation')) || (Request::url() === route('class_room_add_get', 'using_template'))) {
                                            echo 'active';
                                        } ?>">
                    <a href="{{ route('index_list') }}" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-chalkboard"></i>
                        <div data-i18n="Class Rooms">Class Rooms</div>
                    </a>
                </li>
            <?php } ?>

            <?php if (in_array('teachers', $stie_config_arr)) { ?>
                <li class="menu-item <?php if ((Request::url() === route('teacher_list')) || (Request::url() === route('teacher_add'))) {
                                            echo 'active';
                                        } ?>">
                    <a href="{{ route('teacher_list') }}" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-school"></i>
                        <div data-i18n="Teachers">Teachers</div>
                    </a>
                </li>
            <?php } ?>

            <?php if (in_array('students', $stie_config_arr)) { ?>
                <li class="menu-item <?php if ((Request::url() === route('student_list')) || (Request::url() === route('student_add', 'single')) || (Request::url() === route('student_add', 'bulk_import')) || (Request::url() === route('student_add', 'excel_import'))) {
                                            echo 'active';
                                        } ?>">
                    <a href="{{ route('student_list') }}" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-accessible"></i>
                        <div data-i18n="Students">Students</div>
                    </a>
                </li>
            <?php } ?>
            <?php if (in_array('parents', $stie_config_arr)) { ?>
                <li class="menu-item <?php if ((Request::url() === route('parent_list')) || (Request::url() === route('parent_add'))) {
                                            echo 'active';
                                        } ?>">
                    <a href="{{ route('parent_list') }}" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-users"></i>
                        <div data-i18n="Parents">Parents</div>
                    </a>
                </li>
            <?php } ?>

            <?php if (in_array('student_attendance', $stie_config_arr)) { ?>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-calendar-exclamation"></i>
                        <div data-i18n="Student Attendance">Student Attendance</div>
                    </a>
                </li>
            <?php } ?>
            <?php if (in_array('recorded_live_classes', $stie_config_arr)) { ?>
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <i class="menu-icon tf-icons ti ti-device-audio-tape"></i>
                        <div data-i18n="Recorded Live Classes">Recorded Live Classes</div>
                    </a>
                </li>
            <?php } ?>
            <?php if (in_array('video_course', $stie_config_arr)) { ?>
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-brand-zoom"></i>
                        <div data-i18n="Video Course">Video Course</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a class="menu-link">
                                <div data-i18n="Add Parent">Online Courses</div>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php } ?>
            <?php if (in_array('online_courses', $stie_config_arr)) { ?>
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <i class="menu-icon fa-solid fa-globe"></i>
                        <div data-i18n="Online Courses">Online Courses</div>
                    </a>
                </li>
            <?php } ?>
            <?php if (in_array('materials', $stie_config_arr)) { ?>
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-stack-push"></i>
                        <div data-i18n="Materials">Materials</div>
                    </a>
                </li>
            <?php } ?>
            <?php if (in_array('assignments', $stie_config_arr)) { ?>
                <li class="menu-item <?php if ((Request::url() === route('assignment'))) {
                                            echo 'active';
                                        } ?>">
                    <a href="{{ route('assignment') }}" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-brand-stackoverflow"></i>
                        <div data-i18n="Assignments">Assignments</div>
                    </a>
                </li>
            <?php } ?>
            <?php if (in_array('assessments', $stie_config_arr)) { ?>
                <li class="menu-item <?php if ((Request::url() === route('assessment'))) {
                                            echo 'active';
                                        } ?>">
                    <a href="{{ route('assessment') }}" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-text-caption"></i>
                        <div data-i18n="Assessments">Assessments</div>
                    </a>
                </li>
            <?php } ?>
            <?php if (in_array('certificates', $stie_config_arr)) { ?>
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-certificate"></i>
                        <div data-i18n="Certificates">Certificates</div>
                    </a>
                </li>
            <?php } ?>
            <?php if (in_array('templates', $stie_config_arr)) { ?>
                <li class="menu-item <?php if ((Request::url() === route('template_index')) || (Request::url() === route('template_add_get'))) {
                                            echo 'active';
                                        } ?>">
                    <a href="{{ route('template_index') }}" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-stack-3"></i>
                        <div data-i18n="Templates">Templates</div>
                    </a>
                </li>
            <?php } ?>
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text" data-i18n="AI Section">AI Section</span>
            </li>
            <?php if (in_array('student_progress', $stie_config_arr)) { ?>
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-progress-bolt"></i>
                        <div data-i18n="Student Progress">Student Progress</div>
                    </a>
                </li>
            <?php } ?>
            <?php if (in_array('ai_chan', $stie_config_arr)) { ?>
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-brand-wechat"></i>
                        <div data-i18n="AI Chan (Chat Bot)">AI Chan (Chat Bot)</div>
                    </a>
                </li>
            <?php } ?>
            <?php if (in_array('games', $stie_config_arr)) { ?>
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-device-gamepad-2"></i>
                        <div data-i18n="Games">Games</div>
                    </a>
                </li>
            <?php } ?>

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text" data-i18n="Management Section">Management Section</span>
            </li>
            <?php if (in_array('branches', $stie_config_arr)) { ?>
                <li class="menu-item <?php if ((Request::url() === route('branch_index')) || (Request::url() === route('branch_add_get'))) {
                                            echo 'active';
                                        } ?>">
                    <a href="{{ route('branch_index') }}" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-building-pavilion"></i>
                        <div data-i18n="Branches">Branches</div>
                    </a>
                </li>
            <?php } ?>

            <?php if (in_array('live_stream_settings', $stie_config_arr)) { ?>
                <li class="menu-item">
                    <a href="a" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-brand-youtube-kids"></i>
                        <div data-i18n="Live Stream Settings">Live Stream Settings</div>
                    </a>
                </li>
            <?php } ?>
            <?php if (in_array('human_resources', $stie_config_arr)) { ?>
                <li class="menu-item">
                    <a href="a" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-play-handball"></i>
                        <div data-i18n="Human Resources">Human Resources</div>
                    </a>
                </li>
            <?php } ?>
            <?php if (in_array('accounting', $stie_config_arr)) { ?>
                <li class="menu-item">
                    <a href="a" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-cash"></i>
                        <div data-i18n="Accounting">Accounting</div>
                    </a>
                </li>
            <?php } ?>
            <?php if (in_array('agreements', $stie_config_arr)) { ?>
                <li class="menu-item">
                    <a href="a" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-brand-backbone"></i>
                        <div data-i18n="Agreements">Agreements</div>
                    </a>
                </li>
            <?php } ?>
            <?php if (in_array('inventory_lists', $stie_config_arr)) { ?>
                <li class="menu-item">
                    <a href="a" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-brand-mastercard"></i>
                        <div data-i18n="Inventory List">Inventory List</div>
                    </a>
                </li>
            <?php } ?>
            <?php if (in_array('services_and_products', $stie_config_arr)) { ?>
                <li class="menu-item">
                    <a href="a" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-brand-svelte"></i>
                        <div data-i18n="Services and Products">Services and Products</div>
                    </a>
                </li>
            <?php } ?>
            <?php if (in_array('roles', $stie_config_arr)) { ?>
                <li class="menu-item <?php if ((Request::url() === route('user_role_list'))) {
                                            echo 'active';
                                        } ?>">
                    <a href="{{ route('user_role_list') }}" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-schema"></i>
                        <div data-i18n="Services and Products">Roles</div>
                    </a>
                </li>
            <?php } ?>

            <?php if (in_array('users', $stie_config_arr)) { ?>
                <li class="menu-item <?php if ((Request::url() === route('other_user_index')) || (Request::url() === route('other_user_add_get'))) {
                                            echo 'active';
                                        } ?>">
                    <a href="{{ route('other_user_index') }}" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-cookie-man"></i>
                        <div data-i18n="Users">Users</div>
                    </a>
                </li>
            <?php } ?>
            <?php if (in_array('user_privileges', $stie_config_arr)) { ?>
                <li class="menu-item <?php if ((Request::url() === route('user_privilege_list')) || (Request::url() === route('user_privilege'))) {
                                            echo 'active';
                                        } ?>">
                    <a href="{{ route('user_privilege_list') }}" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-brand-solidjs"></i>
                        <div data-i18n="Users"> User Privileges</div>
                    </a>
                </li>
            <?php } ?>

            <?php if (in_array('smart_reports', $stie_config_arr)) { ?>
                <li class="menu-item">
                    <a href="a" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-chart-infographic"></i>
                        <div data-i18n="Smart Reports">Smart Reports</div>
                    </a>
                </li>
            <?php } ?>
            <?php if (in_array('online_store', $stie_config_arr)) { ?>
                <li class="menu-item">
                    <a href="a" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-shopping-bag"></i>
                        <div data-i18n="Online Store">Online Store</div>
                    </a>
                </li>
            <?php } ?>
            <?php if (in_array('payment_gateways', $stie_config_arr)) { ?>
                <li class="menu-item">
                    <a href="a" class="menu-link">
                        <i class="icon_resize tf-icons ti ti-brand-paypal"></i>
                        <div data-i18n="Payment Gateways">Payment Gateways</div>
                    </a>
                </li>
            <?php } ?>
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text" data-i18n="Support Section">Support Section</span>
            </li>
            <?php if (in_array('help_desk', $stie_config_arr)) { ?>
                <li class="menu-item">
                    <a href="a" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-help"></i>
                        <div data-i18n="Help Desk">Help Desk</div>
                    </a>
                </li>
            <?php } ?>
            <?php if (in_array('settings', $stie_config_arr)) { ?>
                <li class="menu-item">
                    <a href="a" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-settings"></i>
                        <div data-i18n="Settings">Settings</div>
                    </a>
                </li>
            <?php } ?>
            <?php if (in_array('modules', $stie_config_arr)) { ?>
                <li class="menu-item">
                    <a href="a" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-packages"></i>
                        <div data-i18n="Modules">Modules</div>
                    </a>
                </li>
            <?php } ?>

            <li class="menu-item">
                <a href="{{ route('common_logout') }}" class="menu-link">
                    <i class="menu-icon icon_resize tf-icons ti ti-home-move"></i>
                    <div data-i18n="Logout">Logout</div>
                </a>
            </li>
        </ul>
    <?php } ?>
    <?php
    //for other user roles -HR,manager ,etc..
    $primary_roles = array(1, 2, 3, 4);
    if (!in_array($user_role_id, $primary_roles)) {
        $privileges = App\Models\UserPrivilege::getPrivilegesByUserId($user_id);
        $privileges_arr = explode(',', $privileges);

    ?>
        <ul class="menu-inner py-1">

            <li class="menu-item <?php if (Request::url() === route('dashboard')) {
                                        echo 'active';
                                    } ?>">
                <a href="{{ route('dashboard')}}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-smart-home"></i>
                    <div data-i18n="Dashboard">Dashboard</div>
                    <!--div class="badge bg-primary rounded-pill ms-auto">5</div-->
                </a>
            </li>

            <li class="menu-item <?php if (Request::url() === route('my_profile_user')) {
                                        echo 'active';
                                    } ?>">
                <a href="{{route('my_profile_user')}}" class="menu-link">
                    <i class="menu-icon fa-regular fa-circle-user"></i>
                    <div data-i18n="My Profile">My Profile</div>
                </a>
            </li>
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text" data-i18n="Academy Section">Academy Section</span>
            </li>
            <?php
            $subject_arr = array('subjectsCreate', 'subjectsRead', 'subjectsUpdate', 'subjectsDelete');
            $privileges = App\Models\UserPrivilege::getPrivilegesByUserId($user_id);
            $all_privilege_arr = explode(',', $privileges);
            //$result_subject = array_intersect($all_privilege_arr, $subject_arr);
            //$subject_count = count($result_subject);
            if (in_array('subjectsRead', $all_privilege_arr)) {
            ?>
                <li class="menu-item <?php if (Request::url() === route('subject_index')) {
                                            echo 'active';
                                        } ?>">
                    <a href="{{ route('subject_index')}}" class="menu-link">
                        <i class="menu-icon fa-solid fa-book"></i>
                        <div data-i18n="Subject">Subject</div>
                        <!--div class="badge bg-primary rounded-pill ms-auto">5</div-->
                    </a>
                </li>
            <?php } ?>
            <?php
            $department_arr = array('departmentsCreate', 'departmentsRead', 'departmentsUpdate', 'departmentsDelete');
            $privileges = App\Models\UserPrivilege::getPrivilegesByUserId($user_id);
            $all_privilege_arr = explode(',', $privileges);
            //$result_subject = array_intersect($all_privilege_arr, $subject_arr);
            //$subject_count = count($result_subject);
            if (in_array('departmentsRead', $all_privilege_arr)) {
            ?>
                <li class="menu-item <?php if (Request::url() === route('department_index')) {
                                            echo 'active';
                                        } ?>">
                    <a href="{{ route('department_index')}}" class="menu-link">
                        <i class="menu-icon fa-solid fa-network-wired"></i>
                        <div data-i18n="Department">Department</div>
                        <!--div class="badge bg-primary rounded-pill ms-auto">5</div-->
                    </a>
                </li>
            <?php } ?>
            <?php
            if (in_array('parentsRead', $all_privilege_arr)) {
            ?>
                <li class="menu-item <?php if (Request::url() === route('parent_list')) {
                                            echo 'active';
                                        } ?>">
                    <a href="{{ route('parent_list')}}" class="menu-link">
                        <i class="menu-icon fa-solid fa-users"></i>
                        <div data-i18n="Parents">Parents</div>
                        <!--div class="badge bg-primary rounded-pill ms-auto">5</div-->
                    </a>
                </li>
            <?php } ?>
            <?php
            if (in_array('studentsRead', $all_privilege_arr)) {
            ?>
                <li class="menu-item <?php if (Request::url() === route('student_list')) {
                                            echo 'active';
                                        } ?>">
                    <a href="{{ route('student_list')}}" class="menu-link">
                        <i class="menu-icon fa-solid fa-user-group"></i>
                        <div data-i18n="Students">Students</div>
                        <!--div class="badge bg-primary rounded-pill ms-auto">5</div-->
                    </a>
                </li>
            <?php } ?>
            <?php
            if (in_array('teachersRead', $all_privilege_arr)) {
            ?>
                <li class="menu-item <?php if (Request::url() === route('teacher_list')) {
                                            echo 'active';
                                        } ?>">
                    <a href="{{ route('teacher_list')}}" class="menu-link">
                        <i class="menu-icon fa-solid fa-user-graduate"></i>
                        <div data-i18n="Teachers">Teachers</div>
                        <!--div class="badge bg-primary rounded-pill ms-auto">5</div-->
                    </a>
                </li>
            <?php } ?>
            <?php
            if (in_array('templatesRead', $all_privilege_arr)) {
            ?>
                <li class="menu-item <?php if (Request::url() === route('template_index')) {
                                            echo 'active';
                                        } ?>">
                    <a href="{{ route('template_index')}}" class="menu-link">
                        <i class="menu-icon fa-solid fa-layer-group"></i>
                        <div data-i18n="Templates">Templates</div>
                        <!--div class="badge bg-primary rounded-pill ms-auto">5</div-->
                    </a>
                </li>
            <?php } ?>

            <?php if (in_array('classsroomsRead', $all_privilege_arr)) { ?>

                <li class="menu-item <?php if (Request::url() === route('index_list')) {
                                            echo 'active';
                                        } ?>">
                    <a href="{{route('index_list')}}" class="menu-link">
                        <i class="menu-icon fa-solid fa-school"></i>
                        <div data-i18n="Class Rooms">Class Rooms </div>
                    </a>
                </li>
            <?php } ?>
            <?php
            if (in_array('assignmentsRead', $all_privilege_arr)) {
            ?>
                <li class="menu-item <?php if (Request::url() === route('assignment')) {
                                            echo 'active';
                                        } ?>">
                    <a href="{{ route('assignment')}}" class="menu-link">
                        <i class="menu-icon icon_resize tf-icons ti ti-brand-stackoverflow"></i>
                        <div data-i18n="Assignments">Assignments</div>
                        <!--div class="badge bg-primary rounded-pill ms-auto">5</div-->
                    </a>
                </li>
            <?php } ?>

            <li class="menu-item">
                <a href="{{ route('common_logout') }}" class="menu-link">
                    <i class="menu-icon fa-solid fa-right-from-bracket"></i>
                    <div data-i18n="Logout">Logout</div>
                </a>
            </li>
        </ul>
    <?php } ?>
</aside>
