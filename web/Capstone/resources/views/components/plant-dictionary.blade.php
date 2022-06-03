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
    <section class="px-2 py-2 sm:py-4">
        <main>
            <x-panel class="group p-1 sm:p-4">
                <div class="pb-4 float-right">
                    <a href="{{route('home', ['userID'=>auth()->user()->id])}}">
                        <svg class="fill-green-500" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg" width="20" height="20"><path d="M7.825.12a.5.5 0 00-.65 0L0 6.27v7.23A1.5 1.5 0 001.5 15h4a.5.5 0 00.5-.5v-3a1.5 1.5 0 013 0v3a.5.5 0 00.5.5h4a1.5 1.5 0 001.5-1.5V6.27L7.825.12z"></path></svg>
                    </a>
                </div>
                <div id="searcher">
                    <form id="searchform" method="GET" action="{{route('plantDict', ['userID'=>auth()->user()->id])}}">
                        <div class="text-sm font-semibold w-full text-left flex">
                            <label class="basis-1/6 text-sm sm:text-lg px-2 text-center">식물명</label>
                            <input type="text" name="plantType" id="searchbar" class="bg-gray-50 hover:bg-gray-200 focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-2 pr-2 sm:pl-7 sm:pr-12 sm:py-3 text-sm sm:text-lg border-gray-300 rounded-md" placeholder="검색">
                            <button type="submit" class="text-center basis-1/6 bg-blue-500 text-white uppercase font-semibold text-xs sm:text-lg py-2 px-4 ml-2 rounded-2xl hover:bg-blue-600">검색</button>
                        </div>
                        <div>
                            <ul class="px-2 py-2 gap-x-2 sm:gap-x-4 lg:gap-8 w-full grid md:flex grid-cols-7 justify-center" id="consonant">
                                @foreach ($consonant as $cons)
                                    <li class="text-sm sm:text-lg text-blue-600 hover:text-blue-200" style="cursor:pointer" onclick="consonantSubmit(this.textContent)">{{$cons}}</li>
                                @endforeach
                            </ul><input type="hidden" id="consonantInput" name="consonant" value="">
                        </div>
                        <div id="detailSearch" class="w-full">
                            <div class="ml-4 sm:ml-10 lg:ml-14 inline-flex" style="cursor: pointer" onclick="detailSearchShow()">
                                <label class="text-sm sm:text-lg font-semibold">상세검색</label>
                                <svg id="downarrow" class="ml-2 sm:mt-1 flex-shrink-0 w-6 h-6 text-gray-500 dark:text-gray-400" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 5l-6.5 7L1 5" stroke="currentColor" stroke-linecap="square"></path></svg>
                                <svg id="uparrow" class="ml-2 sm:mt-1 flex-shrink-0 w-6 h-6 text-gray-500 dark:text-gray-400" style="display:none" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 10l6.5-7 6.5 7" stroke="currentColor" stroke-linecap="square"></path></svg>
                            </div>
                            <x-panel class="mt-2 p-0 md:inline-flex md:w-max" id="filter" style="display: none">
                                <div class="mt-2 px-2">
                                    <div class="md:gap-2 md:w-max">
                                        <label class="text-sm sm:text-lg px-2 font-semibold">광도</label>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                lux_low
                                            </x-slot>
                                            낮은 광도(300~800lux)
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                lux_middle
                                            </x-slot>
                                            중간 광도(800~1,500lux)
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                lux_high
                                            </x-slot>
                                            높은 광도(1,500~10,000lux)
                                        </x-form.checkbox>
                                    </div>
                                    <div class="md:gap-2 md:w-max">
                                        <label class="text-sm sm:text-lg px-2 font-semibold">잎색</label>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                leaf_green
                                            </x-slot>
                                            녹색, 연두색
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                leaf_yellow
                                            </x-slot>
                                            금색, 노란색
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                leaf_white
                                            </x-slot>
                                            흰색, 크림색
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                leaf_gray
                                            </x-slot>
                                            은색, 회색
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                leaf_red
                                            </x-slot>
                                            빨강, 분홍, 자주색
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                leaf_mix
                                            </x-slot>
                                            여러 색 혼합
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                leaf_etc
                                            </x-slot>
                                            기타
                                        </x-form.checkbox>
                                    </div>
                                    <div class="md:gap-2 md:w-max">
                                        <label class="text-sm sm:text-lg px-2 font-semibold">잎무늬</label>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                leafpattern_stripe
                                            </x-slot>
                                            줄무늬
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                leafpattern_point
                                            </x-slot>
                                            점무늬
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                leafpattern_side
                                            </x-slot>
                                            잎 가장자리 무늬
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                leafpattern_etc
                                            </x-slot>
                                            기타
                                        </x-form.checkbox>
                                    </div>
                                    <div class="md:gap-2 md:w-max">
                                        <label class="text-sm sm:text-lg px-2 font-semibold">꽃 색</label>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                flower_blue
                                            </x-slot>
                                            파랑색
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                flower_pupple
                                            </x-slot>
                                            보라색
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                flower_pink
                                            </x-slot>
                                            분홍색
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                flower_red
                                            </x-slot>
                                            빨강색
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                flower_orange
                                            </x-slot>
                                            오렌지색
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                flower_white
                                            </x-slot>
                                            흰색
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                flower_mix
                                            </x-slot>
                                            혼합색
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                flower_etc
                                            </x-slot>
                                            기타
                                        </x-form.checkbox>
                                    </div>
                                    <div class="md:gap-2 md:w-max">
                                        <label class="text-sm sm:text-lg px-2 font-semibold">열매 색</label>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                fruit_blue
                                            </x-slot>
                                            파랑색
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                fruit_pupple
                                            </x-slot>
                                            보라색
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                fruit_black
                                            </x-slot>
                                            검정색
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                fruit_red
                                            </x-slot>
                                            빨강색
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                fruit_orange
                                            </x-slot>
                                            오렌지색
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                fruit_yellow
                                            </x-slot>
                                            노랑색
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                fruit_white
                                            </x-slot>
                                            흰색
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                fruit_mix
                                            </x-slot>
                                            혼합색
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                fruit_etc
                                            </x-slot>
                                            기타
                                        </x-form.checkbox>
                                    </div>
                                    <div class="form-check md:gap-2 md:w-max">
                                        <label class="form-check-label text-sm sm:text-lg px-2 font-semibold">꽃 피는 계절</label>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                flower_spring
                                            </x-slot>
                                            봄
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                flower_summer
                                            </x-slot>
                                            여름
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                flower_autumn
                                            </x-slot>
                                            가을
                                        </x-form.checkbox>
                                        <x-form.checkbox>
                                            <x-slot:id>
                                                flower_winter
                                            </x-slot>
                                            겨울
                                        </x-form.checkbox>
                                    </div>
                                    <div class="my-2">
                                        <button type="submit" class="text-center bg-blue-500 text-white font-semibold text-sm py-2 px-4 ml-2 rounded-full hover:bg-blue-600">검색</button>
                                        <button type="reset" class="text-center bg-gray-400 text-white font-semibold text-sm py-2 px-4 ml-2 rounded-full hover:bg-gray-500">초기화</button>
                                    </div>
                                </div>
                            </x-panel>
                        </div>
                    </form>
                    <label class="pl-1 text-xs text-gray-500" id="searchNotice">상세검색은 가로모드나 PC버전을 이용하세요.</label>
                </div>
            </x-panel>
            <x-panel class="pt-2 mt-2">
                <div class="max-w-2xl mx-auto py-4 px-4 sm:py-6 sm:px-6 lg:max-w-7xl lg:px-8">
                <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                    {{-- 식물 리스트 loop --}}
                    @if(isset($plantslist))
                        @foreach ($plantslist as $data)
                            <a href="{{route('plantDetail', ['userID'=>auth()->user()->id, 'plantNO'=>$data->id])}}" class="group">
                                <div class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
                                    <img src="https://nongsaro.go.kr/{{explode('|', $data->rtnFileCours)[0]}}/{{explode('|', $data->rtnStreFileNm)[0]}}" class="w-full h-full object-center object-cover group-hover:opacity-75">
                                </div>
                                <p class="mt-1 text-lg font-medium text-gray-900">{{$data->cntntsSj}}</p>
                            </a>
                        @endforeach
                    @else
                        <h1>요청하신 정보를 찾을 수 없습니다.</h1>
                    @endif
                </div>
                </div>
                @if(isset($plantslist))
                <section class="flex justify-center py-4">
                    {{$plantslist->links('vendor.pagination.tailwind')}}
                </section>
                @endif
            </x-panel>
        </main>
    </section>
</section>
<script>
    detail = document.getElementById('detailSearch');
    notice = document.getElementById('searchNotice');
    if(window.innerWidth>425){
        detail.style.display="";
        notice.style.display="none";
    }
    else{
        detail.style.display="none";
        notice.style.display="";
    }
    window.onresize = function(event){
        if(window.innerWidth>425){
            detail.style.display="";
            notice.style.display="none";
        }
        else{
            detail.style.display="none";
            notice.style.display="";
        }
    }
    function detailSearchShow(){
        filter = document.getElementById('filter');
        if(filter.style.display === 'none'){
            filter.style.display="";
            document.getElementById('uparrow').style.display="";
            document.getElementById('downarrow').style.display="none";
        }
        else{
            filter.style.display="none";
            document.getElementById('downarrow').style.display="";
            document.getElementById('uparrow').style.display="none";
        }
    }
    function consonantSubmit(value){
        document.getElementById('consonantInput').value=value;
        document.getElementById('searchform').submit();
    }
</script>
<x-footer/>
