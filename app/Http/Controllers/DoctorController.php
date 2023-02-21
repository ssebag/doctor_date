<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\softDeletes;
use App\Http\Controllers\Traits\ForModelTrait;
use App\Models\Doctor;
use App\Models\Department;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class DoctorController extends Controller
{
        use ForModelTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
       public $days_week=['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday'];
       public  $hours=['9 AM','10 AM','11 AM','12 PM','1 PM','2 PM','3 PM','4 PM','5 PM','6 PM'];



    public function index()
    {
        //$doctors=Doctor::all();
        $doctors=$this->showAll(Doctor::class);
        return view('forAdmin.doctorTable',compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $days_week=$this->days_week;
        $hours=$this->hours;
        $department=$this->showAll(Department::class);

       return view('forAdmin.addDoctor',['department'=>$department,'days_week'=>$days_week,'hours'=>$hours]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image=$request->file('photo')->getClientOriginalName();
        $image_name=$request->name.'_'.$image;
        $path=$request->file('photo')->storeAs('doctors',$image_name,'uploadPhoto');
       $k=$request['department'];
       $kk=Department::where('name',$k)->first();
       $kkk=$kk['id'];
       $request['department']=$kkk;


       $user=User::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'password' => Hash::make($request['password']),
        'role' =>'manager',
        'phone'=>$request['phone1'],
        'city'=>$request['city'],
        'address'=>$request['address'],

    ]);
    $user->save();
    if($user['role']== 'manager'){
       $doctor=Doctor::create([
        'user_id'=> $user['id'],
        'name'=>$request['name'],
        'photo' =>  $path,
        'department' =>  $request['department'],
        'phone2' =>  $request['phone2'],
        'details' =>  $request['details'],
        'working_days_from' =>  $request['working_days_from'],
        'working_days_to' =>  $request['working_days_to'],
        'working_hours_from' =>  $request['working_hours_from'],
        'working_hours_to' =>  $request['working_hours_to'],
    ]);
       return redirect()->route('department.doctors',$k);}
    }
    public function doctorToUser($id){
        $user=User::findOrfail($id);
        $doctor=Doctor::where('user_id',$id)->first();
        if($user['role']=='manager'){
            $user['role']='user';
            $doctor->delete();
            $user->save();
            return redirect()->back();
        }
        elseif($user['role']=='user'){
            $isDoctor=Doctor::where('user_id',$id)->withTrashed()->first();
             $days_week=$this->days_week;
                $hours=$this->hours;
            if($isDoctor == Null)
            {
                return view("forAdmin.completeToDoctor",['user'=>$user,'days_week'=>$days_week,'hours'=>$hours]);

            }
            else{
            if($isDoctor->deleted_at == Null){

                return view("forAdmin.completeToDoctor",['user'=>$user,'days_week'=>$days_week,'hours'=>$hours]);
            }
            elseif($isDoctor->deleted_at != Null){
                $isDoctor->deleted_at=Null;
                $isDoctor->save();
                $user->role='manager';
                $user->save();
                return redirect()->back();
            }
            }



        }
    }
    public function completeDoctor(Request $req,$id){
        $user=User::where('id',$id)->first();
        $user->role='manager';
        $user->save();
        $k=$req['department'];
        $kk=Department::where('name',$k)->first();
        $kkk=$kk['id'];
        $req['department']=$kkk;
       $data['name'] =$user['name'];
       $data['user_id'] =$user['id'];
        $data['photo']=$req['photo'];
        $data['phone']=$req['phone'];
        $data['details']=$req['details'];
        $data['department']=$req['department'];
        $data['phone2']=$req['phone2'];
        $data['working_days_from']=$req['working_days_from'];
        $data['working_days_to']=$req['working_days_to'];
        $data['working_hours_to']=$req['working_hours_to'];
        $data['working_hours_from']=$req['working_hours_from'];
        Doctor::create($data);
        return redirect()->route('users.show');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // $doctors=Doctor::where('user_id',$id)->withTrashed()->first();
       $doctors=$this->showOne('user_id',$id,Doctor::class)->withTrashed()->first();
        return view('doctorProfile',compact('doctors'));

    }
    /**for show patient who related to a doctor */
    public function showPatient($id){
        $doctor=Doctor::where('name',$id)->first();
        $d=$doctor['id'];
       $patient=Appointment::where('dr_id',$d)->select('pa_id','dr_id')->groupBy('pa_id','dr_id')->get();

       return view('forAdmin.doctorPatient',compact('patient'),compact('doctor'));
    }
   public function showAppointmentallpatient($id){
     $doctor=Doctor::where('name',$id)->first();
     $d=$doctor['id'];
     $appointment=Appointment::where('dr_id',$d)->where('done','no')->orderBy('done','DESC')->get();
     return view('forAdmin.patientforDoctorAppointment',compact('appointment'),['patient'=>$doctor]);
   }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $days_week=['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday'];
        $hours=['9 AM','10 AM','11 AM','12 PM','1 PM','2 PM','3 PM','4 PM','5 PM','6 PM','7 PM','8 PM','9 PM','10 PM','11 PM','12 AM'];
        $doctor=Doctor::where('user_id',$id)->first();
        return view('forAdmin.editDoctor',['doctor'=>$doctor, 'days_week'=>$days_week,'hours'=>$hours]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $doctor=Doctor::where('user_id',$id)->first();
        $user=User::where('id',$id)->first();
        $doctor->name = $request->name;
        $image=$request->file('photo')->getClientOriginalName();
        $image_name=$request->name.'_'.$image;
        $path=$request->file('photo')->storeAs('doctors',$image_name,'uploadPhoto');
        $doctor->photo = $path;
        $n=Department::where('name',$request['department'])->first();
        $doctor->department = $n['id'];
        $doctor->phone2 = $request->phone2;
        $doctor->details = $request->details;
        $doctor->working_days_from = $request->working_days_from;
        $doctor->working_days_to = $request->working_days_to;
        $doctor->working_hours_from = $request->working_hours_from;
        $doctor->working_hours_to = $request->working_hours_to;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->address=$request->address;
        $user->phone=$request->phone;
        $doctor->update();
        $user->update();
        return redirect()->route('doctor.show',$doctor->user_id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor=Doctor::findOrfail($id);
        $user=User::where('id',$doctor['user_id'])->first();
        $user['role']='user';
        $user->save();
        $doctor->delete();

        return back();

    }
    public function search(Request $req){



        $res=Doctor::where('name','LIKE','%'.$req['query'].'%')->orWhere('details','LIKE','%'.$req['query'].'%')->first();

        $res1=User::where('role','manager')->where('city','LIKE','%'.$req['query'].'%')->orWhere('address','LIKE','%'.$req['query'].'%')->get();

      if($res)
        {  $res=Doctor::where('name','LIKE','%'.$req['query'].'%')->orWhere('details','LIKE','%'.$req['query'].'%')->get();

              return view('forSearch',['res'=>$res]);}


          elseif($res1)
         { //$res1=User::where('role','manager')->where('city','LIKE','%'.$req['query'].'%')->orWhere('address','LIKE','%'.$req['query'].'%')->get();
            for($i=0 ; $i < count($res1) ; $i++){
                $doctor[$i]=Doctor::where('user_id',$res1[$i]['id'])->get();
                dd($doctor[$i]);
             }
             return view('forSearch',['res'=>$doctor[$i]]);
              }

                return redirect()->back()->with('error','not found');

    }







    public function photo(){
        return view ('upload');
    }

    public function photostore(Request $req){
        $image=$req->file('photo')->getClientOriginalName();
        $kk='user1_'.$image;
        $path = $req->file('photo')->storeAs('doctor',$kk,'uploadPhoto');
        Department::create([
            'name'=>'seba',
            'url'=>$path,
        ]);
        return $path;
    }
}
