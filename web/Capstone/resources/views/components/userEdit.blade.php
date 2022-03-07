<x-layout>
</x-layout>

    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 border-gray-200 p-6 rounded-xl">
            <h1 dusk="registerPage-infor" class="text-center font-bold tesxt-xl">사용자 정보 수정</h1>
            <form dusk="registerPage-register-form" method="POST" action="{{route('userUpdate', ['userID'=>auth()->user()->id])}}" class="mt-10">
                @csrf
                @method('PATCH')
                <div class="mb-6">
                    <label dusk="registerPage-name-label" class="block mb-2 uppercase font-bold text-xs text-gray-700" for="name">
                        이름
                    </label>
                    <input dusk="registerPage-register-form-name-input" class="border border-gray-400 p-2 w-full" type="text" name="name" id="name" value="{{$user->name}}" required>

                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label dusk="registerPage-username-label" class="block mb-2 uppercase font-bold text-xs text-gray-700" for="username">
                        닉네임
                    </label>

                    <input dusk="registerPage-register-form-username-input" class="border border-gray-400 p-2 w-full" type="text" name="username" id="username" value="{{$user->username}}" required>
                    @error('username')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label dusk="registerPage-email-label" class="block mb-2 uppercase font-bold text-xs text-gray-700" for="email">
                        이메일(ID)
                    </label>

                    <input dusk="registerPage-register-form-email-input" class="border border-gray-400 p-2 w-full" type="email" name="email" id="email" value="{{$user->email}}" disabled>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label dusk="registerPage-password-label" class="block mb-2 uppercase font-bold text-xs text-gray-700" for="password">
                        비밀번호
                    </label>

                    <input dusk="registerPage-register-form-password-input" class="border border-gray-400 p-2 w-full" type="password" name="password" id="password" value="{{old('password')}}" required>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="grid grid-rows-2 gap-4">
                    <button dusk="registerPage-register-form-submit-button" type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">
                        확인
                    </button>
                    <a dusk="registerPage-register-form-cancle-anchor" href="{{route('home')}}" class="bg-gray-400 text-white text-center rounded py-2 px-4 hover:bg-gray-500 ">
                        취소
                    </a>
                </div>
            </form>
        </main>
    </section>
<x-flash/>
