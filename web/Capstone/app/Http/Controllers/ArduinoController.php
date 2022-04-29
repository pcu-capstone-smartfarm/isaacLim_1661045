<?php

namespace App\Http\Controllers;

use App\Models\Arduino;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\http\Controllers\Controller;
use App\Models\Serial;
use Tymon\JWTAuth\Facades\JWTAuth;

class ArduinoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'serialRegist']]);
    }

    /**
     * @OA\Post(
     *      path="/api/arduino/login",
     *      tags={"로그인"},
     *      summary="로그인",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="email",
     *                  type="string",
     *                  format="email",
     *                  description="(필수)사용자 이메일",
     *                  example="test1234@test.com"
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  type="string",
     *                  format="password",
     *                  description="(필수)사용자 비밀번호",
     *                  example="test1234"
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="성공",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="access_token",
     *                  type="string",
     *                  description="JWT 토큰"
     *              ),
     *              @OA\Property(
     *                  property="token_type",
     *                  type="string",
     *                  description="토큰 유형"
     *              ),
     *              @OA\Property(
     *                  property="expired_in",
     *                  type="string",
     *                  description="토큰 만료시간"
     *              ),
     *              example={
     *                  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJFUzI1NiJ9.eyJpc3MiOiJvZmZpY2V3YXZlLWFwaSIsInN1YiI6IkF1dGhvcml6YXRpb24iLCJhdWQiOiJ3aW5kb3dzIiwiaWF0IjoxNjQxMzYzNzgwLCJleHAiOjE2NDEzNzA5ODAsInNjb3BlcyI6WyJST0xFX01FTUJFUiJdLCJjb21wYW55X2lkIjoxLCJ1c2VyX2lkIjoxLCJhZ2VudF9pZCI6IjYxZDQwNjY0YzNjYzVhNDgyYjY3ZjgxMyIsImVtYWlsIjoiamp1bmlAamlyYW4uY29tIiwibmFtZSI6bnVsbCwibWFuYWdlciI6bnVsbH0.ppdnrZylYPjSpd0Fq8YjNmpCWxtyvvpfq9Sab0ydioX2vfmf8FFxSfmyQ9tVSJfWbHS9VrrUBh-dUNo57jo3Xg",
     *                  "token_type": "bearer",
     *                  "expired_in": 3600
     *              }
     *          )
     *      ),
     *      @OA\Response(
     *          response="403",
     *          description="이메일 or 비밀번호 불일치",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="에러 메시지",
     *                  example={
     *                      "message" : "fail"
     *                  }
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="422",
     *          description="비밀번호 누락",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="에러 메시지",
     *                  example={
     *                      "message" : "The password field is required.",
     *                      "errors" : {
     *                          "password" : [
     *                              "The password field is required."
     *                          ]
     *                      }
     *                  }
     *              )
     *          )
     *      )
     * )
     */

    public function login(Request $request){
        $request->validate([
            'email'=>'required|email|max:255',
            'password'=>'required|max:255'
        ]);     //validate 실패 시 422
        $credentials = request(['email', 'password']);
        if (! $token = JWTAuth::attempt($credentials)) {
            return abort(403, 'fail');
        }
        return $this->respondWithToken($token);
    }

    /**
     * @OA\Post(
     *      path="/api/User/4/arduino/input",
     *      tags={"아두이노 센서"},
     *      summary="아두이노 센서값 저장",
     *      @OA\Parameter{
     *          name="user_id",
     *          in="path",
     *          description="(필수)사용자 번호"
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      }
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="token",
     *                  type="string",
     *                  description="(필수)JWT 토큰",
     *                  example="eyJ0eXAiOiJK..."
     *              ),
     *              @OA\Property(
     *                  property="plantID",
     *                  type="numeric",
     *                  description="(필수)식물 ID",
     *                  example="2"
     *              ),
     *              @OA\Property(
     *                  property="humidity",
     *                  type="numeric",
     *                  description="습도 센서값"
     *                  example="11"
     *              ),
     *              @OA\Property(
     *                  property="temp",
     *                  type="numeric",
     *                  description="온도 센서값"
     *                  example="11"
     *              ),
     *              @OA\Property(
     *                  property="humidity_soil",
     *                  type="numeric",
     *                  description="토양습도 센서값"
     *                  example="11"
     *              ),
     *              @OA\Property(
     *                  property="illuminance",
     *                  type="numeric",
     *                  description="조도 센서값"
     *                  example="11"
     *              ),
     *
     *          )
     *      ),
     *      @OA\Response(
     *          response="201",
     *          description="성공",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="success",
     *                  type="string",
     *                  description="성공 메세지"
     *              ),
     *              @OA\Property(
     *                  property="arduino_id",
     *                  type="numeric",
     *                  description="저장된 아두이노 아이디"
     *              ),
     *              example={
     *                  "success": "아두이노 송신값 저장 완료",
     *                  "arduino_id": 22
     *              }
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="사용자 정보 불일치",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="fail",
     *                  type="string",
     *                  description="에러 메시지",
     *                  example={
     *                      "fail" : "사용자 정보 불일치"
     *                  }
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="비로그인(Guest로 접근 시)",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="에러 메시지",
     *                  example={
     *                      "message" : "Unauthenticated"
     *                  }
     *              )
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response="422",
     *          description="타입 에러",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="에러 메시지",
     *                  example={
     *                      "message" : "The humidity must be a number.",
     *                      "errors" : {
     *                          "password" : [
     *                              "The humidity must be a number."
     *                          ]
     *                      }
     *                  }
     *              )
     *          )
     *      )
     * )
     */

    public function sensorInput(Request $request, $userID){
        if ($userID != auth()->user()->id) {
            return response()->json(['fail' => '사용자 정보 불일치'], 401);
        }
        $request->merge(['userID'=>$userID])->validate([
            'userID' => 'required|numeric',
            'plantID' => 'required|numeric',
            'token' => 'required|string',
            'humidity' => 'numeric',
            'temp' => 'numeric',
            'humidity_soil' => 'numeric',
            'illuminance' => 'numeric'
        ]);

        $arduino = new Arduino([
            'user_id' => $userID,
            'plant_id' => $request->plantID,
            'humidity' => $request->humidity,
            'temp' => $request->temp,
            'humidity_soil' => $request->humidity_soil,
            'illuminance' => $request->illuminance
        ]);
        $arduino->save();

        return response()->json(['success' => '아두이노 송신값 저장 완료', 'arduino_id' => $arduino->id], 201);
    }


    /**
     * @OA\Post(
     *      path="/api/User/{user_id}/arduino/refresh",
     *      tags={"토큰 재발급"},
     *      summary="토큰 재발급",
     *      security={
     *          {"auth":{}}
     *      }
     *      @OA\Parameter{
     *          name="user_id",
     *          in="path",
     *          description="(필수)사용자 번호"
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      }
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="token",
     *                  type="string",
     *                  description="(필수)재발급용 토큰",
     *                  example="eyJ0eXAiOiJKV1QiLCJhbGciOi..."
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="성공",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="access_token",
     *                  type="string",
     *                  description="JWT 토큰"
     *              ),
     *              @OA\Property(
     *                  property="token_type",
     *                  type="string",
     *                  description="토큰 유형"
     *              ),
     *              @OA\Property(
     *                  property="expired_in",
     *                  type="string",
     *                  description="토큰 만료시간"
     *              ),
     *              example={
     *                  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJFUzI1NiJ9.eyJpc3MiOiJvZmZpY2V3YXZlLWFwaSIsInN1YiI6IkF1dGhvcml6YXRpb24iLCJhdWQiOiJ3aW5kb3dzIiwiaWF0IjoxNjQxMzYzNzgwLCJleHAiOjE2NDEzNzA5ODAsInNjb3BlcyI6WyJST0xFX01FTUJFUiJdLCJjb21wYW55X2lkIjoxLCJ1c2VyX2lkIjoxLCJhZ2VudF9pZCI6IjYxZDQwNjY0YzNjYzVhNDgyYjY3ZjgxMyIsImVtYWlsIjoiamp1bmlAamlyYW4uY29tIiwibmFtZSI6bnVsbCwibWFuYWdlciI6bnVsbH0.ppdnrZylYPjSpd0Fq8YjNmpCWxtyvvpfq9Sab0ydioX2vfmf8FFxSfmyQ9tVSJfWbHS9VrrUBh-dUNo57jo3Xg",
     *                  "token_type": "bearer",
     *                  "expired_in": 3600
     *              }
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="형식 불일치(토큰 값)",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="에러 메시지",
     *                  example={
     *                      "message" : "Unauthenticated"
     *                  }
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="사용자 정보 불일치",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="에러 메시지",
     *                  example={
     *                      "message" : "사용자 정보 불일치"
     *                  }
     *              )
     *          )
     *      )
     * )
     */

    public function refresh($userID)
    {
        if($userID != auth()->user()->id){
            return response()->json(['fail'=> '사용자 정보 불일치'], 401);
        }
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * @OA\Post(
     *      path="/api/User/{user_id}/arduino/logout",
     *      tags={"로그아웃"},
     *      summary="로그아웃",
     *      security={
     *          {"auth":{}}
     *      }
     *      @OA\Parameter{
     *          name="user_id",
     *          in="path",
     *          description="(필수)사용자 번호"
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      }
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="token",
     *                  type="string",
     *                  description="(필수)JWT 토큰",
     *                  example="eyJ0eXAiOiJKV1QiLCJhbGciOi..."
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="성공",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="메시지"
     *              ),
     *              example={
     *                  "success" : "로그아웃 완료"
     *              }
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="형식 불일치(토큰 값)",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="에러 메시지",
     *                  example={
     *                      "message" : "Unauthenticated"
     *                  }
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response="401",
     *          description="사용자 정보 불일치",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  description="에러 메시지",
     *                  example={
     *                      "message" : "사용자 정보 불일치"
     *                  }
     *              )
     *          )
     *      )
     * )
     */

    public function arduinoLogout($userID)
    {
        if($userID != auth()->user()->id){
            return response()->json(['fail'=> '사용자 정보 불일치'], 401);
        }
        auth()->logout();
        return response()->json(['success' => '로그아웃 완료'], 200);
    }

    public function serialRegist(Request $request)
    {
        $request->validate([
            'serial_no' => 'required|string|max:100'
        ]);
        $serial = Serial::with('plant')->where('code', $request->serial_no)->first();
        $plant = $serial->plant;

        //해당 serial 번호가 존재하지 않거나 지정된 plant 없을 때
        if($serial == null || $plant == null){
            return response()->json(['fail' => 'serial_no 불일치 or 사용자 등록 미실시'], 403);
        }

        //이미 인증된 기기에 접속 시도
        if($plant->device_verification_at != null){
            return response()->json(['fail' => '기기 중복'], 403);
        }
        $plant->device_verification_at = now();
        $plant->save();
        return response()->json(['success'=>'등록 완료', 'userID'=>$plant->user_id], 201);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
