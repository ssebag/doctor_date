<?php
namespace App\Http\Controllers\Traits;
trait ForModelTrait{
    public function showAll($model){
        return $model::all();

    }
    public function showOne($col,$id,$model){
        return $model::where($col,$id);
    }

}
