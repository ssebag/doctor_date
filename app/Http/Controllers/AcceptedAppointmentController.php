<?php

namespace App\Http\Controllers;

use App\Models\acceptedAppointment;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Department;
use App\Models\Appointment;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CreateAppointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;
class AcceptedAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($id)
    {
        $d=Auth::user()->unreadNotifications;
        foreach($d as $not){
           //$not->update(['read_at'=>now()]);
           $not->markAsRead();
           //$not->delete();
        }
        if(Auth::id() == $id){
        $doctor=Doctor::where('user_id',$id)->first();
        $forAcceptedAppointment=AcceptedAppointment::where('dr_id',$doctor->id)->get();
        return view('forAcceptedAppointment',compact('forAcceptedAppointment'));

    } else
        {
            return redirect('/');
        }
  }

    public function addAppointment(Request $req,$id)
    { $A=Appointment::where('day',$req['day'])->where('begin_hour',$req['begin_hour'])->get();
        if($A->isEmpty())
        {
            $req['pa_id']=Auth::id();
            $req['dr_id']=$id;
            $n=new Carbon($req['begin_hour']);
            $nn=$n->addMinute('30')->toTimeString();
            $req['end_hour']=$nn;
            $req['duration']='30 m';

            $req['type']  =$req->input('category');
            $req['done']="no";
            $req['status']="yet";

            for($i =0 ; $i< count($req->input('category') ) ; $i++){

                $req['type']=$req['type'][$i];
            }

            $doctor=Doctor::where('id',$id)->first();
            $user=User::where('id',$doctor->user_id)->get();
            $data=acceptedAppointment::create($req->all());
            $doc=Doctor::findorfail($id);
            $dep=$doc['department'];
            $department=Department::where('id',$dep)->first();
            $deppp=$department['name'];
            Notification::send($user, new CreateAppointment($data->id));
            return redirect()->route('department.doctors',$deppp);



                    }
        else{
            $doctor=Doctor::where('id',$id)->first();
            $d=$doctor['name'];
            return redirect()->route('appointment.take',$d)->with('alert','select other hour!');

        }
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
     * @param  \App\Models\acceptedAppointment  $acceptedAppointment
     * @return \Illuminate\Http\Response
     */
    public function show(acceptedAppointment $acceptedAppointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\acceptedAppointment  $acceptedAppointment
     * @return \Illuminate\Http\Response
     */
    public function edit(acceptedAppointment $acceptedAppointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\acceptedAppointment  $acceptedAppointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, acceptedAppointment $acceptedAppointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\acceptedAppointment  $acceptedAppointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(acceptedAppointment $acceptedAppointment)
    {
        //
    }
}
