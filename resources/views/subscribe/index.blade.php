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
                <p class="fs-5 text-body-secondary">После оплаты подписки вам будет доступен весь функционал, описанный
                    в тарифе</p>
                <p class="fs-5 text-body-secondary">В конце каждого месяца после награждения для вас могут открываться
                    новые тарифы</p>
            </div>
        </header>
        <main>
            <div class="row row-cols-1 row-cols-md-3 mb-3 text-center" style="justify-content: center;">
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3"><h4 class="my-0 fw-normal">«Базовый»</h4></div>
                        <div class="card-body"><h1 class="card-title pricing-card-title">1900 ₽<small
                                    class="text-body-secondary fw-light">/ мес</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Доступ к обучающим материалам (видеоуроки)</li>
                                <li>Доступ к онлайн-платформе «Бриллиантовая Читка (Брю-Ч)»</li>
                                <li>Ежедневная взаимная поддержка:
                                    ваш отчёт проверяют 2 других участника
                                </li>
                                <li>Поддержка напарника (бадди)</li>
                                <li>Доступ в чат участников марафона — навсегда</li>
                                <li>Участие в системе номинаций и призов</li>
                            </ul>
                            <span onclick="getModal('base')" data-bs-toggle="modal" data-bs-target="#subscribeModal"
                                  href="#"
                                  class="w-100 btn btn-lg btn-primary">Оплатить</span>
                            {{--                            href="{{route('payment', ['subscribe' => 'base', 'user' => auth()->user()->id])}}"--}}
                        </div>
                    </div>
                </div>
                @if (checkWinner(false))
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-sm">
                            <div class="card-header py-3"><h4 class="my-0 fw-normal">«Победитель»</h4></div>
                            <div class="card-body"><h1 class="text-success fw-bold card-title pricing-card-title">950
                                    ₽<small
                                        class="text-body-secondary fw-light">/ мес</small></h1>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>Доступ к обучающим материалам (видеоуроки)</li>
                                    <li>Доступ к онлайн-платформе «Бриллиантовая Читка (Брю-Ч)»</li>
                                    <li>Ежедневная взаимная поддержка:
                                        ваш отчёт проверяют 2 других участника
                                    </li>
                                    <li>Поддержка напарника (бадди)</li>
                                    <li>Доступ в чат участников марафона — навсегда</li>
                                    <li>Участие в системе номинаций и призов</li>
                                    <li class="text-success fw-bold">Сохранение статуса победителя</li>
                                </ul>
                                <span onclick="getModal('winner')" data-bs-toggle="modal"
                                      data-bs-target="#subscribeModal"
                                      href="#"
                                      class="w-100 btn btn-lg btn-primary">Оплатить</span>
                                {{--                            href="{{route('payment', ['subscribe' => 'base', 'user' => auth()->user()->id])}}"--}}
                            </div>
                        </div>
                    </div>
                @endif
                @if (checkWinner(true))
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-sm">
                            <div class="card-header py-3"><h4 class="my-0 fw-normal">«Чемпион»</h4></div>
                            <div class="card-body"><h1 class="text-success fw-bold card-title pricing-card-title">190
                                    ₽<small
                                        class="text-body-secondary fw-light">/ мес</small></h1>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>Доступ к обучающим материалам (видеоуроки)</li>
                                    <li>Доступ к онлайн-платформе «Бриллиантовая Читка (Брю-Ч)»</li>
                                    <li>Ежедневная взаимная поддержка:
                                        ваш отчёт проверяют 2 других участника
                                    </li>
                                    <li>Поддержка напарника (бадди)</li>
                                    <li>Доступ в чат участников марафона — навсегда</li>
                                    <li>Участие в системе номинаций и призов</li>
                                    <li class="text-success fw-bold">Статус «Чемпион месяца»</li>
                                    <li class="text-success fw-bold">Яркая фиксация твоей победы в рейтингах</li>
                                </ul>
                                <span onclick="getModal('champion')" data-bs-toggle="modal"
                                      data-bs-target="#subscribeModal"
                                      href="#"
                                      class="w-100 btn btn-lg btn-primary">Оплатить</span>
                                {{--                            href="{{route('payment', ['subscribe' => 'base', 'user' => auth()->user()->id])}}"--}}
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Modal -->
            <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                </div>
            </div>
        </main>
    </div>

    <script>

        function getModal(subscribe) {
            $.ajax({
                url: '{{route('promocode.modal')}}',
                type: 'GET',
                data: {
                    subscribe: subscribe
                },
                success: function (response) {
                    $('.modal-dialog').html(response)
                },
                error: function (xhr, status, error) {
                    console.log('Error ' + error)
                }
            });
        }


    </script>

</x-app-layout>
