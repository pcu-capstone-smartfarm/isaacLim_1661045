<?php

namespace App\Http\Controllers;

use App\Models\Nongsaro_gardenlist;
use App\Models\Plant;
use App\Models\Serial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlantsController extends Controller
{
    public function plantRegisterPage(Request $request, $userID)
    {
        $apiPlantsList = Nongsaro_gardenlist::select('cntntsSj')->get();
        $arr = array();
        foreach ($apiPlantsList as $value) {
            array_push($arr, $value->cntntsSj);
        }
        $consonant = array('ㄱ', 'ㄴ', 'ㄷ', 'ㄹ', 'ㅁ', 'ㅂ', 'ㅅ', 'ㅇ', 'ㅈ', 'ㅊ', 'ㅋ', 'ㅌ', 'ㅍ', 'ㅎ');
        return view('components.NoArduinoHome', [
            'arrPlantName' => $arr,
            'consonant' => $consonant
        ]);
    }

    public function plantRegister(Request $request, $userID)
    {
        if($userID != auth()->user()->id){
            return back()->with('fail', '사용자 정보 불일치');
        }
        $request->merge(['userID'=> $userID])->validate([
            'userID' => 'required|numeric',
            'plantType'=>'required|string',
            'plantName' => 'required|string|max:255',
            'serialNO' => 'required|string|max:255',
        ]);
        $serial = Serial::where('code', $request->serialNO)->first();
        if($serial == null)
        {
            return back()->with('fail', '시리얼 번호 불일치');
        }
        $cntntsSj = Nongsaro_gardenlist::where('cntntsSj', $request->plantType)->first();
        if($cntntsSj == null)
        {
            return back()->with('fail', '식물 종류 불일치');
        }
        $plant = new Plant([
            'user_id' => $userID,
            'serial_id' => $serial->id,
            'plantname' => $request->plantName,
            'nongsaro_gardenlist_id' => $cntntsSj->id,
            'device_verification_at' => null
        ]);
        $plant->save();

        return redirect(route('userHome', ['userID'=>auth()->user()->id]))->with('success', '식물 등록 성공');
    }

    public function plantSearchPage()
    {
        $consonant  = array('ㄱ', 'ㄴ', 'ㄷ', 'ㄹ', 'ㅁ', 'ㅂ', 'ㅅ', 'ㅇ', 'ㅈ', 'ㅊ', 'ㅋ', 'ㅌ', 'ㅍ', 'ㅎ');
        return view('components.plant-dictionary', [
            'consonant'=>$consonant,
            'plantslist'=>DB::table('Nongsaro_gardenlists')->paginate(12),
        ]);
    }
}
