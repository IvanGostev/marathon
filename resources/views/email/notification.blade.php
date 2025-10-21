<x-mail::message>
# {{$title}}

{{$text}}

<x-mail::button :url="'https://bru-ch.com/'">
Перейти на сайт
</x-mail::button>

Спасибо,<br>
{{ config('app.name') }}
</x-mail::message>
