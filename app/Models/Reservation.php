<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservation';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $guarded = [];

    public static function Add($id,$date){


        $rs = Reservation::create([
            'cust_id'=>$id,
            'arrival_time'=>$date
        ]);
        return $rs;
    }

    public static function deletetime($id){
        $rs = Reservation::where('cust_id',$id)
            ->delete();
        return $rs;
    }
}
