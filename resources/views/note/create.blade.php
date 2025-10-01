<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Создание отчета') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://unpkg.com/bs-brain@2.0.4/tutorials/timelines/timeline-1/assets/css/timeline-1.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <script src="{{ asset('ru/ru.js')}}"></script>
    <div class="py-12 d-flex  mx-auto sm:px-6 lg:px-8 ">
        <!-- Timeline 1 - Bootstrap Brain Component -->
        <section class="bsb-timeline-1 py-5 py-xl-8 w-100">
            <div class="container">
                <div class="row justify-content-center gap-10">
                    <ul class=" col-sm-2 timeline">
                        <li class="timeline-item">
                            <div class="timeline-body">
                                <div class="timeline-content">
                                    <div class="card border-0">
                                        <div class="card-body p-1g">
                                            <h6 class="card-title p-1">Создания отчета</h6>
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
                    <form class="bg-white shadow sm:rounded-lg col-sm-9 p-2" action="{{route('note.demo')}}"
                          method="post"
                          class="p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsive">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Книга
                                <span data="mybook"
                                      style="font-size: 12px; color: blue; cursor: pointer; font-weight: 500"
                                >(Открыть поле свободного ввода)</span>
                            </label>
                            <select class="form-select" aria-label="Книга" name="book_id">
                                @foreach($books as $book)
                                    <option @isset($data['book_id'])
                                                {{$data['book_id'] == $book->id ? 'selected' : ''}}
                                            @endisset value="{{$book->id}}">{{$book->title}}</option>
                                @endforeach
                            </select>
                            <input placeholder="Ведите название книги" style="display: none" type="text"
                                   class="form-control" name="mybook">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Название</label>
                            <input required @isset($data['title`']) value="{{$data['title']}}" @endisset  type="text"
                                   class="form-control" id="exampleFormControlInput1" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Отчет</label>
                            <textarea required id="editor" class="form-control" rows="20" name="text">@isset($data['text'])
                                    {!! $data['text'] !!}
                                @endisset</textarea>
                            <button type="submit" class="btn btn-dark mt-3">Далее</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <style>
        .tooltip {
            display: none;
        }
    </style>

    <script>


        $(document).ready(function () {
            $('#editor').summernote({
                height: '300px',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['fontname', 'bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                ],
                lang:'ru-RU',
                focus: true,
            });
        });

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

        $('[data="mybook"]').click(function () {
            if ($('[name="mybook"]').css('display') == 'none') {
                $('[name="mybook"]').css('display', 'block');
                $('[name="book_id"]').css('display', 'none');
                $('[data="mybook"]').html('(Открыть выбор книг)')
            } else {
                $('[name="mybook"]').css('display', 'none');
                $('[name="book_id"]').css('display', 'block');
                $('[data="mybook"]').html('(Открыть поле свободного ввода)')
            }
        })
    </script>
</x-app-layout>
