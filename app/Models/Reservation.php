<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservation';
    public $timestamps = false;
    protected $primaryKey = 'id';
}
