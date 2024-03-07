<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'gender',
        'phone',
        'dob'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'dob' => 'date:Y-m-d',
        'password' => 'hashed',
    ];

    public function getFullNameAttribute(): string
    {
        return "$this->name $this->last_name";
    }

    public function grade()
    {
        return $this->hasOne(Grade::class);
    }

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    public function students()
    {
        return $this->hasManyThrough(Student::class, Grade::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
