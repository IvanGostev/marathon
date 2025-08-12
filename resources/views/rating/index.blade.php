<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Рейтинг') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsive">
                <form action="{{route('rating.index')}}">
                    <select onchange="form.submit()" class="form-select" aria-label="Default select example" name="type">
                        <option value="persistent" {{$type == 'persistent' ? 'selected' : ''}}>Настойчивый лидер</option>
                        <option value="inspiring" {{$type == 'inspiring' ? 'selected' : ''}}>Вдохновляющий лидер</option>
                        <option value="popular" {{$type == 'popular' ? 'selected' : ''}}>Популярный лидер</option>
                    </select>
                </form>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Имя</th>
                        <th scope="col">Количество отчетов</th>
                        <th scope="col">Написано комментариев</th>
                        <th scope="col">Суммарное число просмотров постов и отчетов</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th>{{$user->name}}</th>
                            <th>{{$user->OfDay}}</th>
                            <th>{{$user->OfComment}}</th>
                            <th>{{$user->OfView}}</th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</x-app-layout>
