<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Личный блог') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet"
          type="text/css"/>
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
    <script src="{{ asset('ru/ru.js')}}"></script>
    <section>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4 align-items-center justify-content-center">
                        <div class="card-body text-center align-items-center justify-content-center">
                            <img src="{{$user->img ? asset('storage/' . $user->img) : asset('img/ava.webp')}}"
                                 alt="avatar"
                                 class="rounded-circle img-fluid" style="width: 150px; margin: 0 auto;">
                            <h5 class="my-3">{{$user->name}}</h5>
                            <p class="text-muted mb-1">Зарегистрирован с {{$user->created_at}}</p>
                            <div class="d-flex justify-content-center mb-2">
                                {{--                                    <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary">Follow</button>--}}
                                {{--                                    <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary ms-1">Message</button>--}}
                            </div>
                        </div>
                    </div>
                    @if($user->description)
                        <div class="card mb-4 mb-lg-0">
                            <div class="card-body p-0">
                                <p class="d-flex justify-content-between align-items-center p-3">{{$user->description}}</p>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-12 ">
                            @if (auth()->user()->id == $user->id)
                                <div class="card mb-4  mb-3">
                                    <div class="card-body">
                                        <form action="{{route('post.store')}} " method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Название</label>
                                                <input class="form-control" name="title" required>
                                            </div>
                                            <div class="mb-3">
                                                <textarea id="froala-editor" class="form-control" rows="15"
                                                          name="text" required></textarea>
                                            </div>
                                            <div style="width: 100%; display: flex; justify-content: right">
                                                <button type="submit" class="btn btn-dark mb-3">Выложить</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                            @foreach($items as $item)
                                <div class="card mb-4 ">
                                    <div class="card-body">
                                        <h5 class="card-title h5">{{$item['title']}}</h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary">{{formatDate($item['created_at'])}}</h6>
{{--                                        <p class="card-text">{!! substr($item['text'], 0, 100) !!}</p>--}}
                                        <div style="width: 100%; display: flex; justify-content: right">
                                            <a href="{{$item['type'] == 'post' ? route('post.view', $item['id']) : route('note.view', $item['id'])}}"
                                               class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white btn btn-dark">Подробнее</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        new FroalaEditor("#froala-editor", {
            toolbarButtons: [
                ['insertLink', 'insertTable', 'emoticons', 'fontAwesome', 'specialCharacters', 'embedly', 'insertHR'],

                ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting'],

                ['alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent'],

                ['undo', 'redo', 'fullscreen', 'spellChecker', 'selectAll'],
            ],
            language: 'ru',
            height:  '150px'
        })
        ;
    </script>
</x-app-layout>
