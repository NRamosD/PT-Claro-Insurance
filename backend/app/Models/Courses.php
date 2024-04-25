<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;

    protected $table  = "courses";

    protected $fillable = [
        "name",
        "id_schedule",
        "start_date",
        "end_date",
        "type"
    ];

    public function schedule(){
        return $this->hasMany(Schedule::class, "id");
    }
    
}
