<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'classroom_id',
        'note1',
        'note2',
        'note3',
        'note4',
        'average'
    ];
}
