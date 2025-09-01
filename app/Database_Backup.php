<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Database_Backup extends Model
{
    protected $table = 'database_backup';
    protected $fillable = ['filename', 'path'];  
}
