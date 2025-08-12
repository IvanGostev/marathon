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
                        <textarea id="froala-editor" class="form-control" rows="15" name="text"></textarea>
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
</x-app-layout>
