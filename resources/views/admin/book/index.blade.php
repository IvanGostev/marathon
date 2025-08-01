<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Книги') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsive">
                <form action="{{route('admin.book.store')}}" class="row g-2" method="post">
                    @csrf
                    <div class="col-auto">
                        <input type="text" name="title" class="form-control" id="inputPassword2" placeholder="Название">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Добавить</button>
                    </div>
                </form>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Название</th>
                        <th scope="col">Дата создания</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($books as $book)
                        <tr>
                            <th>{{$book->title}}</th>
                            <td>{{$book->created_at}}</td>
                            <td>
                                <form method="post" action="{{route('admin.book.delete', $book->id)}}">
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
    </div>
</x-app-layout>
