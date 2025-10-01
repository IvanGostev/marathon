<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Видео') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet"
          type="text/css"/>
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://unpkg.com/bs-brain@2.0.4/tutorials/timelines/timeline-1/assets/css/timeline-1.css">
    <script src="{{asset('js/summernote-ru-RU.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-ru-Ru.js"></script>
    <script src="{{ asset('ru/ru.js')}}"></script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg ">
                <form action="{{route('admin.video.store')}} " method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <input class="form-control mt-2 block w-full p-2" name="file" type="file">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Отчет</label>
                        <textarea id="editor" class="form-control" rows="15" name="text"></textarea>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-dark mb-3">Добавить</button>
                    </div>
                </form>
            </div>
            <table class="table p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsive">
                <thead>
                <tr>
                    <th scope="col">Текст</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($videos as $video)
                    <tr>
                        <td><p>{!! $video->text !!}</p></td>
                        <td>
                            <a href="{{asset('storage/' . $video->src)}}" type="submit" class="btn btn-dark">Смотреть видео</a>
                        </td>
                        <td>
                            <form method="post" action="{{route('admin.video.delete', $video->id)}}">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-dark">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function() {
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
                lang:'ru-RU',
                fontNames:['Roboto','Times New Roman','Helvetica'],
                // disableResizeEditor: true
            });
        });
        (function($) {
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
</x-app-layout>
