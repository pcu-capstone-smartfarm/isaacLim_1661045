<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','filesize', 'path', 'filename', 'originalname', 'type', 's3_path'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
