<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Разработчик проекта | Иван Гостев</title>
    <meta name="robots" content="noindex, nofollow, noarchive, nosnippet, noimageindex">
    <meta name="googlebot" content="noindex, nofollow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Иван Гостев — Разработчик IT-решений">
    <meta property="og:description" content="Создание высокотехнологичных платформ, систем взаимопомощи и интеллектуальных сервисов.">
    <meta property="og:image" content="{{ asset('images/dev-preview.jpg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="Иван Гостев — Разработчик IT-решений">
    <meta property="twitter:description" content="Создание высокотехнологичных платформ, систем взаимопомощи и интеллектуальных сервисов.">
    <meta property="twitter:image" content="{{ asset('images/dev-preview.jpg') }}">
    <style>
        :root {
            --bg: #000;
            --text: #fff;
            --muted: #666;
            --accent: #fff;
            --border: #222;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
        }

        /* Навигация */
        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 15px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid var(--border);
        }

        .logo {
            font-size: 0.8rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-weight: 700;
            padding-right: 20px;
            max-width: 70%;
            line-height: 1.2;
        }

        .nav-btn {
            background: var(--text);
            color: var(--bg);
            padding: 10px 25px;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 700;
            border-radius: 4px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
            flex-shrink: 0;
        }

        .nav-btn:hover {
            opacity: 0.8;
            transform: translateY(-2px);
        }

        /* Контент */
        main {
            padding: 160px 20px 80px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .hero {
            text-align: center;
            max-width: 900px;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 1s forwards;
        }

        h1 {
            font-size: 1.2rem;
            letter-spacing: 4px;
            font-weight: 400;
            color: var(--muted);
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .name {
            font-size: clamp(3.5rem, 12vw, 7rem);
            font-weight: 800;
            margin: 0;
            letter-spacing: -4px;
            line-height: 0.9;
        }

        .desc {
            font-size: 1.2rem;
            color: #888;
            margin-top: 30px;
            line-height: 1.6;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 40px;
            margin-top: 100px;
            width: 100%;
            max-width: 1100px;
        }

        .feature-item {
            padding: 40px;
            border: 1px solid var(--border);
            border-radius: 20px;
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
            background: #050505;
            cursor: pointer;
            overflow: hidden;
            text-align: left;
        }

        .feature-item:hover {
            border-color: #444;
            transform: scale(1.02);
            background: #0a0a0a;
        }

        .feature-item h3 {
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #fff;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .feature-item h3::before {
            content: '';
            width: 8px;
            height: 8px;
            background: var(--text);
            border-radius: 50%;
        }

        .feature-item p {
            font-size: 1rem;
            color: #666;
            line-height: 1.7;
            transition: 0.3s;
        }

        .feature-item:hover p {
            color: #aaa;
        }

        .interactive-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }

        .blob {
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(80px);
            transition: 0.1s ease;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            nav {
                padding: 15px 20px;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .name {
                letter-spacing: -2px;
            }
        }
    </style>
</head>

<body>
    <div class="interactive-bg">
        <canvas id="starfield"></canvas>
        <div class="blob" id="mouse-blob"></div>
    </div>

    <nav>
        <div class="logo">Иван Гостев разработчик БРИЛЬЯНТОВОЙ ЧИТКИ</div>
        <a href="https://t.me/ivangostevdeveloper" class="nav-btn" target="_blank">СВЯЗАТЬСЯ В TELEGRAM</a>
    </nav>

    <main>
        <section class="hero">
            <h1>Разработчик данного проекта</h1>
            <div class="name">Иван Гостев</div>
            <p class="desc">
                Вся архитектура, программный код и визуальная составляющая платформы, на которой вы сейчас находитесь,
                полностью разработаны мной.
            </p>

            <div class="features-grid">
                <div class="feature-item">
                    <h3>Разработка Блога</h3>
                    <p>Мной была создана интеллектуальная система обмена знаниями с поддержкой медиафайлов и сложной
                        структурой данных для удобного чтения.</p>
                </div>
                <div class="feature-item">
                    <h3>Система Взаимопомощи</h3>
                    <p>Я спроектировал уникальный механизм автоматического подбора коучей и напарников, который
                        соединяет пользователей в реальном времени.</p>
                </div>
                <div class="feature-item">
                    <h3>Логика Геймификации</h3>
                    <p>Мной разработана система достижений и рейтингов, которая превращает каждое ваше действие на сайте
                        в прогресс и социальный статус.</p>
                </div>
                <div class="feature-item">
                    <h3>Управление Прогрессом</h3>
                    <p>Я внедрил аналитические инструменты и личные кабинеты, позволяющие пользователям эффективно
                        отслеживать свое развитие внутри платформы.</p>
                </div>
            </div>

            <div style="margin-top: 100px; padding-bottom: 50px;">
                <p style="color: #333; font-size: 0.8rem; letter-spacing: 5px; text-transform: uppercase;">Ваш проект
                    заслуживает лучшей реализации &bull; 2026</p>
            </div>
        </section>
    </main>

    <script>
        const canvas = document.getElementById('starfield');
        const ctx = canvas.getContext('2d');
        let width, height, stars = [];

        function init() {
            width = window.innerWidth;
            height = window.innerHeight;
            canvas.width = width;
            canvas.height = height;
            stars = [];
            for (let i = 0; i < 200; i++) {
                stars.push({
                    x: Math.random() * width,
                    y: Math.random() * height,
                    size: Math.random() * 2,
                    speed: Math.random() * 0.5 + 0.1
                });
            }
        }

        function animate() {
            ctx.clearRect(0, 0, width, height);
            ctx.fillStyle = '#fff';
            stars.forEach(star => {
                ctx.beginPath();
                ctx.arc(star.x, star.y, star.size, 0, Math.PI * 2);
                ctx.fill();
                star.y -= star.speed;
                if (star.y < 0) {
                    star.y = height;
                    star.x = Math.random() * width;
                }
            });
            requestAnimationFrame(animate);
        }

        window.addEventListener('resize', init);
        init();
        animate();

        const blob = document.getElementById('mouse-blob');
        document.addEventListener('mousemove', (e) => {
            const x = e.clientX - 250;
            const y = e.clientY - 250;
            blob.style.transform = `translate(${x}px, ${y}px)`;
        });
    </script>
</body>

</html>