<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Video Course</title>
    <meta name="description" content="" />
    @include('dashboard.header')
    <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
    $org_color = App\Models\Organization::getOrgColorByID($org_id);
    $student_avatar = !empty(App\Models\User::getStudentAvatarById($user_id)) ? App\Models\User::getStudentAvatarById($user_id) : '15.png';
    ?>

    <link rel="stylesheet" href="{{asset('assets/select2/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/plyr/plyr.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/bootstrap-select/bootstrap-select.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/rateyo/rateyo.css')}}" />
    <!-- Page CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/app-academy.css')}}" />

    <style type="text/css">
      .course_lists .btn-primary {
        background-color: <?php echo $org_color; ?> !important;
        border-color: <?php echo $org_color; ?> !important;
      }

      .course_lists .app-brand-logo.demo {
        width: auto !important;
        height: auto !important;
      }

      .course_lists .form-check-input:checked,
      .course_lists .form-check-input[type=checkbox]:indeterminate,
        {
        background-color: <?php echo $org_color; ?> !important;
        border-color: <?php echo $org_color; ?> !important;
      }

      .course_lists .form-check-input:focus {
        border-color: <?php echo $org_color; ?> !important;
      }

      .course_lists .bg-primary {
        background-color: <?php echo $org_color; ?> !important;
      }

      .course_lists .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
      .course_lists .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
      .course_lists .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
      .course_lists .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
        background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, <?php echo $org_color; ?> 76.47%) !important;
        color: #ffffff !important;
      }

      .course_lists .menu-vertical .app-brand {
        margin: 20px 0.875rem 20px 1rem;
      }

      .course_lists aside i, .course_lists nav i {
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

      .course_lists #template-customizer .template-customizer-open-btn {
        display: none;
      }

      .product-sale-label {
        color: #787070;
        background: var(--bs-hover);
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 2px 8px;
        position: absolute;
        top: 15px;
        left: 15px;
      }

      .product-like-icon {
        /*  color: #696969;*/
        font-size: 22px;
        line-height: 20px;
        position: absolute;
        top: 15px;
        right: 38px;
      }

      .product-like-icon:hover {
        color: var(--bs-hover);
      }

      .product-like-icon:before,
      .product-like-icon:after {
        color: #fff;
        background-color: #000;
        font-size: 12px;
        line-height: 18px;
        padding: 7px 7px 5px;
        visibility: hidden;
        position: absolute;
        right: 0;
        top: 15px;
        transition: all 0.3s ease 0s;
      }

      .product-like-icon:after {
        content: '';
        height: 15px;
        width: 15px;
        padding: 0;
        transform: translateX(-50%) rotate(45deg);
        right: auto;
        left: 50%;
        top: 15px;
        z-index: -1;
      }

      .heart {
        color: #787070;
        position: absolute;
        margin-left: auto;
        margin-top: auto;
        z-index: 999;
        cursor: pointer;
        font-size: 13px;
      }

      .heart-checkbox {
        display: none;
      }

      .heart-checkbox:checked+.heart {
        color: red;
      }

      .course_badge {
        font-size: 13px;
        padding: 4px 11px;
        position: absolute;
        top: 34%;
        left: 15px;
      }

      .ti-notes, .ti-clock-hour-9 {
        font-size: 17px !important;
        color: #7367f0 !important;
        font-weight: bold;
      }

      .price_list {
        font-size: 18px;
        font-weight: 600;
        color: #5f2ded;
        margin-bottom: 20px
      }

      .price_list .del__2 {
        color: #ff2828 !important;
        font-size: 16px !important;
      }

      .price_list del {
        color: #a2a9b6;
        font-size: 13px;
      }

      .fa-star.checked {
        color: orange;
      }

      .avatar {
        vertical-align: middle;
        border-radius: 50%;
      }
      .gridarea__wraper {
          box-shadow: 0 0 20px 10px rgba(95, 45, 237, 0.1);
      }
      .gridarea__wraper.gridarea__course__list {
    display: flex;
    margin-bottom: 30px;
    padding-right: 30px;
}
.gridarea__wraper.gridarea__course__list .gridarea__img {
    margin-bottom: 0;
    width: 35%;
}
.gridarea__wraper .gridarea__img img {
    width: 100%;
    border-radius: 4px;
}
.gridarea__wraper .gridarea__img .gridarea__small__button {
    position: relative;
    top: -84.5%;
    left: 3%;
}
.gridarea__wraper .gridarea__img .gridarea__small__button .grid__badge, .course_badge {
    background: #f2277e;
    color: #fff;
    border-radius: 3px;
    font-weight: 600;
    font-size: 12px;
    display: inline-block;
    text-align: center;
    padding: 5px 15px;
    line-height: 1;
}
.gridarea__wraper.gridarea__course__list .gridarea__content {
    width: 65%;
        padding-left: 30px;
}
.gridarea__wraper .gridarea__content .gridarea__list {
    margin-bottom: 15px;
}
.gridarea__wraper .gridarea__content .gridarea__list ul {
    display: flex;
    padding: 0px;
}
.gridarea__wraper .gridarea__content .gridarea__list ul li {
    font-size: 14px;
    width: 50%;
    list-style: none;
    display: inline-block;
}
.gridarea__wraper .gridarea__content .gridarea__list ul li i {
    font-size: 18px;
    color: #5f2ded;
    margin-right: 5px;
}

