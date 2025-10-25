<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="margin-bottom: 0">
            {{ __('Статистика') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link
        href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap"
        rel="stylesheet"
    />

    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />

    <link rel="stylesheet" href="{{asset('calendare/css/style.css')}}"/>
    <link href="
https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css
" rel="stylesheet">
    <div class="container ">

        <div class="row py-10 bsb-timeline-1">
            <div class="col-md-3">
                <div class="list-group bg-light" style="padding: 10px 10px 20px 10px">
                    <a style="border-color: #008000!important; background-color: #008000!important; margin: 10px 10px"
                       href="{{route('note.create')}}" class=" btn btn-dark" aria-current="true">
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
                                            <h6 class="card-title p-1 text-secondary">Оценка первого отчета</h6>
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
                                            <h6 class="card-title p-1 text-secondary">Оценка второго отчета</h6>
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
                    <div class="calendar calendar-first" id="calendar_first">
                        <div class="calendar_header">
                            <button class="switch-month switch-left">
                                <i class="fa fa-chevron-left"></i>
                            </button>
                            <h2></h2>
                            <button class="switch-month switch-right">
                                <i class="fa fa-chevron-right"></i>
                            </button>
                        </div>
                        <div class="calendar_weekdays"></div>
                        <div class="calendar_content"></div>
                    </div>
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsive">
                        <div>
                            <button data-bs-toggle="modal" data-bs-target="#staticAllWord" style="display: flex; gap: 10px; background: rgb(68, 68, 68); color: white; align-items: center;"
                               type="button" href="{{route('file.all', auth()->user()->id)}}" class="mb-3 btn">
                                <img style="width: 30px; height: 30px" src="{{asset('img/word.svg')}}" alt="">Выгрузить
                                все отчеты в один файл</button>

                        </div>
                        <br>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Название</th>
                                <th scope="col">Статус</th>
                                <th scope="col">Дата создания</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($notes as $note)
                                <tr>
                                    <th>{{$note->title}}</th>
                                    <td>{{$note->status == 'moderation' ? 'Модерация' : ($note->status == 'approve' ? 'Одобрено' : 'Не прошел проверку')}}</td>
                                    <td>{{$note->created_at}}</td>
                                    {{--                                    <td>--}}
                                    {{--                                        <nav class="menu">--}}
                                    {{--                                            <input type="checkbox" href="#" class="menu-open" name="menu-open"--}}
                                    {{--                                                   id="menu-open" style="z-index: 1000!important"/>--}}
                                    {{--                                            <label class="menu-open-button" style="z-index: 1000!important" for="menu-open">--}}
                                    {{--                                                <i class="fa fa-share-alt share-icon"></i>--}}
                                    {{--                                            </label>--}}

                                    {{--                                            <a href="https://www.facebook.com" target="_blank"--}}
                                    {{--                                               style="z-index: 100" class="menu-item facebook_share_btn"> <i class="fa fa-facebook"></i> </a>--}}
                                    {{--                                            <a href="https://www.twitter.com" target="_blank"--}}
                                    {{--                                               style="z-index: 100" class="menu-item twitter_share_btn"> <i class="fa fa-twitter"></i> </a>--}}
                                    {{--                                            <a href="https://www.pinterest.com" target="_blank"--}}
                                    {{--                                               style="z-index: 100" class="menu-item pinterest_share_btn"> <i class="fa fa-pinterest"></i>--}}
                                    {{--                                            </a>--}}
                                    {{--                                            <a href="https://www.youtube.com" target="_blank"--}}
                                    {{--                                               style="z-index: 100" class="menu-item youtube_share_btn"> <i class="fa fa-youtube"></i> </a>--}}
                                    {{--                                            <a href="https://www.tumblr.com" target="_blank"--}}
                                    {{--                                               style="z-index: 100" class="menu-item tumblr_share_btn">--}}
                                    {{--                                                <i class="fa fa-tumblr"></i> </a>--}}
                                    {{--                                            <a href="https://plus.google.com" target="_blank"--}}
                                    {{--                                               style="z-index: 100" class="menu-item google_plus_share_btn"> <i--}}
                                    {{--                                                    class="fa fa-google-plus"></i> </a>--}}
                                    {{--                                        </nav>--}}
                                    {{--                                    </td>--}}
                                    <td>
                                        <a type="button" href="{{route('note.view', $note->id)}}" class="btn btn-dark">Подробнее</a>
                                    </td>
                                    <td>
                                        <button id="{{$note->id}}" data-bs-toggle="modal" data-bs-target="#staticWord"  style="display: flex; gap: 10px" type="button"
                                           href="" class="btn btn-dark">
                                            <img style="width: 20px; height: 20px" src="{{asset('img/word.svg')}}"
                                                 alt="">Word</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <style>


        @media screen and (max-width: 700px) {

        }

        a {
            color: inherit;
        }

        .menu-item,
        .menu-open-button {
            background: #EEEEEE;
            border-radius: 100%;
            width: 35px;
            height: 35px;
            position: absolute;
            color: #FFFFFF;
            text-align: center;
            line-height: 20px;
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
            -webkit-transition: -webkit-transform ease-out 200ms;
            transition: -webkit-transform ease-out 200ms;
            transition: transform ease-out 200ms;
            transition: transform ease-out 200ms, -webkit-transform ease-out 200ms;
        }

        .menu-open {
            display: none;
        }

        .menu {
            margin: auto;

            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            width: 35px;
            height: 35px;
            text-align: center;
            box-sizing: border-box;
            font-size: 14px;
        }

        .share-icon {
            color: #596778;
            /*background color*/
        }

        .menu-item:hover {
            background: #EEEEEE;
            color: #3290B1;
        }

        .menu-item:nth-child(3) {
            -webkit-transition-duration: 180ms;
            transition-duration: 180ms;
        }

        .menu-item:nth-child(4) {
            -webkit-transition-duration: 180ms;
            transition-duration: 180ms;
        }

        .menu-item:nth-child(5) {
            -webkit-transition-duration: 180ms;
            transition-duration: 180ms;
        }

        .menu-item:nth-child(6) {
            -webkit-transition-duration: 180ms;
            transition-duration: 180ms;
        }

        .menu-item:nth-child(7) {
            -webkit-transition-duration: 180ms;
            transition-duration: 180ms;
        }

        .menu-item:nth-child(8) {
            -webkit-transition-duration: 180ms;
            transition-duration: 180ms;
        }

        .menu-item:nth-child(9) {
            -webkit-transition-duration: 180ms;
            transition-duration: 180ms;
        }

        .menu-open-button {
            z-index: 2;
            -webkit-transition-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transition-timing-function: cubic-bezier(0.175, 0.885, 0.32, 1.275);
            -webkit-transition-duration: 400ms;
            transition-duration: 400ms;
            -webkit-transform: scale(1.1, 1.1) translate3d(0, 0, 0);
            transform: scale(1.1, 1.1) translate3d(0, 0, 0);
            cursor: pointer;
            box-shadow: 3px 3px 0 0 rgba(0, 0, 0, 0.14);
        }

        .menu-open-button:hover {
            -webkit-transform: scale(1.2, 1.2) translate3d(0, 0, 0);
            transform: scale(1.2, 1.2) translate3d(0, 0, 0);
        }

        .menu-open:checked + .menu-open-button {
            -webkit-transition-timing-function: linear;
            transition-timing-function: linear;
            -webkit-transition-duration: 200ms;
            transition-duration: 200ms;
            -webkit-transform: scale(0.8, 0.8) translate3d(0, 0, 0);
            transform: scale(0.8, 0.8) translate3d(0, 0, 0);
        }

        .menu-open:checked ~ .menu-item {
            -webkit-transition-timing-function: cubic-bezier(0.935, 0, 0.34, 1.33);
            transition-timing-function: cubic-bezier(0.935, 0, 0.34, 1.33);
        }

        .menu-open:checked ~ .menu-item:nth-child(3) {
            transition-duration: 180ms;
            -webkit-transition-duration: 180ms;
            -webkit-transform: translate3d(0.08361px, -104.99997px, 0);
            transform: translate3d(0.08361px, -104.99997px, 0);
        }

        .menu-open:checked ~ .menu-item:nth-child(4) {
            transition-duration: 280ms;
            -webkit-transition-duration: 280ms;
            -webkit-transform: translate3d(90.9466px, -52.47586px, 0);
            transform: translate3d(90.9466px, -52.47586px, 0);
        }

        .menu-open:checked ~ .menu-item:nth-child(5) {
            transition-duration: 380ms;
            -webkit-transition-duration: 380ms;
            -webkit-transform: translate3d(90.9466px, 52.47586px, 0);
            transform: translate3d(90.9466px, 52.47586px, 0);
        }

        .menu-open:checked ~ .menu-item:nth-child(6) {
            transition-duration: 480ms;
            -webkit-transition-duration: 480ms;
            -webkit-transform: translate3d(0.08361px, 104.99997px, 0);
            transform: translate3d(0.08361px, 104.99997px, 0);
        }

        .menu-open:checked ~ .menu-item:nth-child(7) {
            transition-duration: 580ms;
            -webkit-transition-duration: 580ms;
            -webkit-transform: translate3d(-90.86291px, 52.62064px, 0);
            transform: translate3d(-90.86291px, 52.62064px, 0);
        }

        .menu-open:checked ~ .menu-item:nth-child(8) {
            transition-duration: 680ms;
            -webkit-transition-duration: 680ms;
            -webkit-transform: translate3d(-91.03006px, -52.33095px, 0);
            transform: translate3d(-91.03006px, -52.33095px, 0);
        }

        .menu-open:checked ~ .menu-item:nth-child(9) {
            transition-duration: 780ms;
            -webkit-transition-duration: 780ms;
            -webkit-transform: translate3d(-0.25084px, -104.9997px, 0);
            transform: translate3d(-0.25084px, -104.9997px, 0);
        }

        .facebook_share_btn {
            background-color: #3b5998;
            box-shadow: 3px 3px 0 0 rgba(0, 0, 0, 0.14);
            text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.12);
        }

        .facebook_share_btn:hover {
            color: #3b5998;
            text-shadow: none;
        }

        .twitter_share_btn {
            background-color: #00aced;
            box-shadow: 3px 3px 0 0 rgba(0, 0, 0, 0.14);
            text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.12);
        }

        .twitter_share_btn:hover {
            color: #00aced;
            text-shadow: none;
        }

        .google_plus_share_btn {
            background-color: #dd4b39;
            box-shadow: 3px 3px 0 0 rgba(0, 0, 0, 0.14);
            text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.12);
        }

        .google_plus_share_btn:hover {
            color: #dd4b39;
            text-shadow: none;
        }

        .youtube_share_btn {
            background-color: #bb0000;
            box-shadow: 3px 3px 0 0 rgba(0, 0, 0, 0.14);
            text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.12);
        }

        .youtube_share_btn:hover {
            color: #bb0000;
            text-shadow: none;
        }

        .pinterest_share_btn {
            background-color: #cb2027;
            box-shadow: 3px 3px 0 0 rgba(0, 0, 0, 0.14);
            text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.12);
        }

        .pinterest_share_btn:hover {
            color: #cb2027;
            text-shadow: none;
        }

        .tumblr_share_btn {
            background-color: #32506d;
            box-shadow: 3px 3px 0 0 rgba(0, 0, 0, 0.14);
            text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.12);
        }

        .tumblr_share_btn:hover {
            color: #32506d;
            text-shadow: none;
        }

        .fa {
            padding-top: 10px;
        }
    </style>


    <script src="{{ asset('calendare/js/jquery.min.js')}}"></script>
    <script src="{{ asset('calendare/js/popper.js')}}"></script>
    <script src="{{ asset('calendare/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('calendare/js/main.js')}}"></script>
    <script>

        function checkGreen(e) {
            var checkingDate =
                e.getFullYear() + "/" + (e.getMonth() + 1) + "/" + e.getDate();
            var datesGreen = [
                @foreach ($dates as $date)
                    '{{      $date->year . '/'.  $date->month . '/' . $date->day}}',

                @endforeach
            ];
            return datesGreen.includes(checkingDate);
        }

        // function checkRed(e) {
        //     var checkingDate =
        //         e.getFullYear() + "/" + (e.getMonth() + 1) + "/" + e.getDate();
        //     var datesGreen = ["2025/8/3", "2025/8/5", "2025/8/"];
        //     return datesGreen.includes(checkingDate);
        // }
    </script>




    <!-- Modal -->
    <div class="modal fade" id="staticWord" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" action="{{route('file.download')}}" method="post">
                @csrf
                <input type="text"  class="hidden modal-content-note-id" name="note_id"  value="">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Выберите части</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-check">
                        <input class="form-check-input" name="book" type="checkbox" value="book" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Название: книги(курса, урока....)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="title" type="checkbox" value="title" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Раздел
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="text" value="text" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Отчет
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="results" value="results" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Итоги
                        </label>
                    </div>
                    <div class="form-check">
                        <input  class="form-check-input" type="checkbox" name="go" value="go" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Действуй
                        </label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Скачать</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="staticAllWord" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{route('file.all')}}" method="post" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Выберите части</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="flexCheckDefault">
                            Выберите диапазон дат
                        </label>
                    <input type="text" name="daterange" value="" />

                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="book" type="checkbox" value="book" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Названии: книги(курса, урока....)
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" name="title" type="checkbox" value="title" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Разделы
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="text" value="text" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Отчеты
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="results" value="results" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Итоги
                        </label>
                    </div>
                    <div class="form-check">
                        <input  class="form-check-input" type="checkbox" name="go" value="go" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Действия
                        </label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Скачать</button>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script>
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left',
                locale: {
                    "format": "MM/DD/YYYY",
                    "separator": " - ",
                    "applyLabel": "Сохранить",
                    "cancelLabel": "Назад",
                    "daysOfWeek": [
                        "Вс",
                        "Пн",
                        "Вт",
                        "Ср",
                        "Чт",
                        "Пт",
                        "Сб"
                    ],
                    "monthNames": [
                        "Январь",
                        "Февраль",
                        "Март",
                        "Апрель",
                        "Май",
                        "Июнь",
                        "Июль",
                        "Август",
                        "Сентябрь",
                        "Октябрь",
                        "Ноябрь",
                        "Декабрь"
                    ],
                }
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
        $('[data-bs-target="#staticWord"]').click((e) => {
            $('[name="note_id" ]').val($(e.target).attr('id'))
        })
    </script>
</x-app-layout>
