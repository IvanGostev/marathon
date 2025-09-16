<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Главная страница') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
    <script src="{{ asset('ru/ru.js')}}"></script>

    <div class="container">
        <div class="row py-10 bsb-timeline-1">
            <div class="col-md-3">
                <div class="list-group bg-light" style="padding: 10px 10px 20px 10px">
                    <a style="margin: 10px 10px" href="{{route('note.create')}}" class=" btn btn-dark"
                       aria-current="true">
                        Написать отчет
                    </a>
                    <ul class="timeline">
                        <li class="timeline-item">
                            <div class="timeline-body">
                                <div class="timeline-content">
                                    <div class="card border-0">
                                        <div class="card-body p-1g">
                                            <h6 class="card-title p-1 text-secondary">Создания отчета</h6>
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
                                            <h6 class="card-title p-1 text-secondary">Просмотр отчета</h6>
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
                </div>
            </div>
            <div class="col-md-9">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <div class="container-fluid" style="        padding-left: 0;">
                                <div class="navbar-collapse" id="navbarNavAltMarkup">
                                    <div class="navbar-nav fw-medium">
                                        <a class="nav-link {{in_array('dashboard' , explode('/', request()->url())) ? 'active text-decoration-underline' : ''}}"
                                           href="{{route('dashboard')}}">Отчеты</a>
                                        <a class="nav-link {{in_array('videos' , explode('/', request()->url())) ? 'active text-decoration-underline' : ''}}"
                                           href="{{route('video.index')}}">
                                            {{ __('Теория') }}
                                        </a>

                                        <a class="nav-link {{in_array('notes' , explode('/', request()->url())) ? 'active text-decoration-underline' : ''}}"
                                           href="{{route('note.index')}}">
                                            {{ __('Статистика') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </nav>

                        <div class="p-6 text-gray-900">

                            <p class="h5">
                                Дорогой друг! Мы рады приветствовать тебя на платформе марафона «Бриллиантовая читка» —
                                пространстве, где рождаются новые навыки, глубкие открытия и настоящая дружба на основе
                                любви к обучению.


                                Здесь тебя ждет не просто чтение, а настоящая трансформация: ты будешь учиться по
                                эффективной 5-шаговой технологии обучения, которая поможет не просто читать, а усваивать
                                и применять знания из книг. И все это — в уникальной атмосфере поддержки, мотивации и
                                здоровой конкуренции вместе с другими читателями, напарниками и коучами.


                                Готовься стать частью сообщества, где растут вместе!</p>
                            <br>
                            <p class="h5">1. Как устроен марафон? Суть, правила и система мотивации</p>
                            <p class="h6">Ваша главная задача:</p>
                            <p>Ежедневно читать не менее 20 минут, писать отчет о прочитанном и проверять отчеты двух других участников. Это основа нашего роста и взаимной поддержки.

</p>




                            <p class="h6">Три роли для участия и победы: <br>
                                В нашем марафоне каждый может найти свою роль и возможность блеснуть!
                            </p>




<p> 1. Читатель (основная роль) <br> 2. Напарник (добровольная роль) <br> 3. Коуч (добровольная роль) <br>
Стать Напарником или Коучем может любой участник! Укажите эту цель в своем профиле в разделе «Мой блог» и выберите максимальное количество людей, которым вы готовы помочь.
    <br>Награды и признание:
    <br> Победители ежемесячно получают денежные призы (скидки на следующий месяц) и эксклюзивные значки в виде звезды в круге, которые отображаются в вашем профиле и показывают вашу историю побед!
    <br>Итоги подводятся после 18:00 последнего дня месяца. Все отчеты и оценки, отправленные позже, не учитываются. Рейтинг победителей будет висеть на главной до 18:00 последнего дня следующего месяца!
    <br>
</p>

                 <p class="h5">2. Правила нашего пространства</p>












                                Чтобы наша платформа оставалась комфортной и безопасной для всех, просим соблюдать следующие правила:
                            <br>












                                Не передавать ссылки для доступа на платформу тем, кто не является участником марафона.
                            <br>












                                ✅ Можно делиться ссылкой на свой личный блог с друзьями и знакомыми. <br>












                                ⚠️ Категорически запрещены: оскорбления, хамство, ненормативная лексика, разжигание розни, публикация рекламы, спам и флуд.
                            <br>












                                ‍♂️ Нарушители будут удалены из чата и с платформы без предупреждения. <br>












                                Мы создаем пространство уважения и доверия. Давайте поддерживать его вместе! <br>












                                Желаем вам яркого путешествия в мир книг, искренней поддержки и заслуженных побед! <br>












                                Кто это: Специалист, который профессионально помогает тебе быстрее и качественнее усвоить материал книги. Ставит цели, делится инструментами и поддерживает на каждом этапе.
                            <br>












                                Полные и актуальные правила марафона, детальные условия участия и критерии победы в номинациях всегда можно посмотреть в приложенном файле:

                            <br>
                            <br>

                            <a class="btn btn-dark" href="{{asset('files/ПравилаМарафонаБрю-Ч.pdf')}}">Правила</a>

                            <br>
                            <br>
                            <p class="h5">3: Доска победителей</p>


                                Мы гордимся нашими чемпионами! Ежемесячно мы подводим итоги и отмечаем самых активных и вдохновляющих участников.
                            <br>
  Как это будет выглядеть: <br>
  На главной странице сайта будет размещен специальный блок «Победители [Месяц] [Год]».
                            <br>
  В нем будут отображены: <br>
  Имена и аватары победителей в основных номинациях. <br>
                            Иконки их побед (например, ⭐ для «Читателя месяца»). <br>
Их результаты (например, количество отчетов или средний балл). <br>
Этот блок будет обновляться после 18:00 последнего дня месяца и оставаться на видном месте до конца следующего месяца, чтобы все могли поздравить победителей и взять с них пример!
                            <br>
 Ваше имя может быть следующим!<br>
                            </p>

                        </div>
                    </div>
                </div>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsive">
                        <h5 class="h5">Книги</h5>
                        <br>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Название</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($books as $book)
                                <tr>
                                    <td>{{$book->title}}</td>
                                    <td>
                                        <a class="btn btn-dark" href="{{$book->link}}">Читать</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
