<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Рейтинг') }}
        </h2>
    </x-slot>
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 d-flex gap-1">
            <form action="{{route('rating.index')}}" class="p-4 sm:p-8 bg-white shadow sm:rounded-lg col-sm-4" style="
            display:flex;
            flex-direction: column;
            gap: 20px;
                align-items: flex-start;">
                <div class="input-group mb-3 " style="border-radius: 5px">
                    <input value="{{request()->search ?? ''}}" name="search" type="text" class="form-control" style=" border-radius: 5px 0 0 5px;" placeholder="Введите имя участника" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-outline-dark" type="submit" id="button-addon2"> <i class="fas fa-search"></i></button>
                </div>
                <button name="type" value="inspiring"  class="nav-link {{(str_contains(  request()->fullUrl(), 'inspiring') or (!str_contains(  request()->fullUrl(), 'popular') and !str_contains(  request()->fullUrl(), 'persistent'))) ? 'fw-bold text-decoration-underline' : ''}}">Вдохновляющий читатель</button>
                <button name="type" value="popular" class="nav-link {{str_contains(  request()->fullUrl(), 'popular') ? 'fw-bold text-decoration-underline' : ''}}">Популярный читатель</button>
                <button name="type" value="persistent" class="nav-link {{str_contains(  request()->fullUrl(), 'persistent') ? 'fw-bold text-decoration-underline' : ''}}">Настойчивый читатель</button>
            </form>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsrive col-sm-8" style="margin-top:0 ">


                <table class="table ">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Пользователь</th>
                        <th scope="col">Количество отчетов</th>
                        <th scope="col">Написано комментариев</th>
                        <th scope="col">Суммарное число просмотров постов и отчетов</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th>{{isset($id) ? $id=$id+1 : $id = 1}}</th>
                            <th>
                                <a href="{{route('post.index', $user->id)}}" style="display: flex; gap: 15px">
                                    <img style="object-fit: cover; width: 50px; height: 50px; border-radius: 100%;" src="{{$user->img ? asset('storage/' . $user->img) : asset('img/ava.jpeg')}}" alt="">
                                    <p style="display: block">{{$user->name}}</p>
                                </a>
                            </th>
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
