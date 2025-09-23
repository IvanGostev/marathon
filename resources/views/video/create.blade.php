<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Создание поста') }}
        </h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet"
          type="text/css"/>
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
    <script src="{{ asset('ru/ru.js')}}"></script>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form action="{{route('post.store')}}" method="post"
                  class="p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsive">
                @csrf
                <div class="mb-3">
                    <textarea required id="froala-editor" class="form-control" rows="20" name="text"></textarea>
                    <button type="submit" class="btn btn-dark mt-3">Создать</button>
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
                    language: 'ru',
                    height: 500
                })
                ;
            </script>
        </div>
    </div>

</x-app-layout>
