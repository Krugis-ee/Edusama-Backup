<?php

use Illuminate\Support\Facades\Route;
//jp
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\UserRoleController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\UserPrivilegeController;
use App\Http\Controllers\OtherUserController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\ParentDashboardController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LessonController;
/*

|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//jp start

Route::get('forgot-password',[CustomAuthController::class,'forgot_password'])->middleware('alreadyLoggedIn')->name('forgot-password');
Route::post('forgot_password_process', [CustomAuthController::class, 'forgot_password_process'])->name('common_forgot_password');

Route::get('login',[CustomAuthController::class,'login'])->middleware('alreadyLoggedIn')->name('login');
Route::post('login_process', [CustomAuthController::class, 'login_process'])->name('common_login');

Route::get('logout', [CustomAuthController::class, 'logout'])->name('common_logout');

Route::get('admin', [DashboardController::class, 'dashboard'])->middleware('isLoggedIn')->name('dashboard');
Route::get('suspend', [DashboardController::class, 'suspend'])->name('suspend');

// Admin user- CRUD
//CRUD user
Route::controller(UserController::class)->prefix('superadmin/admin')->middleware('isSuperadminLoggedIn')->group(function () {
    Route::get('list', 'index')->name('user_index');
    Route::get('suspended_list', 'suspended_list_index')->name('user_suspended_list');

    Route::get('add', 'add')->name('user_add_get');
    Route::post('add', 'add_new')->name('user_add');

    Route::get('edit/{id}', 'edit')->name('user_edit');
    Route::post('update', 'update')->name('user_update');;

    //Route::get('delete/{id}', 'delete')->name('user_delete');

    Route::get('/new_password/{id}', 'new_password')->name('new_user_password');
    Route::post('change_password', 'change_password')->name('change_user_password');

    Route::get('status/{id}', 'status')->name('user_status');
    Route::post('change_status', 'change_status')->name('change_user_status');
  });
  //CRUD
//Admin user - CRUD

//CRUD Organization
Route::controller(OrganizationController::class)->prefix('superadmin/organization')->middleware('isSuperadminLoggedIn')->group(function () {
  Route::get('list', 'list')->name('organization_list');
  Route::get('suspended_list', 'suspended_list_index')->name('organization_suspended_list');

  Route::get('add', 'add')->name('organization_add');
  Route::post('add', 'add_new')->name('organization_add_new');
  Route::get('edit/{id}', 'edit')->name('organization_edit');
  Route::post('update', 'update')->name('organization_update');
  Route::get('status/{id}', 'status')->name('organization_status');
  Route::post('change_status', 'change_status')->name('change_organization_status');
});
//CRUD

//CRUD UserRole
Route::controller(UserRoleController::class)->prefix('admin/role')->middleware('isLoggedIn')->group(function () {
Route::get('add', 'add')->name('user_role_add');
Route::post('add', 'add_new')->name('user_role_add_new');
Route::get('edit/{id}', 'edit')->name('user_role_edit');
Route::post('update', 'update')->name('user_role_update');
Route::get('status/{id}', 'status')->name('user_role_status');
Route::post('change_status', 'change_status')->name('change_user_role_status');
Route::get('list', 'list')->name('user_role_list');
Route::get('suspended_list', 'suspended_list')->name('user_role_suspended_list');

});

//CRUD UserRole
Route::controller(UserPrivilegeController::class)->prefix('admin/privilege')->middleware('isLoggedIn')->group(function () {

  Route::get('add', 'privilege')->name('user_privilege');
  Route::post('add_new', 'privilege_add')->name('user_privilege_add');
  Route::get('list', 'privilege_list')->name('user_privilege_list');
  Route::get('edit/{id}', 'edit')->name('user_privilege_edit');
Route::post('update', 'update')->name('user_privilege_update');
  });

//CRUD Parent
Route::controller(ParentController::class)->prefix('admin/parents')->middleware('isLoggedIn')->group(function () {
  Route::get('add', 'add')->name('parent_add');
  Route::post('add', 'add_new')->name('parent_add_new');
  Route::get('edit/{id}', 'edit')->name('parent_edit');
  Route::post('update', 'update')->name('parent_update');
  Route::get('status/{id}', 'status')->name('parent_status');
  Route::post('change_status', 'change_status')->name('change_parent_status');
  Route::get('list', 'list')->name('parent_list');
  Route::get('suspended_list', 'suspended_list')->name('parent_suspended_list');
});

// Other users- CRUD
//CRUD user
Route::controller(OtherUserController::class)->prefix('admin/user')->middleware('isLoggedIn')->group(function () {
  Route::get('list', 'index_other_users')->name('other_user_index');
  Route::get('suspended_list', 'suspended_list_other_users_index')->name('other_user_suspended_list');

  Route::get('add', 'add_other_user')->name('other_user_add_get');
  Route::post('add', 'add_new_other_user')->name('other_user_add');

  Route::get('edit/{id}', 'edit_other_user')->name('other_user_edit');
  Route::post('update', 'update_other_user')->name('other_user_update');;

  //Route::get('delete/{id}', 'delete')->name('user_delete');

  Route::get('/new_password/{id}', 'other_user_new_password')->name('new_other_user_password');
  Route::post('change_password', 'other_user_change_password')->name('change_other_user_password');

  Route::get('status/{id}', 'other_user_status')->name('other_user_status');
  Route::post('change_status', 'other_user_change_status')->name('other_user_change_user_status');
});
//CRUD

//CRUD branch
Route::controller(BranchController::class)->prefix('admin/branch')->middleware('isLoggedIn')->group(function () {
  Route::get('list', 'index_branches')->name('branch_index');
  Route::get('suspended_list', 'suspended_list_branches_index')->name('branch_suspended_list');

  Route::get('add', 'add_branch')->name('branch_add_get');
  Route::post('add', 'add_new_branch')->name('branch_add');

  Route::get('edit/{id}', 'edit_branch')->name('branch_edit');
  Route::post('update', 'update_branch')->name('branch_update');;

  Route::post('change_status', 'branch_change_status')->name('branch_change_status');
});
//CRUD

//CRUD subject
Route::controller(SubjectController::class)->prefix('admin/subject')->middleware('isLoggedIn')->group(function () {
    Route::get('list', 'index_subjects')->name('subject_index');
    Route::get('suspended_list', 'suspended_list_subjects_index')->name('subject_suspended_list');

    Route::get('add', 'add_subject')->name('subject_add_get');
    Route::post('add', 'add_new_subject')->name('subject_add');

    Route::get('edit/{id}', 'edit_subject')->name('subject_edit');
    Route::post('update', 'update_subject')->name('subject_update');;

    Route::post('change_status', 'subject_change_status')->name('subject_change_status');
	});
  //CRUD

//CRUD Lesson
Route::controller(LessonController::class)->prefix('admin/lesson')->middleware('isLoggedIn')->group(function () {
    Route::get('list/{subj_id}', 'manage_subject')->name('manage_subject');
    Route::get('suspended_list', 'suspended_list_lessons_index')->name('lesson_suspended_list');

    Route::get('add/{subj_id}', 'add_lesson')->name('lesson_add_get');
    Route::post('add', 'add_new_lesson')->name('lesson_add');

    Route::get('edit/{id}', 'edit_lesson')->name('lesson_edit');
    Route::post('update', 'update_lesson')->name('lesson_update');;

    Route::post('change_status', 'lesson_change_status')->name('lesson_change_status');
	});
  //CRUD

//CRUD department
Route::controller(DepartmentController::class)->prefix('admin/department')->middleware('isLoggedIn')->group(function () {
    Route::get('list', 'index_departments')->name('department_index');
    Route::get('suspended_list', 'suspended_list_departments_index')->name('department_suspended_list');

    Route::get('add', 'add_department')->name('department_add_get');
    Route::post('add', 'add_new_department')->name('department_add');

    Route::get('edit/{id}', 'edit_department')->name('department_edit');
    Route::post('update', 'update_department')->name('department_update');;

    Route::post('change_status', 'department_change_status')->name('department_change_status');
	});
  //CRUD

//CRUD Student
Route::controller(StudentController::class)->prefix('admin/students')->middleware('isLoggedIn')->group(function () {
    Route::get('add/{slug}', 'add')->name('student_add');
    Route::post('add', 'add_new')->name('student_add_new');
    Route::post('add_by_file','add_student_by_file')->name('add_student_by_file');
    Route::post('add_student_bulk','add_student_bulk')->name('add_student_bulk');
    Route::get('edit/{id}', 'edit')->name('student_edit');
    Route::post('update', 'update')->name('student_update');
    Route::get('status/{id}', 'status')->name('student_status');
    Route::post('change_status', 'change_status')->name('change_student_status');
    Route::get('list', 'list')->name('student_list');
    Route::get('suspended_list', 'suspended_list')->name('student_suspended_list');
    Route::get('get_parents_by_branch', 'get_parents_by_branch')->name('get_parents_by_branch');
	Route::get('send_bulk_student_email', 'send_bulk_student_email')->name('send_bulk_student_email');
  });

  //CRUD Teacher
Route::controller(TeacherController::class)->prefix('admin/teachers')->middleware('isLoggedIn')->group(function () {
  Route::get('add', 'add')->name('teacher_add');
  Route::post('add', 'add_new')->name('teacher_add_new');
  Route::get('edit/{id}', 'edit')->name('teacher_edit');
  Route::post('update', 'update')->name('teacher_update');
  Route::get('status/{id}', 'status')->name('teacher_status');
  Route::post('change_status', 'change_status')->name('change_teacher_status');
  Route::get('list', 'list')->name('teacher_list');
  Route::post('suspended_list', 'suspended_list')->name('teacher_suspended_list');
  
});


//CRUD template
Route::controller(TemplateController::class)->prefix('admin/template')->middleware('isLoggedIn')->group(function () {
   Route::get('list', 'index_templates')->name('template_index');
  // Route::get('suspended_list', 'suspended_list_branches_index')->name('branch_suspended_list');

  Route::get('add', 'add_template')->name('template_add_get');
  Route::post('add', 'add_new_template')->name('template_add');

   Route::get('edit/{id}', 'edit_template')->name('template_edit');
   Route::post('update', 'update_template')->name('template_update');
   //jp
   

  // Route::get('change_status', 'branch_change_status')->name('branch_change_status');
});
//CRUD

//CRUD class_room
Route::controller(ClassRoomController::class)->prefix('admin/class_room')->middleware('isLoggedIn')->group(function () {
  Route::get('list', 'index_list')->name('index_list'); 
  Route::get('add/{slug}', 'add_class_room')->name('class_room_add_get');
  
  Route::post('add', 'add_class_room_using_template')->name('add_class_room_using_template');
  Route::post('add/manual_creation', 'add_new_manual_creation')->name('class_room_manual_add');
	//zoom
	Route::get('generate_zoom_meeting/{id}', 'generate_zoom_meeting_get')->name('generate_zoom_meeting_get'); 
	Route::post('generate_zoom_meeting', 'generate_zoom_meeting_post')->name('generate_zoom_meeting_post'); 
	Route::get('zoom_meeting/{id}', 'zoom_meeting')->name('zoom_meeting'); 
	//zoom
  //
  Route::get('manage/{id}','manage_class_room')->name('manage_class_room');
  Route::post('assign_students','assign_students_to_classroom')->name('assign_students');
  //
  Route::get('edit/{id}/{slug}', 'edit')->name('class_room_edit');
  Route::post('update', 'update_using_template')->name('update_using_template');
  Route::post('update_manual_updation', 'update_by_manual_updation')->name('update_by_manual_updation');
  Route::post('change_status', 'change_status')->name('change_class_room_status');
});
//CRUD

// Student dashboard
Route::get('student', [StudentDashboardController::class, 'dashboard'])->middleware('isLoggedIn')->name('student_dashboard');
Route::controller(StudentDashboardController::class)->prefix('student')->middleware('isLoggedIn')->group(function () {
    Route::get('online_class','online_class')->name('online_class');
    Route::get('course_details/{id}','course_details')->name('course_details');
    Route::get('my_profile','my_profile')->name('my_profile_student');
    Route::get('edit_my_profile','edit_my_profile')->name('edit_my_profile_student');
    Route::post('update_my_profile','update_my_profile')->name('update_my_profile_student');
    Route::get('change_password','change_password')->name('change_password_student');
    Route::post('change_password_process','change_password_process')->name('change_password_process_student');
    Route::get('student_assignment','student_assignment')->name('student_assignment');
    Route::get('assignment_download_status','assignment_download_status')->name('assignment_download_status');
    Route::post('answer_upload_status','answer_upload_status')->name('answer_upload_status');
	Route::get('assessment','assessment')->name('student_assessment');
	Route::get('exam_screen/{id}','exam_screen')->name('student_exam_screen');
});
//Teacher Dashboard
Route::get('teacher', [TeacherDashboardController::class, 'dashboard'])->middleware('isLoggedIn')->name('teacher_dashboard');
Route::controller(TeacherDashboardController::class)->prefix('teacher')->middleware('isLoggedIn')->group(function () {
    Route::get('video_course','video_course')->name('video_course');
    Route::get('my_profile','my_profile')->name('my_profile_teacher');
    Route::get('edit_my_profile','edit_my_profile')->name('edit_my_profile_teacher');
    Route::post('update_my_profile','update_my_profile')->name('update_my_profile_teacher');
    Route::get('change_password','change_password')->name('change_password_teacher');
    Route::post('change_password_process','change_password_process')->name('change_password_process_teacher');
	Route::get('teacher_assignment','teacher_assignment')->name('teacher_assignment');
	Route::post('teacher_add_assignment','teacher_add_assignment')->name('teacher_add_assignment');
	Route::get('get_subjects_by_teacher_id','get_subjects_by_teacher_id')->name('get_subjects_by_teacher_id');
	Route::get('edit_teacher_assignment','edit_teacher_assignment')->name('edit_teacher_assignment');
	Route::post('update_teacher_assignment','update_teacher_assignment')->name('update_teacher_assignment');
	Route::get('teacher_assignment_change_status','teacher_assignment_change_status')->name('teacher_assignment_change_status');
	Route::post('publish_teacher_assignment','publish_teacher_assignment')->name('publish_teacher_assignment');
	Route::get('teacher_assignment_progress/{assignment_id}','teacher_assignment_progress')->name('teacher_assignment_progress');
	Route::post('teacher_add_assignment_score','teacher_add_assignment_score')->name('teacher_add_assignment_score');
});

Route::get('parent', [ParentDashboardController::class, 'dashboard'])->middleware('isLoggedIn')->name('parent_dashboard');
Route::controller(ParentDashboardController::class)->prefix('parent')->middleware('isLoggedIn')->group(function () {
    Route::get('my_profile','my_profile')->name('my_profile_parent');
    Route::get('edit_my_profile','edit_my_profile')->name('edit_my_profile_parent');
    Route::post('update_my_profile','update_my_profile')->name('update_my_profile_parent');
    Route::get('change_password','change_password')->name('change_password_parent');
    Route::post('change_password_process','change_password_process')->name('change_password_process_parent');
    Route::get('parent_assignment/{student_id?}','parent_assignment')->name('parent_assignment');
});
//Route::get('teacher', [TeacherDashboardController::class, 'dashboard'])->middleware('isLoggedIn')->name('teacher_dashboard');
/*Route::controller(StudentDashboardController::class)->prefix('student')->middleware('isLoggedIn')->group(function () {
    Route::get('index', 'get_parents_by_branch')->name('get_parents_by_branch');
  });*/
