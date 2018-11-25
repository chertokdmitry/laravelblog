@extends('admin.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Статьи</h1>
    </div>
    <div>
        <ul>
            @foreach ($items as $item)
                <li>
                    <a href="/article/{{ $item['id'] }}">{{ $item['title'] }}</a>
                </li>
            @endforeach
        </ul>
@endsection