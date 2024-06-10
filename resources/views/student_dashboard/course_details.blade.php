<!DOCTYPE html>
<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Course Details</title>
  <meta name="description" content="" />
  @include('dashboard.header')
  <?php
    $user_id = session()->get('loginId');
    $org_id = App\Models\User::getOrganizationId($user_id);
    $org_logo = App\Models\Organization::getOrgLogoByID($org_id);
    $org_name = App\Models\Organization::getOrgNameById($org_id);
    $org_color = App\Models\Organization::getOrgColorByID($org_id);
    ?>
  <link rel="stylesheet" href="assets/plyr/plyr.css" />
  <!-- Page CSS -->
  <link rel="stylesheet" href="assets/css/app-academy-details.css" />
  <!-- Helpers -->

  <style type="text/css">
    .course_details .btn-primary {
      background-color: <?php echo $org_color; ?> !important;
      border-color: <?php echo $org_color; ?> !important;
    }

    .course_details .app-brand-logo.demo {
      width: auto !important;
      height: auto !important;
    }

    .course_details .form-check-input:checked,
    .course_details .form-check-input[type=checkbox]:indeterminate,
    {
      background-color: <?php echo $org_color; ?> !important;
      border-color: <?php echo $org_color; ?> !important;
    }

    .course_details .form-check-input:focus {
      border-color: <?php echo $org_color; ?> !important;
    }

    .course_details .bg-primary {
      background-color: <?php echo $org_color; ?> !important;
    }

    .course_details .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
    .course_details .layout-menu-hover.layout-menu-collapsed .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
    .course_details .bg-menu-theme .menu-inner .menu-item.active>.menu-link.menu-toggle,
    .course_details .bg-menu-theme.menu-vertical .menu-item.active>.menu-link:not(.menu-toggle) {
      background: linear-gradient(72.47deg, <?php echo $org_color; ?> 22.16%, rgb(224, 8, 20, 0.7) 76.47%) !important;
      color: #ffffff !important;
    }

    .course_details .menu-vertical .app-brand {
      margin: 20px 0.875rem 20px 1rem;
    }

    .course_details i {
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

    .course_details #template-customizer .template-customizer-open-btn {
      display: none;
    }

    .course__details__price ul li {
      margin-right: 20px;
      list-style: none;
      display: inline-block;
    }

    .course__details__price ul li .course__price {
      font-weight: 500;
      font-size: 21px;
      line-height: 25px;
      color: #5f2ded;
    }

    .course__details__price ul li .course__price del {
      font-weight: 500;
      font-size: 13px;
      line-height: 16px;
      color: #a2a9b6;
    }

    .course__details__price ul li .course__details__date i {
      color: #5f2ded;
    }

    .review__box {
      text-align: center;
    }

    .review__box .review__number {
      font-weight: 800;
      font-size: 72px;
      line-height: 90px;
    }

    .review__box span {
      font-weight: 500;
      font-size: 16px;
      line-height: 26px;
    }

    .review__wrapper .single__progress__bar {
      position: relative;
      top: -19px;
    }

    .review__wrapper .single__progress__bar .rating__text {
      display: inline-block;
      position: relative;
      top: 19px;
    }

    .review__wrapper .single__progress__bar .progress {
      max-width: 85%;
      margin-left: 38px;
      height: 10px;
      margin-right: 22px;
      top: 3px;
      position: relative;
    }

    .review__wrapper .single__progress__bar .progress-bar {
      display: flex;
      flex-direction: column;
      justify-content: center;
      overflow: hidden;
      color: #7367f0;
      text-align: center;
      white-space: nowrap;
      transition: #7367f0;
    }

    .review__wrapper .single__progress__bar span {
      position: absolute;
      right: 0;
      top: 58%;
    }

    .blogsidebar__name__2 h5 {
      font-weight: 700;
      font-size: 20px;
      line-height: 25px;
      margin: 0;
      margin-bottom: 7px;
      color: #dd3333;
    }

    .blogsidebar__name__2 h5 a {
      color: #dd3333;
    }

    .blogsidebar__name__2 p {
      font-weight: 400;
      font-size: 12px;
      line-height: 15px;
      margin: 0;
    }

    .blog__sidebar__text__2 p {
      line-height: 26px;
      font-size: 14px;
    }

    .blogsidbar__icon__2 ul li {
      margin-right: 6px;
      list-style: none;
      display: inline-block;
    }

    .blogsidbar__icon__2 ul {
      margin: 0px;
      padding: 0px;
    }

    .blogsidbar__icon__2 .ti-sm {
      font-size: 1.376rem !important;
    }

    .blogsidbar__icon__2 ul li a:hover {
      background: #b13bff;
      color: #fff;
      border: 1px solid #b13bff;
    }

    .blogsidbar__icon__2 ul li a {
      width: 35px;
      height: 35px;
      line-height: 32px;
      display: inline-block;
      border: 1px solid #b13bff;
      text-align: center;
      background: #fff;
      color: #b13bff;
      border-radius: 10px;
    }

    .blogarae__img__2.course__details__img__2 {
      margin-bottom: 20px;
    }

    .blogarae__img__2 {
      position: relative;
    }

    .registerarea__content.course__details__video {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    .registerarea__content {
      z-index: 1;
    }

    .registerarea__video {
      display: flex;
      align-items: center;
    }

    .blogarae__img__2 .registerarea__content .registerarea__video a,
    .blog__details__img__2 .registerarea__content .registerarea__video a {
      margin-right: 0;
    }

    @media (min-width: 992px) and (max-width: 1365px) {
      .registerarea__video a {
        width: 60px;
        height: 60px;
        line-height: 60px;
      }
    }

    .registerarea__video a {
      width: 80px;
      height: 80px;
      line-height: 80px;
      background: #f2277e;
      color: #fff;
      border-radius: 100%;
      text-align: center;
      margin-right: 20px;
      display: inline-block;
      position: relative;
    }

    .registerarea__video a::before {
      content: "";
      border: 2px solid #f2277e;
      position: absolute;
      z-index: 0;
      left: 50%;
      top: 50%;
      -webkit-transform: translateX(-50%) translateY(-50%);
      transform: translateX(-50%) translateY(-50%);
      display: block;
      width: 180px;
      height: 180px;
      border-radius: 50%;
      -webkit-animation: zoomBig 3.25s linear infinite;
      animation: zoomBig 3.25s linear infinite;
      -webkit-animation-delay: 0.75s;
      animation-delay: 0.75s;
    }

    .registerarea__video a::after {
      content: "";
      border: 2px solid #f2277e;
      position: absolute;
      z-index: 0;
      left: 50%;
      top: 50%;
      -webkit-transform: translateX(-50%) translateY(-50%);
      transform: translateX(-50%) translateY(-50%);
      display: block;
      width: 180px;
      height: 180px;
      border-radius: 50%;
      -webkit-animation: zoomBig 3.25s linear infinite;
      animation: zoomBig 3.25s linear infinite;
      -webkit-animation-delay: 0s;
      animation-delay: 0s;
    }

    .default__button.default__button--2:hover {
      background-color: #fff;
      color: #b13bff;
      border: 1px solid #b13bff;
    }

    .bg-featured {
      background-color: #f2277e;
      border: 1px solid #f2277e;
    }

    @keyframes zoomBig {
      0% {
        -webkit-transform: translate(-50%, -50%) scale(0.5);
        transform: translate(-50%, -50%) scale(0.5);
        opacity: 1;
        border-width: 3px;
      }
      40% {
        opacity: .5;
        border-width: 2px;
      }
      65% {
        border-width: 1px;
      }
      100% {
        -webkit-transform: translate(-50%, -50%) scale(1);
        transform: translate(-50%, -50%) scale(1);
        opacity: 0;
        border-width: 1px;
      }
    }

    @keyframes zoomBig {
      0% {
        -webkit-transform: translate(-50%, -50%) scale(0.5);
        transform: translate(-50%, -50%) scale(0.5);
        opacity: 1;
        border-width: 3px;
      }
      40% {
        opacity: .5;
        border-width: 2px;
      }
      65% {
        border-width: 1px;
      }
      100% {
        -webkit-transform: translate(-50%, -50%) scale(1);
        transform: translate(-50%, -50%) scale(1);
        opacity: 0;
        border-width: 1px;
      }
    }

    .course__details__sidebar .event__sidebar__wraper .event__price__wraper {
      margin-bottom: 20px;
    }

    .event__sidebar__wraper .event__price__wraper {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 50px;
    }

    .event__sidebar__wraper .event__price__wraper .event__price {
      font-weight: 700;
      font-size: 21px;
      line-height: 25px;
      color: #5f2ded;
    }

    .event__sidebar__wraper .event__price__wraper .event__price del {
      font-weight: 600;
      font-size: 14px;
      line-height: 17px;
      color: #a2a9b6;
    }

    .event__sidebar__wraper .event__price__wraper .event__Price__button a {
      width: 81px;
      height: 27px;
      display: inline-block;
      background: #312a57;
      color: #ff275a;
      font-weight: 600;
      font-size: 14px;
      line-height: 27px;
      text-align: center;
    }

    .course__summery__button {
      text-align: center;
    }

    .is_dark .default__button {
      color: var(--blackColor);
    }

    .course__summery__button .default__button {
      width: 100%;
      margin-bottom: 10px;
    }

    .default__button {
      padding: 10px 25px;
      background-color: #dd3333;
      color: #fff;
      display: inline-block;
      text-align: center;
      border-radius: 4px;
      font-size: 15px;
      border: 1px solid #dd3333;
    }

    .is_dark .default__button {
      color: #fff;
    }

    .course__summery__button .default__button {
      width: 100%;
      margin-bottom: 10px;
    }

    .default__button.default__button--2 {
      background-color: #b13bff;
      border: 1px solid #b13bff;
    }

    .nav-pills .nav-link.active,
    .nav-pills .nav-link.active:hover,
    .nav-pills .nav-link.active:focus {
      background-color: #b13bff;
      color: #fff;
    }

    .course__summery__button span {
      font-size: 13px;
      color: var(--contentColor);
    }

    .course__summery__lists {
      margin-top: 20px;
    }

    .course__summery__lists li {
      display: flex;
      padding: 10px 0;
      border-bottom: 1px solid #312a57;
      list-style: none;
    }

    .course__summery__lists li .course__summery__item {
      display: flex;
      justify-content: space-between;
      width: 100%;
      font-size: 14px;
    }

    .course__summery__lists li .course__summery__item .sb_label {
      font-weight: 500;
    }

    .course__summery__lists li .course__summery__item .sb_content {
      background: #312a57;
      padding: 6px 10px;
      line-height: 13px;
      font-size: 12px;
      border-radius: 50px;
      color: #fff;
    }

    .course__summery__lists li .course__summery__item .sb_content a {
      color: #fff;
    }

    @media (min-width: 992px) and (max-width: 1365px) {
      .blogsidebar__content__wraper__2 {
        padding: 20px 20px 20px 20px;
      }
    }

    .blogsidebar__content__wraper__2 {
      padding: 20px 20px 20px 20px;
      border: 1px solid #eee;
      box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.02);
      margin-bottom: 30px;
    }

    .sidebar__title {
      font-weight: 700;
      font-size: 22px;
      line-height: 30px;
      position: relative;
      padding-left: 8px;
      margin-bottom: 25px;
    }

    .sidebar__title::before {
      position: absolute;
      content: "";
      width: 2px;
      height: 21px;
      background: #5f2ded;
      left: 0;
      bottom: 5px;
    }

    .blogsidebar__content__wraper__2 .follow__icon ul li {
      margin-right: 6px;
      list-style: none;
      display: inline-block;
    }

    .blogsidebar__content__wraper__2 .follow__icon ul li a {
      width: 39px;
      height: 38px;
      text-align: center;
      line-height: 38px;
      background: #312a57;
      color: #fff;
      display: inline-block;
      border-radius: 10px;
    }

    .blogsidebar__content__wraper__2 .follow__icon ul li a:hover {
      background: #fff;
      color: #312a57;
      border: 1px solid #312a57;
    }

    ul {
      padding: 0px;
    }

    .course__details__populer__list li {
      display: flex;
      align-items: center;
      margin-bottom: 25px;
    }

    li {
      list-style: none;
    }

    .course__details__populer__list li .course__details__populer__content {
      margin-left: 20px;
    }

    .course__details__populer__list li .course__details__populer__content span {
      font-weight: 500;
      font-size: 14px;
      line-height: 17px;
      color: #5f2ded;
    }

    .course__details__populer__list li .course__details__populer__content h6 {
      margin: 0;
      font-weight: 600;
      font-size: 16px;
      line-height: 22px;
      color: #000 !important;
    }

    .course__details__populer__list li .course__details__populer__content h6 a {
      color: #000000a3 !important;
    }

    .blogsidebar__content__wraper__2 .get__touch__input input {
      border: none;
      border-bottom: 1px solid #757575;
      width: 100%;
      background: none;
      padding-bottom: 10px;
      margin-bottom: 20px;
      color: #000000a3;
    }

    .default__button:hover {
      background-color: #fff;
      color: #dd3333;
      border-color: #dd3333;
      border: 1px solid #dd3333;
    }

    .get__touch__input input:focus-visible {
      outline: none;
    }

    .blog__details__heading__2 h5 {
      font-weight: 700;
      font-size: 24px;
      line-height: 38px;
      color: #dd3333;
    }

    .blog__details__content__wraper .blog__details__list__2 ul li i {
      width: 31px;
    }

    .aboutarea__list__2 ul li i {
      width: 31px;
      height: 33px;
      line-height: 31px;
      text-align: center;
      background: rgba(95, 45, 237, 0.04);
      color: #5f2ded;
      transition: .3s;
      display: inline-block;
      margin-right: 15px;
    }

    .aboutarea__list__2 ul li {
      display: flex;
      margin-bottom: 15px;
      font-weight: 500;
    }

    .aboutarea__list__2 p {
      margin-bottom: 0px;
    }

    .online__course__wrap {
      margin-top: 30px;
    }

    .instructor__heading__2 {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }

    .instructor__heading__2 h3 {
      font-weight: 700;
      font-size: 30px;
      line-height: 1.2px;
      margin-bottom: 0;
    }

    .instructor__heading__2 a {
      color: #dd3333;
    }

    .row__custom__class {
      margin-left: -15px;
      margin-right: -15px;
      padding: 0;
    }

    .product-sale-label {
      color: #7367f0;
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
      color: #ddd;
      position: absolute;
      margin-left: auto;
      margin-top: auto;
      z-index: 999;
      cursor: pointer;
    }

    .heart-checkbox {
      display: none;
    }

    .heart-checkbox:checked + .heart {
      color: red;
    }

    .course_badge {
      background: var(--bs-hover);
      font-size: 13px;
      padding: 4px 11px;
      position: absolute;
      top: 34%;
      left: 15px;
    }

    .ti-notes {
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
      color: #f2277e;
    }

    .blog__details__comment .blog__details__comment__heading h5 {
      font-weight: 700;
      font-size: 24px;
      line-height: 30px;
    }

    .blog__details__comment .blog__details__comment__inner {
      display: flex;
    }

    .blog__details__comment .blog__details__comment__inner .author__img {
      margin-right: 30px;
    }

    .blog__details__comment .blog__details__comment__inner .author__content .author__name h6 {
      font-weight: 600;
      font-size: 18px;
      line-height: 25px;
      margin: 0;
    }

    .blog__details__comment .blog__details__comment__inner .author__content .author__name p {
      font-weight: 600;
      font-size: 12px;
      line-height: 29px;
      text-transform: uppercase;
      margin: 0;
      margin-bottom: 5px;
    }

    .blog__details__comment .blog__details__comment__inner .author__content .author__text p {
      font-weight: 400;
      font-size: 14px;
      line-height: 23px;
    }
    /*.blog__details__comment .author__icon {
    position: absolute;
    right: 0;
}*/

    .blog__details__comment .author__icon button {
      border: none;
      background: none;
    }

    .blog__details__comment .blog__details__comment__inner.author__padding__left {
      padding-left: 100px;
    }

    .blog__details__comment {
      border-top: 1px solid #ddd;
      padding-top: 50px;
      border-bottom: 1px solid #ddd;
      padding-bottom: 15px;
    }

    .blog__details__form {
      padding-top: 50px;
    }

    .blog__details__form .blog__details__input__heading {
      padding-bottom: 30px;
    }

    .blog__details__form .blog__details__input__heading h5 {
      font-weight: 600;
      font-size: 26px;
      line-height: 30px;
    }

    .blog__details__form .blog__details__input {
      margin-bottom: 10px;
    }

    .blog__details__form .blog__details__input input {
      border: 1px solid #ddd;
      width: 100%;
      margin-bottom: 30px;
      padding-left: 20px;
      height: 60px;
      background: none;
      font-weight: 500;
      font-size: 14px;
      line-height: 26px;
      border-radius: 4px;
    }

    .blog__details__form .blog__details__input input:focus-visible,
    .blog__details__form .blog__details__input textarea:focus-visible {
      outline: none;
    }

    .blog__details__form .blog__details__input textarea {
      height: 209px;
      padding-left: 20px;
      width: 100%;
      border: 1px solid #ddd;
      padding-top: 20px;
      background: none;
      font-weight: 500;
      font-size: 14px;
      line-height: 26px;
      border-radius: 4px;
    }

    .blog__details__button {
      text-align: center;
      margin-top: 30px;
    }

    .author__name a {
      color: #dd3333;
    }

    .training_who .accordion-button::after, .curriculum_accordion .accordion-button::after{
      content: none !important;
    }
    .training_who .list-group-item{
      border: none !important;
    }
    .training_who .accordion-body{
      padding: 1.125rem 0.82rem !important;
    }
    ul#menu li {
  display:inline;
  margin-left: 10px;
}
.btn-outline-facebook:hover {
    color: #fff !important;
    background-color: #355089 !important;
    border-color: #355089 !important;
}
.btn-outline-facebook {
    color: #3b5998;
    border-color: #3b5998;
}
.btn-outline-twitter:hover {
    color: #fff !important;
    background-color: #1a91da !important;
    border-color: #1a91da !important;
}
.btn-outline-linkedin {
    color: #0077b5;
    border-color: #0077b5;
}
.btn-outline-linkedin:hover {
    color: #fff !important;
    background-color: #006ba3 !important;
    border-color: #006ba3 !important;
}
  </style>

