<x-dropdown>
    <x-slot name="trigger">
        <button dusk="posts-dropdown-button" class="pl-3 pr-20 text-sm font-semibold w-full  text-left flex">
            <label class="text-base font-medium text-gray-500 hover:text-gray-900">
                컨텐츠
            </label>
            <x-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;"/>
        </button>
    </x-slot>

    <x-dropdown-item>컨텐츠<br/>1</x-dropdown-item>
    <x-dropdown-item>컨텐츠<br/>2</x-dropdown-item>
    <x-dropdown-item>컨텐츠<br/>3</x-dropdown-item>
    <x-dropdown-item>컨텐츠<br/>4</x-dropdown-item>
    <x-dropdown-item>컨텐츠<br/>5</x-dropdown-item>
</x-dropdown>
