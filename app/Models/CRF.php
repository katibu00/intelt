<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CRF extends Model
{
    use HasFactory;

    public function student(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function course(){
        return $this->belongsTo(Course::class, 'course_id','id');
    }
    public function level(){
        return $this->belongsTo(Level::class, 'level_id','id');
    }
    public function session(){
        return $this->belongsTo(Session::class, 'session_id','id');
    }
}
