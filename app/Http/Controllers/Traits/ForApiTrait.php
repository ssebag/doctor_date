<?php
namespace App\Http\Controllers\Traits;
trait ForApiTrait{
    public function showTrait($data=null){
     $d=$data::all();
     if(!$d->isEmpty())
     {   $dataa=[
        'data'=>$d,
        'message'=>'Show All Done',
        'status'=>200,
       ];
     return response($dataa);}
     else{
        $dataa=[

            'message'=>'Its empty',
            'status'=>401,
           ];
         return response($dataa);
     }
    }
    public function showOneTrait($data=null,$id){
     $d=$data::find($id);
     if($d != null)
     {   $dataa=[
        'data'=>$d,
        'message'=>'Show Item Done',
        'status'=>200,
       ];
     return response($dataa);}
     else{
        $dataa=[

            'message'=>'The Item Not Found',
            'status'=>401,
           ];
         return response($dataa);
     }
    }
    public function storeItem($data,$msg,$status){
           $dataa=[
           'data'=>$data,
           'message'=>$msg,
           'status'=>$status,
          ];
        return response($dataa);}

    public function deleteItem($data=null,$id){
        $dataa=$data::findOrfail($id);
        $dataa->delete();
        $data2=[
            'data'=>$dataa,
            'message'=>'The Delete is Ok',
            'status'=>200,
        ];
        return response($data2);
    }

       }



