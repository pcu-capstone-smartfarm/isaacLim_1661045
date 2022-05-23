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
        $userPlant = $users->plants()->first();
        if(!isset($arduinos)){
            if(!isset($userPlant)){
                return redirect()->route('plantRegisterPage', ['userID'=>auth()->user()->id]);
            }
            else{
                if($userPlant->device_verification_at == null){
                    return redirect()->route('arduinoRegisterPage', ['userID'=>auth()->user()->id]);
                }
                else
                    return redirect()->route('noSensorHome', ['userID'=>auth()->user()->id]);
            }
        }

        return view('components.homepage-arduino', [
            'arduinos'=>$arduinos
        ]);
    }

    public function arduinoRegistPage($userID)
    {
        $users = User::find($userID);
        if($users->plants()->first()->device_verification_at == null)
            return view('components.arduinoRegisterPage');
        else
            return redirect()->route('userHome', ['userID'=>auth()->user()->id]);
    }

    public function noSensorPage($userID)
    {
        $users = User::find($userID);
        if($users->arduinos()->first()==null)
            return view('components.noSensorPage');
        else
            return redirect()->route('userHome', ['userID'=>auth()->user()->id]);
    }
}
