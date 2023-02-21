<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Department;
use App\Models\User;
use App\Models\acceptedAppointment;
use Illuminate\Database\Eloquent\softDeletes;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentMail;

class AppointmentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments= Appointment::orderBy('day','ASC')->orderBy('done','DESC')->get();
       return view('appointmentTable',compact('appointments'));
    }

    public function takeAppointment($id){

        $days_week=['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday'];
        $hours=['09:00 AM', '09:30 AM','10:00 AM', '10:30 AM','11:00 AM', '11:30 AM',
        '12:00 PM', '12:30 PM','1:00 PM', '1:30 PM','2:00 PM', '2:30 PM','3:00 PM', '3:30 PM','4:00 PM'
            ];

       $doctor=Doctor::where('name',$id)->first();
        return view('takeAppointment',['doctor'=>$doctor,'days_week'=>$days_week,'hours'=>$hours]);



    }
    public function addAppointment($id)
    {
        $A=acceptedAppointment::where('id',$id)->first();
        $data['pa_id']=$A['pa_id'];
        $data['dr_id']=$A['dr_id'];
        $data['day']=$A['day'];
        $data['begin_hour']=$A['begin_hour'];
        $data['end_hour']=$A['end_hour'];
        $data['duration']=$A['duration'];
        $data['status']=$A['status'];
        $data['type']=$A['type'];
        $data['done']=$A['done'];
        $dat=Appointment::create($data);
        $doctor=$A->dr_id;
        $doc=Doctor::findorfail($doctor);
        $do=$doc->user_id;
        $dep=$doc['department'];
        $department=Department::where('id',$dep)->first();
        $deppp=$department['name'];
        $A->delete();
        /** for mail */
        $na=User::where('id',$data['pa_id'])->first();
        $name=$na['name'];
        $doctor=$doc['name'];
        $day=$data['day'];
        $hour=$data['begin_hour'];
        $email=$na['email'];
        Mail::to($email)->send(new AppointmentMail($name,$doctor,$day,$hour));
        return redirect()->route('appointment.new.show',$do);

    }


    public function appointmentDone($id){
        $appointment=Appointment::findOrfail($id);
        if($appointment['done'] == 'yes')
        {
            $appointment->done = 'no';
            $appointment->save();
            return redirect()->back();
        }
        elseif($appointment['done'] == 'no')
        {
            $appointment->done = 'yes';
            $appointment->save();
            return redirect()->back();
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function addStatus($id){
        $appointment=Appointment::where('id',$id)->first();
        return view('addStatus',compact('appointment'));
    }
    public function addStatusPost(Request $req,$id){
        $appointment=Appointment::where('id',$id)->first();
        $appointment->status=$req->status;
        $appointment->save();
        return redirect()->route('patient.appointment',['user_id'=>$appointment->user->name,'dr_id'=>$appointment->dr_id]);
    }
    public function edit($id)
    {
        $days_week=['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday'];
        $hours=['09:00 AM', '09:30 AM','10:00 AM', '10:30 AM','11:00 AM', '11:30 AM',
        '12:00 PM', '12:30 PM','1:00 PM', '1:30 PM','2:00 PM', '2:30 PM','3:00 PM', '3:30 PM','4:00 PM'
            ];
       $appointment=Appointment::findOrfail($id);
       return view('editAppointment',compact('hours'),compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $appointment=Appointment::findOrfail($id);
        $n=new Carbon($request['begin_hour']);
        $nn=$n->addMinute('30')->toTimeString();
        $request['end_hour']=$nn;
        $request['type']  =$request->input('category');
        for($i =0 ; $i< count($request->input('category') ) ; $i++){

            $request['type']=$request['type'][$i];
        }

        $appointment->day=$request->day;
        $appointment->begin_hour=$request->begin_hour;
        $appointment->end_hour=$request->end_hour;
        $appointment->type=$request['type'];

        $appointment->save();
        $patient=User::findOrfail($appointment->pa_id);
        //Session::put('requestReferrer',URL::previous());
        //return redirect(Session::get('requestReferrer'));
        return redirect()->route('patient.appointment',['user_id'=>$appointment->user->name,'dr_id'=>$appointment->dr_id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment=Appointment::findOrfail($id);
        $appointment->delete();
        return redirect()->back();

    }
}
