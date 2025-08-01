<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Создание отчета') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet"
          type="text/css"/>
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
    <script src="{{ asset('ru/ru.js')}}"></script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form action="{{route('note.store')}}" method="post"
                  class="p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsive">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Книга</label>
                    <select class="form-select" aria-label="Книга" name="book_id">
                        @foreach($books as $book)
                            <option value="{{$book->id}}">{{$book->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Название</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="title">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Отчет</label>
                    <textarea id="froala-editor" class="form-control" rows="20" name="text"></textarea>
                    <button type="submit" class="btn btn-dark mt-3">Отправить на проверку</button>
                </div>
            </form>

            <script>
                new FroalaEditor("#froala-editor", {
                    toolbarButtons: [
                        ['insertLink', 'insertTable', 'emoticons', 'fontAwesome', 'specialCharacters', 'embedly', 'insertHR'],

                        ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting'],

                        ['alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent'],

                        ['undo', 'redo', 'fullscreen', 'spellChecker', 'selectAll'],
                    ],
                    language: 'ru'
                })
                ;
            </script>
        </div>
    </div>

</x-app-layout>