</head>

<body class="course_details">
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
      @include('student_dashboard.sidebar')
      <!-- / Menu -->
      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->
        @include('student_dashboard.navbar')
        <!-- / Navbar -->
        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="mt-3 mb-4" style="color: <?php echo $org_color; ?>;">Course Details</h4>
            <div class="card g-3 mt-5">
              <div class="card-body row g-3">
                <div class="col-lg-12 mb-3">
                  <div class="d-flex justify-content-between align-items-center flex-wrap mb-2 gap-1">
                    <div class="me-1 mb-3">
                      <img width="100%" src="{{asset('assets/img/course/'.$class_room_detail->banner_img )}}" alt="course_1">
                    </div>
                    <div class="d-flex align-items-center mb-3">
					                            <?php
												$subjects = App\Models\ClassRoomSubjectTeachers::where('class_room_id', $class_room->id)->get();
                                                    if ($subjects) {
                                                        $count_subjects = count($subjects);
                                                       if($count_subjects){
														$i=0;														   
                                                        foreach ($subjects as $subject) {

                                                            $subject_id = $subject->subject_id;
                                                            $subject_obj = App\Models\Subject::find($subject_id);
                                                            if($i%2==0)
																echo '<span class="badge bg-featured">'.$subject_obj->subject_name.'</span>';
															else																	
																echo '<span class="badge bg-primary" style="background-color: #b13bff !important;border: 1px solid #b13bff;margin-left: 30px;">'.$subject_obj->subject_name.'</span>';
                    
													$i++;
												}}}
													?>
                      </div>
                    <div class="d-flex align-items-center mb-3">
                      <span>Last Update: <?php $date_updated=date_create($class_room->updated_at); echo date_format($date_updated,"M d,Y"); ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8">
                  <div class="d-flex justify-content-between align-items-center flex-wrap mb-2 gap-1">
                    <div class="me-1 mb-3">
                      <h3 class="mb-1">
                          <b><?php echo $class_room->class_room_name; ?></b>
                        </h3>
                      <!-- <p class="mb-1">Prof. <span class="fw-medium"> Devonne Wallbridge </span></p> -->
                    </div>
                    <div class="course__details__price d-flex align-items-center">
                      <ul style="padding:0px;">
                        <li>
                          <div class="course__price"> <?php if($class_room_detail->offer_price) echo '$'.number_format($class_room_detail->offer_price,2); ?> <del>/ <?php if($class_room_detail->price) echo '$'.number_format($class_room_detail->price,2); ?></del>
                          </div>
                        </li>
                        <li>
                          <div class="course__details__date">
                            <i class="ti ti-notes"></i> <?php
								$timings = App\Models\ClassRoomTimings::getTimings($class_room->id); 
								$weak_days=array();
								 $from_date=$class_room->start_date;
								 $to_date=$class_room->end_date;
								$count_jp=0;
								foreach($timings as $timing)
								{								
									//array_push($weak_days,$timing->weakday);
								$count_jp+= daycount($timing->weakday, strtotime($from_date), strtotime($to_date), 0);
								}
								echo $count_jp.' lessons';
								//print_r($weak_days);
								?>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="card academy-content shadow-none border mb-4">
                    <div class="card-body">
                      <h5 class="mb-2">About this course</h5>
                      <?php echo $class_room_detail->about; ?>
                      <hr class="my-4" />
                      <h5>By the numbers</h5>
                      <div class="d-flex flex-wrap">
                        <div class="me-5">
                          <p class="text-nowrap">
                            <i class="ti ti-checks ti-sm me-2 mt-n2"></i>Skill level: <?php echo $class_room_detail->skill_level; ?>
                          </p>
                          <p class="text-nowrap">
                            <i class="ti ti-user ti-sm me-2 mt-n2"></i>Students: <?php $teachers_subject = App\Models\ClassRoomSubjectTeachers::where('class_room_id', $class_room->id)->get();
                                                    $count=0;
													if ($teachers_subject)
													{
														foreach($teachers_subject as $teacher_subject)
														{
														$students_id=$teacher_subject->students_id;
														$students_id_arr=explode(',',$students_id);
														$count+=count($students_id_arr);
														}
														
													}									 
													
												echo $count;
													?>
                          </p>
                          <p class="text-nowrap">
                            <i class="ti ti-flag ti-sm me-2 mt-n2"></i>Languages: <?php echo $class_room_detail->language; ?>
                          </p>
                          <p class="text-nowrap">
                            <i class="ti ti-file ti-sm me-2 mt-n2"></i>Captions: <?php if( $class_room_detail->caption==1) echo 'Yes'; else echo 'No'; ?>
                          </p>
                        </div>
                        <div>
                          <p class="text-nowrap">
                            <i class="ti ti-pencil ti-sm me-2 mt-n2"></i>Lectures: <?php $teachers = App\Models\ClassRoomSubjectTeachers::where('class_room_id', $class_room->id)->get();
                                                    if ($teachers) echo count($teachers);?>
                          </p>
                          <p class="text-nowrap">
                            <i class="ti ti-clock ti-sm me-2 mt-n2"></i>Video: <?php echo $class_room_detail->total_duration; ?>
                          </p>
                        </div>
                      </div>
                      <hr class="mb-4 mt-2" />
                      <h5>Description</h5>
                      <?php echo $class_room_detail->description; ?>
					  <hr class="my-4" />
                      <div class="col-xl-12">
                        <div class="nav-align-top mb-4">
                          <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                            <li class="nav-item">
                              <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-curriculum" aria-controls="navs-pills-justified-curriculum" aria-selected="false">
                                <i class="tf-icons ti ti-star ti-xs me-1"></i> Curriculum </button>
                            </li>
                            <li class="nav-item">
                              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-messages" aria-controls="navs-pills-justified-messages" aria-selected="false">
                                <i class="tf-icons ti ti-user-question ti-xs me-1"></i> Who is for? </button>
                            </li>
                          </ul>
                          <div class="tab-content" style="background: #ebeaee;">
                            <div class="tab-pane fade show active" id="navs-pills-justified-curriculum" role="tabpanel">
                              <div id="accordionIcon" class="accordion mt-3 accordion-without-arrow curriculum_accordion">
                                <?php 
								$course_sections = DB::select('SELECT main_title FROM course_curriculam WHERE class_room_id='.$class_room->id.' GROUP BY main_title');
                                                
								if ($course_sections ) {
									foreach($course_sections as $course_section)
									{
										$main_title= $course_section->main_title; 										
									?>
										<div class="accordion-item card">
                                  <h2 class="accordion-header text-body d-flex justify-content-between" id="accordionIconOne">
                                      <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#<?php echo Str::slug($main_title); ?>" aria-controls="accordionIcon-1">
                                        <span class="d-flex flex-column">
                                          <span class="h5 mb-0"><?php echo $main_title; ?></span>
                                        </span>
                                      </button>
                                    </h2>
                                  <div id="<?php echo Str::slug($main_title); ?>" class="accordion-collapse collapse" data-bs-parent="#accordionIcon">
                                    <div class="accordion-body">
									<?php								
									$course_contents = App\Models\CourseCurriculam::where('class_room_id', $class_room->id)->where('main_title',$main_title)->get();
									if($course_contents)
									{
										foreach($course_contents as $course_content)
										{ 
										
										?>
											<div class="form-check d-flex align-items-center mb-3">
                                        <label for="defaultCheck1" class="form-check-label">
                                          <span class="mb-0 h6"><?php echo  $course_content->sub_title;?></span>
                                          <span class="text-muted d-block"><?php echo $course_content->duration;?></span>
                                        </label>
                                      </div>
										<?php 
										}
									}
									?>                                   
                                     
                                    </div>
                                  </div>
                                </div>
                                
									<?php }
									
								}
								?>
								
							  </div>
                            </div>
                            <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                              <div class="d-flex flex-wrap">
                                <div class="col-lg-12">
                                  <h5>
                                    <b>Who can receive this training?</b>
                                  </h5>
								  <?php echo $class_room_detail->who_is_for;?>
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="course__details__sidebar">
                    <div class="event__sidebar__wraper aos-init aos-animate" data-aos="fade-up">
                      <div class="event__price__wraper">
                        <div class="event__price"> <?php if($class_room_detail->offer_price) echo '$'.number_format($class_room_detail->offer_price,2); ?> <del>/ <?php if($class_room_detail->price) echo '$'.number_format($class_room_detail->price,2); ?></del>
                        </div>
                        <div class="event__Price__button">
                          <a href="#"><?php if($class_room_detail->discount_percentage) echo $class_room_detail->discount_percentage.' % OFF' ?></a>
                        </div>
                      </div>
                      <div class="course__summery__button">
                        <a class="default__button" href="#">Enroll Now</a>
                        <span>
                      </div>
                      <div class="course__summery__lists">
                        <ul>
                          <li>
                            <div class="course__summery__item">
                              <span class="sb_label">Instructor:</span>
							  <div class="d-flex avatar-group my-3">
                                                    <?php
                                                    $teachers = App\Models\ClassRoomSubjectTeachers::where('class_room_id', $class_room->id)->get();
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
                        <!--span class="sb_content">
                                  <a href="#">D. Willaim</a>
                                </span-->
                      </div>
                      </li>
                      <li>
                        <div class="course__summery__item">
                          <span class="sb_label">Start Date</span>
                          <span class="sb_content">
						  <?php 
						  $start_date= $class_room->start_date; 
						  $date_start=date_create($start_date);
