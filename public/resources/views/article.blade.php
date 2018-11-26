@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="nav-scroller py-1 mb-2">
            <nav class="nav d-flex justify-content-between">

                @foreach ($categories as $category)
                    <a class="p-2 text-muted" href="/cat/{{ $category['id'] }}">{{ $category['title'] }}</a>
                @endforeach
            </nav>
        </div>
    </div>
    <main role="main" class="container">
        <div class="row">
            <div class="col-md-12 blog-main">
                    <div class="blog-post">
                        <h4><span class="badge badge-info"></span></h4>
                        <img class="card-img-top" src="/public/photos/{{ $article['url'] }}">
                        <br><br>
                        <h2 class="blog-post-title">{{ $article['title'] }}</h2>
                        <p class="blog-post-meta">{{ $article->created_at->format('d-m-Y') }} by Dmitry</p>
                        <p>{{ $article['content'] }}</p>
                    </div><!-- /.blog-post -->
            </div><!-- /.blog-main -->
        </div>
    </main>

    <div class="container">
        <div class="row">
            <div class="col">
                <h4 class="pb-3 mb-4 font-italic border-bottom">
                    Комментарии
                </h4>
                @foreach ($comments as $comment)
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
                <br><br><br>
            </div>
            <div class="col">
                <h4 class="pb-3 mb-4 font-italic border-bottom">
                    Оставить комментарий
                </h4>
                <form action="#" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="title">Имя</label>
                    <input type="text"
                           class="form-control"
                           id="title"
                           name="title"
                           placeholder=" Имя">
                    <br><br>
                    <label for="email">Email</label>
                    <input type="text"
                           class="form-control"
                           id="email"
                           name="email"
                           placeholder=" Email">
                    <br><br>
                    <label for="fulltext">Текст</label>
                    <textarea rows="4" cols="50"
                              class="form-control"
                              id="fulltext"
                              name="fulltext"
                              placeholder=" Текст">

                    </textarea>
                    <br><br>
                    <a href="#" class="btn btn-primary disabled">Добавить</a>
                </form>
            </div>
        </div>
    </div>

    <p>
        <a href="#" class="btn btn-secondary btn-lg btn-block">Наверх</a>
    </p>
@endsection