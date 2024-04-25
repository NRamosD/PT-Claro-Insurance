<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table  = "schedule";

    protected $fillable = [
        "name",
        "start_time",
        "end_time",
        "id_course",
        "id_day"
    ];

    public function courses(){
        return $this->belongsTo(Courses::class,"id_course");
    }

    public function days(){
        return $this->belongsTo(Days::class,"id_day");
    }


    
}
