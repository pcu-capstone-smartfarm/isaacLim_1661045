<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\Serial;
use Illuminate\Http\Request;

class PlantsController extends Controller
{
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
            return back()->with('serialfail', '시리얼 번호 불일치');
        }
        $plant = new Plant([
            'user_id' => $userID,
            'serial_id' => $serial->id,
            'plantname' => $request->plantName,
            'crops_code' => $request->cropsCode,
            'device_verification_at' => null
        ]);
        $plant->save();

        return redirect(route('userHome', ['userID'=>auth()->user()->id]))->with('success', '식물 등록 성공');
    }
}
