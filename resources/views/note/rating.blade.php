<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Просмотр отчета') }}
        </h2>

        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{asset('modules/rating_stars/main.css')}}"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="{{asset('modules/rating_stars/main.js')}}"></script>
    </x-slot>
    <div class="container">
        <div class="row py-10 bsb-timeline-1">
            <div class="col-md-3">
                <div class="list-group bg-light" style="padding: 10px 10px 20px 10px">
                    <a style="border-color: #008000!important; background-color: #008000!important; margin: 10px 10px"
                       href="{{route('note.create')}}" class=" btn btn-dark"
                       aria-current="true">
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
                                            <h6 class="card-title p-1 {{$number == 1? 'fw-medium' : 'text-secondary'}}">
                                                Оценка первого отчета</h6>
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
                                            <h6 class="card-title p-1 {{$number == 2? '' : 'text-secondary'}}">Оценка
                                                второго отчета</h6>
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
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsive">
                        <div class="form-group mt-3 d-flex gap-3" style="align-items: center;">
                            <img
                                src="{{$note->user()->img ? asset('storage/' . $note->user()->img) : asset('img/ava.jpeg')}}"
                                class="rounded-circle"
                                style="width: 70px; height: 70px;"
                                alt="Avatar"/>
                            <label class="form-label h5">{{$note->user()->name}}</label>
                        </div>
                        <br>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label h6">Название: книги(курса,
                                урока....)</label>
                            <input readonly type="text" class="form-control" id="exampleFormControlInput1" name="book"
                                   value="{{($note->mybook ?? ($note->book()->title ?? '-'))}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label h6">Раздел</label>
                            <input readonly type="text" class="form-control" id="exampleFormControlInput1" name="title"
                                   value="{{$note->title}}">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label h6">Отчет</label>
                            {!! $note->text !!}
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label h6">Итоги</label>
                            {!! $note->text !!}

                        </div>
                        @if(!$note->files()->isEmpty())
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label h6">Перескажи вслух</label>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Файл</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($note->files() as $file)
                                        <tr>
                                            <th scope="row">{{isset($count) ? $count = $count+1 : $count = 1}}</th>
                                            <td>
                                                <a target="_blank" href="{{asset('storage/'. $file->src)}}"
                                                   class="btn  btn-outline-dark">Посмотреть
                                                    вложение</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label h6">Действуй</label>
                            <p>{{$note->go}}</p>
                        </div>
                    </div>

                </div>
                <div class="mt-2 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <form class="p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsive" method="post"
                          action="{{route('comment.store')}}">
                        @csrf
                        <input hidden="hidden" name="note_id" value="{{$note->id}}">
                        <div class="form-group mt-3">
                            <label class="form-label">{{auth()->user()->name}}</label>
                            <img
                                src="{{auth()->user()->img ? asset('storage/' . auth()->user()->img) : asset('img/ava.jpeg')}}"
                                class="rounded-circle"
                                style="width: 70px; height: 70px;"
                                alt="Avatar"/>
                        </div>
                        <div class="form-group mt-3">

                            <label class="form-label">Оценка</label>
                            <div class="star-box">
                                <div class="star">
                                    <input
                                        class="star-input"
                                        type="radio"
                                        id="st-1"
                                        value="1"
                                        name="stars"
                                        autocomplete="off"/>

                                    <div class="star-shape"></div>

                                </div>
                                <div class="star">
                                    <input
                                        class="star-input"
                                        type="radio"
                                        id="st-2"
                                        value="2"
                                        name="stars"
                                        autocomplete="off"
                                    />

                                    <div class="star-shape"></div>

                                </div>
                                <div class="star">
                                    <input
                                        class="star-input"
                                        type="radio"
                                        id="st-3"
                                        value="3"
                                        name="stars"
                                        autocomplete="off"
                                    />

                                    <div class="star-shape"></div>

                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3" style="position: relative; ">
                            <label class="form-label">Ваш отзыв</label>
                            <div style="position: absolute; bottom: 0; right: 0" class="emoji">
                                <span>🙂</span>
                                <div id="emoji-picker">
                                    <div class="emoji-arrow"></div>
                                </div>
                            </div>
                            <textarea id="text-area" class="form-control" name="text" rows="5"
                                      placeholder="Поделитесь своими впечатлениями"></textarea>

                        </div>
                        <input type="text" hidden name="number" value="{{$number ?? 1}}">
                        <div class="form-group mt-3">
                            <div style="display: flex; justify-content: space-between">
                                <a href="{{$number == 1? route('note.rating', 2) : route('note.index')}}" type="submit"
                                   name="skipping " value="back" class="btn btn-dark mt-3">Пропустить</a>

                                <button type="submit" class="btn btn-dark mt-3">Отправить на проверку</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <style>

            .star-rating {
                font-size: 0;
            }

            .star-rating__wrap {
                display: inline-block;
                font-size: 1rem;
            }

            .star-rating__wrap:after {
                content: "";
                display: table;
                clear: both;
            }

            .star-rating__ico {
                float: right;
                padding-left: 2px;
                cursor: pointer;
                color: #FFB300;
            }

            .star-rating__ico:last-child {
                padding-left: 0;
            }

            .star-rating__input {
                display: none;
            }

            .star-rating__ico:hover:before,
            .star-rating__ico:hover ~ .star-rating__ico:before,
            .star-rating__input:checked ~ .star-rating__ico:before {
                content: "\f005";
            }

        </style>


        <!-- this script is provided by https://www.htmlfreecode.com coded by: Kerixa Inc. -->
        <style>
            body {
                background: linear-gradient(313deg, rgba(238, 238, 238, 1) 0%, rgba(240, 239, 210, 1) 100%);
            }

            * {
                box-sizing: border-box;
            }

            .center {
                position: absolute;
                top: 50%;
                left: 50%;
                -ms-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
            }

            /*.container {*/
            /*    display: flex;*/
            /*    justify-content: center;*/
            /*    align-items: center;*/
            /*}*/

            .emoji {
                font-size: 30px;
                position: relative;
                cursor: pointer;
                margin-left: 10px;
            }

            .emoji > span {
                padding: 10px;
                border: 1px solid transparent;
                transition: 100ms linear;
            }

            .emoji span:hover {
                background-color: #fff;
                border-radius: 4px;
                border: 1px solid #e7e7e7;
                box-shadow: 0 7px 14px 0 rgb(0 0 0 / 12%);
            }

            #emoji-picker {
                padding: 6px;
                font-size: 20px;
                z-index: 1;
                position: absolute;
                display: none;
                width: 189px;
                border-radius: 4px;
                top: 53px;
                right: 0;
                background: #fff;
                border: 1px solid #e7e7e7;
                box-shadow: 0 7px 14px 0 rgb(0 0 0 / 12%);
            }

            #emoji-picker span {
                cursor: pointer;
                width: 35px;
                height: 35px;
                display: inline-block;
                text-align: center;
                padding-top: 4px;
            }

            #emoji-picker span:hover {
                background-color: #e7e7e7;
                border-radius: 4px;
            }

            .emoji-arrow {
                position: absolute;
                width: 0;
                height: 0;
                top: 0;
                right: 18px;
                box-sizing: border-box;
                border-color: transparent transparent #fff #fff;
                border-style: solid;
                border-width: 4px;
                transform-origin: 0 0 0;
                transform: rotate(135deg);
            }

            #text-area {
                font-family: sans-serif, monospace;
                font-size: 20px;
                min-height: 40px;
                min-width: 500px;
                border-radius: 10px;
                padding: 20px;
                border: 1px solid #c1c1c1;
            }

            /******************************/

            .creator {
                position: fixed;
                right: 5px;
                top: 5px;
                font-size: 13px;
                font-family: sans-serif;
                text-decoration: none;
                color: #111;
            }

            .creator:hover {
                color: deeppink;
            }

            .creator i {
                font-size: 12px;
                color: #111;
            }
        </style>
        <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
        <div class="center">
            {{--            <div class="container">--}}
            {{--                <textarea required  name="message" placeholder="write..."></textarea>--}}
            {{--           --}}
            {{--            </div>--}}
        </div>
        <script>


            let emojiPicker = function () {
                let i = null;
                let index = null;
                let emojiCode = [
                    128077,
                    128150,
                    128578,
                    128525,
                    128079,
                    128588,
                    11088,
                    128293,
                    127881,
                    128175
                ];

                for (index = 0; index <= emojiCode.length - 1; index++) {
                    document.querySelector("#emoji-picker").innerHTML += "<span class='my-emoji'>" + "&#" + emojiCode[index] + "</span>";
                }

                $(document).on("click", ".my-emoji", function () {
                    let textArea = $('#text-area');
                    textArea.val(textArea.val() + $(this).text());
                    $("#emoji-picker").hide();
                    textArea.focus();
                });
            }

            emojiPicker();

            $(".emoji").click(function (e) {
                e.preventDefault();
                $("#emoji-picker").toggle();
            });
        </script>


</x-app-layout>
