<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\DashboardNewsController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\FormTemplatesController;
use App\Http\Controllers\Admin\FormTypeController;
use App\Http\Controllers\Admin\MasterUsersController;
use App\Http\Controllers\Admin\OtherMenuController;
use App\Http\Controllers\Admin\PengajuanAdminController;
use App\Http\Controllers\Admin\ProgramStudiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AkunController;
use App\Http\Controllers\User\PengajuanController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('auth.login');
// })->name('login-page');
Route::get('/', [LoginController::class, 'showLoginForm'])->name('index');


Route::get('/language/{locale}', function ($locale) {
    // https://lokalise.com/blog/laravel-localization-step-by-step/
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('language.change'); // Menyediakan nama 'language.change' untuk rute ini


Route::view('/forbidden', '400');

Auth::routes();
// Auth::routes(['verify' => true]);
/*
// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');
*/
// Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.sipa.home')->middleware('is_admin');
Route::get('open/getProgramStudi/{departmentId}', [PengajuanController::class, 'getProgramStudi'])->name('openGetProgramStudi');

Route::group(['namespace' => '', 'prefix' => 'admin',  'middleware' => ['auth', 'is_admin']], function () {
    Route::get('home', [AdminController::class, 'adminHome'])->name('admin.sipa.home');
    Route::resource('master/department', DepartmentController::class);
    Route::resource('master/program-studi', ProgramStudiController::class);
    Route::resource('master/tipe-borang', FormTypeController::class);
    Route::resource('master/jenis-borang', FormTemplatesController::class);
    Route::resource('master/berita-dashboard', DashboardNewsController::class);
    Route::resource('master/menu-lain', OtherMenuController::class);

    Route::get('pengajuan-surat', [PengajuanAdminController::class, 'index'])->name('pengajuanadmin.index');
    Route::get('pengajuan-surat/{id}', [PengajuanAdminController::class, 'edit'])->name('pengajuanadmin.preview');
    Route::put('pengajuan-surat/{id}', [PengajuanAdminController::class, 'update'])->name('pengajuanadmin.update');
    Route::get('/get-data-by-department/{departmentId}/{status}', [PengajuanAdminController::class, 'getByDepartmentId'])->name('getPengajuanByDepartmentId');
    Route::get('/api/getDataHome/{departmentId}', [AdminController::class, 'getDataHome'])->name('getDataHome');

    Route::get('users', [MasterUsersController::class, 'index'])->name('masteruser.index');
    Route::put('users/{id}/{roleId}', [MasterUsersController::class, 'changeRole'])->name('masteruser.changeRole');
    Route::get('users/getByDepartementId/{departmentId}', [MasterUsersController::class, 'getByDepartmentId'])->name('masteruser.getByDepartementId');
    Route::delete('users/{id}', [MasterUsersController::class, 'destroy'])->name('masteruser.destroy');

    Route::resource('backup', BackupController::class);
    Route::put('backup', [BackupController::class, 'downloadDB'])->name('backup.downloadDB');

    // Route::get('/language/{locale}', function ($locale) {
    //     app()->setLocale($locale);
    //     session()->put('locale', $locale);
    //     return redirect()->back();
    // });
});

Route::group(['namespace' => '', 'prefix' => 'user',  'middleware' => ['auth', 'is_user']], function () {
    Route::get('home', [UserController::class, 'userHome'])->name('user.sipa.home');

    Route::get('pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
    Route::get('getProgramStudi/{departmentId}', [PengajuanController::class, 'getProgramStudi'])->name('getProgramStudi');
    Route::post('pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');

    Route::get('riwayat', [PengajuanController::class, 'riwayat'])->name('pengajuan.riwayat');
    Route::get('riwayat/preview/{id}', [PengajuanController::class, 'preview'])->name('pengajuan.preview');
    Route::get('riwayat/edit/{id}', [PengajuanController::class, 'edit'])->name('pengajuan.edit');
    Route::put('riwayat/update/{id}', [PengajuanController::class, 'update'])->name('pengajuan.update');
    Route::get('riwayat/sent/{id}', [PengajuanController::class, 'sent'])->name('pengajuan.sent');
    Route::get('riwayat/cancel/{id}', [PengajuanController::class, 'cancel'])->name('pengajuan.cancel');

    Route::get('template-surat/{id}', [PengajuanController::class, 'templateSurat'])->name('templateSurat');
    // Route::get('/language/{locale}', function ($locale) {
    //     app()->setLocale($locale);
    //     session()->put('locale', $locale);
    //     return redirect()->back();
    // });
});

Route::group(['namespace' => '', 'prefix' => 'app',  'middleware' => ['auth', 'all_user']], function () {
    Route::get('pengaturan-akun', [AkunController::class, 'index'])->name('pengaturan-akun.index');
    Route::put('pengaturan-akun/{id}', [AkunController::class, 'update'])->name('pengaturan-akun.update');
    Route::put('pengaturan-akun-updateImg/{id}', [AkunController::class, 'updateImg'])->name('pengaturan-akun-updateImg');


    Route::get('change-password', [AkunController::class, 'changePassword'])->name('change-password');
    Route::put('change-password/{id}', [AkunController::class, 'changePasswordUpdate'])->name('change-password-update');
});
