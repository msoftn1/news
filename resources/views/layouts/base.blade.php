<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="/css/blog.css" rel="stylesheet">

    <title>Новости</title>
</head>

<div class="container">
    <header class="blog-header py-3">
        <form action="{{ route('search') }}">
            <input type="text" id="search-field" name="search" class="form-control" style="display: none"/>
        </form>
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
                <a class="text-muted" href="{{ route('index') }}">Главная</a> |
                <a class="text-muted" href="{{ route('sources') }}">Источники</a> |
                <a class="text-muted" href="{{ route('authors') }}">Авторы</a>
            </div>
            <div class="col-4 text-center">
                <a class="blog-header-logo text-dark" href="#">Новости</a>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                <a class="text-muted" href="#" aria-label="Search" id="search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                         stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img"
                         viewBox="0 0 24 24" focusable="false"><title>Search</title>
                        <circle cx="10.5" cy="10.5" r="7.5"/>
                        <path d="M21 21l-5.2-5.2"/>
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <x-categories/>

    @if (!empty($topNews))
        <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
            <div class="col-md-6 px-0">
                <div>
                    <h1 class="display-4 font-italic">{{ $topNews->title }}</h1>
                    <p class="lead my-3">{{ $topNews->description }}</p>
                    <p class="lead mb-0"><a href="{{ route('view', ['id' => $topNews->id]) }}"
                                            class="text-white font-weight-bold">Читать далее...</a></p>
                </div>
            </div>
        </div>
    @endif

    <div class="row mb-2">
        @if (!empty($topNewsBusiness))
            <div class="col-md-6">
                <div
                    class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-success">{{ $topNewsBusiness->name }}</strong>
                        <h3 class="mb-0">{{ $topNewsBusiness->title }}</h3>
                        <div class="mb-1 text-muted">{{ date('F d, Y', strtotime($topNewsBusiness->published_at)) }}</div>
                        <p class="mb-auto">{{ $topNewsBusiness->description }}</p>
                        <a href="{{ route('view', ['id' => $topNewsBusiness->id]) }}" class="stretched-link">Читать
                            далее</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <img style="width: 200px;" src="{{ route('image', ['name' => $topNewsBusiness->getImageId()]) }} "/>
                    </div>
                </div>
            </div>
        @endif

        @if (!empty($topNewsTechnology))
            <div class="col-md-6">
                <div
                    class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-success">{{ $topNewsTechnology->name }}</strong>
                        <h3 class="mb-0">{{ $topNewsTechnology->title }}</h3>
                        <div class="mb-1 text-muted">{{ date('F d, Y', strtotime($topNewsTechnology->published_at)) }}</div>
                        <p class="mb-auto">{{ $topNewsTechnology->description }}</p>
                        <a href="{{ route('view', ['id' => $topNewsTechnology->id]) }}" class="stretched-link">Читать
                            далее</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <img style="width: 200px; height: 250px" src="{{ route('image', ['name' => $topNewsTechnology->getImageId()]) }}"/>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<main role="main" class="container">
    <div class="row">

        <div class="col-md-8 blog-main">
            @if(isset($breadcrumbs))

                <div>
                    @foreach($breadcrumbs as $item)
                        @if(!$loop->last)
                            <a href="{{ $item->getUrl() }}">{{ $item->getTitle() }}</a> ->
                        @else
                            {{ $item->getTitle() }}
                        @endif
                    @endforeach
                </div>

            @endif

            @yield('content')
        </div>

        <aside class="col-md-4 blog-sidebar">
            <x-news-archive/>
            <x-languages/>
            <!--<x-sources/>-->
        </aside><!-- /.blog-sidebar -->

    </div><!-- /.row -->

</main><!-- /.container -->

<footer class="blog-footer">
    <p>Сервис новостей</p>
</footer>

<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
</style>
<!-- Custom styles for this template -->
<link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
<!-- Custom styles for this template -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $('#search').click(function () {
        $('#search-field').toggle();
    });

    $("#search-field").autocomplete({
        source: "{{ route('search.ajax') }}",
        minLength: 3
    });

</script>

</body>
</html>
