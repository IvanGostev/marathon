<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Посты') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsive">
                <form action="{{route('admin.post.index')}}">
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
                        <th scope="col">Название</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Дата создания</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <th>{{$post->title}}</th>
                            <td>{{$post->status == 'moderation' ? 'Модерация' : ($post->status == 'approve' ? 'Одобрено' : 'Не прошел проверку')}}</td>
                            <td>{{$post->created_at}}</td>
                            <td>
                                <form method="post" action="{{route('admin.post.approve', $post->id)}}">
                                    @csrf
                                    <button type="submit" class="btn btn-dark">Одобрить</button>
                                </form>
                            </td>
                            <td>
                                <form method="post" action="{{route('admin.post.reject', $post->id)}}">
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
