@extends('admin.main')

@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Новая категория</h1>
    </div>
        <div>
            <br><br>
            <form method="POST" action="/category">
                @csrf
                <label for="title">Название</label>
                <input type="text"
                       class="form-control"
                       id="title"
                       name="title"
                       placeholder=" Название">
                <br><br>
                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>

@endsection
