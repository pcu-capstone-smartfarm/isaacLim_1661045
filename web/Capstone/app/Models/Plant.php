<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'serial_id', 'plantname', 'crops_code', 'device_verification_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function arduinos()
    {
        return $this->hasMany('App\Models\Arduino');
    }

    public function serial()
    {
        return $this->belongsTo('App\Models\Serial');
    }
}