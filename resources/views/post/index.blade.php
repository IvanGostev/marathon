<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Личный блог') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://unpkg.com/bs-brain@2.0.4/tutorials/timelines/timeline-1/assets/css/timeline-1.css">
    <script src="{{asset('js/summernote-ru-RU.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-ru-Ru.js"></script>


    <script src="{{ asset('ru/ru.js')}}"></script>
    <section>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-5">
                    <div class="card mb-4 align-items-center justify-content-center">
                        <div class="card-body text-center align-items-center justify-content-center">
                            <img src="{{$user->img ? asset('storage/' . $user->img) : asset('img/ava.jpeg')}}"
                                alt="avatar" class="rounded-circle img-fluid"
                                style="object-fit: cover; width: 150px; height: 150px; margin: 0 auto;">
                            <h5 class="my-3">{{$user->name}}</h5>
                            <div class="d-flex justify-content-center gap-2 mb-3">
                                @if($user->is_assistant === 'active')
                                    <span class="badge bg-primary">Напарник</span>
                                @endif
                                @if($user->is_coach === 'active')
                                    <span class="badge bg-success">Коуч</span>
                                @endif
                            </div>
                            <div class="d-flex">
                                @foreach($user->groupedAwards() as $award)
                                    <div class="d-flex flex-column align-items-center mx-1">
                                        <div data-bs-toggle="tooltip" data-bs-placement="top" title="{{$award->title}}"
                                            style="width: 30px; height: 30px">
                                            {!! str_replace('#fde910', 'green', $award->img) !!}
                                        </div>
                                        <span class="small text-muted">{{ $award->count }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <p class="text-muted mb-1">Зарегистрирован с {{$user->created_at}}</p>
                            <p class="text-muted mb-1">Хобби: {{$user->hobby}}</p>
                            <p class="text-muted mb-1">День рождение: {{$user->date}}</p>
                            <p class="text-muted mb-1">Город: {{$user->city}}</p>
                            <p class="text-muted mb-1">Номер телефон: {{$user->phone}}</p>
                            <div class="d-flex mb-2 pt-3" style="flex-direction: column; gap: 10px;">
                                @if (auth()->user()->id != $user->id)
                                    @foreach($userRequests as $req)
                                        @if(admissionRequest(auth()->user()->id, $user->id))
                                            @if(($req->type === 'partner' && auth()->user()->is_assistant === 'active') || ($req->type === 'coach' && auth()->user()->is_coach === 'active'))
                                                <form method="post" action="{{route('coach.store')}}">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                                    <input type="hidden" name="request_id" value="{{$req->id}}">
                                                    <input type="hidden" name="type" value="{{$req->type}}">
                                                    <button type="submit" class="btn btn-dark w-100">
                                                        Стать {{ $req->type === 'coach' ? 'коучем' : 'напарником' }}
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
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
                <div class="col-lg-7">
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
                                            <div class="mb-3" style="position: relative;">
                                                <div style="position: absolute; bottom: 0; right: 0; z-index: 100"
                                                    class="emoji">
                                                    <span>🙂</span>
                                                    <div id="emoji-picker">
                                                        <div class="emoji-arrow"></div>
                                                    </div>
                                                </div>
                                                <textarea id="editor" class="form-control" rows="15" name="text"
                                                    required></textarea>
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
                                        <h6 class="card-subtitle mb-2 text-body-secondary">
                                            {{formatDate($item['created_at'])}}</h6>
                                        {{-- <p class="card-text">{!! substr($item['text'], 0, 100) !!}</p>--}}
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
    <style>
        @font-face {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            src: local('Roboto'), local('Roboto-Regular'), url('https://fonts.gstatic.com/s/roboto/v19/KFOmCnqEu92Fr1Mu72xKOzY.woff2') format('woff2');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }
    </style>

    <script>
        $(document).ready(function () {
            $('#editor').summernote({
                height: '300px',
                fontName: 'Roboto',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                ],
                focus: true,
                lang: 'ru-RU',
                fontNames: ['Roboto', 'Times New Roman', 'Helvetica'],
                // disableResizeEditor: true
            });
        });
        (function ($) {
            $.extend(true, $.summernote.lang, {
                'ru-RU': {
                    font: {
                        bold: 'Полужирный',
                        italic: 'Курсив',
                        underline: 'Подчёркнутый',
                        clear: 'Убрать стили шрифта',
                        height: 'Высота линии',
                        name: 'Шрифт',
                        strikethrough: 'Зачёркнутый',
                        subscript: 'Нижний индекс',
                        superscript: 'Верхний индекс',
                        size: 'Размер шрифта',
                    },
                    image: {
                        image: 'Картинка',
                        insert: 'Вставить картинку',
                        resizeFull: 'Восстановить размер',
                        resizeHalf: 'Уменьшить до 50%',
                        resizeQuarter: 'Уменьшить до 25%',
                        floatLeft: 'Расположить слева',
                        floatRight: 'Расположить справа',
                        floatNone: 'Расположение по-умолчанию',
                        shapeRounded: 'Форма: Закругленная',
                        shapeCircle: 'Форма: Круг',
                        shapeThumbnail: 'Форма: Миниатюра',
                        shapeNone: 'Форма: Нет',
                        dragImageHere: 'Перетащите сюда картинку',
                        dropImage: 'Перетащите картинку',
                        selectFromFiles: 'Выбрать из файлов',
                        maximumFileSize: 'Максимальный размер файла',
                        maximumFileSizeError: 'Превышен максимальный размер файла',
                        url: 'URL картинки',
                        remove: 'Удалить картинку',
                        original: 'Оригинал',
                    },
                    video: {
                        video: 'Видео',
                        videoLink: 'Ссылка на видео',
                        insert: 'Вставить видео',
                        url: 'URL видео',
                        providers: '(YouTube, Vimeo, Vine, Instagram, DailyMotion или Youku)',
                    },
                    link: {
                        link: 'Ссылка',
                        insert: 'Вставить ссылку',
                        unlink: 'Убрать ссылку',
                        edit: 'Редактировать',
                        textToDisplay: 'Отображаемый текст',
                        url: 'URL для перехода',
                        openInNewWindow: 'Открывать в новом окне',
                    },
                    table: {
                        table: 'Таблица',
                        addRowAbove: 'Добавить строку выше',
                        addRowBelow: 'Добавить строку ниже',
                        addColLeft: 'Добавить столбец слева',
                        addColRight: 'Добавить столбец справа',
                        delRow: 'Удалить строку',
                        delCol: 'Удалить столбец',
                        delTable: 'Удалить таблицу',
                    },
                    hr: {
                        insert: 'Вставить горизонтальную линию',
                    },
                    style: {
                        style: 'Стиль',
                        p: 'Нормальный',
                        blockquote: 'Цитата',
                        pre: 'Код',
                        h1: 'Заголовок 1',
                        h2: 'Заголовок 2',
                        h3: 'Заголовок 3',
                        h4: 'Заголовок 4',
                        h5: 'Заголовок 5',
                        h6: 'Заголовок 6',
                    },
                    lists: {
                        unordered: 'Маркированный список',
                        ordered: 'Нумерованный список',
                    },
                    options: {
                        help: 'Помощь',
                        fullscreen: 'На весь экран',
                        codeview: 'Исходный код',
                    },
                    paragraph: {
                        paragraph: 'Параграф',
                        outdent: 'Уменьшить отступ',
                        indent: 'Увеличить отступ',
                        left: 'Выровнять по левому краю',
                        center: 'Выровнять по центру',
                        right: 'Выровнять по правому краю',
                        justify: 'Растянуть по ширине',
                    },
                    color: {
                        recent: 'Последний цвет',
                        more: 'Еще цвета',
                        background: 'Цвет фона',
                        foreground: 'Цвет шрифта',
                        transparent: 'Прозрачный',
                        setTransparent: 'Сделать прозрачным',
                        reset: 'Сброс',
                        resetToDefault: 'Восстановить умолчания',
                    },
                    shortcut: {
                        shortcuts: 'Сочетания клавиш',
                        close: 'Закрыть',
                        textFormatting: 'Форматирование текста',
                        action: 'Действие',
                        paragraphFormatting: 'Форматирование параграфа',
                        documentStyle: 'Стиль документа',
                        extraKeys: 'Дополнительные комбинации',
                    },
                    help: {
                        'insertParagraph': 'Новый параграф',
                        'undo': 'Отменить последнюю команду',
                        'redo': 'Повторить последнюю команду',
                        'tab': 'Tab',
                        'untab': 'Untab',
                        'bold': 'Установить стиль "Жирный"',
                        'italic': 'Установить стиль "Наклонный"',
                        'underline': 'Установить стиль "Подчеркнутый"',
                        'strikethrough': 'Установить стиль "Зачеркнутый"',
                        'removeFormat': 'Сборсить стили',
                        'justifyLeft': 'Выровнять по левому краю',
                        'justifyCenter': 'Выровнять по центру',
                        'justifyRight': 'Выровнять по правому краю',
                        'justifyFull': 'Растянуть на всю ширину',
                        'insertUnorderedList': 'Включить/отключить маркированный список',
                        'insertOrderedList': 'Включить/отключить нумерованный список',
                        'outdent': 'Убрать отступ в текущем параграфе',
                        'indent': 'Вставить отступ в текущем параграфе',
                        'formatPara': 'Форматировать текущий блок как параграф (тег P)',
                        'formatH1': 'Форматировать текущий блок как H1',
                        'formatH2': 'Форматировать текущий блок как H2',
                        'formatH3': 'Форматировать текущий блок как H3',
                        'formatH4': 'Форматировать текущий блок как H4',
                        'formatH5': 'Форматировать текущий блок как H5',
                        'formatH6': 'Форматировать текущий блок как H6',
                        'insertHorizontalRule': 'Вставить горизонтальную черту',
                        'linkDialog.show': 'Показать диалог "Ссылка"',
                    },
                    history: {
                        undo: 'Отменить',
                        redo: 'Повтор',
                    },
                    specialChar: {
                        specialChar: 'SPECIAL CHARACTERS',
                        select: 'Select Special characters',
                    },
                },
            });
        })(jQuery);

    </script>
    <style>
        .center {
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }



        .emoji {
            font-size: 30px;
            position: relative;
            cursor: pointer;
            margin-left: 10px;
        }

        .emoji>span {
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
                let textArea = $('.note-editable p:last')
                textArea.html(textArea.html() + $(this).text());
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