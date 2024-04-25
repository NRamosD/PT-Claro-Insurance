<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Days extends Model
{
    use HasFactory;

    protected $table  = "days";

    protected $fillable = [
        "day_name"
    ];

    public function schedule(){
        return $this->hasMany(Schedule::class, "id");
    }
    
}
