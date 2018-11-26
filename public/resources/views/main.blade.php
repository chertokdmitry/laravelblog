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
    <div class="container">
        <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
            <div class="col-md-6 px-0">
                <h1 class="display-4 font-italic">Блог на Laravel</h1>
                <p class="lead my-3">Дизайн сайта создан на последней версии Bootstrap 4.1. В панели управления можно создавать новые категории.
                    К каждой статье загружается изображение. Посетители могут оставлять комментарии.</p>
            </div>
        </div>
    </div>
    @isset ($featured_articles)
    <div class="container">
        <div class="row mb-2">
        @foreach ($featured_articles as $article)
                <div class="col-md-6">
                    <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                        <div class="card-body d-flex flex-column align-items-start">
                            <h4><span class="badge badge-info">{{ $article->category->title }}</span></h4>
                            <img class="card-img-top" src="/public/photos/{{ $article['url'] }}" alt="" style="max-width:180px;">
                            <div class="mb-1 text-muted">{{ $article->created_at->format('d-m-Y') }}</div>
                            <p class="card-text mb-auto">{{ $article['title'] }}</p>
                            <a href="/art/{{ $article['id'] }}">Подробнее</a>
                        </div>

                    </div>
                </div>
        @endforeach
        </div>
    </div>
    @endisset

    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                <h3 class="pb-3 mb-4 font-italic border-bottom">
                    Последние материалы
                </h3>

                @foreach ($articles as $article)
                    <div class="blog-post">
                        <h4><span class="badge badge-info">{{ $article->category->title }}</span></h4>
                        <img class="card-img-top" src="/public/photos/{{ $article['url'] }}">
                        <h2 class="blog-post-title">{{ $article['title'] }}</h2>
                        <p class="blog-post-meta">{{ $article->created_at->format('d-m-Y') }}, автор Dmitry. Комментарии ({{ $comment_count[$article['id']] }})</p>
                        <p>{{ $article['content'] }}</p>
                        <a href="/art/{{ $article['id'] }}">Подробнее</a>
                    </div><!-- /.blog-post -->
                @endforeach

                <nav class="blog-pagination">

                    {{ $articles->links() }}

                </nav>

            </div><!-- /.blog-main -->
            <aside class="col-md-4 blog-sidebar">
                <div class="p-3 mb-3 bg-light rounded">
                    <h4 class="font-italic">Все развлечения Москвы</h4>
                    <p class="mb-0">Блог об интересных событиях столицы. Модные места, новости театра, новинки кино, выставки и многое другое.</p>
                </div>

                <div class="p-3">
                    <h4 class="font-italic">Архив</h4>
                    <ol class="list-unstyled mb-0">
                        <li><a href="/date/9/2018">Сентябрь 2018</a></li>
                        <li><a href="/date/8/2018">Август 2018</a></li>
                        <li><a href="/date/7/2018">Июль 2018</a></li>
                        <li><a href="/date/6/2018">Июнь 2018</a></li>
                        <li><a href="/date/5/2018">Май 2018</a></li>
                    </ol>
                </div>

                <div class="p-3">
                    <h4 class="font-italic">Соцсети</h4>
                    <ol class="list-unstyled">
                        <li><a href="#">GitHub</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Facebook</a></li>
                    </ol>
                </div>
            </aside><!-- /.blog-sidebar -->

        </div><!-- /.row -->

    </main><!-- /.container -->


        <p>
            <a href="#" class="btn btn-secondary btn-lg btn-block">Наверх</a>
        </p>

@endsection
