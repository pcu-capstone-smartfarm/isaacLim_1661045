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
                    <div>
                        <label class="text-sm sm:text-lg">식물 종류</label>
                        <a href="http://api.nongsaro.go.kr/sample/ajax/garden/gardenList.html" target="_blank">
                            <input type="text" name="plantType" id="plantType" class="hover:bg-gray-200 focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:py-3 text-sm sm:text-lg border-gray-300 rounded-md" placeholder="클릭하여 선택" disabled required>
                        </a>
                    </div>
                    <div class="pt-2 sm:pt-6">
                        <label class="text-sm sm:text-lg">식물 이름</label>
                        <input type="text" name="plantName" id="plantName" class="hover:bg-gray-200 focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:py-3 text-sm sm:text-lg border-gray-300 rounded-md" placeholder="식물 이름" required>
                    </div>
                    <div class="pt-2 sm:pt-6 ">
                        <label class="text-sm sm:text-lg">기기 인증</label>
                        <div class="relative rounded-md shadow-sm">
                            <input type="text" name="plantType" id="plantType" class="hover:bg-gray-200 focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-7 pr-12 sm:py-3 text-sm sm:text-lg border-gray-300 rounded-md" placeholder="시리얼 번호" required>
                            <div class="absolute inset-y-0 right-0 flex items-center">
                                <label class="mr-2 sm:mr-4 px-2 py-1 bg-blue-500 rounded-3xl text-sm sm:text-lg text-gray-100 hover:bg-blue-600">확인</label>
                            </div>
                        </div>
                    </div>
                    <x-form.field>
                        <div class="flex justify-center">
                            <button dusk="form-button" type="submit" class="text-center bg-blue-500 text-white uppercase font-semibold text-xs sm:text-lg py-2 px-5 rounded-2xl hover:bg-blue-600">제 출</button>
                        </div>
                    </x-form.field>
                </form>
            </div>
        </x-panel>
    </main>
</section>
