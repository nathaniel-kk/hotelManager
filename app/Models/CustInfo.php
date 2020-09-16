<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustInfo extends Model
{
    protected $table = 'cust_info';
    public $timestamps = false;
    protected $primaryKey = 'cust_id';

}
