<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Теория') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <div class="container">
        <div class="row">
            <div class="row py-10 bsb-timeline-1">
                <div class="col-md-3">
                    <div class="list-group bg-light" style="padding: 10px 10px 20px 10px">
                        <a style="border-color: #008000!important; background-color: #008000!important; margin: 10px 10px" href="{{route('note.create')}}" class=" btn btn-dark" aria-current="true">
                            Написать отчет
                        </a>

                        <ul class="timeline">
                            <li class="timeline-item">
                                <div class="timeline-body">
                                    <div class="timeline-content">
                                        <div class="card border-0">
                                            <div class="card-body p-1g">
                                                <h6 class="card-title p-1 text-secondary">Создания отчета</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="timeline-item">
                                <div class="timeline-body">
                                    <div class="timeline-content">
                                        <div class="card border-0">
                                            <div class="card-body p-1g">
                                                <h6 class="card-title p-1 text-secondary">Просмотр отчета</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="timeline-item">
                                <div class="timeline-body">
                                    <div class="timeline-content">
                                        <div class="card border-0">


                                            <div class="card-body p-1g">
                                                <h6 class="card-title p-1 text-secondary" >Оценка первого отчета</h6>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="timeline-item">
                                <div class="timeline-body">
                                    <div class="timeline-content">
                                        <div class="card border-0">


                                            <div class="card-body p-1g">
                                                <h6 class="card-title p-1 text-secondary" >Оценка второго отчета</h6>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid" style="        padding-left: 0;">
                            <div class="navbar-collapse" id="navbarNavAltMarkup">
                                <div class="navbar-nav fw-medium">
                                    <a class="nav-link {{in_array('dashboard' , explode('/', request()->url())) ? 'active text-decoration-underline' : ''}}"
                                       href="{{route('dashboard')}}">Отчеты</a>
                                    <a class="nav-link {{in_array('videos' , explode('/', request()->url())) ? 'active text-decoration-underline' : ''}}"
                                       href="{{route('video.index')}}">
                                        {{ __('Теория') }}
                                    </a>

                                    <a class="nav-link {{in_array('notes' , explode('/', request()->url())) ? 'active text-decoration-underline' : ''}}"
                                       href="{{route('note.index')}}">
                                        {{ __('Статистика') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </nav>
                    <br>
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 p-1 bg-white shadow sm:rounded-lg d-flex gap-3" >
                        <div class="p-2" style="width: 100%">
                            <img style="height: auto; width: 100%" src="{{asset('img/avatar.png')}}" alt="">
                        </div>
                        <div style="max-width: 500px">
                            <p class="h3">Теоретическая основа марафона</p>
                            Весь необходимый теоретический материал для успешного прохождения марафона собран в едином, удобном формате.
                            <br>   Самостоятельное изучение теории — это ваш первый шаг к успешному старту! <br>
                            Чтобы ознакомиться с материалами, пожалуйста, перейдите по ссылке ниже:
                            <br>
                            <br>
                            <a class="btn btn-dark" href="https://disk.yandex.ru/i/2syr_9FR1Wi_Rw">Нажмите сюда</a>
                            <br>
                            <br>
                            Изучите материалы до начала практических занятий, чтобы быть полностью подготовленными и получить максимальный результат от марафона.
                        </div>

                    </div>
                    @foreach($videos as $video)
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 p-1 bg-white shadow sm:rounded-lg">
                            @if($video->src)
                                <video style="width: 100%" controls loop muted>
                                    <source src="{{asset('storage/' . $video->src)}}" type="video/mp4"/>
                                </video>
                            @endif
                            @if($video->img)
                                <img src="{{asset('storage/' . $video->img)}}" style="padding: 10px; width: 100%"
                                     alt="">
                            @endif
                            <p>{!!$video->text!!}</p>
                        </div>
                    @endforeach
                </div>
            </div>

</x-app-layout>
