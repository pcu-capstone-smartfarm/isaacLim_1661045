<x-layout>
</x-layout>
<section id="mainFrame" class="px-6  sm:py-4 flex md:items-center">
    <main class="mx-auto px-4 sm:px-6">
        <div>
            <h1>{{$user->nickname}}님의 식물 {{$plant->plantname}}는 {{$plant->nongsaro_gardenlists->cntntsSj}}입니다.</h1>
            <h1>{{$plant->nongsaro_gardenlists->cntntsSj}} 관련 정보<br>
                @if ($plant->nongsaro_gardenlists->gardendtl->adviseInfo!=null)
                    {{$plant->nongsaro_gardenlists->gardendtl->adviseInfo}}
                @elseif ($plant->nongsaro_gardenlists->gardendtl->fncltyInfo!=null)
                    - {{$plant->nongsaro_gardenlists->gardendtl->fncltyInfo}}
                @else
                    관련된 정보가 아직 없습니다!
                @endif
            </h1>
            <h1>{{$plant->nongsaro_gardenlists->cntntsSj}}는 {{$plant->nongsaro_gardenlists->gardendtl->postngplaceCodeNm}}에 배치하는것이 적당합니다.</h1>
            <h1>{{$plant->nongsaro_gardenlists->cntntsSj}}는 {{$plant->nongsaro_gardenlists->gardendtl->dlthtsCodeNm}} 병충해를 조심해야 합니다.</h1>
        </div>
        <div>
            <div class="max-w-full mx-auto">
                <div class="max-w-full mx-auto py-2">
                    <h2 class="text-2xl font-extrabold text-gray-900 border-t border-gray-200 mt-2 pt-2">일일 일지</h2>
                    <div class="mt-6 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-x-6 lg:gap-y-4">

                        {{-- foreach($files as $file) --}}
                        @for ($i=0; $i<3; $i++)
                        <div class="group relative">
                            <div class="relative w-full h-80 bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                                {{-- src = {{env('AWS_CLOUDFRONT_S3_URL').'/'.$file->path}} --}}
                                <img src="https://tailwindui.com/img/ecommerce-images/home-page-02-edition-01.jpg" alt="Desk with leather desk pad, walnut desk organizer, wireless keyboard and mouse, and porcelain mug." class="w-full h-full object-center object-cover">
                            </div>
                        <h3 class="mt-6 text-sm text-gray-500">
                            <span class="absolute inset-0"></span>
                            {{-- $file->created_at->format('y-m-d') --}}
                            날짜 1
                        </h3>
                            {{-- $json->body --}}
                            <p class="text-base font-semibold text-gray-900">질병 정보 1</p>
                            <p class="text-base font-semibold text-gray-900">질병 정보 2</p>
                        </div>

                    <div class="group relative">
                        <div class="relative w-full h-80 bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                            <img src="https://tailwindui.com/img/ecommerce-images/home-page-02-edition-02.jpg" alt="Wood table with porcelain mug, leather journal, brass pen, leather key ring, and a houseplant." class="w-full h-full object-center object-cover">
                        </div>
                        <h3 class="mt-6 text-sm text-gray-500">
                            <span class="absolute inset-0"></span>
                            날짜 1
                        </h3>
                            <p class="text-base font-semibold text-gray-900">질병 정보 1</p>
                            <p class="text-base font-semibold text-gray-900">질병 정보 2</p>
                    </div>

                    <div class="group relative">
                        <div class="relative w-full h-80 bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                            <img src="https://tailwindui.com/img/ecommerce-images/home-page-02-edition-03.jpg" alt="Collection of four insulated travel bottles on wooden shelf." class="w-full h-full object-center object-cover">
                        </div>
                        <h3 class="mt-6 text-sm text-gray-500">
                            <span class="absolute inset-0"></span>
                            날짜 1
                        </h3>
                            <p class="text-base font-semibold text-gray-900">질병 정보 1</p>
                            <p class="text-base font-semibold text-gray-900">질병 정보 2</p>
                    </div>
                    @endfor
                    </div>
                    <!-- pagination -->
                </div>
            </div>
        </div>
        <div class="pt-4">
        <x-footer/>
        </div>
    </main>
</section>
