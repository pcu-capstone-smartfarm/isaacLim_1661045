<x-dropdown>
    <x-slot name="trigger">
        <button dusk="posts-dropdown-button" class="pl-3 pr-20 text-sm font-semibold w-full  text-left flex">
            <label class="text-base font-medium text-gray-500 hover:text-gray-900">
                상세 기록
            </label>
            <x-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;"/>
        </button>
    </x-slot>

    <x-dropdown-item href="{{route('reports_temp', ['userID'=>auth()->user()->id])}}">온도</x-dropdown-item>
    <x-dropdown-item href="{{route('reports_humidity', ['userID'=>auth()->user()->id])}}">습도</x-dropdown-item>
    <x-dropdown-item href="{{route('reports_illuminance', ['userID'=>auth()->user()->id])}}">조도</x-dropdown-item>
    <x-dropdown-item href="{{route('reports_humidity_soil', ['userID'=>auth()->user()->id])}}">토양습도</x-dropdown-item>
</x-dropdown>
