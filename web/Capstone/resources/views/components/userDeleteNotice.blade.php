<x-index>
</x-index>
<section class="px-6 py-8">
    <main class="max-w-lg mx-auto mt-10">
        <x-panel class="group">
            <h1 class="text-center font-bold text-red-500 tesxt-xl pb-4">탈퇴 안내</h1>
            <h1 class="text-center font-bold tesxt-xl pb-4">사용자 탈퇴시 복구 할 수 없습니다.</h1>
            <label class="block text-center">
            <h1 class="inline text-center tesxt-xl pb-4">탈퇴를 희망할 경우 아래에</h1>
            <h1 class="inline text-center font-bold text-red-500 tesxt-xl pb-4"> {{$user->username}} 탈퇴 </h1>
            <h1 class="inline text-center tesxt-xl pb-4">를 입력해주시기 바랍니다.</h1>
            </label>
            <label class="block border-solid border-2 border-black rounded-full mt-4 px-3 py-2">
                <input type="text" class="block w-full">
            </label>
            <form dusk="registerPage-register-form" method="POST" action="{{route('register')}}" class="mt-6">
                @csrf
            <div class="grid grid-rows-2 gap-4">
                <button dusk="registerPage-register-form-submit-button" type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">
                    확인
                </button>
                <a dusk="registerPage-register-form-cancle-anchor" href="{{route('home')}}" class="bg-gray-400 text-white text-center rounded py-2 px-4 hover:bg-gray-500 ">
                    취소
                </a>
            </div>
        </x-panel>
    </main>
</section>
<x-footer/>
