<x-layout>
</x-layout>
@auth
    @if(isset($arduinos))
        <x-mobile-grid :arduinos="$arduinos"/>
    @endif
@endauth
