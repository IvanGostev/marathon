<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Видео') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <div class="py-12">
        @foreach($videos as $video)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 p-1">
            <video style="width: 100%" controls loop muted>
                <source src="{{asset('storage/' . $video->src)}}" type="video/mp4"/>
            </video>
        </div>
            @endforeach
    </div>

</x-app-layout>
