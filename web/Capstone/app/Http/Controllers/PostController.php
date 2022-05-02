<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\Serial;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //홈페이지 로그인 여부에 따라 다르게 출력
    //비로그인 페이지
    public function index()
    {
        //이미 로그인된 상태에서 접속 시도 시 로그인 페이지로 이동
        if (auth()->check()) {
            return redirect()->route('userHome', ['userID'=>auth()->user()->id]);
        }
        //게스트 페이지 출력
        return view('components.homePage');
    }

    //로그인 페이지 출력
    public function userIndex(Request $request, $userID)
    {
        if ($userID != auth()->user()->id) {
            return back()->with('fail', '사용자 정보 불일치');
        }
        $request->merge(['userID'=> $userID])->validate([
            'userID' => 'required|numeric'
        ]);
        $users = User::find($userID);
        $arduinos = $users->arduinos()->latest()->take(1)->first();

        return view('components.homepage-arduino', [
            'arduinos'=>$arduinos
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
