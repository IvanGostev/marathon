<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
          integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-24">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img class="block  w-auto fill-current text-gray-800 h-20" src="{{asset('img/logo.png')}}" alt="">
                    </a>
                </div>

            </div>
            <div class="flex">
                @if(in_array('admin' , explode('/', request()->url())))
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link style="text-decoration: none;" :href="route('admin.book.index')" :active="request()->routeIs('notes')">
                            {{ __('Книги') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link style="text-decoration: none;" :href="route('admin.note.index')"
                                    :active="in_array('notes' , explode('/', request()->url()))">
                            {{ __('Отчеты') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link style="text-decoration: none;" :href="route('admin.post.index')"
                                    :active="in_array('posts' , explode('/', request()->url()))">
                            {{ __('Посты') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link style="text-decoration: none;" :href="route('admin.comment.index')"
                                    :active="in_array('comments' , explode('/', request()->url()))">
                            {{ __('Комментарии') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link style="text-decoration: none;" :href="route('admin.video.index')"
                                    :active="in_array('video' , explode('/', request()->url()))">
                            {{ __('Добавление видео') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link style="text-decoration: none;" :href="route('admin.promocode.index')"
                                    :active="in_array('promocodes' , explode('/', request()->url()))">
                            {{ __('Промокоды') }}
                        </x-nav-link>
                    </div>
                @else
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link style="text-decoration: none;" :href="route('dashboard')" :active="(request()->routeIs('dashboard') or request()->routeIs('note.index') or request()->routeIs('video.index'))">
                            {{ __('Отчеты') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link style="text-decoration: none;" :href="route('post.index', auth()->user())"
                                    :active="in_array('posts' , explode('/', request()->url()))">
                            {{ __('Мой блог') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link style="text-decoration: none;" :href="route('rating.index', auth()->user())"
                                    :active="in_array('ratings' , explode('/', request()->url()))">
                            {{ __('Рейтинг') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link style="text-decoration: none;" :href="route('subscribe.index')" :active="in_array('subscribes' , explode('/', request()->url()))">
                            {{ __('Моя подписка') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <button type="button" class="link " data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <i class="fa-regular fa-bell"></i>
                        </button>
                    </div>
                    <!-- Модальное окно -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                         tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Уведомления</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Закрыть"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-response">
                                        <tbody>
                                        @foreach(notifications() as $notification)
                                            @switch($notification->type)
                                                @case('note')
                                                    <tr>
                                                        <td>
                                                            <p class="text-secondary"
                                                               style=" font-size: 14px;">{{formatDate($notification->created_at)}}</p>
                                                            <a href="{{route('note.view', $notification->comment()->note()->id)}}">К
                                                                вашему отчету написали новый
                                                                комментарий</a>

                                                        </td>
                                                    </tr>
                                                    @break
                                                @case('post')
                                                    <tr>
                                                        <td>
                                                            <p class="text-secondary"
                                                               style=" font-size: 14px;">{{formatDate($notification->created_at)}}</p>
                                                            <a href="{{route('post.view', $notification->comment()->post()->id)}}">К
                                                                вашему посту написали новый
                                                                комментарий </a>

                                                        </td>
                                                    </tr>
                                                    @break
                                            @endswitch
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <a href="https://t.me/+BUO9SxMDGmQ0NDRi"><img style="width: 32px; margin-right: 10px;" src="{{asset('img/tg.svg')}}" alt=""></a>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Профиль') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('admin.note.index')">
                            {{ __('Админ панель') }}
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Выход') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            <div class="-me-2 flex items-center sm:hidden">

                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Главная страница') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Профиль') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Выход') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
