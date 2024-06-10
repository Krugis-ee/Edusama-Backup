<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Parent Assignments</title>
    <meta name="description" content="" />
    <link rel="stylesheet" href="{{asset('assets/select2/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/bootstrap-select/bootstrap-select.css')}}" />
    @include('dashboard.header')
    <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
    $org_color = App\Models\Organization::getOrgColorByID($org_id);
    ?>
    <style type="text/css">
        .add_parent .btn-primary {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .add_parent .app-brand-logo.demo {
            width: auto !important;
            height: auto !important;
        }

        .add_parent .form-check-input:checked,
        .add_parent .form-check-input[type=checkbox]:indeterminate {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .add_parent .form-check-input:focus {
            border-color: <?php echo $org_color; ?> !important;
        }

        .add_parent .bg-primary {
            background-color: <?php echo $org_color; ?> !important;
        }

        .add_parent .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_parent .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_parent .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .add_parent .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
            background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
            color: #ffffff !important;
        }

        .add_parent .menu-vertical .app-brand {
            margin: 20px 0.875rem 20px 1rem;
        }

        .add_parent i {
            font-size: 17px !important;
        }

        #half_logo {
            display: none;
        }

        .layout-menu-collapsed .half_logo {
            margin-left: 3px !important;
        }

        .layout-navbar-fixed .layout-page:before {
            background: #0000000d;
            mask: none;
        }

        .add_parent #template-customizer .template-customizer-open-btn {
            display: none;
        }

        .add_org .form-label {
            font-size: 17px;
        }
    </style>
</head>

