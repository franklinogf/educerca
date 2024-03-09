<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Parents extends Authenticatable
{
    use HasFactory;
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'dob' => 'date:Y-m-d',
        'password' => 'hashed',
    ];
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'gender',
        'phone',
        'dob'
    ];

    protected $table = 'parents';
    public function getFullNameAttribute(): string
    {
        return "$this->name $this->last_name";
    }
    public function children()
    {
        return $this->hasMany(Student::class, 'parents_id');
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
