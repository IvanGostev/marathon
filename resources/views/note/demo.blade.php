<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Просмотр отчета') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://unpkg.com/bs-brain@2.0.4/tutorials/timelines/timeline-1/assets/css/timeline-1.css">
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet"
          type="text/css"/>
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
    <script src="{{ asset('ru/ru.js')}}"></script>
    <div class="py-12 d-flex  mx-auto sm:px-6 lg:px-8 ">
        <!-- Timeline 1 - Bootstrap Brain Component -->
        <section class="bsb-timeline-1 py-5 py-xl-8" style="width: 100%">
            <div class="container">
                <div class="row justify-content-center gap-10">
                    <ul class=" col-sm-2 timeline">
                        <li class="timeline-item">
                            <div class="timeline-body">
                                <div class="timeline-content">
                                    <div class="card border-0">
                                        <div class="card-body p-1g">
                                            <h6 class="card-title p-1 text-secondary">Создание отчета</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="timeline-item">
                            <div class="timeline-body">
                                <div class="timeline-content">
                                    <div class="card border-0">
                                        <div class="card-body p-1g">
                                            <h6 class="card-title p-1 fw-medium">Просмотр отчета</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="timeline-item">
                            <div class="timeline-body">
                                <div class="timeline-content">
                                    <div class="card border-0">


                                        <div class="card-body p-1g">
                                            <h6 class="card-title p-1 text-secondary">Оценка первого отчета</h6>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-item">
                            <div class="timeline-body">
                                <div class="timeline-content">
                                    <div class="card border-0">


                                        <div class="card-body p-1g">
                                            <h6 class="card-title p-1 text-secondary">Оценка второго отчета</h6>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <form class="bg-white shadow sm:rounded-lg col-sm-8 p-2" action="{{route('note.store')}}"
                          method="post"
                          class="p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsive">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Название: книги(курса, урока....)</label>
                                <input disabled value="{{$data['book']}}" type="text" class="form-control"
                                       id="exampleFormControlInput1" name="book">
                                <input type="text" hidden name="book" value="{{$data['book']}}">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Раздел</label>
                            <input disabled value="{{$data['title']}}" type="text" class="form-control"
                                   id="exampleFormControlInput1" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Отчет</label>
                            <div
                                style="width: 100%; background-color: #e9ecef; min-height: 200px;     overflow-y: scroll;"
                                disabled
                                id="froala-editor" contenteditable="false" class="form-control" rows="20" name="text">
                                {!!$data['text']!!}
                            </div>
                            <input type="text" hidden name="text" value="{{$data['text']}}">
                            <input type="text" hidden name="results" value="{{$data['results']}}">
                            <input type="text" hidden name="go" value="{{$data['go']}}">
                            <input type="text" hidden name="title" value="{{$data['title']}}">
                            <select hidden multiple name="filesIds[]" id="">
                                @foreach($files as $file)
                                    <option selected value="{{$file->id}}">Object</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">
                                <h5>Подведи итоги</h5>
                            </label>
                            <textarea disabled required class="form-control" rows="4" name="text">@isset($data['results']){!! $data['results'] !!}@endisset</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">
                                <h5>Перескажи вслух</h5>
                            </label>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Файл</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($files as $file)
                                    <tr>
                                        <th scope="row">{{isset($count) ? $count = $count+1 : $count = 1}}</th>
                                        <td>
                                            <a target="_blank" href="{{asset('storage/'. $file->src)}}" class="btn  btn-outline-dark">Посмотреть
                                                вложение</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">
                                <h5 class="text-align-center">ДЕЙСТВУЙ! в течении 12 часов (макс 24 часов)</h5>
                            </label>
                            <textarea disabled required class="form-control" rows="4" name="go">@isset($data['go']){!! $data['go'] !!}@endisset</textarea>
                            <div style="display: flex; justify-content: space-between">
                                <button type="submit" name="action" value="back" class="btn btn-dark mt-3">
                                    Редактировать
                                </button>

                                <button type="submit" class="btn btn-dark mt-3">Отправить на проверку</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>


    <script>
    </script>
</x-app-layout>