<body class="add_parent">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('parent_dashboard.sidebar')
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('parent_dashboard.navbar')
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="app-ecommerce mb-3">
                            <div class="card-header d-flex flex-wrap justify-content-between gap-3">
                                <div class="card-title mb-0 me-1">
                                    <h4 class="mb-1 mt-3" id="pagetitle" style="color:<?php echo $org_color; ?>">Assignment Lists</h4>
                                </div>
                                @if($student_count == 1)
                                <div class="d-flex justify-content-md-end align-items-center gap-3 flex-wrap">
                                    <h5 style="color:<?php echo $org_color; ?>">Child name: </h5><span>
                                        <h5>{{App\Models\User::getStudentNameByID($student_id)}}</h5>
                                    </span>
                                </div>
                                @endif
                                @if($student_count > 1)
                                <form id="fetchAssignments" method="GET">
                                    <div class="d-flex justify-content-md-end align-items-center gap-3 flex-wrap">
                                        <select id="select2Basic" name="student_id" class="form-select form-select-lg parent_student" data-allow-clear="true">
                                            <option value="">Select child name</option>
                                            <?php
                                            $sele = '';
                                            foreach ($students as $student) {
                                                if (isset($_GET['student_id'])) {
                                                    if ($_GET['student_id'] == $student->id)
                                                        $sele = 'selected';
                                                    else
                                                        $sele = '';
                                                }
                                            ?>
                                                <option <?php echo $sele; ?> value="{{ $student->id }}">{{ $student->first_name.' '.$student->last_name }}</option>
                                            <?php }  ?>
                                        </select>
                                    </div>
                                </form>
                                @endif
                            </div>
                        </div>
                        <div class="card col-12">
                            <div class="card-body table_admin text-nowrap">
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr style="background-color: #f5c6cb30;">
                                            <th>Homework</th>
                                            <th>Subject</th>
                                            <th>Delivery Date</th>
                                            <th>File</th>
                                            <th>Status</th>
                                            <th>Response Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(!empty($assignments))
                                        @foreach ($assignments as $assignment)
                                        <tr>
                                            <td>
                                                <div class="word_ellipsis" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$assignment->title}}" style="cursor:pointer;">{{$assignment->title}}</div>
                                            </td>
                                            <td>{{App\Models\Subject::getSubjectNameBySubjectID($assignment->subject_id)}}</td>
                                            <td>{{$assignment->delivery_date}}</td>
                                            <?php
                                            $assignment_answer_pdf = App\Models\AssignmentProgress::getAnswerPdfByAssignmentId($assignment->id, $student_id);
                                            if (!empty($assignment_answer_pdf)) {
                                            ?>
                                                <td style="text-align: center !important;">
                                                    <div class="align-items-center lh-1 me-3 mb-3 mb-sm-0" style="cursor:pointer;">
                                                        <span class="badge badge-center bg-label-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{$assignment->title}}">
                                                            <a class="view-file" href="{{asset('assets/pdf/student_assignment/answer_file/'.$assignment_answer_pdf)}}" target="_blank" style="color:#4b4b4b ;">
                                                                <i class="ti ti-eye"></i>
                                                            </a>
                                                        </span>
                                                    </div>
                                                </td>
                                            <?php } else { ?>
                                                <td><span class="badge bg-label-primary" style="cursor:pointer;">Yet to Upload</span></td>
                                            <?php } ?>
                                            <?php
                                            $assignment_submitted_date = App\Models\AssignmentProgress::getAssignmentSubmittedDate($assignment->id, $student_id);
                                            $assignment_answer_pdf = App\Models\AssignmentProgress::getAnswerPdfByAssignmentId($assignment->id, $student_id);
                                            if (!empty($assignment_answer_pdf)) {
                                            ?>
                                                <td>
                                                    <span class="badge rounded-pill bg-label-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="sent on {{date("d/m/Y",strtotime($assignment_submitted_date))}}" style="cursor:pointer;">Sent</span>
                                                </td>
                                            <?php } else { ?>
                                                <td>
                                                    <span class="badge rounded-pill bg-label-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Yet to Receive Response" style="cursor:pointer;">Pending</span>
                                                </td>
                                            <?php } ?>
                                            <td>
                                                <?php
                                                $assignment_answer_status = App\Models\AssignmentProgress::getAnswerResponseStatusByAssignmentId($assignment->id, $student_id);
                                                $assignment_score = App\Models\AssignmentProgress::getAnswerScore($assignment->id, $student_id);
                                                $assignment_submitted_date = App\Models\AssignmentProgress::getAssignmentSubmittedDate($assignment->id, $student_id);
                                                $assignment_score_comment = App\Models\AssignmentProgress::getAnswerScoreComment($assignment->id, $student_id);
                                                if ($assignment_answer_status == 1) {
                                                ?>
                                                    <span data-bs-toggle="modal" class="toggle-class" data-title="{{$assignment->title}}" data-score="{{$assignment_score}}" data-date="{{date("d/m/Y",strtotime($assignment_submitted_date))}}" data-score_comment="{{$assignment_score_comment}}" style="cursor:pointer;">
                                                        <span class="badge badge-center bg-success bg-glow" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Response Received"><i class="ti ti-hand-stop"></i></span>
                                                    </span>
                                                <?php }
                                                if ($assignment_answer_status == 0) { ?>
                                                    <span>
                                                        <span class="badge badge-center bg-label-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Yet to Receive Response"><i class="ti ti-clock"></i></span>
                                                    </span>
                                                <?php } ?>
                                                <div class="modal fade" id="assign_preview" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title mt-3 title" id="modalCenterTitle" style="color:<?php echo $org_color; ?>">
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body" style="text-align: left;">
                                                                <div class="row g-2">
                                                                    <div class="col mb-2">
                                                                        <label for="assign_score" class="form-label">Score</label>
                                                                        <input type="text" class="form-control score" id="assign_score" readonly />
                                                                    </div>
                                                                    <div class="col mb-2">
                                                                        <label for="received_on" class="form-label">Received On</label>
                                                                        <input type="text" class="form-control date" id="received_on" readonly />
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <label for="assign_comments" class="form-label">Comments</label>
                                                                        <textarea class="form-control score_comment" id="assign_comments" rows="3" readonly></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content -->
                <!-- Footer -->

                <!-- / Footer -->
                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->
    @include('dashboard.footer')
    <!-- Page JS -->
    <script src="{{asset('assets/js/forms-selects.js')}}"></script>
    <script src="{{asset('assets/select2/select2.js')}}"></script>
    <!-- endbuild -->
    <!-- Vendors JS -->
    <script type="text/javascript">
        new DataTable('#example', {
            pagingType: 'simple_numbers'
        });
    </script>
    <script>
        $(function() {
            // $('#suspend').on("click",function() {
            $("#example").on("click", ".toggle-class", function() {

                $(".score").val($(this).data('score'));
                $(".date").val($(this).data('date'));
                $(".title").html($(this).data('title'));
                $(".score_comment").html($(this).data('score_comment'));
                $("#assign_preview").modal('show');
            });
        });
    </script>
    <script>
        $("#select2Basic").change(function() {
            var student_id = $(this).val();
            $('#fetchAssignments').submit();
        });
    </script>
</body>

</html>
