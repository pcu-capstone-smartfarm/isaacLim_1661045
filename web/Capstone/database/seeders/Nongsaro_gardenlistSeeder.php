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
        $json = json_decode($api->getPlantName());
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
    }
}
