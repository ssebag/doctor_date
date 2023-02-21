<?php
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\AccAppointmentController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/** patient */
Route::get('/users',[PatientController::class,'index'])->name('all.user.for.admin');
Route::get('/user/{id}',[PatientController::class,'show'])->name('one.user');
Route::get('/patient/delete/{id}',[PatientController::class,'destroy'])->name('delete.patient');


/**doctor */
Route::get('/doctors',[DoctorController::class,'index'])->name('all.doctors.for.admin');
Route::get('/doctor/{id}',[DoctorController::class,'show'])->name('one.doctor');
Route::get('/doctor/delete/{id}',[DoctorController::class,'destroy'])->name('delete.doctor');


/**department */
Route::get('/departments',[DepartmentController::class,'index'])->name('all.department');
Route::post('/department/save',[DepartmentController::class,'store'])->name('store.department.for.admin');
Route::get('/department/{id}',[DepartmentController::class,'show'])->name('one.department');
Route::get('/department/delete/{id}',[DepartmentController::class,'destroy'])->name('delete.department');


/**appointment */
Route::get('/appointments',[AppointmentController::class,'index'])->name('all.appointment.for.manager');
Route::get('/appointment/{id}',[AppointmentController::class,'show'])->name('one.appointment.for.manager');
Route::get('/appointment/delete/{id}',[AppointmentController::class,'destroy'])->name('delete.appointment');

/**accepted appointment */
Route::get('/accepted/appointments',[AccAppointmentController::class,'index'])->name('all.acc.appointment.for.manager');
Route::get('/accepted/appointment/{id}',[AccAppointmentController::class,'show'])->name('one.acc.appointment.for.manager');
