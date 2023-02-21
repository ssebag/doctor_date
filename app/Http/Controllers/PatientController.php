<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Patient;
use App\Models\Doctor;
use App\Http\Controllers\Traits\ForModelTrait;
use App\Models\Appointment;

use Illuminate\Http\Request;

class PatientController extends Controller
{ use ForModelTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $users=$this->showAll(User::class);
        return view('forAdmin.allUsers',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id == Auth::id() || Auth::user()->role=="admin" )
            {
                $user=User::findOrfail($id);
                $information=Appointment::where('pa_id',$id)->select('dr_id')->groupBy('dr_id')->get();
                return view('yourProfile',compact('user'),compact('information'));
                }
            else{
                $user=User::findOrfail($id);
                $doctor=Doctor::where('user_id',Auth::id())->first();
                $d=$doctor['id'];
                $information=Appointment::where('pa_id',$id)->where('dr_id',$d)->select('dr_id')->groupBy('dr_id')->get();

                return view('yourProfile',compact('user'),compact('information'));


            }
    }

    public function showAppointment($user_id,$de_id){
        $doctor=Doctor::findOrfail($de_id);
        if(Auth::id() == $doctor->user_id || Auth::user()->name == $user_id)
        {$patient=User::where('name',$user_id)->first();
        $p=$patient['id'];
        $appointment=Appointment::where('pa_id',$p)->where('dr_id',$de_id)->get();
        return view('forAdmin.patientAppointment',compact('appointment'),compact('patient'));}
        else {
            return redirect('/');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user=User::findOrfail($id);
        if($user['role']== 'manager'){
            $doctor=Doctor::where('user_id',$id)->first();

            return redirect()->route('doctors.edit',$doctor->id);
        }
        elseif($user['role']== 'user'){
            return view('forAdmin.editUser',compact('user'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=User::findOrfail($id);
              $user->name=$request->name;
                $user->email=$request->email;
                $user->phone=$request->phone;
                $user->address=$request->address;
                $user->save();
                return redirect()->route('patient.show',$id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::findOrfail($id);
        if($user->role == 'user'){
            $user->delete();
        }
        return redirect()->back();
    }
}
