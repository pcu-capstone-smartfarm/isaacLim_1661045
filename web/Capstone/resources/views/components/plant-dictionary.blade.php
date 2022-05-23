<!DOCTYPE html lang="ko">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<title>CAPSTONE</title>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<section id="mainFrame">
    <section class="px-6 py-0 sm:py-4">
        <main>
            <x-panel class="group p-4">
                <div class="pb-4 float-right" onclick="window.close()">
                    <svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg" width="30" height="30"><path d="M1.5 1.5l12 12m-12 0l12-12" stroke="currentColor"></path></svg>
                </div>
            <div id="searcher">
            <form>
                <div class="text-sm font-semibold w-full text-left flex">
                    <label class="basis-1/6 text-sm sm:text-lg px-2 text-center">식물명</label>
                    <input type="text" name="plantType" id="searchbar" class="bg-gray-50 hover:bg-gray-200 focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:py-3 text-sm sm:text-lg border-gray-300 rounded-md" placeholder="검색" required>
                    <button type="submit" class="text-center basis-1/6 bg-blue-500 text-white uppercase font-semibold text-xs sm:text-lg py-2 px-4 ml-2 rounded-2xl hover:bg-blue-600">검색</button>
                </div>
                <div class="inline">
                    <ul class="px-2 py-2 gap-x-2 sm:gap-x-4 w-full grid md:flex grid-cols-7" id="consonant">
                        @foreach ($consonant as $cons)
                            <li class="text-sm sm:text-lg text-blue-600 hover:text-blue-200" style="cursor:pointer" onclick="consonantFilter(this.textContent)">{{$cons}}</li>
                        @endforeach
                    </ul>
                </div>
                <div id="detailSearch" class="hidden">
                    <div>
                        <label class="text-sm sm:text-lg px-2">광도</label>
                        <input type="checkbox"><label>낮은 광도(300~800lux)</label>
                        <input type="checkbox"><label>중간 광도(800~1,500lux)</label>
                        <input type="checkbox"><label>높은 광도(1,500~10,000lux)</label>
                    </div>
                    <div>
                        <label class="text-sm sm:text-lg px-2">잎색</label>
                        <input type="checkbox"><label>녹색, 연두색</label>
                        <input type="checkbox"><label>금색, 노란색</label>
                        <input type="checkbox"><label>흰색, 크림색</label>
                        <input type="checkbox"><label>은색, 회색</label>
                        <input type="checkbox"><label>빨강, 분홍, 자주색</label>
                        <input type="checkbox"><label>여러 색 혼합</label>
                        <input type="checkbox"><label>기타</label>
                    </div>
                    <div>
                        <label class="text-sm sm:text-lg px-2">잎무늬</label>
                        <input type="checkbox"><label>줄무늬</label>
                        <input type="checkbox"><label>점무늬</label>
                        <input type="checkbox"><label>잎 가장자리 무늬</label>
                        <input type="checkbox"><label>기타</label>
                    </div>
                    <div>
                        <label class="text-sm sm:text-lg px-2">꽃 색</label>
                        <input type="checkbox"><label>파랑색</label>
                        <input type="checkbox"><label>보라색</label>
                        <input type="checkbox"><label>분홍색</label>
                        <input type="checkbox"><label>빨강색</label>
                        <input type="checkbox"><label>오렌지색</label>
                        <input type="checkbox"><label>흰색</label>
                        <input type="checkbox"><label>혼합색</label>
                        <input type="checkbox"><label>기타</label>
                    </div>
                    <div>
                        <label class="text-sm sm:text-lg px-2">열매 색</label>
                        <input type="checkbox"><label>파랑색</label>
                        <input type="checkbox"><label>보라색</label>
                        <input type="checkbox"><label>분홍색</label>
                        <input type="checkbox"><label>빨강색</label>
                        <input type="checkbox"><label>오렌지색</label>
                        <input type="checkbox"><label>흰색</label>
                        <input type="checkbox"><label>혼합색</label>
                        <input type="checkbox"><label>기타</label>
                    </div>
                    <div>
                        <label class="text-sm sm:text-lg px-2">꽃 피는 계절</label>
                        <input type="checkbox"><label>봄</label>
                        <input type="checkbox"><label>여름</label>
                        <input type="checkbox"><label>가을</label>
                        <input type="checkbox"><label>겨울</label>
                    </div>
                </div>
            </form>
            </div>
            </x-panel>
            <x-panel>
                <div class="max-w-2xl mx-auto py-4 px-4 sm:py-6 sm:px-6 lg:max-w-7xl lg:px-8">
                <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                    {{-- 식물 리스트 loop --}}
                    @foreach ($plantslist as $data)
                        <a href="#" class="group">
                            <div class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
                                <img src="https://nongsaro.go.kr/{{explode('|', $data->rtnFileCours)[0]}}/{{explode('|', $data->rtnStreFileNm)[0]}}" class="w-full h-full object-center object-cover group-hover:opacity-75">
                            </div>
                            <p class="mt-1 text-lg font-medium text-gray-900">{{$data->cntntsSj}}</p>
                        </a>
                    @endforeach
                </div>
                </div>
                <section class="flex justify-center py-4">
                    {{$plantslist->links('vendor.pagination.tailwind')}}
                </section>
            </x-panel>
        </main>
    </section>
</section>
<script>
    detail = document.getElementById('detailSearch');
    if(window.innerWidth>425)
        detail.className="";
    else
        detail.className="hidden";
    window.onresize = function(event){
        if(window.innerWidth>425){
            detail.className="";
        }
        else{
            detail.className="hidden";
        }
    }
</script>
