<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceOption extends Model
{
    use HasFactory;
    protected $fillable = [
        'option',
        'description'
    ];
    public $timestamps = false;
}
