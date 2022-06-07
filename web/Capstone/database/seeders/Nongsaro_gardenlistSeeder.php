<?php

namespace Database\Seeders;

use App\Http\Controllers\OpenApiController;
use App\Models\Nongsaro_gardenlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Nongsaro_gardenlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $api = new OpenApiController;
        $json = json_decode($api->getGardenList());
        foreach($json->item as $value){
            $nongsaro = new Nongsaro_gardenlist;
            $nongsaro->cntntsNo = $value->cntntsNo;
            $nongsaro->cntntsSj = $value->cntntsSj;
            $nongsaro->rtnFileSeCode = $value->rtnFileSeCode;
            $nongsaro->rtnFileSn = $value->rtnFileSn;
            $nongsaro->rtnOrginlFileNm = $value->rtnOrginlFileNm;
            $nongsaro->rtnStreFileNm = $value->rtnStreFileNm;
            $nongsaro->rtnFileCours = $value->rtnFileCours;
            $nongsaro->rtnImageDc = $value->rtnImageDc;
            $nongsaro->rtnThumbFileNm = $value->rtnThumbFileNm;
            $nongsaro->rtnImgSeCode = $value->rtnImgSeCode;
            $nongsaro->save();
        }
        $nongsaro = new Nongsaro_gardenlist;
        $nongsaro->cntntsNo = 21111;
        $nongsaro->cntntsSj = "애호박";
        $nongsaro->rtnFileSeCode = "Aehobak1|Aehobak2|Aehobak3|Aehobak4";
        $nongsaro->rtnFileSn = "1|2|3|4";
        $nongsaro->rtnOrginlFileNm = "Aehobak1.jpeg|Aehobak2.jpeg|Aehobak3.png|Aehobak4.jpeg";
        $nongsaro->rtnStreFileNm = "__";
        $nongsaro->rtnFileCours = "cms_contents/301";
        $nongsaro->rtnImageDc = "애호박|애호박|애호박|애호박";
        $nongsaro->rtnThumbFileNm = "Aehobak1.jpeg|Aehobak2.jpeg|Aehobak3.jpeg|Aehobak4.jpeg";
        $nongsaro->rtnImgSeCode = "0";
        $nongsaro->save();
    }
}
