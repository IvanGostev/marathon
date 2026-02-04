<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Заявки на статус Коуча') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="alert alert-success mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($coaches->isEmpty())
                        <p class="text-center text-gray-500">Нет новых заявок.</p>
                    @else
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Имя</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Дата заявки</th>
                                    <th scope="col">Действия</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coaches as $coach)
                                    <tr>
                                        <th scope="row">{{ $coach->id }}</th>
                                        <td>{{ $coach->name }}</td>
                                        <td>{{ $coach->email }}</td>
                                        <td>{{ $coach->updated_at->format('d.m.Y H:i') }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                @if($coach->contact_info)
                                                    <button type="button" class="btn btn-dark btn-sm text-white" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#contactModal"
                                                            data-contact="{{ $coach->contact_info }}">
                                                        Контакты
                                                    </button>
                                                @endif
                                                <form action="{{ route('admin.coach.approve', $coach->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-success btn-sm">Одобрить</button>
                                                </form>
                                                <form action="{{ route('admin.coach.reject', $coach->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">Отклонить</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Info Modal -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Контактная информация</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="contactInfoText"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var contactModal = document.getElementById('contactModal');
            contactModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var contact = button.getAttribute('data-contact');
                var modalBody = contactModal.querySelector('.modal-body #contactInfoText');
                modalBody.textContent = contact;
            });
        });
    </script>
</x-app-layout>