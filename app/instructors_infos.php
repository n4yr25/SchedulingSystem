<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class instructors_infos extends Model
{
    protected $table = 'instructors_infos';

    protected $fillable = [
        'instructor_id',
        'college',
        'department',
        'gender',
        'barangay',
        'municipality',
        'province',
        'cell_no',
        'employee_type',
        'created_at',
        'updated_at'
    ];
}
