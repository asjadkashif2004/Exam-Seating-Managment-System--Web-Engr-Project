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

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /* -------------------------------------------
        AUTO GENERATE ROWS BASED ON CAPACITY
    --------------------------------------------*/
    public function getRowsAttribute()
    {
        $cap = $this->capacity;
        return max(1, floor(sqrt($cap)));   // square-like layout
    }

    /* -------------------------------------------
        AUTO GENERATE COLS BASED ON CAPACITY
    --------------------------------------------*/
    public function getColsAttribute()
    {
        $rows = $this->rows;
        return max(1, ceil($this->capacity / $rows));
    }
}
