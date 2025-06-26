<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class signatories extends Model
{
    protected $fillable = [
        'fullname',
        'position',
        'role',
    ];
}
