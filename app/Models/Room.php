<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{

    protected $fillable = ['department_id', 'room_no', 'capacity', 'invigilator'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function department(){ return $this->belongsTo(Department::class); }
}
