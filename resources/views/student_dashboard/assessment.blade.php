<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Student Dashboard</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    @include('dashboard.header')
    <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
    $org_color = App\Models\Organization::getOrgColorByID($org_id);
    $student_avatar = !empty(App\Models\User::getStudentAvatarById($user_id)) ? App\Models\User::getStudentAvatarById($user_id) : '15.png';
    ?>
    <!-- Student Dashboard -->
    <link rel="stylesheet" href="assets/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="assets/swiper/swiper.css" />
    <link rel="stylesheet" href="assets/css/app-calendar.css" />
    <link rel="stylesheet" href="assets/fullcalendar/fullcalendar.css" />
    <link rel="stylesheet" href="assets/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="assets/select2/select2.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css">
    <script type="text/javascript" src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="assets/js/helpers.js"></script>
    <script src="assets/js/template-customizer.js"></script>
    <script src="assets/js/config.js"></script>
    <link rel="stylesheet" href="assets/css/app-academy.css" />
    <link rel="stylesheet" href="assets/css/cards-advance.css" />
    <link href="https://cdn.jsdelivr.net/npm/Bootstrap@5.2.2/dist/css/Bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/Bootstrap@5.2.2/dist/js/Bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/Bootstrap@5.2.2/dist/js/Bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,900,700,500,300,100' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js'></script>

    <link rel="stylesheet" href="assets/apex-charts/apex-charts.css" />

    <style type="text/css">
        .dashboard_page .btn-primary {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .dashboard_page .app-brand-logo.demo {
            width: auto !important;
            height: auto !important;
        }

        .dashboard_page .form-check-input:checked,
        .dashboard_page .form-check-input[type=checkbox]:indeterminate {
            background-color: <?php echo $org_color; ?> !important;
            border-color: <?php echo $org_color; ?> !important;
        }

        .dashboard_page .form-check-input:focus {
            border-color: <?php echo $org_color; ?> !important;
        }

        .dashboard_page .bg-primary {
            background-color: <?php echo $org_color; ?> !important;
        }

        .dashboard_page .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .dashboard_page .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .dashboard_page .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
        .dashboard_page .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
            background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
            color: #ffffff !important;
        }

        .dashboard_page .menu-vertical .app-brand {
            margin: 20px 0.875rem 20px 1rem;
        }

        .dashboard_page i {
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

        .dashboard_page #template-customizer .template-customizer-open-btn {
            display: none;
        }

        .dashboard_page line[y1="0"] {
            display: none;
        }

        .dashboard_page .side_panel .avatar-initial {
            background: #f4f2f6;
            color: #000;
            border: 1px solid #eee;
        }

        .dashboard_page .drag_icon {
            font-size: 20px !important;
        }

        td {
            box-shadow: none !important;
        }

        .table_admin select#dt-length-0 {
            margin-right: 10px !important;
        }

        .table_admin .dt-search .dt-input {
            margin-left: 14px !important;
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

        .drag_body .card-body {
            padding: 11px;
        }

        .drag_body .content-right p.mb-0 {
            font-size: 14px;
        }

        .drag_body .content-right {
            text-align: center;
            width: 75%;
        }

        .drag_body .bg-label-primary.p-2.rounded {
            width: 20%;
        }

        .mg-2 {
            margin-bottom: 10px;
        }

        .fc-dayGridMonth-button,
        .fc-timeGridWeek-button,
        .fc-timeGridDay-button,
        .fc-listMonth-button {
            display: none !important;
        }

        .fc-next-button {
            left: 22rem;
        }

        .fc-toolbar-title {
            left: 4rem;
            position: relative;
        }

        .app-academy .app-academy-img-height {
            height: 130px;
        }

        @media (min-width: 768px) {
            .app-academy .app-academy-md-25 {
                width: 25%;
            }

            .app-academy .app-academy-md-50 {
                width: 50%;
            }

            .app-academy .app-academy-md-80 {
                width: 80%;
            }
        }

        @media (min-width: 576px) {
            .app-academy .app-academy-sm-40 {
                width: 40% !important;
            }

            .app-academy .app-academy-sm-60 {
                width: 60% !important;
            }
        }

        @media (min-width: 1200px) {
            .app-academy .app-academy-xl-100 {
                width: 100% !important;
            }

            .app-academy .app-academy-xl-100 {
                width: 100% !important;
            }
        }

        #demo {
            text-align: center;
            font-style: italic;
            color: #e4232e;
            font-weight: bold;
            font-size: 45px;
            margin: 0px auto;
        }

        .text-left {
            text-align: left !important;
        }

        #student_dashboard .ti-xl {
            font-size: 2.25rem !important;
        }

        .my_courses .timeline .timeline-item {
            padding-left: 1.5rem;
        }

        .my_notification:hover {
            color: #f06767;
        }

        .flatpickr-calendar {
            margin: auto;
        }
    </style>
