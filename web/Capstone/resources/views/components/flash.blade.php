@if (session()->has('success'))
    <div dusk="index-flash" x-data="{ show : true }"
        x-init="setTimeout(()=> show = false, 4000)"
        x-show="show"
        class="fixed bg-blue-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm"
    >
        <p>{{ session('success') }}</p>        {{--{{session()->get('success')}}--}}
    </div>
@endif
@if (session()->has('fail'))
    <div dusk="index-flash" x-data="{ show : true }"
        x-init="setTimeout(()=> show = false, 4000)"
        x-show="show"
        class="fixed bg-red-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm"
    >
        <p>{{ session('fail') }}</p>        {{--{{session()->get('fail')}}--}}
    </div>
@endif
