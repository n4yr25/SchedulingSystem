<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstructorStatus extends Model
{
    protected $table = 'instructor_status';
    protected $fillable = ['instructor_id', 'status'];
}