echo date_format($date_start,"d M Y");
						  ?></span>
                        </div>
                      </li>
                      <li>
                        <div class="course__summery__item">
                          <span class="sb_label">Total Duration</span>
                          <span class="sb_content"><?php echo $class_room_detail->total_duration; ?></span>
                        </div>
                      </li>
                      <li>
                        <div class="course__summery__item">
                          <span class="sb_label">Enrolled</span>
                          <span class="sb_content"><?php $teachers_subject = App\Models\ClassRoomSubjectTeachers::where('class_room_id', $class_room->id)->get();
                                                    $count=0;
													if ($teachers_subject)
													{
														foreach($teachers_subject as $teacher_subject)
														{
														$students_id=$teacher_subject->students_id;
														$students_id_arr=explode(',',$students_id);
														$count+=count($students_id_arr);
														}
														
													}									 
													
												echo $count;
													?></span>
                        </div>
                      </li>
                      <li>
                        <div class="course__summery__item">
                          <span class="sb_label">Lectures</span>
                          <span class="sb_content"><?php $teachers = App\Models\ClassRoomSubjectTeachers::where('class_room_id', $class_room->id)->get();
                                                    if ($teachers) echo count($teachers);?>
                        </div>
                      </li>
                      <li>
                        <div class="course__summery__item">
                          <span class="sb_label">Skill Level</span>
                          <span class="sb_content"><?php echo $class_room_detail->skill_level; ?></span>
                        </div>
                      </li>
                      <li>
                        <div class="course__summery__item">
                          <span class="sb_label">Language</span>
                          <span class="sb_content"><?php echo $class_room_detail->language; ?></span>
                        </div>
                      </li>
                      <li>
                        <div class="course__summery__item">
                          <span class="sb_label">Quiz</span>
                          <span class="sb_content"><?php if ($class_room_detail->quiz==1) echo 'Yes'; ?></span>
                        </div>
                      </li>
                      <li>
                        <div class="course__summery__item">
                          <span class="sb_label">Certificate</span>
                          <span class="sb_content"><?php if ($class_room_detail->certificate==1) echo 'Yes'; ?></span>
                        </div>
                      </li>
                      </ul>
                    </div>
                    <div class="course__summery__button">
                      <p>More inquery about course.</p>
                      <a class="default__button default__button--3" href="tel:<?php echo $class_room_detail->contact_number;?>">
                        <i class="icofont-phone"></i> <?php echo $class_room_detail->contact_number;?> </a>
                    </div>
                  </div>
                  <div class="blogsidebar__content__wraper__2 aos-init aos-animate" data-aos="fade-up">
                    <h4 class="sidebar__title">Follow Us</h4>
                    <div class="follow__icon">
                      <ul style="padding: 0px;">
                        <li>
                          <a href="#">
                            <i class="tf-icons ti ti-brand-facebook ti-sm"></i>
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <i class="tf-icons ti ti-brand-youtube ti-sm"></i>
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <i class="tf-icons ti ti-brand-instagram ti-sm"></i>
                          </a>
                        </li>
                        <li>
                          <a href="#">
                            <i class="tf-icons ti ti-brand-twitter ti-sm"></i>
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- / Content -->
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
  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  @include('dashboard.footer')
  <script src="assets/js/main.js"></script>
  <script src="assets/plyr/plyr.js"></script>
  <!-- <script src="assets/js/app-academy-course-details.js"></script> -->
</body>

</html>