.gridarea__wraper.gridarea__course__list .gridarea__content .gridarea__heading {
    max-width: 95%;
}
.gridarea__wraper.gridarea__course__list .gridarea__content .gridarea__heading h3 {
    font-weight: 600;
    font-size: 20px;
    line-height: 30px;
}
.gridarea__wraper.gridarea__course__list .gridarea__content .gridarea__price {
    font-weight: 500;
    font-size: 14px;
    line-height: 22px;
    color: rgba(114, 106, 137, 0.8);
    margin-bottom: 20px;
}
.gridarea__heading h3 a, .course_heading{
color: #dd3333;
}
.gridarea__wraper .gridarea__content .gridarea__bottom {
    border-top: 1px solid #ddd;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 15px;
}
.gridarea__bottom__left {
    display: flex;
    align-items: center;
}
.gridarea__wraper .gridarea__content .gridarea__bottom .gridarea__small__img {
    display: flex;
    align-items: center;
}
.gridarea__wraper .gridarea__content .gridarea__bottom .gridarea__small__img img {
    max-width: 30px;
    border-radius: 50px;
}
.gridarea__wraper .gridarea__content .gridarea__bottom .gridarea__small__content {
    margin-left: 15px;
}
.gridarea__wraper.gridarea__wraper__2 .gridarea__content .gridarea__bottom .gridarea__small__img .gridarea__small__content h6 {
    font-weight: 500;
    font-size: 14px;
    line-height: 17px;
    margin-bottom: 0px;
}
.gridarea__bottom__left .gridarea__star {
    margin-left: 35px;
    color: #ff912c;
    font-size: 15px;
}
/*.gridarea__wraper.gridarea__course__list .gridarea__content .gridarea__bottom .gridarea__details a {
    font-weight: 500;
    font-size: 16px;
    line-height: 19px;
    color: #dd3333;
}*/
.gridarea__wraper .gridarea__content .gridarea__bottom .gridarea__star span {
    color: #6d6e75;
    font-size: 13px;
}
.gridarea__wraper{
      padding: 15px;
}
#demo {
    font-weight: 600;
    font-size: 18px;
    line-height: 22px;
    color: #1ec902;
}
.default__button {
    padding: 10px 25px;
    background-color: #dd3333;
    color: #fff !important;
    display: inline-block;
    text-align: center;
    border-radius: 4px;
    font-size: 15px;
    border: 1px solid #dd3333;
}
.default__button:hover {
    background-color: #fff;
    color: #dd3333 !important;
    border-color: #dd3333;
    border: 1px solid #dd3333;
    cursor: pointer;
}
    </style>
  </head>
  <body class="course_lists">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
         @include('teacher_dashboard.sidebar')
        <!-- / Menu -->
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          @include('teacher_dashboard.navbar')
          <!-- / Navbar -->
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="app-academy">
                  <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
                    <div class="d-flex flex-column justify-content-center">
                      <h5 class="mb-0" style="color: <?php echo $org_color; ?>;">Video Courses</h5>
                    </div>
                    <!-- <div class="d-flex align-content-center flex-wrap gap-3">
                      <div class="d-flex gap-3">
                        <select id="select2_course_select" class="select2 form-select" data-placeholder="All Courses">
                           <option value="">All Courses</option>
                           <option value="n5">n5</option>
                           <option value="n4">n4</option>
                           <option value="speech">Speech Class</option>
                         </select>
                      </div>
                    </div> -->
                  </div>
                  <div class="card online_courses mb-4" id="online_courses">
                     <div class="card-body">
                       <div class="row gy-4 mb-4">
                         <?php				 
				  $i=0;
				  if($timings) {
				  foreach($timings as $timing)
				  { 
				  $weakday=$timing->weakday;
					  $from_time_db=$timing->from_time;
					  $to_time_db=$timing->to_time;
					  //echo $from_time;
					  $from_time = strtotime('this '.$weakday. $from_time_db);
					  $to_time = strtotime('this '.$weakday. $to_time_db);
					  $tz = 'Asia/Kolkata';
							$timestamp = time();
							$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
							$dt->setTimestamp($timestamp); //adjust the object to correct timestamp
							
							$current_time= $dt->format('H:i');
							
							//utc+5.30 - time
							$current_timestamp=time()+ (5 * 60 * 60)+(30*60);
					  if( $current_timestamp<=$to_time) {
						  
					  if($i<3)  {
						   
					  
				  ?>
						 <div class="col-sm-6 col-lg-4">
                           <div class="card h-100 shadow-none border">
                             <div class="rounded-2 text-center mb-3">
                               <!-- <a href="course_details.html"> -->
                                 <img class="img-fluid" src="{{asset('assets/img/course/speech_class.png')}}" alt="tutor image 1" />
                               <!-- </a> -->
                               <span class="badge course_badge"><?php echo ucfirst($weakday); ?></span>
                             </div>
                             <div class="card-body p-3 pt-2">
                               <p style="height: 40px;">
                                 <a href="#" class="h5 course_heading"><?php
								$detail=App\Models\ClassRooms::getClassRoomDetail($timing->class_room_id);
                              echo $detail->class_room_name;
							  ?> </a>
                               </p>
                               <div class="d-flex justify-content-between align-items-center mb-3 gap-2">
                                 <span>
                                   <small class="text-muted"><i class="tf-icons ti ti-notebook"></i>&nbsp;21 lessons</small>
                                 </span>
                                 <span>
                                   <small class="text-muted" style="text-align: left;position: relative;left: -28px;"><i class="tf-icons ti ti-clock-2"></i>&nbsp;<?php
							$diff= $to_time-$from_time;
							echo gmdate("H:i", $diff);							
													
							?></small>
                                 </span>
                               </div>
                               <div class="d-flex justify-content-between align-items-center mb-4 gap-2">
                                 <span>
                                   <small class="text-muted"><i class="tf-icons ti ti-school"></i>&nbsp;35 Students</small>
                                 </span>
                               </div>
							   <div class="alert alert-info" style="margin-bottom: 0px;" role="alert"><small>Starting on:</small>&nbsp;<span class="badge bg-dark bg-glow"><?php  echo date('F d, Y h:i:s a',strtotime('this '.$weakday.$from_time_db)); ?></span></div>
                               <?php 
							//echo $current_timestamp.'-'.$from_time.'-'.$to_time;
							$ten_min_before=$from_time-(10*60);
							if($current_timestamp>=$ten_min_before && $current_timestamp<=$to_time) { ?>
                            <a target="_blank" href="{{ $detail->zoom_start_url }}" class="btn btn-primary waves-effect waves-light" style="float:right;background-color: #dd3333 !important;border-color: #dd3333 !important;">Join Now</a>

					  <?php }
                      else if($current_timestamp < $ten_min_before){ ?>
                                <button class="btn btn-primary waves-effect waves-light" style="float:right;background-color: <?php echo $org_color; ?> !important;border-color: <?php echo $org_color; ?> !important;" onclick='window.location.reload(true);'>Refresh</button>
                            <?php } ?>			  					  
					  
                             </div>
                           </div>
                         </div>
						  <?php 
					  }
					  $i++;
					  } 
					  } } ?>
                         </div>
                       <!--nav aria-label="Page navigation" class="d-flex align-items-center justify-content-center">
                         <ul class="pagination">
                           <li class="page-item prev">
                             <a class="page-link" href="javascript:void(0);">
                               <i class="ti ti-chevron-left ti-xs scaleX-n1-rtl"></i>
                             </a>
                           </li>
                           <li class="page-item active">
                             <a class="page-link" href="javascript:void(0);">1</a>
                           </li>
                           <li class="page-item">
                             <a class="page-link" href="javascript:void(0);">2</a>
                           </li>
                           <li class="page-item">
                             <a class="page-link" href="javascript:void(0);">3</a>
                           </li>
                           <li class="page-item">
                             <a class="page-link" href="javascript:void(0);">4</a>
                           </li>
                           <li class="page-item">
                             <a class="page-link" href="javascript:void(0);">5</a>
                           </li>
                           <li class="page-item next">
                             <a class="page-link" href="javascript:void(0);">
                               <i class="ti ti-chevron-right ti-xs scaleX-n1-rtl"></i>
                             </a>
                           </li>
                         </ul>
                       </nav-->
                     </div>
                   </div>
                <!-- <div class="card">
                  <div class="card-body row gy-4">
                    <div class="col-sm-12 col-lg-6 text-center pt-md-5 px-3">
                      <span class="badge bg-label-primary p-2 mb-3">
                        <i class="ti ti-gift ti-lg"></i>
                      </span>
                      <h3 class="card-title mb-4">Today's Free Courses</h3>
                      <p class="card-text mb-4"> We offers 284 Free Online courses from top tutors and companies to help you start or advance your career skills. Learn online for free and fast today! </p>
                      <button class="btn btn-primary">Get premium courses</button>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                      <img src="{{asset('assets/img/course/egitim-avantajlari.png')}}" width="100%">
                    </div>
                  </div>
                </div> -->
              </div>
            </div>
            <!-- / Content -->
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
    <!-- Vendors JS -->
    <script src="{{asset('assets/select2/select2.js')}}"></script>
    <script src="{{asset('assets/plyr/plyr.js')}}"></script>
    <script src="{{asset('assets/bootstrap-select/bootstrap-select.js')}}"></script>
    <script src="{{asset('assets/rateyo/rateyo.js')}}"></script>
    <!-- Page JS -->
    <script src="{{asset('assets/js/app-academy-course.js')}}"></script>
    <script type="text/javascript">
      $(function() {
        $('#selectpickerBasic').change(function() {
          if ($('#selectpickerBasic').val() == 'online_courses') {
            $('.online_courses').show();
          } else {
            $('.online_courses').hide();
          }
          if ($('#selectpickerBasic').val() == 'my_courses') {
            $('.my_courses').show();
          } else {
            $('.my_courses').hide();
          }
          if ($('#selectpickerBasic').val() == 'all') {
            alert("test");
            $('.online_courses').show();
            $('.my_courses').show();
          }
        });
      });
    </script>
    <script>
      // Set the date we're counting down to
      var countDownDate = new Date("Mar 20, 2024 15:37:25").getTime();

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
        document.getElementById("demo").innerHTML = days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";

        document.getElementById("demo1").innerHTML = days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";

        // If the count down is over, write some text
        if (distance < 0) {
          clearInterval(x);
          document.getElementById("demo").innerHTML = "EXPIRED";
          document.getElementById("demo1").innerHTML = "EXPIRED";
        }
      }, 1000);
    </script>
  </body>
</html>
