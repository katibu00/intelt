<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Settings\CoursesController;
use App\Http\Controllers\Settings\InstitutionController;
use App\Http\Controllers\Settings\SessionController;
use App\Http\Controllers\Settings\FacultiesController;
use App\Http\Controllers\Settings\DepartmentsController;
use App\Http\Controllers\Settings\LevelsController;
use App\Http\Controllers\Settings\GradingController;
use App\Http\Controllers\IntelliSAS\InstitutionsController;
use App\Http\Controllers\MarksController;
use App\Http\Controllers\ResultSummaryController;
use App\Http\Controllers\Student\CourseRegistrationController;
use App\Http\Controllers\Student\StudentProfileController;
use App\Http\Controllers\Student\StudentResultController;
use App\Http\Controllers\Users\StudentsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::get('/logout', [LogoutController::class, 'index'])->name('logout');

//home routes
Route::group(['middleware' => ['auth', 'admin']], function(){
    Route::get('/admin/home', [HomeController::class, 'admin'])->name('admin.home');
});
Route::group(['middleware' => ['auth', 'student']], function(){
    Route::get('/student/home', [HomeController::class, 'student'])->name('student.home');
});


Route::group(['middleware' => ['auth', 'intellisas']], function(){
    Route::get('/intellisas/home', [HomeController::class, 'intellisas'])->name('intellisas.home');
    Route::get('/institutions/index', [InstitutionsController::class, 'index'])->name('institutions.index');
    Route::get('/institutions/create', [InstitutionsController::class, 'create'])->name('institutions.create');
    Route::post('/institutions/store', [InstitutionsController::class, 'store'])->name('institution.store');
    Route::get('/institution/edit/{id}', [InstitutionsController::class, 'edit'])->name('institution.edit');
    Route::post('/institution/update/{id}', [InstitutionsController::class, 'update'])->name('institution.update');
});



Route::group(['prefix' => 'settings', 'middleware' => ['auth',  'admin']], function(){
    Route::get('/institution', [InstitutionController::class, 'index'])->name('settings.institution');

    Route::post('/basic', [InstitutionController::class, 'basic'])->name('basic');

    Route::get('/sessions/index', [SessionController::class, 'index'])->name('sessions.index');
    Route::post('/sessions/store', [SessionController::class, 'store'])->name('sessions.create');
    Route::post('/sessions/update', [SessionController::class, 'update'])->name('sessions.update');
    Route::post('/sessions/delete', [SessionController::class, 'delete'])->name('sessions.delete');

    Route::get('/faculties/index', [FacultiesController::class, 'index'])->name('faculties.index');
    Route::post('/faculties/store', [FacultiesController::class, 'store'])->name('faculties.create');
    Route::post('/faculties/update', [FacultiesController::class, 'update'])->name('faculties.update');
    Route::post('/faculties/delete', [FacultiesController::class, 'delete'])->name('faculties.delete');

    Route::get('/departments/index', [DepartmentsController::class, 'index'])->name('departments.index');
    Route::post('/departments/store', [DepartmentsController::class, 'store'])->name('departments.create');
    Route::post('/departments/update', [DepartmentsController::class, 'update'])->name('departments.update');
    Route::post('/departments/delete', [DepartmentsController::class, 'delete'])->name('departments.delete');

    Route::get('/levels/index', [LevelsController::class, 'index'])->name('levels.index');
    Route::post('/levels/store', [LevelsController::class, 'store'])->name('levels.create');
    Route::post('/levels/update', [LevelsController::class, 'update'])->name('levels.update');
    Route::post('/levels/delete', [LevelsController::class, 'delete'])->name('levels.delete');

    Route::get('/courses/index', [CoursesController::class, 'index'])->name('courses.index');
    Route::get('/courses/create', [CoursesController::class, 'create'])->name('courses.create');
    Route::post('/courses/store', [CoursesController::class, 'store'])->name('courses.store');
    Route::get('/details/{department_id}/{level_id}',  [CoursesController::class, 'details'])->name('courses.details');
    Route::get('/courses/edit/{id}', [CoursesController::class, 'edit'])->name('courses.edit');
    Route::post('/courses/update/{id}', [CoursesController::class, 'update'])->name('courses.update');
    Route::post('/courses/delete/', [CoursesController::class, 'delete'])->name('courses.delete');
    Route::get('/grading_scheme/index/', [GradingController::class, 'index'])->name('grading.index');
    Route::get('/grading_scheme/create/', [GradingController::class, 'create'])->name('grading.create');
    Route::post('/grading_scheme/store/', [GradingController::class, 'store'])->name('grading.store');
});

