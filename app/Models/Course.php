<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    
    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function department(){
        return $this->belongsTo(Department::class, 'department_id','id');
    }
    public function course(){
        return $this->belongsTo(Course::class, 'course_id','id');
    }
    public function combination(){
        return $this->belongsTo(Combination::class, 'department_id','id');
    }
}
