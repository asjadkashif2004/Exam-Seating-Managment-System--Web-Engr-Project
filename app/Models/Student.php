<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'cmd_id',
        'department_id',
        'semester',
        'room_id',
        'invigilator_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function invigilator()
    {
        return $this->belongsTo(User::class, 'invigilator_id');
    }
}
