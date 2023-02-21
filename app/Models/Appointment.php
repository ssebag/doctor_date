<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Appointment extends Model
{
    protected $fillable=['pa_id','dr_id','day','begin_hour','end_hour','duration','type','done','status'];
    use HasFactory;
    public function user(){
        return $this->belongsTo('App\Models\User','pa_id');
    }
    public function doctor(){
        return $this->belongsTo('App\Models\Doctor','dr_id')->withTrashed();
    }
}
