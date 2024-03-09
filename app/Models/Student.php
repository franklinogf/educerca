<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'dob' => 'date:Y-m-d',
        'password' => 'hashed',
        'is_enrolled' => 'boolean'
    ];
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'gender',
        'phone',
        'dob',
        'is_enrolled'
    ];

    public function getFullNameAttribute(): string
    {
        return "$this->name $this->last_name";
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    public function parent()
    {
        return $this->belongsTo(Parents::class, 'parents_id');
    }
    public function scopeNotEnrolled($query)
    {
        return $query->where('is_enrolled', false);
    }
}
