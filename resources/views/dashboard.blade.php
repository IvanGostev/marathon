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
                    <a  style="border-color: #008000!important; background-color: #008000!important; margin: 10px 10px" href="{{route('note.create')}}" class=" btn btn-dark"
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

                            <p class="h6">
                                Дорогой друг! Мы рады приветствовать тебя на платформе марафона «Бриллиантовая читка» —
                                пространстве, где рождаются новые навыки, глубкие открытия и настоящая дружба на основе
                                любви к обучению.


                                Здесь тебя ждет не просто чтение, а настоящая трансформация: ты будешь учиться по
                                эффективной 5-шаговой технологии обучения, которая поможет не просто читать, а усваивать
                                и применять знания из книг. И все это — в уникальной атмосфере поддержки, мотивации и
                                здоровой конкуренции вместе с другими читателями, напарниками и коучами.


                                Готовься стать частью сообщества, где растут вместе!</p>
                            <br>
                            <p class="h6">1. Как устроен марафон? Суть, правила и система мотивации</p>
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

                 <p class="h6">2. Правила нашего пространства</p>












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
                            <p class="h6">3: Доска победителей</p>


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
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pb-10">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsive">
                        <p style="font-size: 18px">
                            Победители ежемесячно получают денежные призы (скидки на следующий месяц) и эксклюзивные значки в
                            виде звезды в круге, которые отображаются в вашем профиле и показывают вашу историю побед!
                            <br>
                            <br>
                        </p>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Номинация</th>
                                <th scope="col">Пользователь</th>
                                <th scope="col">Критерий победы (месяц)</th>
                                <th scope="col">Награда (скидка)</th>
                                <th scope="col">Значок (в круге)</th>

                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>Настойчивый читатель</th>
                                <th>-</th>
                                <th>20+ отчетов</th>
                                <th>10%</th>
                                <th>
                                    <div style="width: 30px; height: 30px">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                            <!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                            <path fill="#fde910"
                                                  d="M320 64C324.6 64 329.2 65 333.4 66.9L521.8 146.8C543.8 156.1 560.2 177.8 560.1 204C559.6 303.2 518.8 484.7 346.5 567.2C329.8 575.2 310.4 575.2 293.7 567.2C121.3 484.7 80.6 303.2 80.1 204C80 177.8 96.4 156.1 118.4 146.8L306.7 66.9C310.9 65 315.4 64 320 64zM320 130.8L320 508.9C458 442.1 495.1 294.1 496 205.5L320 130.9L320 130.9z"/>
                                        </svg>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>Читатель месяца</th>
                                <th>-</th>
                                <th>Максимум отчетов</th>
                                <th>90%</th>
                                <th>
                                    <div style="width: 30px; height: 30px">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                            <!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                            <path fill="red"
                                                  d="M320 64C324.6 64 329.2 65 333.4 66.9L521.8 146.8C543.8 156.1 560.2 177.8 560.1 204C559.6 303.2 518.8 484.7 346.5 567.2C329.8 575.2 310.4 575.2 293.7 567.2C121.3 484.7 80.6 303.2 80.1 204C80 177.8 96.4 156.1 118.4 146.8L306.7 66.9C310.9 65 315.4 64 320 64zM320 130.8L320 508.9C458 442.1 495.1 294.1 496 205.5L320 130.9L320 130.9z"/>
                                        </svg>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>Вдохновляющий читатель</th>
                                <th>-</th>
                                <th>Высший средний балл</th>
                                <th>50%</th>
                                <th>
                                    <div style="width: 30px; height: 30px">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                            <!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                            <path fill="#fde910"
                                                  d="M557.7 64.9L363.5 139.6L365.8 110.3C366.8 97.5 353 88.8 341.8 95.2L165.3 197.4C102.6 233.7 64 300.6 64 373C64 485.1 154.9 576 267 576C339.4 576 406.3 537.4 442.6 474.7L544.8 298.3C551.3 287.2 542.6 273.3 529.7 274.3L500.4 276.6L575.1 82.4C575.7 80.9 576 79.2 576 77.6C576 70.1 570 64.1 562.5 64.1C560.8 64.1 559.2 64.4 557.7 65zM256 256C326.7 256 384 313.3 384 384C384 454.7 326.7 512 256 512C185.3 512 128 454.7 128 384C128 313.3 185.3 256 256 256zM256 352C256 334.3 241.7 320 224 320C206.3 320 192 334.3 192 352C192 369.7 206.3 384 224 384C241.7 384 256 369.7 256 352zM272 448C280.8 448 288 440.8 288 432C288 423.2 280.8 416 272 416C263.2 416 256 423.2 256 432C256 440.8 263.2 448 272 448z"/>
                                        </svg>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>Популярный читатель</th>
                                <th>-</th>
                                <th>Больше всех откликов</th>
                                <th>50%</th>
                                <th>
                                    <div style="width: 30px; height: 30px">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                            <!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                            <path fill="#fde910"
                                                  d="M320 64C355.3 64 384 92.7 384 128C384 163.3 355.3 192 320 192C284.7 192 256 163.3 256 128C256 92.7 284.7 64 320 64zM416 376C416 401 403.3 423 384 435.9L384 528C384 554.5 362.5 576 336 576L304 576C277.5 576 256 554.5 256 528L256 435.9C236.7 423 224 401 224 376L224 336C224 283 267 240 320 240C373 240 416 283 416 336L416 376zM160 96C190.9 96 216 121.1 216 152C216 182.9 190.9 208 160 208C129.1 208 104 182.9 104 152C104 121.1 129.1 96 160 96zM176 336L176 368C176 400.5 188.1 430.1 208 452.7L208 528C208 529.2 208 530.5 208.1 531.7C199.6 539.3 188.4 544 176 544L144 544C117.5 544 96 522.5 96 496L96 439.4C76.9 428.4 64 407.7 64 384L64 352C64 299 107 256 160 256C172.7 256 184.8 258.5 195.9 262.9C183.3 284.3 176 309.3 176 336zM432 528L432 452.7C451.9 430.2 464 400.5 464 368L464 336C464 309.3 456.7 284.4 444.1 262.9C455.2 258.4 467.3 256 480 256C533 256 576 299 576 352L576 384C576 407.7 563.1 428.4 544 439.4L544 496C544 522.5 522.5 544 496 544L464 544C451.7 544 440.4 539.4 431.9 531.7C431.9 530.5 432 529.2 432 528zM480 96C510.9 96 536 121.1 536 152C536 182.9 510.9 208 480 208C449.1 208 424 182.9 424 152C424 121.1 449.1 96 480 96z"/>
                                        </svg>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>Успешный напарник/коуч</th>
                                <th>-</th>
                                <th>Подопечный победил</th>
                                <th>50%</th>
                                <th>
                                    <div style="width: 30px; height: 30px">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                            <!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                            <path fill="#fde910"
                                                  d="M300.9 149.2L184.3 278.8C179.7 283.9 179.9 291.8 184.8 296.7C215.3 327.2 264.8 327.2 295.3 296.7L327.1 264.9C331.3 260.7 336.6 258.4 342 258C348.8 257.4 355.8 259.7 361 264.9L537.6 440L608 384L608 96L496 160L472.2 144.1C456.4 133.6 437.9 128 418.9 128L348.5 128C347.4 128 346.2 128 345.1 128.1C328.2 129 312.3 136.6 300.9 149.2zM148.6 246.7L255.4 128L215.8 128C190.3 128 165.9 138.1 147.9 156.1L144 160L32 96L32 384L188.4 514.3C211.4 533.5 240.4 544 270.3 544L286 544L279 537C269.6 527.6 269.6 512.4 279 503.1C288.4 493.8 303.6 493.7 312.9 503.1L353.9 544.1L362.9 544.1C382 544.1 400.7 539.8 417.7 531.8L391 505C381.6 495.6 381.6 480.4 391 471.1C400.4 461.8 415.6 461.7 424.9 471.1L456.9 503.1L474.4 485.6C483.3 476.7 485.9 463.8 482 452.5L344.1 315.7L329.2 330.6C279.9 379.9 200.1 379.9 150.8 330.6C127.8 307.6 126.9 270.7 148.6 246.6z"/>
                                        </svg>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>Напарник/Коуч месяца</th>
                                <th>-</th>
                                <th>Подопечный — лучший!</th>
                                <th>90%</th>
                                <th>
                                    <div style="width: 30px; height: 30px">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                            <!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                            <path fill="red"
                                                  d="M80 259.8L289.2 345.9C299 349.9 309.4 352 320 352C330.6 352 341 349.9 350.8 345.9L593.2 246.1C602.2 242.4 608 233.7 608 224C608 214.3 602.2 205.6 593.2 201.9L350.8 102.1C341 98.1 330.6 96 320 96C309.4 96 299 98.1 289.2 102.1L46.8 201.9C37.8 205.6 32 214.3 32 224L32 520C32 533.3 42.7 544 56 544C69.3 544 80 533.3 80 520L80 259.8zM128 331.5L128 448C128 501 214 544 320 544C426 544 512 501 512 448L512 331.4L369.1 390.3C353.5 396.7 336.9 400 320 400C303.1 400 286.5 396.7 270.9 390.3L128 331.4z"/>
                                        </svg>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>Вдохновляющий напарник/коуч</th>
                                <th>-</th>
                                <th>Высший балл за помощь</th>
                                <th>50%</th>
                                <th>
                                    <div style="width: 30px; height: 30px">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                            <!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                            <path fill="#fde910"
                                                  d="M80 259.8L289.2 345.9C299 349.9 309.4 352 320 352C330.6 352 341 349.9 350.8 345.9L593.2 246.1C602.2 242.4 608 233.7 608 224C608 214.3 602.2 205.6 593.2 201.9L350.8 102.1C341 98.1 330.6 96 320 96C309.4 96 299 98.1 289.2 102.1L46.8 201.9C37.8 205.6 32 214.3 32 224L32 520C32 533.3 42.7 544 56 544C69.3 544 80 533.3 80 520L80 259.8zM128 331.5L128 448C128 501 214 544 320 544C426 544 512 501 512 448L512 331.4L369.1 390.3C353.5 396.7 336.9 400 320 400C303.1 400 286.5 396.7 270.9 390.3L128 331.4z"/>
                                        </svg>
                                    </div>
                                </th>
                            </tr>


                            </tbody>
                        </table>
                        <p style="font-size: 18px">
                            <br>
                            Ваши победы суммируются! Цифра рядом со значком— это количество месяцев, когда вы брали эту высоту.
                            Покажите всем, на что вы способны!
                            Итоги подводятся после 18:00 последнего дня месяца. Все отчеты и оценки, отправленные позже, не
                            учитываются. Рейтинг победителей будет висеть на главной до 18:00 следующего месяца!
                        </p>
                    </div>
                </div>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg table-responsive">
                        <h6 class="h5">Книги</h6>
                        <a class="btn btn-dark" href="https://disk.yandex.ru/d/qC3pNr7IJB3nRw">Онлайн библиотека</a>
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
