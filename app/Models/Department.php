<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Department extends Model
{
    use softDeletes;
    protected $fillable=['name','url','deleted_at'];
    use HasFactory;
    public function department(){
        return $this->hasMany(Doctor::class);
      }
}
