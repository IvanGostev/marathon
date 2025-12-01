<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>БРИЛЛИАНТОВАЯ ЧИТКА - Оплата успешна прошла!</title>
    <style>
        body {
            margin: 0 auto;
            padding: 0;
            height: 80vh;
            width: 80vw;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .development-message {
            font-size: 3rem;
            font-weight: bold;
            text-align: left;
        }

        .development-message span {
            display: inline-block;
            opacity: 0;
            animation: appear 0.5s forwards, blink 3s infinite 1s;
        }

        .space {
            display: inline-block;
            width: 0.5em;
        }

        @keyframes appear {
            to {
                opacity: 1;
            }
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }
    </style>
</head>
<body>
<div class="development-message" id="message"></div>
<a href="{{route('subscribe.index')}}" style="margin: 0 auto;">Вернуться на сайт</a>
<script>
    const text = "Оплата успешна прошла!";
    const messageElement = document.getElementById('message');

    function typeText() {
        messageElement.innerHTML = '';

        for (let i = 0; i < text.length; i++) {
            if (text[i] === ' ') {
                const space = document.createElement('span');
                space.className = 'space';
                messageElement.appendChild(space);
            } else {
                const span = document.createElement('span');
                span.textContent = text[i];
                span.style.animationDelay = `${i * 0.1}s`;
                messageElement.appendChild(span);
            }
        }
    }

    typeText();
</script>
</body>
</html>
