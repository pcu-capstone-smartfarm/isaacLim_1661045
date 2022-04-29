<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arduino extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'plant_id', 'humidity', 'temp', 'humidity_soil', 'illuminance'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function plant()
    {
        return $this->belongsTo('App\Models\Plant');
    }
}
