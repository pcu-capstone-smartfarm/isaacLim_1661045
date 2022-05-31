<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nongsaro_gardendtl extends Model
{
    use HasFactory;

    protected $fillable = [
        'nongsaro_gardenlist_id',
        'plntbneNm',
        'plntzrNm',
        'distbNm',
        'fmlCodeNm',
        'orgplceInfo',
        'adviseInfo',
        'growthHgInfo',
        'growthAraInfo',
        'lefStleInfo',
        'prpgtEraInfo',
        'managelevelCodeNm',
        'grwtveCodeNm',
        'grwhTpCodeNm',
        'hdCodeNm',
        'frtlzrInfo',
        'soilInfo',
        'watercycleSprngCodeNm',
        'watercycleSummerCodeNm',
        'watercycleAutumnCodeNm',
        'watercycleWinterCodeNm',
        'fncltyInfo',
        'managedemanddoCodeNm',
        'clCodeNm',
        'grwhstleCodeNm',
        'indoorpsncpacompositionCodeNm',
        'eclgyCodeNm',
        'lefmrkCodeNm',
        'lefcolrCodeNm',
        'ignSeasonCodeNm',
        'flclrCodeNm',
        'fmldecolrCodeNm',
        'prpgtmthCodeNm',
        'lighttdemanddoCodeNm',
        'postngplaceCodeNm',
        'dlthtsCodeNm',
    ];

    public function gardenlist()
    {
        return $this->belongsTo('App\Models\Nongsaro_gardenlist', 'nongsaro_gardenlist_id');
    }
}
