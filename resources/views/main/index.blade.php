@extends('layouts.base')

@section('content')
    <h3 class="pb-4 mb-4 font-italic border-bottom">
        Главные новости
    </h3>

    @include('_include.newsItem', ['news' => $mainNews, 'withoutPaginate' => true])


@endsection
