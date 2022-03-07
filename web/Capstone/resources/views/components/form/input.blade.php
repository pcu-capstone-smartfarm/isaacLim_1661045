@props(['name'])

<x-form.field>
    <x-form.label name="{{$name}}" />

    <input class="border border-gray-200 p-2 w-full rounded"
            name="{{ $name }}"
            id="{{ $name }}"
            {{$attributes(['value' => old($name)])}}        {{-- old() 이전 request에서 저장된 입력값 조회(세션에서 불러옴) --}}
    >

    <x-form.error name={{$name}} />
</x-form.field>
