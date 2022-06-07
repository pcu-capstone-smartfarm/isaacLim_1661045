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
        $nongsarodtl = new Nongsaro_gardendtl;
        $nongsarodtl->nongsaro_gardenlist_id = 218;
        $nongsarodtl->plntbneNm = "Cucucrbita moschata";
        $nongsarodtl->plntzrNm = "aehobak, Korean zucchini";
        $nongsarodtl->distbNm = "애호박";
        $nongsarodtl->fmlCodeNm = "호박과";
        $nongsarodtl->orgplceInfo = "한국";
        $nongsarodtl->adviseInfo = "애호박은 한식에서 사용하는 덜 여문 어린 호박을 일컫는다.";
        $nongsarodtl->growthHgInfo = "30";
        $nongsarodtl->growthAraInfo = "30";
        $nongsarodtl->lefStleInfo = "";
        $nongsarodtl->prpgtEraInfo = "여름";
        $nongsarodtl->managelevelCodeNm = "초보자";
        $nongsarodtl->grwtveCodeNm = "보통";
        $nongsarodtl->grwhTpCodeNm = "16~23℃";
        $nongsarodtl->hdCodeNm = "40 ~ 70%";
        $nongsarodtl->frtlzrInfo = "비료를 보통 요구함";
        $nongsarodtl->soilInfo = "";
        $nongsarodtl->watercycleSprngCodeNm = "토양 표면이 말랐을때 충분히 관수함";
        $nongsarodtl->watercycleSummerCodeNm = "흙을 촉촉하게 유지함(물에 잠기지 않을 정도)";
        $nongsarodtl->watercycleAutumnCodeNm = "흙을 촉촉하게 유지함(물에 잠기지 않을 정도)";
        $nongsarodtl->watercycleWinterCodeNm = "토양 표면이 말랐을때 충분히 관수함";
        $nongsarodtl->fncltyInfo = "작물생육용 액비 등 농자재 구입 시 보증 성분함량을 확인하여 부족한 양분을 토양에 충분히 공급하고, 특정 양분들의 과다 투입을 자제하고 올바른 토양의 양·수분 관리가 될 수 있도록 다양한 농업정보들을 활용할 것";
        $nongsarodtl->managedemanddoCodeNm = "낮음 (잘 견딤)";
        $nongsarodtl->clCodeNm = "덩굴식물";
        $nongsarodtl->grwhstleCodeNm = "덩굴성";
        $nongsarodtl->indoorpsncpacompositionCodeNm = "하층목,지피식물";
        $nongsarodtl->eclgyCodeNm = "일반형";
        $nongsarodtl->lefmrkCodeNm = "줄무늬";
        $nongsarodtl->lefcolrCodeNm = "녹색, 연두색,흰색";
        $nongsarodtl->ignSeasonCodeNm = "여름,가을";
        $nongsarodtl->flclrCodeNm = "노랑색";
        $nongsarodtl->fmldecolrCodeNm = "기타";
        $nongsarodtl->prpgtmthCodeNm = "파종,삽목";
        $nongsarodtl->lighttdemanddoCodeNm = "낮은 광도(300~800 Lux),중간 광도(800~1,500 Lux)";
        $nongsarodtl->postngplaceCodeNm = "거실 내측 (실내깊이 300~500cm),거실 창측 (실내깊이 150~300cm),발코니 내측 (실내깊이 50~150cm)";
        $nongsarodtl->dlthtsCodeNm = "응애,깍지벌레,온실가루이";
        $nongsarodtl->save();
    }
    protected function strcheck($value){
        return is_string($value)? $value : '';
    }
}
