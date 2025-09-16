<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Просмотр отчета') }}
        </h2>

        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{asset('modules/rating_stars/main.css')}}" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="{{asset('modules/rating_stars/main.js')}}"></script>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form class="p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsive">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Книга</label>
                    <input readonly type="text" class="form-control" id="exampleFormControlInput1" name="book"
                           value="{{$note->book()->title}}">
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
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsive">
                <div class="mb-3">
                    <div class="card">
                        <div class="p-3">
                            <h6>Комментарии</h6>
                        </div>
                        @foreach($comments as $comment)
                            <div class="d-flex flex-row p-3">
                                <img src="{{asset('storage/' . $comment->user()->img)}}" width="100" height="100"
                                     class="rounded-circle mr-3">
                                <div class="w-100">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex flex-row align-items-center"><span
                                                class="mr-2">{{$comment->user()->name}}</span></div>
                                    </div>
                                    <p class="text-justify comment-text mb-0">{{$comment->text}}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <form class="p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsive" method="post" action="{{route('comment.store')}}">
             @csrf
                <input hidden="hidden" name="note_id" value="{{$note->id}}">
                <div class="form-group mt-3">
                    <label class="form-label">Ваша оценка</label>
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
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-dark">Отправить</button>
                </div>
            </form>
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