</head>

<body class="dashboard_page">
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
              <div class="card-header d-flex flex-wrap justify-content-between gap-3">
                <div class="card-title mb-3 me-1">
                  <h4 class="mb-0 mt-3" id="pagetitle">My Assessments</h4>
                </div>
                <div class="d-flex justify-content-md-end align-items-center gap-3 flex-wrap mb-3">
                  <select id="defaultSelect" class="form-select">
                    <option disabled selected>Filter by Status</option>
                    <option value="all">All</option>
                    <option value="1">Completed</option>
                    <option value="2">Not Started</option>
                  </select>
                </div>
              </div>
            </div>
			
            <div class="card col-12">
              <div class="card-body table_admin text-nowrap">
                <table id="example" class="display" style="width:100%">
                  <thead>
                    <tr style="background-color: #f5c6cb30;">
                      <th>Exam Name</th>
                      <th>Subject</th>
                      <th>Last Date</th>
                      <th>Passing Marks</th>
                      <th>Duration</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php if($exams)
				  {
					  foreach($exams as $exam) { ?>
                    <tr>
                      <td>
                        <div class="word_ellipsis" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Exam 1" style="cursor:pointer;">{{ $exam->exam_name }}</div>
                      </td>
                      <td><?php
						$subject_id=$exam->subject_id;
						$subject=App\Models\Subject::find($subject_id);
						echo $subject_name=$subject->subject_name;
						?></td>
                      <td>{{ $exam->exam_end_date }}</td>
                      <td><?php echo $exam->passing_mark.'/'.$exam->total_marks; ?></td>
                      <td><?php echo $exam->duration; ?></td>
                      <td><span class="badge bg-label-success">Completed</span></td>
                      <td> <span data-bs-toggle="modal" data-bs-target="#scoreboard_preview" style="cursor:pointer;">
                          <span data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Score Board"  class="badge badge-center bg-info bg-glow"><i class="ti ti-scoreboard"></i></span> </span>
                        <div class="modal fade" id="scoreboard_preview" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                              <div class="modal-header d-flex justify-content-between">
                                <h5 class="modal-title" id="modalCenterTitle">
                                  Exam 1
                                </h5> <span class="badge bg-label-success">Passed</span> </div>
                              <div class="modal-body" style="text-align: left;">
                                <div class="row g-2">
                                  <div class="col mb-2">
                                    <label for="assign_score" class="form-label">Subject</label>
                                    <input type="text" class="form-control" value="Subject 1" readonly/> </div>
                                  <div class="col mb-2">
                                    <label for="received_on" class="form-label">Submitted On</label>
                                    <input type="text" class="form-control" id="received_on" placeholder="" value="12-05-2024" readonly/> </div>
                                </div>
                                <div class="row g-2">
                                  <div class="col mb-2">
                                    <label for="assign_score" class="form-label">Score</label>
                                    <input type="text" class="form-control" id="assign_score" placeholder="" value="50" readonly/> </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="reset" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                </div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
				  <?php }} ?>
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
            <!-- Core JS -->
            <!-- build:js assets/vendor/js/core.js -->
            <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>
            <!-- endbuild -->
            <!-- / Layout page -->
            @include('dashboard.footer')
            <!-- Vendors JS -->
            <script src="assets/sortablejs/sortable.js"></script>
            <!-- Main JS -->
            <script src="assets/js/main.js"></script>
            <!-- Page JS -->
            <!-- Page JS -->
            <script src="assets/js/extended-ui-drag-and-drop.js"></script>
            <script type="text/javascript">
                (function() {
                    const cardEl = document.getElementById('sortable-cards')

                    if (cardEl) {
                        Sortable.create(cardEl);
                    }

                });
            </script>
            <!-- Page JS -->
            <script src="assets/js/app-ecommerce-dashboard.js"></script>
            <script src="assets/js/charts-apex.js"></script>
            <script src="assets/js/dashboards-analytics.js"></script>
            <script src="assets/js/app-calendar-events.js"></script>
            <script src="assets/js/app-calendar.js"></script>
            <script src="assets/fullcalendar/fullcalendar.js"></script>
            <script src="assets/select2/select2.js"></script>
            <script src="assets/flatpickr/flatpickr.js"></script>
            <script src="assets/moment/moment.js"></script>
            <script src="assets/js/app-academy-dashboard.js"></script>
            <script src="assets/apex-charts/apexcharts.js"></script>
            <script src="assets/js/dashboards-analytics.js"></script>
            <script src="assets/js/extended-ui-perfect-scrollbar.js"></script>
            <script src="assets/js/app-academy-dashboard.js"></script>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

            <script src="assets/apex-charts/apexcharts.js"></script>
            <script src="assets/js/charts-apex.js"></script>
            <script src="assets/chartjs/chartjs.js"></script>
            <script src="assets/js/charts-chartjs.js"></script>
            <script>
                new DataTable('#example', {
                    pagingType: 'simple_numbers'
                });
            </script>
            <script>
                new DataTable('#example', {
                    pagingType: 'simple_numbers'
                });
            </script>
            <script>
                // Set the date we're counting down to
                var countDownDate = new Date("Apr 17, 2024 15:37:25").getTime();

                // Update the count down every 1 second
                var x = setInterval(function() {

                    // Get today's date and time
                    var now = new Date().getTime();

                    // Find the distance between now and the count down date
                    var distance = countDownDate - now;

                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    // Output the result in an element with id="demo"
                    document.getElementById("demo").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

                    document.getElementById("demo1").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

                    // If the count down is over, write some text
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("demo").innerHTML = "EXPIRED";
                        document.getElementById("demo1").innerHTML = "EXPIRED";
                    }
                }, 1000);
            </script>
            <script>
                var ctx = document.getElementById("myLineChart").getContext("2d");
                var myChart = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: [
                            "January",
                            "February",
                            "March",
                            "April",
                            "May",
                            "June",
                            "July",
                            "August",
                            "September",
                            "October",
                            "November",
                            "Decemebr",
                        ],
                        datasets: [{
                            label: "Course Attended",
                            data: [2, 45, 36, 10, 69, 8, 33, 9, 3, 17, 6, 3],
                            backgroundColor: "#e6374169",
                        }, {
                            label: "Course Missed",
                            data: [2, 5, 8, 6, 4, 3, 2, 5, 5, 2, 1, 10],
                            backgroundColor: "#e95ba3",
                        }, ],
                    },
                });
            </script>
            <script type="text/javascript">
                $(document).ready(function() {

                    google.charts.load('current', {
                        'packages': ['corechart']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {

                        var data = google.visualization.arrayToDataTable([
                            ['Task', 'Hours per Day'],
                            ['Study', 11],
                            ['Playing', 2],
                            ['Watch TV', 2],
                            ['Tution', 2],
                            ['Sleep', 7]
                        ]);

                        var options = {
                            title: 'My Day Schedule',
                            is3D: true
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('piechart3d'));

                        chart.draw(data, options);
                    }


                });
            </script>


</body>

</html>
