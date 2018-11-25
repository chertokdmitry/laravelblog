@extends('admin.main')

@section('content')
    <div class="content">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Новая статья</h1>
        </div>
        <div>
            <br><br>
            <form action="/article" method="post" enctype="multipart/form-data">
                @csrf
                Выберите файл:
                <input type="file" name="userfile" id="userfile">
                <br><br>
                <input type="submit" value="Загрузить" name="submit">
                <br><br>
                <label for="title">Заголовок</label>
                <input type="text"
                       class="form-control"
                       id="title"
                       name="title"
                       placeholder=" Заголовок">
                <br><br>
                <label for="fulltext">Текст</label>
                <textarea rows="4" cols="50"
                          class="form-control"
                          id="fulltext"
                          name="fulltext"
                          placeholder=" Текст">
                </textarea>
                <br><br>
                <label for="category">Категория</label>
                <select id="category" name="category" class="form-control">
                @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}">{{ $category['title'] }}</option>
                @endforeach
                </select>
                <br><br>
                <button type="submit" class="btn btn-primary">Добавить</button>
            </form>
        </div>
    </div>
@endsection
