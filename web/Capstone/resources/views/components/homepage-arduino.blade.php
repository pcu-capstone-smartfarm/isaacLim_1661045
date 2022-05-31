<x-layout>
</x-layout>
@auth
    @if(isset($arduinos))
    <div class="h-auto min-h-full">
        <x-mobile-grid :arduinos="$arduinos"/>
    </div>
    @endif
@endauth
<x-footer/>
