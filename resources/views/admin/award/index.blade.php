<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Награждение') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsive">
                @if($status == 'false')
                    <form action="{{route('admin.award.reward')}}" class="row g-2" method="post">
                        @csrf
                        <div class="col-auto">
                            Выдать награды с подписью
                        </div>
                        <div class="col-auto">
                            <input required type="text" name="message" class="form-control rounded" id="inputPassword2"
                                   placeholder="Подпись">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-warning mb-3">Выдать</button>
                        </div>
                    </form>
                @else
                    <div class="loading-container">
                        <div class="loading-spinner"></div>
                        <div class="loading-text">Процесс выдачи наград</div>
                    </div>
                    <style>

                        .loading-container {
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            justify-content: center;
                            text-align: center;
                        }

                        .loading-spinner {
                            width: 80px;
                            height: 80px;
                            border: 8px solid rgba(000, 000, 000, 0.3);
                            border-top: 8px solid #ffffff;
                            border-radius: 50%;
                            animation: spin 1.5s linear infinite;
                            margin-bottom: 20px;
                        }

                        .loading-text {
                            color: black;
                            font-size: 18px;
                            font-weight: 500;
                            letter-spacing: 0.5px;
                        }

                        @keyframes spin {
                            0% {
                                transform: rotate(0deg);
                            }
                            100% {
                                transform: rotate(360deg);
                            }
                        }
                    </style>
                @endif
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Подпись</th>
                            <th scope="col">Дата создания</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <th>{{$item->message}}</th>
                                <td>{{$item->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</x-app-layout>
