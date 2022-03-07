<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    //회원가입 페이지 출력
    public function register()
    {
        return view('components.register');
    }

    //register 입력 내용으로 DB 저장
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'username'=>['required','min:3','max:255',Rule::unique('users', 'username')],
            'email'=>'required|email|max:255|unique:users,email',
            'password'=>'required|min:6|max:255'
        ]);
        $user = new User([
            'name'=>$request->input('name'),
            'username'=>$request->input('username'),
            'email'=>$request->input('email'),
            'password'=>$request->input('password')
        ]);
        $user->save();

        //회원가입 정보로 로그인
        auth()->login($user);

        return redirect(route('userHome', ['userID'=>auth()->user()->id]))->with('success', '회원가입 성공');
    }
}
