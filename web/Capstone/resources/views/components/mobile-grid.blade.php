<div class="max-w-6xl mx-auto">
<div class="grid md:justify-start md:space-x-10 px-4">
    <main class="max-w-6xl mt-4 lg:mt-20 space-y-6">
        <div class="grid grid-cols-2 md:grid md:grid-cols-4">
            {{-- 온도 --}}
            <div>
                <article class='transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl'>
                    <a href="{{route('reports_temp', ['userID'=>auth()->user()->id])}}">
                        <img class="w-64" src="{{asset('images/temp.png')}}" alt="temp"/>
                        <p class="text-center">온도</p>
                    </a>
                </article>
            </div>

            {{-- 습도 --}}
            <div>
                <article class='transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl'>
                    <a href="{{route('reports_humidity', ['userID'=>auth()->user()->id])}}">
                        <img class="w-64" src="{{asset('images/air_fill.png')}}" alt="humidity"/>
                        <p class="text-center">습도</p>
                    </a>
                </article>
            </div>

            {{-- 조도 --}}
            <div>
                <article class='transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl'>
                    <a href="{{route('reports_illuminance', ['userID'=>auth()->user()->id])}}">
                        <img class="w-64" src="{{asset('images/light.png')}}" alt="illuminance"/>
                        <p class="text-center">조도</p>
                    </a>
                </article>
            </div>

            {{-- 토양 습도 --}}
            <div>
                <article class='transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl'>
                    <a href="{{route('reports_humidity_soil', ['userID'=>auth()->user()->id])}}">
                        <img class="w-64" src="{{asset('images/water_drop.png')}}" alt="soil_humidity"/>
                        <p class="text-center">토양 습도</p>
                    </a>
                </article>
            </div>
        </div>
    </main>
</div>
</div>
<div class="max-w-6xl mx-auto mt-5">
    @if (isset($arduinos))
        <x-dashboard-overlay-list :arduinos="$arduinos"></x-dashboard-overlay-list>
    @endif
</div>
