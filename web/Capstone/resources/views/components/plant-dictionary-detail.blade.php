<!DOCTYPE html lang="ko">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<title>CAPSTONE</title>
<link href="{{asset('css/app.css')}}" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
{{-- Plant icons created by Freepik - Flaticon - --}}
<link href="{{asset('images/plant.png')}}" type="image/x-icon" rel="shortcut icon">
<section id="mainFrame">
    <section class="px-6">
        <main>
            <div class="bg-white">
                <div class="max-w-2xl mx-auto py-10 px-4 grid items-center grid-cols-1 gap-y-16 gap-x-8 sm:px-6 lg:max-w-7xl lg:px-8 lg:grid-cols-2">
                    <div>
                        <div class="inline-flex" style="cursor: pointer">
                            <a class="flex" href="{{route('plantDict', ['userID' => auth()->user()->id])}}">
                            <svg class="ml-2 sm:mt-1 flex-shrink-0 w-6 h-6 text-gray-500 dark:text-gray-400" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 14L3 7.5 10 1" stroke="currentColor" stroke-linecap="square"></path></svg><label class="text-sm sm:text-lg font-semibold" style="cursor: pointer">back</label>
                            </a>
                        </div>
                        <dl class="mt-4 sm:mt-8 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 sm:gap-y-16 lg:gap-x-8">
                            <div>
                                <dt class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">{{$gardendtl->gardenlist->cntntsSj != '' ? $gardendtl->gardenlist->cntntsSj : '데이터 없음'}}</dt>
                                <dd class="mt-2 sm:mt-4 text-gray-500">식물한명 : {{$gardendtl->plntbneNm != '' ? $gardendtl->plntbneNm : '데이터 없음'}}</dd>
                                <dd class="mt-2 sm:mt-4 text-gray-500">식물영명 : {{$gardendtl->plntzrNm != '' ? $gardendtl->plntzrNm : '데이터 없음'}}</dd>
                                <dd class="mt-2 sm:mt-4 text-gray-500">유통명 : {{$gardendtl->distbNm != '' ? $gardendtl->distbNm : '데이터 없음'}}</dd>
                                <dd class="mt-2 sm:mt-4 text-gray-500">과명 : {{$gardendtl->fmlCodeNm != '' ? $gardendtl->fmlCodeNm : '데이터 없음'}}</dd>
                                <dd class="mt-2 sm:mt-4 text-gray-500">원산지 : {{$gardendtl->orgplceInfo != '' ? $gardendtl->orgplceInfo : '데이터 없음'}}</dd>
                            </div>
                            <div class="pt-4 sm:pt-8">
                                <div>
                                    <dt class="font-medium text-gray-900">잎 무늬</dt>
                                    <dd class="mt-2 text-sm text-gray-500">{{$gardendtl->lefmrkCodeNm != '' ? $gardendtl->lefmrkCodeNm : '데이터 없음'}}</dd>
                                </div>
                                <div class="border-t border-gray-200 mt-2">
                                    <dt class="mt-2 font-medium text-gray-900">잎 색</dt>
                                    <dd class="mt-2 text-sm text-gray-500">{{$gardendtl->lefcolrCodeNm != '' ? $gardendtl->lefcolrCodeNm : '데이터 없음'}}</dd>
                                </div>
                                <div class="border-t border-gray-200 mt-2">
                                    <dt class="mt-2 font-medium text-gray-900">꽃 색</dt>
                                    <dd class="mt-2 text-sm text-gray-500">{{$gardendtl->flclrCodeNm != '' ? $gardendtl->flclrCodeNm : '데이터 없음'}}</dd>
                                </div>
                            </div>
                        </dl>

                        <dl class="mt-4 sm:mt-8 grid grid-cols-1 gap-x-6 gap-y-2 sm:grid-cols-2 sm:gap-y-4 lg:gap-x-8">
                        <div class="border-t border-gray-200 pt-4">
                            <div>
                                <dt class="font-medium text-gray-900">성장 높이</dt>
                                <dd class="mt-2 text-sm text-gray-500">{{$gardendtl->growthHgInfo != '' ? $gardendtl->growthHgInfo : '데이터 없음'}}</dd>
                            </div>
                            <div class="border-t border-gray-200 mt-2">
                                <dt class="mt-2 font-medium text-gray-900">성장 너비</dt>
                                <dd class="mt-2 text-sm text-gray-500">{{$gardendtl->growthAraInfo != '' ? $gardendtl->growthAraInfo : '데이터 없음'}}</dd>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-4">
                            <dt class="font-medium text-gray-900">관리 수준</dt>
                            <dd class="mt-2 text-sm text-gray-500">{{$gardendtl->managedemanddoCodeNm != '' ? $gardendtl->managedemanddoCodeNm : '데이터 없음'}}</dd>
                            <div class="border-t border-gray-200 mt-2">
                                <dt class="mt-2 font-medium text-gray-900">생장 속도</dt>
                                <dd class="mt-2 text-sm text-gray-500">{{$gardendtl->grwtveCodeNm != '' ? $gardendtl->grwtveCodeNm : '데이터 없음'}}</dd>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-4">
                            <dt class="font-medium text-gray-900">생육 온도</dt>
                            <dd class="mt-2 text-sm text-gray-500">{{$gardendtl->grwhTpCodeNm != '' ? $gardendtl->grwhTpCodeNm : '데이터 없음'}}</dd>
                            <div class="border-t border-gray-200 mt-2">
                                <dt class="mt-2 font-medium text-gray-900">토양 정보</dt>
                                <dd class="mt-2 text-sm text-gray-500">{{$gardendtl->soilInfo != '' ? $gardendtl->soilInfo : '데이터 없음'}}</dd>
                            </div>
                            <div class="border-t border-gray-200 mt-2">
                                <dt class="mt-2 font-medium text-gray-900">습도</dt>
                                <dd class="mt-2 text-sm text-gray-500">{{$gardendtl->hdCodeNm != '' ? $gardendtl->hdCodeNm : '데이터 없음'}}</dd>
                            </div>
                            <div class="border-t border-gray-200 mt-2">
                                <dt class="mt-2 font-medium text-gray-900">비료 정보</dt>
                                <dd class="mt-2 text-sm text-gray-500">{{$gardendtl->frtlzrInfo != '' ? $gardendtl->frtlzrInfo : '데이터 없음'}}</dd>
                            </div>
                        </div>


                        <div class="border-t border-gray-200 pt-4">
                            <dt class="font-medium text-gray-900">물주기 봄</dt>
                            <dd class="mt-2 text-sm text-gray-500">{{$gardendtl->watercycleSprngCodeNm != '' ? $gardendtl->watercycleSprngCodeNm : '데이터 없음'}}</dd>
                            <div class="border-t border-gray-200 mt-2">
                                <dt class="mt-2 font-medium text-gray-900">물주기 여름</dt>
                                <dd class="mt-2 text-sm text-gray-500">{{$gardendtl->watercycleSummerCodeNm != '' ? $gardendtl->watercycleSummerCodeNm : '데이터 없음'}}</dd>
                            </div>
                            <div class="border-t border-gray-200 mt-2">
                                <dt class="mt-2 font-medium text-gray-900">물주기 가을</dt>
                                <dd class="mt-2 text-sm text-gray-500">{{$gardendtl->watercycleAutumnCodeNm != '' ? $gardendtl->watercycleAutumnCodeNm : '데이터 없음'}}</dd>
                            </div>
                            <div class="border-t border-gray-200 mt-2">
                                <dt class="mt-2 font-medium text-gray-900">물주기 겨울</dt>
                                <dd class="mt-2 text-sm text-gray-500">{{$gardendtl->watercycleWinterCodeNm != '' ? $gardendtl->watercycleWinterCodeNm : '데이터 없음'}}</dd>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-4">
                            <dt class="font-medium text-gray-900">병해충</dt>
                            <dd class="mt-2 text-sm text-gray-500">{{$gardendtl->dlthtsCodeNm != '' ? $gardendtl->dlthtsCodeNm : '데이터 없음'}}</dd>
                            <div class="border-t border-gray-200 mt-2">
                                <dt class="mt-2 font-medium text-gray-900">번식 방법</dt>
                                <dd class="mt-2 text-sm text-gray-500">{{$gardendtl->prpgtmthCodeNm != '' ? $gardendtl->prpgtmthCodeNm : '데이터 없음'}}</dd>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-4">
                            <dt class="font-medium text-gray-900">발화 계절</dt>
                            <dd class="mt-2 text-sm text-gray-500">{{$gardendtl->ignSeasonCodeNm != '' ? $gardendtl->ignSeasonCodeNm : '데이터 없음'}}</dd>
                            <div class="border-t border-gray-200 mt-2">
                                <dt class="mt-2 font-medium text-gray-900">배치 장소</dt>
                                <dd class="mt-2 text-sm text-gray-500">{{$gardendtl->postngplaceCodeNm != '' ? $gardendtl->postngplaceCodeNm : '데이터 없음'}}</dd>
                            </div>
                        </div>
                        </dl>
                    </div>
                    <div class="grid grid-cols-2 grid-rows-2 gap-4 sm:gap-6 lg:gap-8">
                        @if($gardendtl->id!=218)
                            @if (isset(explode('|', $gardendtl->gardenlist->rtnFileCours)[0]))
                                <img src="https://nongsaro.go.kr/{{explode('|', $gardendtl->gardenlist->rtnFileCours)[0]}}/{{explode('|', $gardendtl->gardenlist->rtnStreFileNm)[0]}}" alt="thumbnail1" class="bg-gray-300 rounded-lg border border-gray-500">
                            @endif
                            @if (isset(explode('|', $gardendtl->gardenlist->rtnFileCours)[1]))
                                <img src="https://nongsaro.go.kr/{{explode('|', $gardendtl->gardenlist->rtnFileCours)[1]}}/{{explode('|', $gardendtl->gardenlist->rtnStreFileNm)[1]}}" alt="thumbnail2" class="bg-gray-300 rounded-lg border border-gray-500">
                            @endif
                            @if (isset(explode('|', $gardendtl->gardenlist->rtnFileCours)[2]))
                                <img src="https://nongsaro.go.kr/{{explode('|', $gardendtl->gardenlist->rtnFileCours)[2]}}/{{explode('|', $gardendtl->gardenlist->rtnStreFileNm)[2]}}" alt="thumbnail3" class="bg-gray-300 rounded-lg border border-gray-500">
                            @endif
                            @if (isset(explode('|', $gardendtl->gardenlist->rtnFileCours)[3]))
                                <img src="https://nongsaro.go.kr/{{explode('|', $gardendtl->gardenlist->rtnFileCours)[3]}}/{{explode('|', $gardendtl->gardenlist->rtnStreFileNm)[3]}}" alt="thumbnail4" class="bg-gray-300 rounded-lg border border-gray-500">
                            @endif
                        @else
                            <img src="{{env("AWS_CLOUDFRONT_S3_URL")."/".explode('|', $gardendtl->gardenlist->rtnOrginlFileNm)[0]}}" alt="thumbnail1" class="bg-gray-300 rounded-lg border border-gray-500">
                            <img src="{{env("AWS_CLOUDFRONT_S3_URL")."/".explode('|', $gardendtl->gardenlist->rtnOrginlFileNm)[1]}}" alt="thumbnail2" class="bg-gray-300 rounded-lg border border-gray-500">
                            <img src="{{env("AWS_CLOUDFRONT_S3_URL")."/".explode('|', $gardendtl->gardenlist->rtnOrginlFileNm)[2]}}" alt="thumbnail3" class="bg-gray-300 rounded-lg border border-gray-500">
                            <img src="{{env("AWS_CLOUDFRONT_S3_URL")."/".explode('|', $gardendtl->gardenlist->rtnOrginlFileNm)[3]}}" alt="thumbnail4" class="bg-gray-300 rounded-lg border border-gray-500">
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </section>
</section>
<x-footer/>
