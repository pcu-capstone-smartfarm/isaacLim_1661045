<x-layout/>
<script src="https://unpkg.com/hangul-js" type="text/javascript"></script>
<section id="mainFrame">
    <section class="px-6 py-0 sm:py-4">
        <main class="max-w-lg mx-auto mt-2 auto">
            <x-panel class="group p-4">
                <div class="pb-4">
                    <h1 class="text-center font-bold text-sm sm:text-lg pt-0 sm:pt-4">기기가 등록되지 않았습니다.</h1>
                    <h1 class="text-center font-bold text-sm sm:text-lg py-0">몇가지 내용만 추가하면 서비스를 사용하실수 있습니다.</h1>
                </div>
                <hr/>
                <div class="pt-4">
                    <form method="POST" action="{{route('plantRegister', ['userID'=>auth()->user()->id])}}">
                        @csrf
                        <div>
                            <div class="flex flex-row">
                                <label class="basis-3/4 text-sm sm:text-lg">식물 종류</label>
                                <a class="basis-1/4 text-right text-sm sm:text-lg text-indigo-500 hover:text-indigo-300" href="{{route('plantDict', ['userID'=>auth()->user()->id])}}" target="blank">식물 검색</a>
                            </div>
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <div class="text-sm font-semibold w-full text-left flex">
                                        <input type="text" name="plantType" id="searchbar" class="hover:bg-gray-200 focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:py-3 text-sm sm:text-lg border-gray-300 rounded-md" placeholder="검색" onclick="selectSearchBar()" onkeyup="filterFunction()" required>
                                        <div class="absolute inset-y-0 right-0 flex items-center" style="cursor: pointer">
                                            <x-icon name="down-arrow" class="float-right pointer-events-none"/>
                                        </div>
                                    </div>
                                </x-slot>
                                <div id="dropContents">
                                    <div class="flex flex-row-reverse pr-2" onclick="closeSearchBar()">
                                        <svg viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg" width="15" height="15" style="cursor:pointer"><path d="M1.5 1.5l12 12m-12 0l12-12" stroke="currentColor" stroke-width="2"></path></svg>
                                    </div>
                                    <ul class="px-2 grid grid-cols-7 sm:flex gap-x-2 sm:gap-x-4 justify-center" id="consonant">
                                        @foreach ($consonant as $cons)
                                            <li class="text-sm sm:text-lg text-blue-600 hover:text-blue-200" style="cursor:pointer" onclick="consonantFilter(this.textContent)">{{$cons}}</li>
                                        @endforeach
                                    </ul>
                                    <div id="plantList">
                                        @foreach ($arrPlantName as $item)
                                            <x-dropdown-item name="list" onclick="selectItem(this.textContent)" style="cursor:pointer">{{$item}}</x-dropdown-item>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pt-2 sm:pt-6">
                            <label class="text-sm sm:text-lg">식물 이름</label>
                            <input type="text" name="plantName" id="plantName" class="hover:bg-gray-200 focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:py-3 text-sm sm:text-lg border-gray-300 rounded-md" placeholder="식물 이름" required>
                        </div>
                        <div class="pt-2 sm:pt-6 ">
                            <label class="text-sm sm:text-lg">기기 인증</label>
                            <div class="relative rounded-md shadow-sm">
                                <input type="text" name="serialNO" id="arduinoSerial" class="hover:bg-gray-200 focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:py-3 text-sm sm:text-lg border-gray-300 rounded-md" placeholder="시리얼 번호" required>
                                <div class="absolute inset-y-0 right-0 flex items-center">
                                    <label id="arduinoCheckBox" class="mr-2 sm:mr-4 px-2 py-1 bg-blue-500 rounded-3xl text-sm sm:text-lg text-gray-100 hover:bg-blue-600" onclick="arduinoVerifyCheck()" style="cursor: pointer">확인</label>
                                </div>
                            </div>
                        </div>
                        <x-form.field>
                            <div class="flex gap-4 justify-center ">
                                <button dusk="form-button" type="submit" class="text-center bg-blue-500 text-white uppercase font-semibold text-xs sm:text-lg py-2 px-5 rounded-2xl hover:bg-blue-600">제 출</button>
                                <label id="reset" class="text-center bg-gray-500 text-white uppercase font-semibold text-xs sm:text-lg py-2 px-5 rounded-2xl hover:bg-gray-300" onclick="location.reload()" style="cursor: pointer">취 소</label>
                            </div>
                        </x-form.field>
                    </form>
                </div>
            </x-panel>
        </main>
    </section>
    <x-flash/>
</section>
<script type="text/javascript">
    function filterFunction() {
        let filter, a, i;
        input = document.getElementById('searchbar');
        filter = input.value;
        if(filter === undefined || filter === null || filter === '' ){
            document.getElementById('consonant').style.display="";
        }
        else{
            document.getElementById('consonant').style.display="none";
        }
        a = document.getElementsByName('list');
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent;
            if (Hangul.search(txtValue, filter) > -1) {
                a[i].style.display = "";
            }
            else {
            a[i].style.display = "none";
            }
        }
    }
    function selectSearchBar(element){
        dropContents = document.getElementById('dropContents').parentElement;
        dropContents.style.display = "";
        a=document.getElementsByName('list');
        for(i=0; i<a.length; i++)
        {
            a[i].style.display="";
        }
    }
    function selectItem(text){
        input = document.getElementById('searchbar');
        dropContents = document.getElementById('dropContents').parentElement;
        input.value = text.trim();
        dropContents.style.display = "none";
    }
    function closeSearchBar(){
        document.getElementById('dropContents').parentElement.style.display="none";
    }
    function arduinoVerifyCheck(){
        const data = document.getElementById('arduinoSerial').value;
        if(data == null || data == '' || data==undefined)
            window.alert("입력 오류");
        else{
            const xhr = new XMLHttpRequest();
            let url = '/api/serialCheck';
            xhr.open("POST", url);
            {{--xhr.setRequestHeader('Access-Control-Allow-origin', '{{route('serialCheck')}}');--}}
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.setRequestHeader("Accept", "application/json");
            xhr.onreadystatechange = function() {
                console.log(xhr.readyState);
                console.log(xhr.status);
                if(xhr.readyState === 4 && xhr.status === 200){
                    let bar = document.getElementById('arduinoSerial');
                    bar.style="background-color:rgb(229,231,235)";
                    bar.readOnly=true;
                    document.getElementById('arduinoCheckBox').style.display="none";
                    window.alert("인증 완료");
                    console.log('response : '+xhr.response);
                }
                else if(xhr.readyState === 4 && xhr.status !== 200){
                    window.alert("인증 번호 미일치");
                }
            };
            xhr.send(JSON.stringify({"serial_no" : data, "_token":"{{csrf_token()}}"}));
        }
    }
    function consonantFilter(consonant){
        let searcher = new Hangul.Searcher(consonant);
        let data = <?php echo json_encode($arrPlantName, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT | JSON_HEX_APOS)?>;
        Array.from(data).forEach(function(item, index, data){
            data[index] = Hangul.disassemble(item);
            if(searcher.search(data[index][0]) != 0)
            {
                document.getElementById('plantList').children[index].style.display="none";
            }
            else
            {
                document.getElementById('plantList').children[index].style.display="";
            }
        });
    }
</script>
@endif
