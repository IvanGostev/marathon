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
                <p class="fs-5 text-body-secondary">После оплаты подписки вам будет доступен весь функционал системы</p>
            </div>
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
                            <a onclick="getModal('base')" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#"
                               class="w-100 btn btn-lg btn-primary">Оплатить</a>
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
                            <a onclick="getModal('premium')" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#"
                               class="w-100 btn btn-lg btn-primary">Оплатить</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button trigger modal -->


            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
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
