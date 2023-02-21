<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Traits\ForModelTrait;

class DepartmentController extends Controller
{
    use ForModelTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments=Department::all();
        return view('forAdmin.departmentTable',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forAdmin.addDepartment');
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
        $image_name=$request->name .'_' .$image;
        $path = $request->file('photo')->storeAs('department',$image_name,'uploadPhoto');
        Department::create([
            'name'=>$request->name,
            'url'=>$path,
        ]);
        return redirect()->route('departments');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department=Department::where('name',$id)->withTrashed()->first();
        $department_name=$department->name;
        if($department->deleted_at == Null){

              $dep=$department['id'];
                $doctors=Doctor::where('department',$dep)->get();
                return view('departments',compact('doctors'),compact('department_name'));
        }
        else{
            return redirect()->back();
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$department=Department::where('id',$id)->first();
        $department=$this->showOne('id',$id,Department::class)->first();
        return view('editDepartment',compact('department'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $department=Department::findOrfail($id);
        $department->name=$request->name;
        $department->url=$request->url;
        $doctor=Doctor::where('department',$id)->get();

        $department->save();
        return redirect()->route('departments');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department=Department::findOrfail($id);
        $department->delete();
        return redirect()->back();
    }
}
