<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Комментарии') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsive">
                <form action="{{route('admin.comment.index')}}">
                    <select onchange="form.submit()" class="form-select" aria-label="Default select example"
                            name="type">
                        <option value="all" {{$type == 'all' ? 'selected' : ''}}>Все</option>
                        <option value="moderation" {{$type == 'moderation' ? 'selected' : ''}}>Только на модерации
                        </option>
                    </select>
                </form>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Текст</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Дата создания</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($comments as $comment)
                        <tr>
                            <th>{{$comment->text}}</th>
                            <td>{{$comment->status == 'moderation' ? 'Модерация' : ($comment->status == 'approve' ? 'Одобрено' : 'Не прошел проверку')}}</td>
                            <td>{{$comment->created_at}}</td>
                            <td>
                                <form method="post" action="{{route('admin.comment.approve', $comment->id)}}">
                                    @csrf
                                    <button type="submit" class="btn btn-dark">Одобрить</button>
                                </form>
                            </td>
                            <td>
                                <form method="post" action="{{route('admin.comment.reject', $comment->id)}}">
                                    @csrf
                                    <button type="submit" class="btn btn-dark">Отклонить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</x-app-layout>
