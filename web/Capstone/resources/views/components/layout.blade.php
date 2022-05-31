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
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }
    async function openSlider(){
        document.getElementById("sliderOverlay").className="ease-in duration-500 opacity-100"
        mainFrame =  document.getElementById("mainFrame");
        if(mainFrame != null)
            mainFrame.className="hidden";
        await sleep(500);
    }
    async function closeSlider(){
        document.getElementById("sliderOverlay").className="duration-500 ease-in-out opacity-0";
        mainFrame = document.getElementById("mainFrame");
        await sleep(500);
        document.getElementById("sliderOverlay").className="hidden";
        if(mainFrame != null)
            mainFrame.className="";
    }
</script>

<style>
    html{
        scroll-behavior: smooth;
    }
    .clamp{
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .clamp.one-line{
        -webkit-line-clamp: 1;
    }
</style>

<body style="font-family: Open Sans, sans-serif">
    <section class="px-6 py-4">
        <div class="relative bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="flex justify-between items-center border-b-2 border-gray-100 py-4 md:justify-start md:space-x-10">
                    <div class="flex justify-start lg:w-0 lg:flex-1">
                        @auth
                        <a href="{{route('userHome', ['userID'=>auth()->user()->id])}}">
                            @else
                            <a href="{{route('home')}}">
                        @endauth
                        <span class="sr-only">Workflow</span>
                        <svg viewBox="0 0 15 15" fill="#3ADF00" xmlns="http://www.w3.org/2000/svg" width="30" height="30"><path d="M7.5 15V7m0 .5v3m0-3a4 4 0 00-4-4h-3v3a4 4 0 004 4h3m0-3h3a4 4 0 004-4v-3h-3a4 4 0 00-4 4v3zm0 0l4-4m-4 7l-4-4" stroke="currentColor"></path></svg>
                        </a>
                    </div>
                    <div class="-mr-2 -my-2 md:hidden">
                        <button type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-expanded="false"
                                onclick="openSlider()">
                        <span class="sr-only">Open menu</span>
                        <!-- Heroicon name: outline/menu -->

                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        </button>
                    </div>
                    <nav class="hidden md:flex space-x-10">
                        <div class="relative">
                        </div>

                        @auth
                        <x-category-dropdown dusk="posts-dropdown"/>
                        <a class="text-base font-medium text-gray-500 hover:text-gray-900" href="{{route('plantDict', ['userID'=>auth()->user()->id])}}" target="blank">
                            사전
                        </a>
                        <a class="text-base font-medium text-gray-500 hover:text-gray-900">
                            일지
                        </a>
                        @endauth
                    </nav>
                    <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
                        @auth
                        <x-dropdown>
                            <x-slot name="trigger">
                                <button dusk="user-dropdown" class="text-xs font-bold uppercase">Welcome, {{auth()->user()->name}}!</button>
                            </x-slot>
                            <x-dropdown-item dusk="logout-anchor" href="#" x-data="{}" @click.prevent="document.querySelector('#logout-form').submit()">로그아웃</x-dropdown-item>
                            <x-dropdown-item dusk="logout-anchor" href="{{route('userEdit', ['userID'=>auth()->user()->id])}}">정보수정</x-dropdown-item>
                            <x-dropdown-item dusk="logout-anchor" href="{{route('userDeleteNotice', ['userID'=>auth()->user()->id])}}">유저 탈퇴</x-dropdown-item>
                        </x-dropdown>
                        <form id="logout-form" method="POST" action="{{route('logout', ['userID'=>auth()->user()->id])}}" class="hidden">
                            @csrf
                        </form>
                        @else
                            <a dusk="login-anchor" href="{{route('login')}}" class="whitespace-nowrap text-base font-medium text-gray-500 hover:text-gray-900">
                                로 그 인
                            </a>
                            <a dusk="register-anchor" href="{{route('register')}}" class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                                회 원 가 입
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="sliderOverlay" class="hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
        <div id="bgOverlay" class="absolute inset-0 overflow-hidden">
          <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
          <div id="slideOver" class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
            <div id="closeBtn" class="pointer-events-auto relative w-screen max-w-md">
              <div class="absolute top-0 left-0 -ml-8 flex pt-4 pr-2 sm:-ml-10 sm:pr-4">
                <button id="btnClose" type="button" class="rounded-md text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-white" onclick="closeSlider()">
                  <span class="sr-only">Close panel</span>
                  <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
              <div class="flex h-full flex-col overflow-y-scroll bg-white py-6 shadow-xl">
                <div class="relative mt-6 flex-1 px-4 sm:px-6">
                    <aside class="w-64" aria-label="Sidebar">
                        <ul class="space-y-2">
                            <li>
                                <a href="{{route('home')}}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M7.825.12a.5.5 0 00-.65 0L0 6.27v7.23A1.5 1.5 0 001.5 15h4a.5.5 0 00.5-.5v-3a1.5 1.5 0 013 0v3a.5.5 0 00.5.5h4a1.5 1.5 0 001.5-1.5V6.27L7.825.12z" fill="currentColor"></path></svg>
                                    <span class="ml-3">홈페이지</span>
                                </a>
                            </li>
                            @auth
                            <li>
                                <div>
                                    <x-category-dropdown dusk="posts-dropdown" class="py-3"/>
                                </div>
                            </li>
                            <li>
                                <a target="blank" href="{{route('plantDict', ['userID'=>auth()->user()->id])}}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <div class="">
                                        <svg class="flex-shrink-0 w-6 h-6  text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M1.5 0a.5.5 0 00-.5.5v13a.5.5 0 00.5.5H3V0H1.5z" fill="currentColor"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M4 15h1v-1h6.5a2.5 2.5 0 002.5-2.5v-9A2.5 2.5 0 0011.5 0H4v15zm7-10H7V4h4v1z" fill="currentColor"></path></svg>
                                    </div>
                                    <span class="flex-1 ml-3 whitespace-nowrap">식물 도감</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('userEdit', ['userID'=>auth()->user()->id])}}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                                    <span class="flex-1 ml-3 whitespace-nowrap">사용자 정보 수정</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700" @click.prevent="document.querySelector('#mobile-logout-form').submit()" x-data={}>
                                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path></svg>
                                    <span class="flex-1 ml-3 whitespace-nowrap">로그아웃</span>
                                </a>
                                <form id="mobile-logout-form" method="POST" action="{{route('logout', ['userID'=>auth()->user()->id])}}" class="hidden">
                                    @csrf
                                </form>
                            </li>
                            <li>
                                <a href="{{route('userDeleteNotice', ['userID'=>auth()->user()->id])}}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg"><path d="M1.5 1.5l12 12m-12 0l12-12" stroke="currentColor"></path></svg>
                                    <span class="flex-1 ml-3 whitespace-nowrap">회원 탈퇴</span>
                                </a>
                            </li>
                            @else
                            <li>
                                <a href="{{route('login')}}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"></path></svg>
                                    <span class="flex-1 ml-3 whitespace-nowrap">로그인</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('register')}}" class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 4a3 3 0 00-3 3v6a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H5zm-1 9v-1h5v2H5a1 1 0 01-1-1zm7 1h4a1 1 0 001-1v-1h-5v2zm0-4h5V8h-5v2zM9 8H4v2h5V8z" clip-rule="evenodd"></path></svg>
                                    <span class="flex-1 ml-3 whitespace-nowrap">회원가입</span>
                                </a>
                            </li>
                            @endauth
                        </ul>
                    </aside>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</body>
