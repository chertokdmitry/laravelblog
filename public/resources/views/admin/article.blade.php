@extends('admin.main')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $item['title'] }}</h1>
    </div>

    <div class="card">
        <img class="card-img-top" src="/public/photos/{{ $item['url'] }}">
        <div class="card-body">
            <p class="card-text">{{ $item['content'] }}</p>
        </div>
    </div>

@endsection