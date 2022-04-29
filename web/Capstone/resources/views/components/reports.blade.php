<x-layout/>
<section class="px-6 py-8 flex md:items-center">
    <main class="max-w-7xl mx-auto px-4 sm:px-6">
        <form>
            <div class="w-full">
                <div class="bg-white divide-y divide-gray-200 shrink-0">
                <div class="items-center flex md:inline-block">
                    <div class="md:py-4">
                        <div class="flex items-center">
                            <input type="date" name="start_day" class="rounded-full">
                        </div>
                    </div>
                        <div class="px-3 md:py-4 content-center">
                            <input type="submit" value="조회" class="px-3 py-2 md:h-max rounded-full bg-blue-500 text-sm text-white">
                        </div>
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

<div>
    <div class="w-9/12 px-20">
        <canvas id="myChart" width="400" height="400"/>
    </div>
</div>

<script>
    let timedata = [];
    let sensordata = [];
    let devicewith = window.innerWidth;
    let pointsize = 0;
    if(devicewith>600)
        pointsize = 5;
    else
        pointsize = devicewith/100;

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
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            layout: {
                autoPadding : false
            }
        }
    });
    window.onresize = function(event){
        devicewith = window.innerWidth;
        if(devicewith>600)
            pointsize = 5;
        else
            pointsize = devicewith/100 - devicewith/100%1;
        console.log(pointsize);
        myChart.data.datasets.pointBorderWidth = pointsize;
    }
</script>

