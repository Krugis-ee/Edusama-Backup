<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Video Courses</title>
    <meta name="description" content="" />
    @include('dashboard.header')
    <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
    $org_color = App\Models\Organization::getOrgColorByID($org_id);
    ?>
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/core.css" class="template-customizer-core-css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />
    <!-- Vendors CSS -->
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
    top: -62.5%;
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
@font-face{
    font-family:digital;
    src: url("{{asset('assets/fonts/timer/digital-7.ttf')}}");
}
.timer{
    font-family:digital;
}
</style>
	<!--Timer-->


	<!--Timer-->
  </head>
  <body class="course_lists">
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        @include('student_dashboard.sidebar')
        <!-- / Menu -->
        <!-- Layout container -->
        <div class="layout-page">
          @include('student_dashboard.navbar')
          <!-- / Navbar -->
          <!-- Content wrapper -->
          <div class="content-wrapper">
		  
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="mt-3 mb-4" style="color: <?php echo $org_color; ?>;">Video Courses</h4>
              <div class="app-academy">
                <div class="alert alert-success alert-dismissible" role="alert"> Education, talents, and career opportunities. All in one place. Grow your skill with the most reliable online courses and certifications <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="row">
                  <div class="col-md-8 mb-4"></div>
                  <!-- <div class="col-md-4 mb-4" style="float: right;">
                    <label for="selectpickerBasic" class="form-label">Filter</label>
                    <select id="selectpickerBasic" class="selectpicker w-100" data-style="btn-default">
                      <option value="all">All</option>
                      <option value="my_courses">My Courses</option>
                      <option value="online_courses">Online Courses</option>
                    </select>
                  </div> -->
                </div>
                <div class="card my_courses mb-4" id="my_courses">
                  <div class="card-header d-flex flex-wrap justify-content-between gap-3">
                    <div class="card-title mb-0 me-1">
                      <h5 class="mb-1" style="color: <?php echo $org_color; ?>;">My Courses</h5>
                      <!--p class="text-muted mb-0">Total 3 course you have purchased</p-->
                    </div>
                    <!--div class="d-flex justify-content-md-end align-items-center gap-3 flex-wrap">
                      <select id="select2_course_select" class="select2 form-select" data-placeholder="All Courses">
                        <option value="">All Courses</option>
                        <option value="n5">n5</option>
                        <option value="n4">n4</option>
                        <option value="speech">Speech Class</option>
                      </select>
                      <label class="switch">
                        <input type="checkbox" class="switch-input" />
                        <span class="switch-toggle-slider">
                          <span class="switch-on"></span>
                          <span class="switch-off"></span>
                        </span>
                        <span class="switch-label text-nowrap mb-0">Hide completed</span>
                      </label>
                    </div-->
                  </div>
                  <div class="card-body">
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

					  if($i<2)  {


				  ?>
                    <div class="row gy-4">
                      <div class="col-lg-12">
                        <div class="gridarea__wraper gridarea__wraper__2 gridarea__course__list aos-init aos-animate" data-aos="fade-up">
                          <div class="gridarea__img">
                            <a href="#">
                              <img loading="lazy" src="{{asset('assets/img/course/grid_1.png')}}" alt="grid">
                            </a>
                            <div class="gridarea__small__button">
                              <div class="grid__badge"><?php echo ucfirst($weakday); ?></div>
                            </div>
                          </div>
                          <div class="gridarea__content">
                            <div class="gridarea__list">
                              <ul>
                                <li>
                                  <i class="ti ti-notes"></i>&nbsp;23 lessons
                                </li>
                                <li>
                                  <i class="ti ti-clock-hour-9"></i>&nbsp;<?php
							$diff= $to_time-$from_time;
							echo gmdate("H:i", $diff);

							?>
                                </li>
                              </ul>
                            </div>
                            <div class="gridarea__heading">
                              <h3>
                                <a href="#"><?php
								$detail=App\Models\ClassRooms::getClassRoomDetail($timing->class_room_id);
                              echo $detail->class_room_name;
							  ?> </a>
							  </h3>
                            </div>
                            <div class="gridarea__price">
                              Starting On: <span style="color: rgba(114, 106, 137, 0.8);font-size: 14px;"><?php  echo date('F d, Y h:i:s a',strtotime('this '.$weakday.$from_time_db)); ?></span>

                            </div>
							<?php
							//echo $current_timestamp.'-'.$from_time.'-'.$to_time;
							$five_min_before=$from_time-(5*60);
							if ($current_timestamp >= $five_min_before && $current_timestamp <= $to_time) { ?>
                                                                        <div class="gridarea__bottom">
                                                                            <div class="gridarea__details">
                                                                                <a target="_blank" href="{{ route('zoom_meeting',$detail->id) }}" class="default__button">Join Now</a>
                                                                            </div>
                                                                        </div>
                                                                    <?php } else if ($current_timestamp < $five_min_before) { ?>
                                                                        <div class="gridarea__bottom">
                                                                            <div class="gridarea__details">
                                                                                <button class="btn btn-primary waves-effect waves-light" style="float:right;background-color: <?php echo $org_color; ?> !important;border-color: <?php echo $org_color; ?> !important;" onclick='window.location.reload(true);'>Refresh</button>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>
					  <?php  $start_date_time= date('F d,Y H:i:s',strtotime('this '.$weakday.$from_time_db)); ?>
					  <div class="row" style="text-align:center;">
						<span class="timer" id="trip_<?php echo $start_date_time; ?>" style="text-align: center; color: <?php echo $org_color; ?>; font-size: 60px;  margin: 0px auto;"></span><span class="text-danger" style=font-size: 20px;><?php echo('Days'.'&nbsp;&nbsp;&nbsp;&nbsp;'.':'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'Hours'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.':'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'Minutes'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.':'.'&nbsp;&nbsp;&nbsp;&nbsp;'.'Seconds'); ?></span>
					</div>

                          </div>
                        </div>
                      </div>
                    </div>
					  <?php
					  }
					  $i++;
					  }
					  } } ?>
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
                
                <div class="card my_courses mb-4" id="my_courses">
                  <div class="card-header d-flex flex-wrap justify-content-between gap-3">
                    <div class="card-title mb-0 me-1">
                      <h5 class="mb-1" style="color: <?php echo $org_color; ?>;">Featured Courses</h5>                      
                    </div>                    
                  </div>
                  <div class="card-body">
				  <?php
				  $i=0;
				  if($featured_classroom_ids) {
				  foreach($featured_classroom_ids as $featured_classroom_id)
				  {
					  $class_room_obj = App\Models\ClassRooms::find($featured_classroom_id);
					 $start_date=$class_room_obj->start_date;
					 /*$weakday=$timing->weakday;
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
							$current_timestamp=time()+ (5 * 60 * 60)+(30*60);*/
				  ?>
                    <div class="row gy-4">
                      <div class="col-lg-12">
                        <div class="gridarea__wraper gridarea__wraper__2 gridarea__course__list aos-init aos-animate" data-aos="fade-up">
                          <div class="gridarea__img">
                            <a href="#">
                              <img loading="lazy" src="{{asset('assets/img/course/grid_1.png')}}" alt="grid">
                            </a>
                            <div class="gridarea__small__button">
                              <div class="grid__badge"><?php  echo date('F d, Y',strtotime($start_date)); ?></div>
                            </div>
                          </div>
                          <div class="gridarea__content">
                            <div class="gridarea__list">
                              <ul>
                                <li>
                                  <i class="ti ti-notes"></i>&nbsp;<?php

								$timings = App\Models\ClassRoomTimings::getTimings($class_room_obj->id); 
								$weak_days=array();
								 $from_date=$class_room_obj->start_date;
								 $to_date=$class_room_obj->end_date;
								$count_jp=0;
								foreach($timings as $timing)
								{								
									//array_push($weak_days,$timing->weakday);
								$count_jp+= daycount($timing->weakday, strtotime($from_date), strtotime($to_date), 0);
								}
								echo $count_jp.' lessons';
								//print_r($weak_days);
								?>
                                </li>
                                <li>
                                  <i class="ti ti-clock-hour-9"></i>&nbsp;<?php
							echo $class_room_obj->duration;
							?>
                                </li>
                              </ul>
                            </div>
                            <div class="gridarea__heading">
                              <h3>
                                <a href="#"><?php
								//$detail=App\Models\ClassRooms::getClassRoomDetail($timing->class_room_id);
                              echo $class_room_obj->class_room_name;
							  ?> </a>
							  </h3>
                            </div>
                            <div class="gridarea__price">
                              Starting On: <span style="color: rgba(114, 106, 137, 0.8);font-size: 14px;"><?php  echo date('F d, Y',strtotime($start_date)); ?></span>

                            </div>						                                  
					  <?php  $start_date_time= date('F d,Y H:i:s',strtotime($start_date.' 00:00:00')); ?>
					  <div class="row" style="text-align:center;">
						<span class="timer" id="trip_<?php echo $start_date_time; ?>" style="text-align: center; color: <?php echo $org_color; ?>; font-size: 60px;  margin: 0px auto;"></span><span class="text-danger" style=font-size: 20px;><?php echo('Days'.'&nbsp;&nbsp;&nbsp;&nbsp;'.':'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'Hours'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.':'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'Minutes'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.':'.'&nbsp;&nbsp;&nbsp;&nbsp;'.'Seconds'); ?></span>
					</div>

                          </div>
                        </div>
                      </div>
                    </div>
					  <?php
					  
					  $i++;
					  }
					  }  ?>                   
                  </div>
                </div>
                
		   </div>
                
                <div class="card online_courses mb-4" id="online_courses">
                  <div class="card-header d-flex flex-wrap justify-content-between gap-3">
                    <div class="card-title mb-0 me-1">
                      <h5 class="mb-1" style="color: <?php echo $org_color; ?>;">Upcoming Online Courses</h5>
                    </div>
                    <!--div class="d-flex justify-content-md-end align-items-center gap-3 flex-wrap">
                      <select id="select2_course_select" class="select2 form-select" data-placeholder="All Courses">
                        <option value="">All Courses</option>
                        <option value="n5">n5</option>
                        <option value="n4">n4</option>
                        <option value="speech">Speech Class</option>
                      </select>
                    </div-->
                  </div>
                  <div class="card-body">
                    <div class="row gy-4 mb-4">					
					 <?php 
					 if($upcoming_classes)
					 {
					  foreach($upcoming_classes as $upcoming_class)
					  {
						  if(!in_array($upcoming_class->id,$classroom_ids))
						  {
					  
					  ?>
                      <div class="col-sm-6 col-lg-4">
                        <div class="card p-2 h-100 shadow-none border">
                          <div class="rounded-2 text-center mb-3">
                            <a href="{{route('course_details',$upcoming_class->id )}}">
                              <img class="img-fluid" src="{{asset('assets/img/course/speech_class.png')}}" alt="tutor image 1" />
                            </a>
                            <!--span class="badge course_badge">Speech</span-->
                          </div>
                          <div class="card-body p-3 pt-2">
                            <div class="d-flex justify-content-between align-items-center mb-3 gap-2">
                              <span>
                                <i class="ti ti-notes"></i>&nbsp;
<?php

								$timings = App\Models\ClassRoomTimings::getTimings($upcoming_class->id); 
								$weak_days=array();
								 $from_date=$upcoming_class->start_date;
								 $to_date=$upcoming_class->end_date;
								$count_jp=0;
								foreach($timings as $timing)
								{								
									//array_push($weak_days,$timing->weakday);
								$count_jp+= daycount($timing->weakday, strtotime($from_date), strtotime($to_date), 0);
								}
								echo $count_jp.' lessons';
								//print_r($weak_days);
								?>
								 </span>
                              <span>
                                <i class="ti ti-clock-hour-9"></i>&nbsp;<?php echo $upcoming_class->duration; ?> </span>
                            </div>
                            <a href="{{route('course_details',$upcoming_class->id)}}" class="h5 course_heading"><?php echo $upcoming_class->class_room_name; ?></a>
                            <p></p>
							<?php
							   $class_room_detail=App\Models\ClassRoomDetail::where('class_room_id',$upcoming_class->id)->first();
							?>
                            <div class="d-flex justify-content-between align-items-center mb-3 price_list" style="color: #5f2ded; font-size: 13px;">
                              <span> <?php if($class_room_detail) echo '$'.number_format($class_room_detail->offer_price,2); ?> <del>/ <?php if($class_room_detail) echo '$'.number_format($class_room_detail->price,2); ?></del>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center gap-2">
                              <div class="d-flex avatar-group my-3">
                                                    <?php
                                                    $teachers = App\Models\ClassRoomSubjectTeachers::where('class_room_id', $upcoming_class->id)->get();
                                                    if ($teachers) {
                                                        $count_teachers = count($teachers);
                                                        $i = 0;
                                                        foreach ($teachers as $teacher) {

                                                            $teacher_id = $teacher->teacher_id;
                                                            $teacher_obj = App\Models\User::find($teacher_id);
                                                            if ($i < 2) {
                                                                $teacher_avatar_name = !empty($teacher_obj->teacher_avatar) ? $teacher_obj->teacher_avatar : "3.png";
                                                    ?>
                                                                <div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="{{ $teacher_obj->first_name.' '.$teacher_obj->last_name }}" class="avatar pull-up">
                                                                    <img src="{{ asset('assets/img/teacher_avatar/'.$teacher_avatar_name)}}" alt="Avatar" class="rounded-circle pull-up" />
                                                                </div>
                                                    <?php
                                                                $i++;
                                                            }
                                                        }
                                                    } ?>
                                                    <?php
                                                    $remain_count = $count_teachers - $i; ?>
                                                    <?php if ($remain_count > 0) { ?>
                                                        <div class="avatar">
                                                            <span class="avatar-initial rounded-circle pull-up" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $remain_count.' more' }}">+{{$remain_count}}</span>
                                                        </div>
                                                    <?php } ?>
                                                </div>
							  <!--span>
                                <img src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar" class="avatar avatar-xs">
                                <span style="top: 2px;position: relative;right: -4px;">John Doe</span>
                              </span-->
                            </div>
                          </div>
                        </div>
                      </div>
					 <?php }}} ?>
                      
                    </div>
                    <!--<nav aria-label="Page navigation" class="d-flex align-items-center justify-content-center">
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
                    </nav>
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
                      <img src="assets/img/course/egitim-avantajlari.png" width="100%">
                    </div>
                  </div>
                </div> -->
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
function TimeRemaining(){
   var els = document.querySelectorAll('[id^="trip_"]');
   for (var i=0; i<els.length; i++) {
   	 var el_id = els[i].getAttribute('id');
   	 var end_time = el_id.split('_')[1];
   	 var deadline = new Date(end_time);
     var now = new Date();
     var t = Math.floor(deadline.getTime() - now.getTime());
     var days = Math.floor(t / (1000 * 60 * 60 * 24));
     var hours = Math.floor((t % (1000 * 60 * 60 * 24))/(1000 * 60 * 60));
     var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
     var seconds = Math.floor((t % (1000 * 60)) / 1000);
     if (t < 0) {
		 //location.reload();
		 //const myTimeout = setTimeout(TimeRemaining, 1000);
        //document.getElementById("trip_" + end_time).innerHTML = 'EXPIRED';
     }else{
     	document.getElementById("trip_" + end_time).innerHTML = days + " : " + hours + " : " + minutes + " : " + seconds + " ";
     }
   }
}

function StartTimeRemaining(){
    TimeRemaining();
	setInterval(function(){
		TimeRemaining();
	}, 1000)
}


StartTimeRemaining();
</script>
  </body>
</html>
