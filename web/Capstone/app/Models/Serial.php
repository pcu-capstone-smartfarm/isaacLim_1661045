<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serial extends Model
{
    use HasFactory;

    protected $fillable = ['code'];

    public function plant()
    {
        return $this->hasOne('App\Models\Plant');
    }
}
