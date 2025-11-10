<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Просмотр поста') }}
        </h2>

        <style>
            @font-face {
                font-family: "Roboto";
                src: url({{asset('font/Roboto.ttf')}});
            }
        </style>          </x-slot>
    <div class="py-12" style="font-family: 'Roboto'">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form class="p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsive">
                <div class="mb-3">
                    <p class="h3">{{$post->title}}</p>
                </div>
                <div class="mb-3" style="  font-family: 'Roboto', sans-serif;!important">
                    {!! $post->text !!}
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
                                <img style="object-fit: cover" src="{{$comment->user()->img ? asset('storage/' . $comment->user()->img) : asset('img/ava.jpeg')}}" width="100" height="100"
                                     class="rounded-circle mr-3">
                                <div class="w-100">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex flex-row align-items-center"><span
                                                class="mr-2" style="font-weight: 500">{{$comment->user()->name}}</span></div>
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
                <input hidden="hidden" name="post_id" value="{{$post->id}}">
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
