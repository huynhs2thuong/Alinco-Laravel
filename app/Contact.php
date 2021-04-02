<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Contact extends Model
{
    protected $fillable = ['name', 'phone','title', 'message','created_at','updated_at'];

    public function getCreatedAtAttribute($date) {
        if (!empty($date)) return Carbon::parse($date)->format('d/m/Y');
        else return '';
    }
}
