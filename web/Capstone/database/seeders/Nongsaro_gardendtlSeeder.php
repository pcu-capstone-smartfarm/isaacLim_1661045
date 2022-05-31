<?php

namespace Database\Seeders;

use App\Http\Controllers\OpenApiController;
use App\Models\Nongsaro_gardendtl;
use Illuminate\Database\Seeder;

class Nongsaro_gardendtlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $api = new OpenApiController;
        $arr = $api->getGardenDtl();
        foreach($arr as $value){
            $nongsarodtl = new Nongsaro_gardendtl;
            $nongsarodtl->nongsaro_gardenlist_id = $this->strcheck($value->nongsaro_gardenlist_id);
            $nongsarodtl->plntbneNm = $this->strcheck($value->plntbneNm);
            $nongsarodtl->plntzrNm = $this->strcheck($value->plntzrNm);
            $nongsarodtl->distbNm = $this->strcheck($value->distbNm);
            $nongsarodtl->fmlCodeNm = $this->strcheck($value->fmlCodeNm);
            $nongsarodtl->orgplceInfo = $this->strcheck($value->orgplceInfo);
            $nongsarodtl->adviseInfo = $this->strcheck($value->adviseInfo);
            $nongsarodtl->growthHgInfo = $this->strcheck($value->growthHgInfo);
            $nongsarodtl->growthAraInfo = $this->strcheck($value->growthAraInfo);
            $nongsarodtl->lefStleInfo = $this->strcheck($value->lefStleInfo);
            $nongsarodtl->prpgtEraInfo = $this->strcheck($value->prpgtEraInfo);
            $nongsarodtl->managelevelCodeNm = $this->strcheck($value->managelevelCodeNm);
            $nongsarodtl->grwtveCodeNm = $this->strcheck($value->grwtveCodeNm);
            $nongsarodtl->grwhTpCodeNm = $this->strcheck($value->grwhTpCodeNm);
            $nongsarodtl->hdCodeNm = $this->strcheck($value->hdCodeNm);
            $nongsarodtl->frtlzrInfo = $this->strcheck($value->frtlzrInfo);
            $nongsarodtl->soilInfo = $this->strcheck($value->soilInfo);
            $nongsarodtl->watercycleSprngCodeNm = $this->strcheck($value->watercycleSprngCodeNm);
            $nongsarodtl->watercycleSummerCodeNm = $this->strcheck($value->watercycleSummerCodeNm);
            $nongsarodtl->watercycleAutumnCodeNm = $this->strcheck($value->watercycleAutumnCodeNm);
            $nongsarodtl->watercycleWinterCodeNm = $this->strcheck($value->watercycleWinterCodeNm);
            $nongsarodtl->fncltyInfo = $this->strcheck($value->fncltyInfo);
            $nongsarodtl->managedemanddoCodeNm = $this->strcheck($value->managedemanddoCodeNm);
            $nongsarodtl->clCodeNm = $this->strcheck($value->clCodeNm);
            $nongsarodtl->grwhstleCodeNm = $this->strcheck($value->grwhstleCodeNm);
            $nongsarodtl->indoorpsncpacompositionCodeNm = $this->strcheck($value->indoorpsncpacompositionCodeNm);
            $nongsarodtl->eclgyCodeNm = $this->strcheck($value->eclgyCodeNm);
            $nongsarodtl->lefmrkCodeNm = $this->strcheck($value->lefmrkCodeNm);
            $nongsarodtl->lefcolrCodeNm = $this->strcheck($value->lefcolrCodeNm);
            $nongsarodtl->ignSeasonCodeNm = $this->strcheck($value->ignSeasonCodeNm);
            $nongsarodtl->flclrCodeNm = $this->strcheck($value->flclrCodeNm);
            $nongsarodtl->fmldecolrCodeNm = $this->strcheck($value->fmldecolrCodeNm);
            $nongsarodtl->prpgtmthCodeNm = $this->strcheck($value->prpgtmthCodeNm);
            $nongsarodtl->lighttdemanddoCodeNm = $this->strcheck($value->lighttdemanddoCodeNm);
            $nongsarodtl->postngplaceCodeNm = $this->strcheck($value->postngplaceCodeNm);
            $nongsarodtl->dlthtsCodeNm = $this->strcheck($value->dlthtsCodeNm);
            $nongsarodtl->save();
        }
    }
    protected function strcheck($value){
        return is_string($value)? $value : '';
    }
}
