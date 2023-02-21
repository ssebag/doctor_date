<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\ForApiTrait;
use App\Models\Doctor;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    use ForApiTrait;
    public function index()
    {
       return $this->showTrait(Doctor::class);
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

        $validator=Validator::make($request->all(), [
            'name' => ['required','unique:departments,name'.$request->id],
            'url'=>['required','unique:departments,url'.$request->id],
            'url'=>['required','unique:departments,url'.$request->id],
            'url'=>['required','unique:departments,url'.$request->id],
            'url'=>['required','unique:departments,url'.$request->id],
            'url'=>['required','unique:departments,url'.$request->id],
            'url'=>['required','unique:departments,url'.$request->id],
        ]);

        if($validator->fails()){
                return $this->storeItem(null,$validator->errors(),201);
        }


            $data=Department::create($request->all());
            return $this->storeItem($data,'The Item Is Store',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->showOneTrait(Doctor::class,$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->deleteItem(Doctor::class,$id);
    }
}
