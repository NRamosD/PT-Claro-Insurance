<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCourses extends Model
{
    use HasFactory;

    protected $table  = "student_courses";

    protected $fillable = [
        "description",
        "id_course",
        "id_student"
    ];

    public function courses(){
        return $this->belongsTo(Courses::class,"id_course");
    }

    public function student(){
        return $this->belongsTo(Student::class,"id_student");
    }
    

}
