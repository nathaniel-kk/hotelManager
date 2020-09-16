<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeRecord extends Model
{
    protected $table = 'time_record';
    public $timestamps = false;
    protected $primaryKey = 'time_id';
}
