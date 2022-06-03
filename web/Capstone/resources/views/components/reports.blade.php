<x-layout/>
<section class="px-6  sm:py-4 flex md:items-center">
    <main class="mx-auto px-4 sm:px-6">
        <form action="{{url()->current()}}">
            <div class="w-full">
                <div class="bg-white divide-y divide-gray-200 shrink-0">
                <div class="flex justify-center">
                    <div class="md:py-4">
                        <div class="">
                            <input type="date" name="start_day" class="rounded-full">
                        </div>
                    </div>
                        <div class="px-3 md:py-4">
                            <button class="px-3 py-2 md:h-max rounded-full bg-blue-500 text-sm text-white">조회</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @if ($errors -> any())             {{-- 한번에 에러 출력 --}}
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-red-500 text-xs">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </main>
</section>
@if(isset($arduinodatas))
<section class="sm:px-6">
    <div id="chart-container">
        <canvas id="myChart"/>
    </div>
</section>

<script>
    let timedata = [];
    let sensordata = [];
    let devicewith = window.innerWidth;
    let pointsize = 0;
    if(devicewith>600){
        pointsize = 5;
        document.getElementById('chart-container').style.width=window.innerWidth-100;
        document.getElementById('chart-container').style.height=window.innerHeight-200;
    }
    else{
        pointsize = devicewith/100;
        document.getElementById('chart-container').style.width=window.innerWidth-50;
        document.getElementById('chart-container').style.height=window.innerHeight-100;
    }

    @foreach ($arduinodatas as $data)
        timedata.push('{{$data->created_at->format('m-d g:i a')}}');
        sensordata.push('{{$data[$sensortype]}}');
    @endforeach

    let graphColor = ['rgba({{$graphcolor[0]}}, {{$graphcolor[1]}}, {{$graphcolor[2]}}, {{$graphcolor[3]}})'];

    for(let i=0; i<10; i++)
        graphColor.push('rgba('+ Math.random()*255 + ',' + Math.random()*255 + ',' + Math.random()*255 + ', 1)');

    const ctx = document.getElementById('myChart');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: timedata,
            datasets: [{
                label: '{{$label}}',
                data: sensordata,
                backgroundColor: graphColor,
                borderColor: graphColor,
                borderWidth: 2,
                pointBorderWidth : pointsize,
            }]
        },
        options: {
            maintainAspectRatio:false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
        }
    });
    window.onresize = function(event){
        devicewith = window.innerWidth;
        if(devicewith>600){
            pointsize = 5;
            document.getElementById('chart-container').style.width=window.innerWidth-100;
            document.getElementById('chart-container').style.height=window.innerHeight-200;
        }
        else{
            pointsize = devicewith/100 - devicewith/100%1;
            document.getElementById('chart-container').style.width=window.innerWidth-50;
            document.getElementById('chart-container').style.height=window.innerHeight-100;
        }
        console.log(pointsize);
        myChart.data.datasets.pointBorderWidth = pointsize;
    }
</script>

@endif
<div class="pt-4">
<x-footer/>
</div>
