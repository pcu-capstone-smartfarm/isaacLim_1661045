<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\User;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function humidityReports(Request $request, $userID)
    {
        if ($userID != auth()->user()->id) {
            return back()->with('fail', '사용자 정보 불일치');
        }

        $request->merge(['userID'=>$userID])->validate([
            'userID' => 'required|numeric',
            'start_day' => 'nullable|date'
        ]);

        //파란색 그래프 선
        $colorArray = [000, 204, 255, 1];

        if($request->start_day == null)
            $arduinodatas = User::find($userID)->arduinos()->select('created_at', 'humidity')->latest()->take(10)->get();
        else{
            $arduinodatas = User::find($userID)->arduinos()->select('created_at', 'humidity')->whereDate('created_at', date('Y-m-d', strtotime($request->start_day)))->get();
        }
        if($arduinodatas->first() == null){
            return back()->withErrors('해당되는 데이터가 없습니다.');
        }

        // db호출 1번만
        return view('components.reports', [
            'userID'=>$userID,
            'label'=>'습도 (%)',
            'sensortype'=>'humidity',
            'graphcolor'=>$colorArray,
            'arduinodatas'=>$arduinodatas
        ]);
    }

    public function tempReports(Request $request, $userID)
    {
        if ($userID != auth()->user()->id) {
            return back()->with('fail', '사용자 정보 불일치');
        }

        $request->merge(['userID'=>$userID])->validate([
            'userID' => 'required|numeric',
            'start_day' => 'nullable|date'
        ]);

        //빨간색 그래프 선
        $colorArray = [255, 000, 051, 1];

        if($request->start_day == null)
            $arduinodatas = User::find($userID)->arduinos()->select('created_at', 'temp')->latest()->take(10)->get();
        else{
            $arduinodatas = User::find($userID)->arduinos()->select('created_at', 'temp')->whereDate('created_at', date('Y-m-d', strtotime($request->start_day)))->get();
        }
        if($arduinodatas->first() == null){
            return back()->withErrors('해당되는 데이터가 없습니다.');
        }

        return view('components.reports', [
            'userID'=>$userID,
            'label'=>'온도 (°C)',
            'sensortype'=>'temp',
            'graphcolor'=>$colorArray,
            'arduinodatas'=>$arduinodatas
        ]);
    }

    public function humiditySoilReports(Request $request, $userID)
    {
        if ($userID != auth()->user()->id) {
            return back()->with('fail', '사용자 정보 불일치');
        }

        $request->merge(['userID'=>$userID])->validate([
            'userID' => 'required|numeric',
            'start_day' => 'nullable|date'
        ]);

        //갈색 그래프 선
        $colorArray = [153, 051, 000, 1];

        if($request->start_day == null)
            $arduinodatas = User::find($userID)->arduinos()->select('created_at', 'humidity_soil')->latest()->take(10)->get();
        else{
            $arduinodatas = User::find($userID)->arduinos()->select('created_at', 'humidity_soil')->whereDate('created_at', date('Y-m-d', strtotime($request->start_day)))->get();
        }
        if($arduinodatas->first() == null){
            return back()->withErrors('해당되는 데이터가 없습니다.');
        }

        return view('components.reports', [
            'userID'=>$userID,
            'label'=>'토양 습도 (%)',
            'sensortype'=>'humidity_soil',
            'graphcolor'=>$colorArray,
            'arduinodatas'=>$arduinodatas
        ]);
    }

    public function illuminanceReports(Request $request, $userID)
    {
        if ($userID != auth()->user()->id) {
            return back()->with('fail', '사용자 정보 불일치');
        }

        $request->merge(['userID'=>$userID])->validate([
            'userID' => 'required|numeric',
            'start_day' => 'nullable|date'
        ]);

        //갈색 그래프 선
        $colorArray = [255, 153, 051, 1];

        if($request->start_day == null)
            $arduinodatas = User::find($userID)->arduinos()->select('created_at', 'illuminance')->latest()->take(10)->get();
        else{
            $arduinodatas = User::find($userID)->arduinos()->select('created_at', 'illuminance')->whereDate('created_at', date('Y-m-d', strtotime($request->start_day)))->get();
        }
        if($arduinodatas->first() == null){
            return back()->withErrors('해당되는 데이터가 없습니다.');
        }

        return view('components.reports', [
            'userID'=>$userID,
            'label'=>'조도 (Ev)',
            'sensortype'=>'illuminance',
            'graphcolor'=>$colorArray,
            'arduinodatas'=>$arduinodatas
        ]);
    }
}
