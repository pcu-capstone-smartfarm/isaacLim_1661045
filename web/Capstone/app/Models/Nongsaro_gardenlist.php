<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nongsaro_gardenlist extends Model
{
    use HasFactory;

    protected $fillable = ['cntntsNo', 'cntntsSj', 'rtnFileSeCode', 'rtnfileSn', 'rtnOriginlFileNm', 'rtnStreFileNm', 'rtnFileCours', 'rtnImageDc', 'rtnThumbFileNm', 'rtnImgSeCode'];

    public function plants()
    {
        return $this->hasMany('App\Models\Plant');
    }
}
