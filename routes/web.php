<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AcceptedAppointmentController;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

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

Route::get('/add', function () {
    return view('forAdmin.addDepartment');
});

Auth::routes();
/* Route::group(['middleware' => ['auth' , 'checkLogin']], function(){
    Route::get('/admin', function(){
        return view('admin');
    });
}); */
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/*Doctor*/
 Route::get('/doctor/{id}',[DoctorController::class, 'show'])->name('doctor.show');
/*patient*/

/*department */
Route::get('/department/{id}',[DepartmentController::class, 'show'])->name('department.doctors');

Route::middleware(['checkUser'])->group(function(){

    Route::get('/takeAppointment/{id}',[AppointmentController::class, 'takeAppointment'])->name('appointment.take'); /** nnnn */
    Route::post('/takeAppointment/{id}',[AcceptedAppointmentController::class, 'addAppointment'])->name('appointment.take.add'); /** nnnn */

    Route::get('/user/edit/{id}',[PatientController::class,'edit'])->name('user.edit');
    Route::put('/user/edit/{id}',[PatientController::class,'update'])->name('user.update');
    Route::get('/patientAppointment/{user_id}/d_p/{dr_id}',[PatientController::class,'showAppointment'])->name('patient.appointment'); /** nnnn */

});
Route::middleware(['checkUMA'])->group(function(){
    Route::get('/patient/{id}',[PatientController::class,'show'])->name('patient.show'); /**for patient profile */ /** nnnn */
    Route::get('/appointment/edit/{id}',[AppointmentController::class,'edit'])->name('appointment.edit');
    Route::put('/appointment/edit/{id}',[AppointmentController::class,'update'])->name('appointment.update');
    Route::delete('/appointment/{id}',[AppointmentController::class,'destroy'])->name('appointment.destroy');
    Route::get('/patientAppointment/{user_id}/d_p/{dr_id}',[PatientController::class,'showAppointment'])->name('patient.appointment'); /** nnnn */

});
Route::middleware(['checkLogin'])->group(function(){
Route::get('/doctor',[DoctorController::class, 'index'])->name('doctor');/** to show all doctors */
Route::get('/doctorAdd',[DoctorController::class, 'create'])->name('doctor.create');/**to add new doctor */
Route::post('/doctor/add',[DoctorController::class, 'store'])->name('doctor.store'); /**to add new doctor */
Route::get('/doctorPatient/{id}',[DoctorController::class,'showPatient'])->name('doctor.patient'); /** to show patient who related to specific doctor */
Route::get('/departments',[DepartmentController::class, 'index'])->name('departments'); /**show department table */
Route::get('/departmentAdd',[DepartmentController::class, 'create'])->name('department.create'); /**add new department */
Route::post('/department/add',[DepartmentController::class, 'store'])->name('department.store'); /**add new department */
Route::get('/appointment',[AppointmentController::class, 'index'])->name('appointment'); /** show all appointment  */
Route::get('/doctorToUser/{id}',[DoctorController::class, 'doctorToUser'])->name('doctorToUser'); /** show all appointment  */
Route::delete('/doctor/{id}',[DoctorController::class,'destroy'])->name('doctor.destroy');
Route::get('/users',[PatientController::class,'index'])->name('users.show');
Route::delete('/user/{id}',[PatientController::class,'destroy'])->name('user.destroy');
Route::get('/department/edit/{id}',[DepartmentController::class,'edit'])->name('department.edit');
Route::put('/department/edit/{id}',[DepartmentController::class,'update'])->name('department.update');
Route::delete('/department/{id}',[DepartmentController::class,'destroy'])->name('department.destroy');
Route::post('/complete/doctor/{id}',[DoctorController::class,'completeDoctor'])->name('Complatedoctor.store');
});

Route::middleware(['checkManager'])->group(function(){
    Route::get('/doctorPatient/{id}',[DoctorController::class,'showPatient'])->name('doctor.patient'); /** to show patient who related to specific doctor */
    Route::get('/patientAppointment/d_p/{dr_id}',[DoctorController::class,'showAppointmentallpatient'])->name('patient.appointment.fordoctor'); /** nnnn */
    Route::get('/doctor/edit/{id}',[DoctorController::class,'edit'])->name('doctors.edit');
    Route::put('/doctor/edit/{id}',[DoctorController::class,'update'])->name('doctors.update');
    Route::get('/appointmentDone/{id}',[AppointmentController::class,'appointmentDone'])->name('appointment.done');
    Route::get('/appointment/newAp/{id}',[AcceptedAppointmentController::class,'index'])->name('appointment.new.show');
    Route::get('/appointment/new/{id}',[AppointmentController::class,'addAppointment'])->name('appointment.new.add');
    Route::get('/status/{id}',[AppointmentController::class,'addStatus'])->name('add.status');
    Route::post('/status/{id}',[AppointmentController::class,'addStatusPost'])->name('add.status.post');

});


Route::get('/search',[DoctorController::class,'search'])->name('page.search');

/* Route::get('/nn',[DoctorController::class,'photo']);
Route::post('/nn',[DoctorController::class,'photostore'])->name('photo.show');
 */

/* Route::get('/send',function(){
    Mail::to('s.sseba96@gmail.com')->send(new SendMail);
    return response('it sent');
});
 */