Route::controller(AssessmentController::class)->prefix('admin/')->middleware('isLoggedIn')->group(function () {
	Route::get('assessment','assessment')->name('assessment');
	Route::get('create_exam','create_exam')->name('create_exam');
	Route::post('post_exam_one','post_exam_one')->name('post_exam_one');
	Route::get('question_bank/{slug}','question_bank')->name('question_bank');
	Route::get('clear_temp','clear_temp')->name('clear_temp');
	//Route::post('clear_one_question_temp','clear_one_question_temp')->name('clear_one_question_temp');
	Route::post('add_question_paper_import_post','add_question_paper_import_post')->name('add_question_paper_import_post');
	Route::post('ExcelpreviewUpdate','ExcelpreviewUpdate')->name('ExcelpreviewUpdate');
	Route::get('get_lessons_by_subjects_id','get_lessons_by_subjects_id')->name('get_lessons_by_subjects_id');
	Route::get('get_subjects_by_branch_id','get_subjects_by_branch_id')->name('get_subjects_by_branch_id');
	Route::post('add_question_manual_creation','add_question_manual_creation')->name('add_question_manual_creation');
    Route::post('fetch_question','fetch_question')->name('fetch_question');
	Route::post('exam_questions_add','exam_questions_add')->name('exam_questions_add');
	Route::post('exam_details_update','exam_details_update')->name('exam_details_update');
	Route::post('exam_update','exam_update')->name('exam_update');
	Route::post('change_exam_status', 'change_exam_status')->name('change_exam_status');
	Route::get('get_exam_by_exam_id','get_exam_by_exam_id')->name('get_exam_by_exam_id');
	Route::get('get_classroom_by_branch_id','get_classroom_by_branch_id')->name('get_classroom_by_branch_id');
	
    Route::get('list_question_','list_question')->name('list_question');
    Route::post('edit_question_type_one','edit_question_type_one')->name('edit_question_type_one');
    Route::post('suspend_question_type_one','suspend_question_type_one')->name('suspend_question_type_one');

    Route::post('edit_question_type_two','edit_question_type_two')->name('edit_question_type_two');
    Route::post('suspend_question_type_two','suspend_question_type_two')->name('suspend_question_type_two');

    Route::post('edit_question_type_four','edit_question_type_four')->name('edit_question_type_four');
    Route::post('suspend_question_type_four','suspend_question_type_four')->name('suspend_question_type_four');
});
Route::controller(DashboardController::class)->prefix('admin/')->middleware('isLoggedIn')->group(function () {
    Route::get('my_profile','my_profile')->name('my_profile_admin');

    Route::get('edit_my_profile_admin','edit_my_profile_admin')->name('edit_my_profile_admin');
    Route::post('update_my_profile_admin','update_my_profile_admin')->name('update_my_profile_admin');
    Route::get('change_password_admin','change_password_admin')->name('change_password_admin');
    Route::post('change_password_process_admin','change_password_process_admin')->name('change_password_process_admin');

    Route::get('edit_my_profile_organization','edit_my_profile_organization')->name('edit_my_profile_organization');
    Route::post('update_my_profile_organization','update_my_profile_organization')->name('update_my_profile_organization');
    Route::get('change_password_organization','change_password_organization')->name('change_password_organization');
    Route::post('change_password_process_organization','change_password_process_organization')->name('change_password_process_organization');
    Route::get('assignment','assignment')->name('assignment');
	Route::get('get_subjects_by_class_room_id','get_subjects_by_class_room_id')->name('get_subjects_by_class_room_id');
	Route::get('get_teachers_by_subject_id','get_teachers_by_subject_id')->name('get_teachers_by_subject_id');
	Route::post('add_assignment','add_assignment')->name('add_assignment');
	Route::get('edit_assignment','edit_assignment')->name('edit_assignment');
	Route::post('update_assignment','update_assignment')->name('update_assignment');
	Route::post('publish_assignment','publish_assignment')->name('publish_assignment');
	Route::post('assignment_change_status','assignment_change_status')->name('assignment_change_status');
	Route::get('assignment_progress/{assignment_id}','assignment_progress')->name('assignment_progress');
	Route::get('get_subjects_by_assignment_id','get_subjects_by_assignment_id')->name('get_subjects_by_assignment_id');
	Route::post('add_assignment_score','add_assignment_score')->name('add_assignment_score');
	Route::get('assignment_reupload_status','assignment_reupload_status')->name('assignment_reupload_status');
	Route::get('assignment_export','assignment_export')->name('assignment_export');
	Route::get('assignment_progress_export','assignment_progress_export')->name('assignment_progress_export');
    Route::get('assignment_teacher_upload_status','assignment_teacher_upload_status')->name('assignment_teacher_upload_status');
});
Route::controller(DashboardController::class)->prefix('admin/user')->middleware('isLoggedIn')->group(function () {
    Route::get('my_profile_user','my_profile_user')->name('my_profile_user');
    Route::get('edit_my_profile_user','edit_my_profile_user')->name('edit_my_profile_user');
    Route::post('update_my_profile_user','update_my_profile_user')->name('update_my_profile_user');
    Route::get('change_password_user','change_password_user')->name('change_password_user');
    Route::post('change_password_process_user','change_password_process_user')->name('change_password_process_user');
});
//super admin
Route::get('superadmin/login',[SuperAdminController::class, 'login'])->middleware('alreadySuperadminLoggedIn')->name('superadmin_login');
Route::post('superadmin/login_process', [SuperAdminController::class, 'login_process'])->name('super_login_process');
Route::get('superadmin', [SuperAdminController::class, 'dashboard'])->middleware('isSuperadminLoggedIn')->name('superadmin_home');
//Route::get('siteconfig', [SuperAdminController::class, 'siteconfig'])->prefix('superadmin')->middleware('isSuperadminLoggedIn')->name('superadmin_siteconfig');
Route::get('superadmin/logout', [SuperAdminController::class, 'logout'])->name('superadmin_logout');
