<x-index>
</x-index>
<div class="h-auto" style="min-height: 80%">
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <x-panel dusk="login-panel">
                <h1 dusk="loginPage-infor" class="text-center font-bold tesxt-xl">로 그 인</h1>
                <form dusk="loginPage-login-form" method="POST" action="{{route('login')}}" class="mt-10">
                    @csrf

                    <x-form.input dusk="loginPage-login-form-email-input" name="email" autocomplete="username"/>
                    <x-form.input dusk="loginPage-login-form-password-input" name="password" type="password" autocomplete="new-password"/>

                    <x-form.button>Log In</x-form.button>
                    <div class="mt-4">
                        <a dusk="registerPage-register-form-cancle-anchor" href="{{route('register')}}" class="bg-gray-400 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-gray-500 ">
                            REGISTER
                        </a>
                    </div>
                </form>
            </x-panel>
        </main>
    </section>
</div>
<x-footer/>
