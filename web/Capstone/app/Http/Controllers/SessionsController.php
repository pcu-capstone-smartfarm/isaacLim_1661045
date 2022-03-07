<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class SessionsController extends Controller
{
    //로그인 페이지 출력
    public function login(Request $request)
    {
        return view('components.login');
    }

    //login 입력 내용으로 DB 비교하여 검증
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|max:255'
        ]);

        if (! auth()->attempt($request->only(['email', 'password']))) {
            throw ValidationException::withMessages([
                'email' => '사용자 정보가 올바르지 않습니다.'
            ]);
        }
        // session()->regenerate();
        return redirect()->route('userHome', ['userID'=>auth()->user()->id])->with('success', '로그인 성공!');
    }

    //페이지 정보로 로그아웃
    public function logout(Request $request, $userID)
    {
        if ($userID != auth()->user()->id) {
            return back()->with('fail', '사용자 정보 불일치');
        }
        $request->merge(['userID'=>$userID])->validate([
            'userID' => 'required|numeric'
        ]);
        auth()->logout();

        return redirect()->route('home')->with('success', '로그아웃 완료');
    }

    public function edit(Request $request, $userID)
    {
        if ($userID != auth()->user()->id) {
            return back()->with('fail', '사용자 정보 불일치');
        }
        $request->merge(['userID'=>$userID])->validate([
            'userID' => 'required|numeric'
        ]);

        return view('components.userEdit', [
            'user' => User::find($userID)
        ]);
    }

    public function update(Request $request, $userID)
    {
        if ($userID != auth()->user()->id) {
            return back()->with('fail', '사용자 정보 불일치');
        }
        $request->merge(['userID'=>$userID])->validate([
            'userID' => 'required|numeric',
            'name' => 'string|max:255',
            'username' => 'string|max:255',
            'password' => 'required|max:255'
        ]);
        $user = User::find($userID);

        if ($request->has('name')) {
            $user->name = $request->input('name');
        }
        if ($request->has('username')) {
            $user->username = $request->input('username');
        }
        if ($request->has('password')) {
            $user->password = $request->input('password');
        }
        $user->save();

        if (Str::contains(url()->previous(), 'userEdit')) {
            return redirect()->route('userHome', ['userID'=>$userID])->with('success', '유저 정보 변경');
        }
        return back()->with('success', '유저 정보 변경');
    }

    public function userDeleteNotice(Request $request, $userID)
    {
        return view('components.userDeleteNotice', ['user'=> User::find($userID)]);
    }
}
