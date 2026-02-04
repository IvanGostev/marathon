<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Взаимопомощь') }}
        </h2>
    </x-slot>

    <style>
        .nav-pills .nav-link.active {
            background-color: black !important;
            color: white !important;
        }
        .nav-pills .nav-link {
            color: black !important;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- User Type Toggle -->
                    <ul class="nav nav-pills mb-4" id="userTypeTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="new-user-tab" data-bs-toggle="pill" data-bs-target="#new-user-content" type="button" role="tab" aria-controls="new-user-content" aria-selected="true">Новый пользователь</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="experienced-user-tab" data-bs-toggle="pill" data-bs-target="#experienced-user-content" type="button" role="tab" aria-controls="experienced-user-content" aria-selected="false">Опытный пользователь</button>
                        </li>
                    </ul>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="tab-content" id="userTypeTabContent">
                        <!-- New User Content -->
                        <div class="tab-pane fade show active" id="new-user-content" role="tabpanel" aria-labelledby="new-user-tab">
                            <div class="row g-4">
                                <!-- Request Partner Form/Status -->
                                <div class="col-md-6">
                                    <div class="card h-100 shadow-sm border-0">
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold mb-4">Запросить напарника</h5>
                                            @if($acceptedPartner)
                                                @php $helper = $acceptedPartner->leader(); @endphp
                                                <div class="alert alert-success border-0 mb-0">
                                                    <p class="fw-bold mb-2">Запрос принят!</p>
                                                    <p class="mb-2">Ваш напарник: 
                                                        <a href="{{ route('post.index', $helper->id) }}" class="fw-bold text-dark text-decoration-underline">
                                                            {{ $helper->name }}
                                                        </a>
                                                    </p>
                                                    <p class="text-muted small mb-0">Теперь вы можете взаимодействовать.</p>
                                                </div>
                                            @elseif($userPartnerRequest)
                                                <div class="alert alert-dark border-0 bg-light mb-0">
                                                    <p class="fw-bold mb-2">Запрос отправлен (Ожидание)</p>
                                                    <p class="text-muted small mb-3">{{ $userPartnerRequest->message }}</p>
                                                    @if($userPartnerRequest->file_paths)
                                                        <div class="d-flex flex-wrap gap-2">
                                                            @foreach($userPartnerRequest->file_paths as $path)
                                                                <a href="{{ asset('storage/' . $path) }}" target="_blank">
                                                                    <img src="{{ asset('storage/' . $path) }}" class="rounded" width="50" height="50" style="object-fit: cover;">
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            @else
                                                <form action="{{ route('mutual-aid.request') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="type" value="partner">
                                                    <div class="mb-3">
                                                        <label for="partner_message" class="form-label text-muted small">Ваше сообщение</label>
                                                        <textarea name="message" id="partner_message" rows="4" class="form-control" placeholder="Опишите, какого напарника вы ищете..."></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="partner_files" class="form-label text-muted small">Фото или видео (можно выбрать несколько)</label>
                                                        <input type="file" name="files[]" id="partner_files" class="form-control" accept="image/*,video/*" multiple>
                                                    </div>
                                                    <button type="submit" class="btn btn-dark w-100 py-2">Отправить запрос</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Request Coach Form/Status -->
                                <div class="col-md-6">
                                    <div class="card h-100 shadow-sm border-0">
                                        <div class="card-body">
                                            <h5 class="card-title fw-bold mb-4">Запросить коуча</h5>
                                            @if($acceptedCoach)
                                                @php $helper = $acceptedCoach->leader(); @endphp
                                                <div class="alert alert-success border-0 mb-0">
                                                    <p class="fw-bold mb-2">Запрос принят!</p>
                                                    <p class="mb-2">Ваш коуч: 
                                                        <a href="{{ route('post.index', $helper->id) }}" class="fw-bold text-dark text-decoration-underline">
                                                            {{ $helper->name }}
                                                        </a>
                                                    </p>
                                                    <p class="text-muted small mb-0">Теперь вы можете взаимодействовать.</p>
                                                </div>
                                            @elseif($userCoachRequest)
                                                <div class="alert alert-dark border-0 bg-light mb-0">
                                                    <p class="fw-bold mb-2">Запрос отправлен (Ожидание)</p>
                                                    <p class="text-muted small mb-3">{{ $userCoachRequest->message }}</p>
                                                    @if($userCoachRequest->file_paths)
                                                        <div class="d-flex flex-wrap gap-2">
                                                            @foreach($userCoachRequest->file_paths as $path)
                                                                <a href="{{ asset('storage/' . $path) }}" target="_blank">
                                                                    <img src="{{ asset('storage/' . $path) }}" class="rounded" width="50" height="50" style="object-fit: cover;">
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            @else
                                                <form action="{{ route('mutual-aid.request') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="type" value="coach">
                                                    <div class="mb-3">
                                                        <label for="coach_message" class="form-label text-muted small">Ваше сообщение</label>
                                                        <textarea name="message" id="coach_message" rows="4" class="form-control" placeholder="Какие вопросы вы хотели бы обсудить с коучем?"></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="coach_files" class="form-label text-muted small">Фото или видео (можно выбрать несколько)</label>
                                                        <input type="file" name="files[]" id="coach_files" class="form-control" accept="image/*,video/*" multiple>
                                                    </div>
                                                    <button type="submit" class="btn btn-dark w-100 py-2">Отправить запрос</button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Experienced User Content -->
                        <div class="tab-pane fade" id="experienced-user-content" role="tabpanel" aria-labelledby="experienced-user-tab">
                            <div class="d-flex flex-column gap-4">
                        <!-- Switch 1: Partner -->
                        <div class="d-flex justify-content-between align-items-center border p-3 rounded">
                            <div>
                                <h5 class="mb-1">Готов стать напарником</h5>
                                <p class="text-muted small mb-0">Включите, если вы готовы стать напарником для других пользователей</p>
                                @if(auth()->user()->is_assistant === 'pending')
                                    <span class="badge bg-warning text-dark mt-2">На рассмотрении</span>
                                @endif
                                @if(auth()->user()->is_assistant === 'active' || auth()->user()->is_assistant === 'pending')
                                    <div class="mt-2 small text-primary">
                                        Максимум человек: {{ auth()->user()->max_assistant_count > 0 ? auth()->user()->max_assistant_count : 'Без ограничений' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                       id="partnerSwitch"
                                       data-type="partner"
                                       {{ (auth()->user()->is_assistant === 'active' || auth()->user()->is_assistant === 'pending') ? 'checked' : '' }}
                                       {{ auth()->user()->is_assistant === 'pending' ? 'disabled' : '' }}>
                            </div>
                        </div>

                        <!-- Switch 2: Coach -->
                        <div class="d-flex justify-content-between align-items-center border p-3 rounded">
                            <div>
                                <h5 class="mb-1">Хочу стать коучом</h5>
                                <p class="text-muted small mb-0">Включите, если вы хотите предложить услуги коучинга</p>
                                @if(auth()->user()->is_coach === 'pending')
                                    <span class="badge bg-warning text-dark mt-2">На рассмотрении</span>
                                @endif
                                @if(auth()->user()->is_coach === 'active' || auth()->user()->is_coach === 'pending')
                                    <div class="mt-2 small text-primary">
                                        Максимум человек: {{ auth()->user()->max_coach_count > 0 ? auth()->user()->max_coach_count : 'Без ограничений' }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input status-toggle" type="checkbox" role="switch"
                                       id="coachSwitch"
                                       data-type="coach"
                                       {{ (auth()->user()->is_coach === 'active' || auth()->user()->is_coach === 'pending') ? 'checked' : '' }}
                                       {{ auth()->user()->is_coach === 'pending' ? 'disabled' : '' }}>
                            </div>
                            </div>
                            
                            <!-- Tables Section (Moved here) -->
                            <div class="mt-4">
                                <div class="row">
                                    <!-- Table 1: Who I am a partner for -->
                                    <div class="col-md-6">
                                        <h4 class="mb-3">Для кого я напарник</h4>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Имя</th>
                                                        <th>Контакты</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($myPartnering as $conn)
                                                        @php $ven = $conn->venerable(); @endphp
                                                        <tr>
                                                            <td>{{ $ven ? $ven->name : 'N/A' }}</td>
                                                            <td>{{ ($ven && $ven->contact_info) ? $ven->contact_info : 'Не указано' }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="2" class="text-center text-muted">Список пуст</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Table 2: Who I am a coach for -->
                                    <div class="col-md-6">
                                        <h4 class="mb-3">Для кого я коуч</h4>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Имя</th>
                                                        <th>Контакты</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($myCoaching as $conn)
                                                        @php $ven = $conn->venerable(); @endphp
                                                        <tr>
                                                            <td>{{ $ven ? $ven->name : 'N/A' }}</td>
                                                            <td>{{ ($ven && $ven->contact_info) ? $ven->contact_info : 'Не указано' }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="2" class="text-center text-muted">Список пуст</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-5">

                                <!-- New Section: Incoming Requests -->
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="mb-0">Запросы на помощь</h4>
                                            <div class="btn-group" role="group" id="request-filter-group">
                                                <button type="button" class="btn btn-outline-dark btn-sm active" data-type="all">Все</button>
                                                <button type="button" class="btn btn-outline-dark btn-sm" data-type="partner">Напарники</button>
                                                <button type="button" class="btn btn-outline-dark btn-sm" data-type="coach">Коучи</button>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-hover align-middle">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Пользователь</th>
                                                        <th>Тип</th>
                                                        <th>Сообщение</th>
                                                        <th>Файлы</th>
                                                        <th>Дата</th>
                                                        <th>Действие</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="requests-table-body">
                                                    @include('partials.mutual-aid-table', ['requests' => $requests])
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notification Modal/Toast equivalent can be handled with js alert for simplicity or complex modal if requested -->
    <!-- Using script for AJAX handling -->
    <!-- Coach Contact Info Modal -->
    <div class="modal fade" id="coachContactModal" tabindex="-1" aria-labelledby="coachContactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="coachContactModalLabel">Заявка на коуча</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Пожалуйста, заполните данные для заявки.</p>
                    <div class="mb-3">
                        <label for="contactInfo" class="form-label">Telegram / Контакты</label>
                        <input type="text" class="form-control" id="contactInfo" required placeholder="@uzername">
                    </div>
                    <div class="mb-3">
                         <label for="coachMaxCount" class="form-label">Максимальное количество людей (для коучинга)</label>
                         <input type="number" class="form-control" id="coachMaxCount" min="0" value="0">
                         <div class="form-text">0 = без ограничений</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-primary" id="submitCoachRequest">Отправить заявку</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Partner Limit Modal -->
    <div class="modal fade" id="partnerLimitModal" tabindex="-1" aria-labelledby="partnerLimitModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="partnerLimitModalLabel">Стать напарником</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                         <label for="partnerMaxCount" class="form-label">Максимальное количество людей (для напарничества)</label>
                         <input type="number" class="form-control" id="partnerMaxCount" min="0" value="0">
                         <div class="form-text">0 = без ограничений</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-primary" id="submitPartnerRequest">Сохранить</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script for AJAX and Modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggles = document.querySelectorAll('.status-toggle');
            
            // Coach elements
            const coachSwitch = document.getElementById('coachSwitch');
            const contactModal = new bootstrap.Modal(document.getElementById('coachContactModal'));
            const submitCoachBtn = document.getElementById('submitCoachRequest');
            const contactInput = document.getElementById('contactInfo');
            const coachMaxCountInput = document.getElementById('coachMaxCount');

            // Partner elements
            const partnerSwitch = document.getElementById('partnerSwitch');
            const partnerModal = new bootstrap.Modal(document.getElementById('partnerLimitModal'));
            const submitPartnerBtn = document.getElementById('submitPartnerRequest');
            const partnerMaxCountInput = document.getElementById('partnerMaxCount');


            // Handle toggles
            toggles.forEach(toggle => {
                toggle.addEventListener('change', function(e) {
                    const type = this.dataset.type;
                    const status = this.checked ? 1 : 0;
                    const originalState = !this.checked;

                    // Turning ON functionality
                    if (status === 1) {
                        e.preventDefault();
                        this.checked = false; // Revert visually until confirmed
                        
                        if (type === 'coach') {
                            contactModal.show();
                        } else if (type === 'partner') {
                            partnerModal.show();
                        }
                        return;
                    }

                    // Turning OFF - proceed immediately
                    sendToggleRequest(type, status, originalState, this);
                });
            });

            // Handle Coach Submit
            submitCoachBtn.addEventListener('click', function() {
                const contact = contactInput.value.trim();
                const maxCount = coachMaxCountInput.value;

                if (!contact) {
                    alert('Пожалуйста, укажите контактные данные');
                    return;
                }

                // Send request for Coach ON
                sendToggleRequest('coach', 1, false, coachSwitch, contact, maxCount);
                contactModal.hide();
            });

            // Handle Partner Submit
            submitPartnerBtn.addEventListener('click', function() {
                const maxCount = partnerMaxCountInput.value;
                
                // Send request for Partner ON
                sendToggleRequest('partner', 1, false, partnerSwitch, null, maxCount);
                partnerModal.hide();
            });


            function sendToggleRequest(type, status, originalState, toggleElement, contactInfo = null, maxCount = null) {
                const bodyData = { type: type, status: status };
                if (contactInfo) {
                    bodyData.contact_info = contactInfo;
                }
                if (maxCount !== null) {
                    bodyData.max_count = maxCount;
                }

                fetch("{{ route('mutual-aid.toggle') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(bodyData)
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        alert(data.message);
                        if(data.status === 'pending' || data.status === 'active') {
                            location.reload(); 
                        }
                        // Visually update the toggle if we are enabling
                        if (status === 1) {
                            toggleElement.checked = true;
                        }
                    } else {
                        alert(data.message || 'Ошибка при обновлении статуса');
                        toggleElement.checked = originalState; // Revert
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Произошла ошибка');
                    toggleElement.checked = originalState; // Revert
                });
            }

            // AJAX Filtering for requests
            const filterGroup = document.getElementById('request-filter-group');
            const tableBody = document.getElementById('requests-table-body');

            if (filterGroup && tableBody) {
                filterGroup.addEventListener('click', function(e) {
                    const btn = e.target.closest('button');
                    if (!btn) return;

                    const type = btn.dataset.type;
                    
                    // Update UI
                    filterGroup.querySelectorAll('button').forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');

                    // Show loading state
                    tableBody.style.opacity = '0.5';

                    let url = "{{ route('mutual-aid') }}";
                    if (type !== 'all') {
                        url += `?type=${type}`;
                    }

                    fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        tableBody.innerHTML = html;
                        tableBody.style.opacity = '1';
                    })
                    .catch(error => {
                        console.error('Error filtering requests:', error);
                        tableBody.style.opacity = '1';
                        alert('Ошибка при загрузке данных');
                    });
                });
            }
        });
    </script>
</x-app-layout>