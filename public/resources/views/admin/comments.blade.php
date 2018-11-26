@extends('admin.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Комментарии</h1>
    </div>
    <div class="container">
        {{ $items->links() }}
        @foreach ($items as $comment)
            <div class="card" style="margin-top:20px;">
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p>{{ $comment['text'] }}</p>
                        <footer class="blockquote-footer">{{ $comment['name'] }}
                            <cite title="Source Title">{{ $comment['email'] }}</cite>
                        </footer>
                    </blockquote>
                </div>
            </div>
        @endforeach
        <br><br>
        {{ $items->links() }}
        <br><br>
    </div>
@endsection