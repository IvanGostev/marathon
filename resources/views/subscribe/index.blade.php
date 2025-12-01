<x-app-layout>
    <style>
        .border-primary {
            border-color: #008000 !important;
        }

        .btn-primary {
            background-color: #008000 !important;
            border-color: #008000 !important;
        }

        .text-bg-primary {
            background-color: #008000 !important;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Моя подписка') }}
        </h2>
    </x-slot>

    <div class="container py-12">
        <header>
            <div class="pricing-header p-3 pb-md-4 mx-auto text-center"><h1
                    class="display-4 fw-normal text-body-emphasis">Подписки</h1>
                <br>
                <p class="fs-5 text-body-secondary">После оплаты подписки вам будет доступен весь функционал системы</p></div>
        </header>
        <main>
            <div class="row row-cols-1 row-cols-md-3 mb-3 text-center" style="justify-content: center;">
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3"><h4 class="my-0 fw-normal">Обычная</h4></div>
                        <div class="card-body"><h1 class="card-title pricing-card-title">200 руб<small
                                    class="text-body-secondary fw-light">/месяц</small></h1>
                            <br>
{{--                            <ul class="list-unstyled mt-3 mb-4">--}}
{{--                                <li>20 users included</li>--}}
{{--                                <li>10 GB of storage</li>--}}
{{--                                <li>Priority email support</li>--}}
{{--                                <li>Help center access</li>--}}
{{--                            </ul>--}}
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal"  type="button" class="w-100 btn btn-lg btn-primary">Оплатить</a>
{{--                            href="{{route('payment', ['subscribe' => 'base', 'user' => auth()->user()->id])}}"--}}
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm border-primary">
                        <div class="card-header py-3 text-bg-primary border-primary"><h4 class="my-0 fw-normal">
                                С коучем</h4></div>
                        <div class="card-body"><h1 class="card-title pricing-card-title">500 руб<small
                                    class="text-body-secondary fw-light">/месяц</small></h1>
                            <br>
{{--                            <ul class="list-unstyled mt-3 mb-4">--}}
{{--                                <li>30 users included</li>--}}
{{--                                <li>15 GB of storage</li>--}}
{{--                                <li>Phone and email support</li>--}}
{{--                                <li>Help center access</li>--}}
{{--                            </ul>--}}
                            <button type="button" class="w-100 btn btn-lg btn-primary">Оплатить</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form class="modal-content" action="{{route('subscribe.pay')}}">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Оплата подписки</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">
                                        <h4>Стоимость: 200руб</h4>
                                        <p>Нет скрытых платежей и авто продления</p>
                                    </label>
                               </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Промокод</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                                <button class="btn btn-primary">Применить промокод</button>
                            <input type="text" class="hidden" name="type" value="base">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
{{--            <h2 class="display-6 text-center mb-4">Сравнение планов</h2>--}}
{{--            <div class="table-responsive">--}}
{{--                <table class="table text-center">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th style="width: 34%;"></th>--}}
{{--                        <th style="width: 22%;">Обычная</th>--}}
{{--                        <th style="width: 22%;">С коучем</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    <tr>--}}
{{--                        <th scope="row" class="text-start">Public</th>--}}
{{--                        <td>--}}
{{--                            <svg class="bi" width="24" height="24" role="img" aria-label="Included">--}}
{{--                                <use xlink:href="#check"></use>--}}
{{--                            </svg>--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            <svg class="bi" width="24" height="24" role="img" aria-label="Included">--}}
{{--                                <use xlink:href="#check"></use>--}}
{{--                            </svg>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <th scope="row" class="text-start">Private</th>--}}
{{--                        <td></td>--}}
{{--                        <td>--}}
{{--                            <svg class="bi" width="24" height="24" role="img" aria-label="Included">--}}
{{--                                <use xlink:href="#check"></use>--}}
{{--                            </svg>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    </tbody>--}}
{{--                    <tbody>--}}
{{--                    <tr>--}}
{{--                        <th scope="row" class="text-start">Permissions</th>--}}
{{--                        <td>--}}
{{--                            <svg class="bi" width="24" height="24" role="img" aria-label="Included">--}}
{{--                                <use xlink:href="#check"></use>--}}
{{--                            </svg>--}}
{{--                        </td>--}}
{{--                        <td>--}}
{{--                            <svg class="bi" width="24" height="24" role="img" aria-label="Included">--}}
{{--                                <use xlink:href="#check"></use>--}}
{{--                            </svg>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <th scope="row" class="text-start">Sharing</th>--}}
{{--                        <td></td>--}}
{{--                        <td>--}}
{{--                            <svg class="bi" width="24" height="24" role="img" aria-label="Included">--}}
{{--                                <use xlink:href="#check"></use>--}}
{{--                            </svg>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <th scope="row" class="text-start">Unlimited members</th>--}}
{{--                        <td></td>--}}
{{--                        <td>--}}
{{--                            <svg class="bi" width="24" height="24" role="img" aria-label="Included">--}}
{{--                                <use xlink:href="#check"></use>--}}
{{--                            </svg>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <th scope="row" class="text-start">Extra security</th>--}}
{{--                        <td></td>--}}
{{--                        <td></td>--}}
{{--                    </tr>--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
        </main>
    </div>


        <div id="Modal" class="modal" tabindex="-1">
            <div class="modal-dialog modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Modal body text goes here.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    <script>
        let myModal = document.getElementById('Modal')
        let myInput = document.getElementById('Input')

        myModal.addEventListener('shown.bs.modal', function () {
            myInput.focus()
        })
    </script>
</x-app-layout>
