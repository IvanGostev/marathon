<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Видео') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <div class="py-12">
        <div class="max-w-7xl mx-auto   rad-5 sm:px-6 lg:px-8 space-y-6 p-1" style="">
            <form action="{{route('admin.video.store')}}" class="row g-2 white p-2" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-auto border-5">
                    <input class="form-control"  name="file" type="file" id="formFile">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-dark mb-3">Добавить</button>
                </div>
            </form>
        </div>
        @foreach($videos as $video)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 p-1">
            <video style="width: 100%" controls loop muted>
                <source src="{{asset('storage/' . $video->src)}}" type="video/mp4"/>
            </video>
        </div>
            @endforeach
    </div>

</x-app-layout>
