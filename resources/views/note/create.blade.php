<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Создание отчета') }}
        </h2>
    </x-slot>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/js/bootstrap.min.js"
            integrity="sha512-nKXmKvJyiGQy343jatQlzDprflyB5c+tKCzGP3Uq67v+lmzfnZUi/ZT+fc6ITZfSC5HhaBKUIvr/nTLCV+7F+Q=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/css/bootstrap-grid.min.css"
          integrity="sha512-dOjUSaLkr6G2pwQ7ry9juX+iXw5602zg1kg8yH+guR3uSEidGyCnOEQnGlr7xwu/8WE+pVm1ZNqaIs5ETTIJQg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.8/css/bootstrap.min.css"
          integrity="sha512-2bBQCjcnw658Lho4nlXJcc6WkV/UxpE/sAokbXPxQNGqmNdQrWqtw26Ns9kFF/yG792pKR1Sx8/Y1Lf1XN4GKA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    {{--    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">--}}


    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>

    {{--    <link rel="stylesheet"--}}
    {{--          href="https://unpkg.com/bs-brain@2.0.4/tutorials/timelines/timeline-1/assets/css/timeline-1.css">--}}
    {{--    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">--}}
    {{--    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
                          class="p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsive"
                          enctype='multipart/form-data'>
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">
                                <h5>Название: книги(курса, урока....)</h5>
                            </label>
                            <select autofocus id="select-2" class="form-select" aria-label="Книга" name="book">
                                @foreach($books as $book)
                                    <option @isset($data['book_id'])
                                                {{$data['book_id'] == $book->id ? 'selected' : ''}}
                                            @endisset value="{{$book->title}}">{{$book->title}}</option>
                                @endforeach
                                @if(isset($data['book']))
                                    <option selected value="{{$data['book']}}">{{$data['book']}}</option>
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">
                                <h5>Раздел</h5>
                            </label>
                            <input required @isset($data['title']) value="{{$data['title']}}" @endisset  type="text"
                                   class="form-control" id="exampleFormControlInput1" name="title">
                        </div>
                        <script>
                            $(document).ready(function () {
                                $('#select-2').select2({tags: true});
                            });
                        </script>
                        <div class="mb-3 text-center">
                            <h3 class="bg-success text-white">ПРОГА-5</h3>
                            <h4 class="bg-success fst-italic text-white">Прочитай - Распиши - Осмысли - Говори -
                                Апробируй</h4>
                        </div>
                        <div class="mb-3">
                            <h4 class="bg-success text-white">1 Прочитай!</h4>
                            <h5 class="fst-italic">Изучай 20 мин (Прочитай или Просмотри видео)</h5>
                            <h6 class="fst-italic">Поставь таймер на 20 мин ( т.е. изучай - 20 мин). Потом сделай шаги
                                2,3,4,5. Затем отдохни - 5 мин.Потом- новый цикл изучения по технологии П.Р.О.Г.А.Новый
                                цикл оформляй на следующем листе.</h6>
                        </div>
                        <div class="mb-3">
                            <h4 class="bg-success text-white">2 Распиши !</h4>
                            <h5 class="fst-italic">Распиши краткий конспект (Пиши меньше, но точнее)</h5>
                            <h6 class="fst-italic">- Ответь : "Что я понял?"</h6>
                            <textarea id="editor" class="form-control" rows="20" name="text">
                                @isset($data['text'])
                                    {!! $data['text'] !!}
                                @endisset</textarea>
                        </div>
                        <div class="mb-3">
                            <h4 class="bg-success text-white">3	Осмысли!</h4>
                            <h5 class="fst-italic">Осмысли суть и напиши не больше 3х основных мыслей (акцентируй внимание на ключевых идеях):</h5>
                            <h6 class="fst-italic">-  Ответь : "Что главное из того, что я понял?"</h6>
                            <textarea id="editor-2" class="form-control" rows="4" name="results">@isset($data['results'])
                                    {!! $data['results'] !!}
                                @endisset</textarea>
                        </div>
                        <div class="mb-3">
                            <h4 class="bg-success text-white">4	Говори!</h4>
                            <h5 class="fst-italic">Проговори вслух краткий перессказ (Сделай это 3 раза).</h5>
                            <h6 class="fst-italic">- Представь, что обьясняешь человеку без конспекта</h6>
                            <input id="input-files" multiple type="file" class="form-control" name="files[]">
                            @if(isset($data['files']))
                                <br>
                                <p class="h6">Файлы загруженные ранее</p>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Файл</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data['files'] as $file)
                                        <tr id="{{$file->id}}">
                                            <th scope="row">{{isset($count) ? $count = $count+1 : $count = 1}}</th>
                                            <td>
                                                <a target="_blank" href="{{asset('storage/'. $file->src)}}"
                                                   class="btn  btn-outline-dark">Посмотреть
                                                    вложение</a>
                                            </td>
                                            <td>
                                                <p onclick="deleteItem({{$file->id}})" class="btn btn-outline-dark">
                                                    Открепить</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <select hidden multiple name="oldFilesIds[]" id="">
                                        @foreach($data['files'] as $file)
                                            <option selected value="{{$file->id}}">Object</option>
                                        @endforeach
                                    </select>
                                    </tbody>
                                </table>
                                <script>
                                    function deleteItem($id) {
                                        $(`tr[id="${$id}"]`).remove();
                                        $(`option[value="${$id}"]`).remove();
                                    }
                                </script>
                            @endif
                        </div>
                        <div class="mb-3">
                                <h4 class="bg-success text-white">5	Апробируй!</h4>
                                <h5 class="fst-italic">Придумай, как ты применишь эти знания.</h5>
                                <h6 class="fst-italic">- Ответь : " Какой 1й шаг ты сделаешь? Когда?"</h6>
                            <textarea id="editor-3" required class="form-control" rows="4" name="go"> @isset($data['go'])
                                    {!! $data['go'] !!}
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
        $('#input-files').change(function (e) {
            Array.from(e.target.files).forEach(file => console.log(file.name));
        });


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
                lang: 'ru-RU',
            });
        });
        $(document).ready(function () {
            $('#editor-2').summernote({
                height: '200px',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['fontname', 'bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                ],
                lang: 'ru-RU',
            });
        });
        $(document).ready(function () {
            $('#editor-3').summernote({
                height: '200px',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['fontname', 'bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                ],
                lang: 'ru-RU',
            });
        });
        settings = {
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
        }
        $.extend(true, $.summernote.lang, {
            'ru-RU': settings,
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

    <style>
        .bg-success {
            background-color: #00b050 !important
        }
    </style>
</x-app-layout>
