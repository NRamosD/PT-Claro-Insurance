<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Days extends Model
{
    use HasFactory;

    protected $table  = "days";
    public $timestamps = false;

    protected $fillable = [
        "day_name"
    ];

    public function schedule(){
        return $this->hasMany(Schedule::class, "id");
    }
    
}
