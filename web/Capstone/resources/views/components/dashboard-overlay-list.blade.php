<div class="grid grid-cols-1 mb-4 md:justify-start md:space-x-10">
<div class="justify-between items-center bg-white shadow overflow-hidden sm:rounded-lg md:justify-start md:space-x-10 px-4">
    <div class="px-4 py-2 sm:px-6 md:px-8 lg:px-10">
      <h3 class="text-lg leading-6 font-medium text-gray-900">최신 {{$arduinos->plant()->first()->plantname}} 측정 기록</h3>
      <p class="mt-1 max-w-2xl text-sm text-gray-500">{{$arduinos->updated_at}}</p>
    </div>
    <div class="border-t border-gray-200">
        <dl>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">습도</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$arduinos->humidity}}%</dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">온도</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$arduinos->temp}}°C</dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">토양 습도</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$arduinos->humidity_soil}}%</dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">조도</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$arduinos->illuminance}}Ev</dd>
            </div>
        </dl>
    </div>
  </div>
</div>
