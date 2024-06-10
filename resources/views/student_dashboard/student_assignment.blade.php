<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Student Assignments</title>
    <meta name="description" content="" />
    <link rel="stylesheet" href="assets/select2/select2.css" />
    @include('dashboard.header')
    <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
    $org_color = App\Models\Organization::getOrgColorByID($org_id);
    ?>

    <style type="text/css">
        .student_assignments #logo_color {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .student_assignments .app-brand-logo.demo {
            width: auto !important;
            height: auto !important;
        }

        .student_assignments .form-check-input:checked,
        .student_assignments .form-check-input[type=checkbox]:indeterminate {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .student_assignments .form-check-input:focus {
            border-color: <?php echo $org_color; ?> !important;
        }

        .student_assignments .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .student_assignments .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .student_assignments .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .student_assignments .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
            background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
            color: #ffffff !important;
        }

        .student_assignments .menu-vertical .app-brand {
            margin: 20px 0.875rem 20px 1rem;
        }

        .student_assignments .icon_resize {
            font-size: 17px !important;
        }

        .student_assignments #layout-menu .icon_resize {
            margin-right: 10px;
        }

        .layout-navbar-fixed .layout-page:before {
            background: #0000000d;
            mask: none;
        }

        .student_assignments #template-customizer .template-customizer-open-btn {
            display: none;
        }

        .table_admin select#dt-length-0 {
            margin-right: 10px !important;
        }

        .table_admin .dt-search .dt-input {
            margin-left: 14px !important;
        }

        .student_assignments .bg-primary {
            background-color: <?php echo $org_color; ?> !important;
        }

        .table_admin .dt-search .dt-input:focus,
        .table_admin .dt-length select.dt-input:focus {
            color: #6f6b7d;
            background-color: #fff;
            border-color: #7367f0;
            outline: 0;
            box-shadow: 0 0.125rem 0.25rem rgba(165, 163, 174, 0.3);
        }

        .table_admin .dt-length select.dt-input {
            --bs-form-select-bg-img: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5 7.5L10 12.5L15 7.5' stroke='%236f6b7d' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M5 7.5L10 12.5L15 7.5' stroke='white' stroke-opacity='0.2' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
            padding: 0.422rem 2.45rem 0.422rem 0.875rem;
            font-size: 0.9375rem;
            font-weight: 400;
            line-height: 1.5;
            color: #6f6b7d;
            appearance: none;
            background-color: #fff;
            background-image: var(--bs-form-select-bg-img), var(--bs-form-select-bg-icon, none);
            background-repeat: no-repeat;
            background-position: right 0.875rem center;
            background-size: 22px 20px;
            border: var(--bs-border-width) solid #dbdade;
            border-radius: var(--bs-border-radius);
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        table.dataTable.display tbody tr:hover>.sorting_1,
        table.dataTable.order-column.hover tbody tr:hover>.sorting_1,
        table.dataTable.display>tbody>tr:nth-child(odd)>.sorting_1,
        table.dataTable.order-column.stripe>tbody>tr:nth-child(odd)>.sorting_1,
        table.dataTable.stripe>tbody>tr:nth-child(odd)>*,
        table.dataTable.display>tbody>tr:nth-child(odd)>* {
            box-shadow: none !important;
        }

        .dt-layout-row {
            padding-bottom: 20px;
        }

        .table_admin th {
            color: #5d596c !important;
            font-weight: normal !important;
            text-transform: uppercase !important;
            font-size: 0.8125rem !important;
            letter-spacing: 1px !important;
        }

        .table_admin .dt-paging-button.current {
            background: rgba(75, 70, 92, 0.08) !important;
            border: 1px solid #aaa !important;
        }

        .table_admin .dt-paging-button.current:active {
            color: #6f6b7d !important;
            background-color: #fff !important;
            border-color: #7367f0 !important;
            outline: 0 !important;
            box-shadow: 0 0.125rem 0.25rem rgba(165, 163, 174, 0.3) !important;
        }

        tr td {
            text-align: center !important;
        }

        tr th {
            text-align: center !important;
        }

        .dt-empty {
            text-align: center !important;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            background-color: #fce4e4;
            border-color: #fce4e4;
            color: inherit !important;
        }

        .dropdown-item:not(.disabled).active,
        .dropdown-item:not(.disabled):active {
            background-color: <?php echo $org_color; ?>;
            color: #fff !important;
        }

        html:not(.layout-menu-collapsed) .bg-menu-theme .menu-inner .menu-item:not(.active)>.menu-link:hover {
            background-color: #fce4e4 !important;
            border-color: #fce4e4 !important;
            color: inherit !important;
        }

        #pagetitle,
        #modalCenterTitle,
        #exampleModalLabel5 {
            color: <?php echo $org_color; ?>;
        }

        #home_work:hover {
            background: linear-gradient(72.47deg, #e00814 22.16%, rgb(224, 8, 20, 0.7) 76.47%) !important;
            color: #ffffff !important;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .word_ellipsis {
            white-space: nowrap;
            width: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body class="student_assignments">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('student_dashboard.sidebar')
            <div class="layout-page">
                <!-- Navbar -->
                @include('student_dashboard.navbar')
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y" id="student_dashboard">
                        <div class="app-ecommerce mb-3">
                            <div class="d-flex flex-column justify-content-center">
                                <h4 class="mb-1 mt-3" id="pagetitle">My Assignments</h4>
                            </div>
                        </div>
                        <!-- <button type="button" class="btn btn-label-dark waves-effect mb-3" style="float:right;">Export&nbsp;<i class="icon_resize ti ti-file-arrow-right ti-sm"></i></button> -->
                        <div class="card col-12">
                            <div class="card-body table_admin text-nowrap">
                                @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                                @endif
                                @error('answer_assignment')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr style="background-color: #f5c6cb30;">
                                            <th>Homework</th>
                                            <th>Subjects</th>
                                            <th>Delivery Date</th>
                                            <th>File</th>
                                            <th>Action</th>
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
                                            $assignment_download_status = App\Models\AssignmentProgress::getAssignmentDownloadStatusByAssignmentId($assignment->id,$student_id);
                                            if ($assignment_download_status == 0) {
                                            ?>
                                                <td>
                                                    <a data-assignment_id="{{$assignment->id}}" href="{{asset('assignments/'.$assignment->assignment_pdf)}}"  class="badge bg-label-primary download" download="assignment question">Download</a>
                                                </td>
                                            <?php } else if ($assignment_download_status == 1) { ?>
                                                <td>
                                                    <a class="badge bg-label-info" href="{{asset('assignments/'.$assignment->assignment_pdf)}}" download="assignment question">Downloaded</a>
                                                </td>
                                            <?php } ?>
                                            <?php
                                            $assignment_answer_pdf = App\Models\AssignmentProgress::getAnswerPdfByAssignmentId($assignment->id,$student_id);
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
                                            <?php } else {
                                                $student_id = App\Models\AssignmentProgress::getStudentIdByAssignmentId($assignment->id);?>
                                                <td>
                                                    <form enctype="multipart/form-data" method="POST" action="{{route('answer_upload_status')}}">
                                                        @csrf
                                                        <div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0" style="cursor:pointer;" onclick="open_file()">
                                                            <i class="ti ti-file-upload ti-sm"></i> Add File
                                                        </div>
                                                        <input type="file" name="answer_assignment" id='input_file' onchange="this.form.submit()" hidden>
                                                        <input type="text" name="assignment_id" value="{{$assignment->id}}" hidden>
                                                        <input type="text" name="answer_sent_status" value="1" hidden>
                                                        <input type="text" name="student_id" value="{{$student_id}}" hidden>
                                                        <input type="text" name="updated_date" value="{{$date = date("Y-m-d h:i:sa");}}" hidden>
                                                    </form>
                                                </td>
                                            <?php } ?>
                                            <?php
                                            $assignment_answer_pdf = App\Models\AssignmentProgress::getAnswerPdfByAssignmentId($assignment->id,$student_id);
                                            $assignment_submitted_date = App\Models\AssignmentProgress::getAssignmentSubmittedDate($assignment->id,$student_id);
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
                                                $assignment_answer_status = App\Models\AssignmentProgress::getAnswerResponseStatusByAssignmentId($assignment->id,$student_id);
                                                $assignment_score = App\Models\AssignmentProgress::getAnswerScore($assignment->id,$student_id);
                                                $assignment_submitted_date = App\Models\AssignmentProgress::getAssignmentSubmittedDate($assignment->id,$student_id);
                                                $assignment_score_comment = App\Models\AssignmentProgress::getAnswerScoreComment($assignment->id,$student_id);
                                                if ($assignment_answer_status == 1) {
                                                ?>
                                                    <span data-bs-toggle="modal" class="toggle-class" data-title="{{$assignment->title}}" data-score="{{$assignment_score}}" data-date="{{date("d/m/Y",strtotime($assignment_submitted_date))}}" data-score_comment ="{{$assignment_score_comment}}" style="cursor:pointer;">
                                                        <span class="badge badge-center bg-success bg-glow" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Response Received"><i class="ti ti-hand-stop"></i></span>
                                                    </span>
                                                <?php } if ($assignment_answer_status == 0) { ?>
                                                    <span>
                                                        <span class="badge badge-center bg-label-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Yet to Receive Response"><i class="ti ti-clock"></i></span>
                                                    </span>
                                                <?php } ?>
                                                <div class="modal fade" id="assign_preview" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title mt-3 title" id="modalCenterTitle">
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
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Content -->
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
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    @include('dashboard.footer')
    <!-- Form Validation -->

    <!-- Page JS -->
    <script src="assets/js/forms-selects.js"></script>
    <script src="assets/select2/select2.js"></script>
    <!-- endbuild -->
    <!-- Vendors JS -->
    <script>
        new DataTable('#example', {
            pagingType: 'simple_numbers'
        });
    </script>
    <script type="text/javascript">
        function open_file() {
            document.getElementById('input_file').click();
        }
    </script>
    <script>
        $("#example").on("click", ".download", function(e) {

            var status = 1;
            var assignment_id = $(this).data('assignment_id');
            // var assignment_pdf = $(this).data('assignment_pdf');
            $.ajax({
                type: 'GET',
                url: "{{ route('assignment_download_status') }}",
                data: {
                    status: status,
                    assignment_id: assignment_id,
                    // assignment_pdf: assignment_pdf
                },

                success: function(data) {
                    //alert(assignment_pdf);
                    location.reload();
                }
            });
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
</body>

</html>
