@extends('admin.main')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Панель управления</h1>

</div>
<h4 class="pb-3 font-italic">
    Общая статистика:
</h4>
<ul>
    <li>Статьи: {{ $articles }}</li>
    <li>Категории: {{ $categories }}</li>
    <li>Комментарии: {{ $comments }}</li>
</ul>
<br><br>
<h4 class="pb-3 font-italic">
    Cтатистика за сегодня:
</h4>
<ul>
    <li>Статьи: 0</li>
    <li>Категории: 0</li>
    <li>Комментарии: 0</li>
</ul>

@endsection