Route::group(['prefix' => 'student', 'middleware' => ['auth',  'student']], function(){
    Route::get('/courses/register', [CourseRegistrationController::class, 'index'])->name('register.courses');
    Route::post('/get-recommeded-courses', [CourseRegistrationController::class, 'getRecommeded'])->name('get-recommeded-courses');
    Route::post('/submit-courses', [CourseRegistrationController::class, 'registerCourses'])->name('submit-courses');
});

Route::group(['prefix' => 'users', 'middleware' => ['auth', 'admin']], function(){
    Route::get('/students',  [StudentsController::class, 'index'])->name('students.index');
    Route::post('/students',  [StudentsController::class, 'store']);
    Route::get('/students/create', [StudentsController::class, 'create'])->name('students.create');
});

Route::group(['prefix' => 'marks', 'middleware' => ['auth', 'admin']], function(){
    Route::get('/create', [MarksController::class, 'create'])->name('marks.create');
    Route::post('/create',  [MarksController::class, 'getMarks'])->name('marks.create');
    Route::post('/initialize-marks-entry',  [MarksController::class, 'initializeMarks'])->name('initialize-marks-entry');
    Route::post('/save-marks-entry',  [MarksController::class, 'saveMarks'])->name('save-marks-entry');
    Route::post('/submit-marks-entry',  [MarksController::class, 'submitMarks'])->name('submit-marks-entry');
    Route::post('/check-absent-marks-entry',  [MarksController::class, 'checkAbsentMarks'])->name('check-absent-marks-entry');
    Route::post('/uncheck-absent-marks-entry',  [MarksController::class, 'uncheckAbsentMarks'])->name('uncheck-absent-marks-entry');
});


Route::group(['prefix' => 'student/result', 'middleware' => ['auth', 'student']], function(){
    Route::get('/index',  [StudentResultController::class, 'index'])->name('student.result.index');
    Route::post('/generate',  [StudentResultController::class, 'generate'])->name('student.result.generate');
});
Route::group(['prefix' => 'admin/result', 'middleware' => ['auth', 'admin']], function(){ 
    Route::get('/summary/index',  [ResultSummaryController::class, 'index'])->name('admin.result.summary.index');
    Route::post('/summary/generate',  [ResultSummaryController::class, 'generate'])->name('admin.result.summary.generate');
    Route::post('/toogle-result-settings',  [InstitutionController::class, 'toogleResult'])->name('toogle-result-settings');
});

Route::group(['prefix' => 'student/profile', 'middleware' => ['auth', 'student']], function(){ 
    Route::get('/index',  [StudentProfileController::class, 'index'])->name('student.profile.index');
  
});


//table
Route::get('/paginate-faculties', [FacultiesController::class, 'paginate']);
Route::post('/search-faculties', [FacultiesController::class, 'search'])->name('search.faculties');

Route::get('/paginate-departments', [DepartmentsController::class, 'paginate']);
Route::post('/search-departments', [DepartmentsController::class, 'search'])->name('search.departments');

Route::get('/paginate-sessions', [SessionController::class, 'paginate']);
Route::post('/search-sessions', [SessionController::class, 'search'])->name('search.sessions');

Route::get('/paginate-courses', [CoursesController::class, 'paginate']);
Route::post('/search-courses', [CoursesController::class, 'search'])->name('search.courses');
Route::post('/sort-courses', [CoursesController::class, 'sort'])->name('sort.courses');

Route::get('/paginate-students', [StudentsController::class, 'paginate']);
Route::post('/search-students', [StudentsController::class, 'search'])->name('search.students');
Route::post('/sort-students', [StudentsController::class, 'sort'])->name('sort.students');
