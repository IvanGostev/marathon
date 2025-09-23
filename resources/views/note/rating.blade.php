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
                    <a style="border-color: #008000!important; background-color: #008000!important; margin: 10px 10px" href="{{route('note.create')}}" class=" btn btn-dark"
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
                                            <h6 class="card-title p-1 {{$number == 1? 'fw-medium' : 'text-secondary'}}">Оценка первого отчета</h6>
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
                                            <h6 class="card-title p-1 {{$number == 2? '' : 'text-secondary'}}">Оценка второго отчета</h6>
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
                    <form class="p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsive">
                        <div class="form-group mt-3">
                            <label class="form-label">{{$note->user()->name}}</label>
                            <img src="{{$note->user()->img ? asset('storage/' . $note->user()->img) : asset('img/ava.jpeg')}}" class="rounded-circle"
                                 style="width: 150px; height: 150px;"
                                 alt="Avatar"/>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Книга</label>
                            <input readonly type="text" class="form-control" id="exampleFormControlInput1" name="book"
                                   value="{{$note->mybook ?? $note->book()->title}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Название</label>
                            <input readonly type="text" class="form-control" id="exampleFormControlInput1" name="title"
                                   value="{{$note->title}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Отчет</label>
                            {!! $note->text !!}
                        </div>
                    </form>

                </div>
                <div class="mt-2 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <form class="p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsive" method="post"
                          action="{{route('comment.store')}}">
                        @csrf
                        <input hidden="hidden" name="note_id" value="{{$note->id}}">
                        <div class="form-group mt-3">
                            <label class="form-label">{{auth()->user()->name}}</label>
                            <img src="{{auth()->user()->img ? asset('storage/' . auth()->user()->img) : asset('img/ava.jpeg')}}" class="rounded-circle"
                                 style="width: 150px; height: 150px;"
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
                        <div class="form-group mt-3">
                            <label class="form-label">Ваш отзыв</label>
                            <textarea class="form-control" name="text" rows="5"
                                      placeholder="Поделитесь своими впечатлениями"></textarea>
                        </div>
                        <input type="text" hidden name="number" value="{{$number ?? 1}}">
                        <div class="form-group mt-3">
                            <div style="display: flex; justify-content: space-between">
                                <a href="{{$number == 1? route('note.rating', 2) : route('note.index')}}"  type="submit" name="skipping " value="back" class="btn btn-dark mt-3">Пропустить</a>

                                <button  type="submit" class="btn btn-dark mt-3">Отправить на проверку</button>
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
</x-app-layout>
