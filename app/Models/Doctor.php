<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use Illuminate\Notifications\Notifiable;
class Doctor extends Model
{
    use softDeletes ,Notifiable;
    protected $fillable=['user_id','name','photo','phone2','address','department','details','working_days_from','working_days_to','working_hours_from','working_hours_to','deleted_at'];
    use HasFactory;
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
      public function depa(){
        return $this->belongsTo('App\Models\Department','department')->withTrashed();
    }
    public function appointment(){
        return $this->hasMany(Appointment::class);
      }

}
