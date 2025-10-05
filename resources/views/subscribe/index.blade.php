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
            {{ __('Подписки') }}
        </h2>
    </x-slot>

    <div class="container py-12">
        <header>
            <div class="pricing-header p-3 pb-md-4 mx-auto text-center"><h1
                    class="display-4 fw-normal text-body-emphasis">Подписки</h1>
                <br>
                <p class="fs-5 text-body-secondary">Quickly build an effective pricing table for your potential
                    customers with this Bootstrap example. It’s built with default Bootstrap components and utilities
                    with little customization.</p></div>
        </header>
        <main>
            <div class="row row-cols-1 row-cols-md-3 mb-3 text-center" style="justify-content: center;">
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3"><h4 class="my-0 fw-normal">Обычный</h4></div>
                        <div class="card-body"><h1 class="card-title pricing-card-title">200 руб<small
                                    class="text-body-secondary fw-light">/месяц</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>20 users included</li>
                                <li>10 GB of storage</li>
                                <li>Priority email support</li>
                                <li>Help center access</li>
                            </ul>
                            <button type="button" class="w-100 btn btn-lg btn-primary">Оплатить</button>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm border-primary">
                        <div class="card-header py-3 text-bg-primary border-primary"><h4 class="my-0 fw-normal">
                                С коучем</h4></div>
                        <div class="card-body"><h1 class="card-title pricing-card-title">500 руб<small
                                    class="text-body-secondary fw-light">/месяц</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>30 users included</li>
                                <li>15 GB of storage</li>
                                <li>Phone and email support</li>
                                <li>Help center access</li>
                            </ul>
                            <button type="button" class="w-100 btn btn-lg btn-primary">Оплатить</button>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="display-6 text-center mb-4">Сравнение планов</h2>
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                    <tr>
                        <th style="width: 34%;"></th>
                        <th style="width: 22%;">Обычный</th>
                        <th style="width: 22%;">С коучем</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row" class="text-start">Public</th>
                        <td>
                            <svg class="bi" width="24" height="24" role="img" aria-label="Included">
                                <use xlink:href="#check"></use>
                            </svg>
                        </td>
                        <td>
                            <svg class="bi" width="24" height="24" role="img" aria-label="Included">
                                <use xlink:href="#check"></use>
                            </svg>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-start">Private</th>
                        <td></td>
                        <td>
                            <svg class="bi" width="24" height="24" role="img" aria-label="Included">
                                <use xlink:href="#check"></use>
                            </svg>
                        </td>
                    </tr>
                    </tbody>
                    <tbody>
                    <tr>
                        <th scope="row" class="text-start">Permissions</th>
                        <td>
                            <svg class="bi" width="24" height="24" role="img" aria-label="Included">
                                <use xlink:href="#check"></use>
                            </svg>
                        </td>
                        <td>
                            <svg class="bi" width="24" height="24" role="img" aria-label="Included">
                                <use xlink:href="#check"></use>
                            </svg>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-start">Sharing</th>
                        <td></td>
                        <td>
                            <svg class="bi" width="24" height="24" role="img" aria-label="Included">
                                <use xlink:href="#check"></use>
                            </svg>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-start">Unlimited members</th>
                        <td></td>
                        <td>
                            <svg class="bi" width="24" height="24" role="img" aria-label="Included">
                                <use xlink:href="#check"></use>
                            </svg>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-start">Extra security</th>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</x-app-layout>
