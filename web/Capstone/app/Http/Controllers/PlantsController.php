<?php

namespace App\Http\Controllers;

use App\Models\Nongsaro_gardendtl;
use App\Models\Nongsaro_gardenlist;
use App\Models\Plant;
use App\Models\Serial;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

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

    public function plantSearchPage(Request $request, $userID)
    {
        $request->merge(['userID'=>$userID])->validate([
            'userID' => 'required|numeric',
            'plantType'=>'nullable|string|max:255',
            'consonant'=>'nullable|string|max:2',
            'lux_low'=>'sometimes|accepted',
            'lux_middle'=>'sometimes|accepted',
            'lux_high'=>'sometimes|accepted',
            'leaf_green'=>'sometimes|accepted',
            'leaf_yellow'=>'sometimes|accepted',
            'leaf_white'=>'sometimes|accepted',
            'leaf_gray'=>'sometimes|accepted',
            'leaf_red'=>'sometimes|accepted',
            'leaf_mix'=>'sometimes|accepted',
            'leaf_etc'=>'sometimes|accepted',
            'leafpattern_stripe'=>'sometimes|accepted',
            'leafpattern_point'=>'sometimes|accepted',
            'leafpattern_side'=>'sometimes|accepted',
            'leafpattern_etc'=>'sometimes|accepted',
            'flower_blue'=>'sometimes|accepted',
            'flower_pupple'=>'sometimes|accepted',
            'flower_pink'=>'sometimes|accepted',
            'flower_red'=>'sometimes|accepted',
            'flower_orange'=>'sometimes|accepted',
            'flower_white'=>'sometimes|accepted',
            'flower_mix'=>'sometimes|accepted',
            'flower_etc'=>'sometimes|accepted',
            'fruit_blue'=>'sometimes|accepted',
            'fruit_pupple'=>'sometimes|accepted',
            'fruit_pink'=>'sometimes|accepted',
            'fruit_red'=>'sometimes|accepted',
            'fruit_orange'=>'sometimes|accepted',
            'fruit_white'=>'sometimes|accepted',
            'fruit_mix'=>'sometimes|accepted',
            'fruit_etc'=>'sometimes|accepted',
            'flower_spring'=>'sometimes|accepted',
            'flower_summer'=>'sometimes|accepted',
            'flower_autumn'=>'sometimes|accepted',
            'flower_winter'=>'sometimes|accepted',
        ]);
        $consonant  = array('ㄱ', 'ㄴ', 'ㄷ', 'ㄹ', 'ㅁ', 'ㅂ', 'ㅅ', 'ㅇ', 'ㅈ', 'ㅊ', 'ㅋ', 'ㅌ', 'ㅍ', 'ㅎ');

        if($request->query()==null){
            $query = Nongsaro_gardenlist::paginate(12);
            return view('components.plant-dictionary', [
                'consonant' => $consonant,
                'plantslist' => $query,
            ]);
        }
        if($request->has('consonant') && !is_null($request->consonant)){
            if($request->consonant == 'ㄱ'){
                $query = Nongsaro_gardenlist::where('cntntsSj', '>=', '가')->where('cntntsSj', '<', '나');
            }
            elseif($request->consonant == 'ㄴ'){
                $query = Nongsaro_gardenlist::where('cntntsSj', '>=', '나')->where('cntntsSj', '<', '다');
            }
            elseif($request->consonant == 'ㄷ'){
                $query = Nongsaro_gardenlist::where('cntntsSj', '>=', '다')->where('cntntsSj', '<', '라');
            }
            elseif($request->consonant == 'ㄹ'){
                $query = Nongsaro_gardenlist::where('cntntsSj', '>=', '라')->where('cntntsSj', '<', '마');
            }
            elseif($request->consonant == 'ㅁ'){
                $query = Nongsaro_gardenlist::where('cntntsSj', '>=', '마')->where('cntntsSj', '<', '바');
            }
            elseif($request->consonant == 'ㅂ'){
                $query = Nongsaro_gardenlist::where('cntntsSj', '>=', '바')->where('cntntsSj', '<', '사');
            }
            elseif($request->consonant == 'ㅅ'){
                $query = Nongsaro_gardenlist::where('cntntsSj', '>=', '사')->where('cntntsSj', '<', '아');
            }
            elseif($request->consonant == 'ㅇ'){
                $query = Nongsaro_gardenlist::where('cntntsSj', '>=', '아')->where('cntntsSj', '<', '자');
            }
            elseif($request->consonant == 'ㅈ'){
                $query = Nongsaro_gardenlist::where('cntntsSj', '>=', '자')->where('cntntsSj', '<', '차');
            }
            elseif($request->consonant == 'ㅊ'){
                $query = Nongsaro_gardenlist::where('cntntsSj', '>=', '차')->where('cntntsSj', '<', '카');
            }
            elseif($request->consonant == 'ㅋ'){
                $query = Nongsaro_gardenlist::where('cntntsSj', '>=', '카')->where('cntntsSj', '<', '타');
            }
            elseif($request->consonant == 'ㅌ'){
                $query = Nongsaro_gardenlist::where('cntntsSj', '>=', '타')->where('cntntsSj', '<', '파');
            }
            elseif($request->consonant == 'ㅍ'){
                $query = Nongsaro_gardenlist::where('cntntsSj', '>=', '파')->where('cntntsSj', '<', '하');
            }
            elseif($request->consonant == 'ㅎ'){
                $query = Nongsaro_gardenlist::where('cntntsSj', '>=', '하');
            }
            $page = (Array)$request->query();
            if($request->has('page')){
                unset($page['page']);
            }
            return view('components.plant-dictionary', [
                'consonant' => $consonant,
                'plantslist' => $query->paginate(12)->withPath(route('plantDict', $page)),
            ]);
        }

        $query = Nongsaro_gardendtl::where('nongsaro_gardenlist_id', '<', '0');

        if($request->has('lux_low')){
            $query = $query->orWhere('lighttdemanddoCodeNm', 'like', '%낮은 광도(300~800 Lux)%');
        }
        if($request->has('lux_middle')){
            $query = $query->orWhere('lighttdemanddoCodeNm', 'like', '%중간 광도(800~1,500 Lux)%');
        }
        if($request->has('lux_high')){
            $query = $query->orWhere('lighttdemanddoCodeNm', 'like', '%높은 광도(1,500~10,000 Lux)%');
        }
        if($request->has('leaf_green')){
            $query = $query->orWhere('lefcolrCodeNm', 'like', '%녹색%');
            $query = $query->orWhere('lefcolrCodeNm', 'like', '%연두색%');
        }
        if($request->has('leaf_yellow')){
            $query = $query->orWhere('lefcolrCodeNm', 'like', '%금색%');
            $query = $query->orWhere('lefcolrCodeNm', 'like', '%노란색%');
        }
        if($request->has('leaf_white')){
            $query = $query->orWhere('lefcolrCodeNm', 'like', '%흰색%');
            $query = $query->orWhere('lefcolrCodeNm', 'like', '%크림색%');
        }
        if($request->has('leaf_gray')){
            $query = $query->orWhere('lefcolrCodeNm', 'like', '%은색%');
            $query = $query->orWhere('lefcolrCodeNm', 'like', '%회색%');
        }
        if($request->has('leaf_red')){
            $query = $query->orWhere('lefcolrCodeNm', 'like', '%빨강%');
            $query = $query->orWhere('lefcolrCodeNm', 'like', '%분홍%');
            $query = $query->orWhere('lefcolrCodeNm', 'like', '%자주색%');
        }
        if($request->has('leaf_mix')){
            $query = $query->orWhere('lefcolrCodeNm', 'like', '%여러색 혼합%');
        }
        if($request->has('leaf_etc')){
            $query = $query->orWhere('lefcolrCodeNm', 'like', '%기타%');
        }
        if($request->has('leafpattern_stripe')){
            $query = $query->orWhere('lefmrkCodeNm', 'like', '%줄무늬%');
        }
        if($request->has('leafpattern_point')){
            $query = $query->orWhere('lefmrkCodeNm', 'like', '%점무늬%');
        }
        if($request->has('leafpattern_side')){
            $query = $query->orWhere('lefmrkCodeNm', 'like', '%잎 가장자리 무늬%');
        }
        if($request->has('leafpattern_etc')){
            $query = $query->orWhere('lefmrkCodeNm', 'like', '%기타%');
        }
        if($request->has('flower_blue')){
            $query = $query->orWhere('flclrCodeNm', 'like', '%파랑색%');
        }
        if($request->has('flower_pupple')){
            $query = $query->orWhere('flclrCodeNm', 'like', '%보라색%');
        }
        if($request->has('flower_pink')){
            $query = $query->orWhere('flclrCodeNm', 'like', '%분홍색%');
        }
        if($request->has('flower_red')){
            $query = $query->orWhere('flclrCodeNm', 'like', '%빨강색%');
        }
        if($request->has('flower_orange')){
            $query = $query->orWhere('flclrCodeNm', 'like', '%오렌지색%');
        }
        if($request->has('flower_white')){
            $query = $query->orWhere('flclrCodeNm', 'like', '%흰색%');
        }
        if($request->has('flower_mix')){
            $query = $query->orWhere('flclrCodeNm', 'like', '%혼합색%');
        }
        if($request->has('flower_etc')){
            $query = $query->orWhere('flclrCodeNm', 'like', '%기타%');
        }
        if($request->has('fruit_blue')){
            $query = $query->orWhere('fmldecolrCodeNm', 'like', '%파랑색%');
        }
        if($request->has('fruit_pupple')){
            $query = $query->orWhere('fmldecolrCodeNm', 'like', '%보라색%');
        }
        if($request->has('fruit_pink')){
            $query = $query->orWhere('fmldecolrCodeNm', 'like', '%검정색%');
        }
        if($request->has('fruit_red')){
            $query = $query->orWhere('fmldecolrCodeNm', 'like', '%빨강색%');
        }
        if($request->has('fruit_orange')){
            $query = $query->orWhere('fmldecolrCodeNm', 'like', '%오렌지색%');
        }
        if($request->has('fruit_yellow')){
            $query = $query->orWhere('fmldecolrCodeNm', 'like', '%노랑색%');
        }
        if($request->has('fruit_white')){
            $query = $query->orWhere('fmldecolrCodeNm', 'like', '%흰색%');
        }
        if($request->has('fruit_mix')){
            $query = $query->orWhere('fmldecolrCodeNm', 'like', '%혼합색%');
        }
        if($request->has('fruit_etc')){
            $query = $query->orWhere('fmldecolrCodeNm', 'like', '%기타%');
        }
        if($request->has('flower_spring')){
            $query = $query->orWhere('ignSeasonCodeNm', 'like', '%봄%');
        }
        if($request->has('flower_summer')){
            $query = $query->orWhere('ignSeasonCodeNm', 'like', '%여름%');
        }
        if($request->has('flower_autumn')){
            $query = $query->orWhere('ignSeasonCodeNm', 'like', '%가을%');
        }
        if($request->has('flower_winter')){
            $query = $query->orWhere('ignSeasonCodeNm', 'like', '%겨울%');
        }

        $query = $query->get();
        $query1 = DB::table('nongsaro_gardenlists');
        for($i = 0; $i < count($query); $i++){
            if($i == 0){
                $query1 = $query1->where('id', $query[$i]->nongsaro_gardenlist_id);
            }
            else{
                $query1 = $query1->orWhere('id', $query[$i]->nongsaro_gardenlist_id);
            }
        }

        if($request->has('plantType') && $request->plantType !== null){
            $query1->orWhere('cntntsSj', 'like', '%'.$request->plantType.'%');
        }
        // else{
        //     $query = Nongsaro_gardenlist::paginate(12)->withPath(route('plantDict', $page));
        // }
        $page = (Array)$request->query();
        if($request->has('page')){
            unset($page['page']);
        }
        return view('components.plant-dictionary', [
            'consonant' => $consonant,
            'plantslist' => $query1->paginate(12)->withPath(route('plantDict', $page)),
        ]);
    }

    public function plantDetail($userID, $plantNO){
        $plant = Nongsaro_gardendtl::find($plantNO);
        return view('components.plant-dictionary-detail', [
            'gardendtl'=>$plant,
        ]);
    }

    public function plantDiaryPage($userID){
        $user = User::find($userID);
        return view('components.plant-diary', [
            'user'=>$user,
            'plant'=>$user->plants->first(),
        ]);
    }
}
