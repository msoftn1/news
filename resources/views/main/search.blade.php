@extends('layouts.base')

@section('content')
    <h3 class="pb-4 mb-4 font-italic border-bottom">
        Новости по запросу {{ urldecode($search) }}
    </h3>

    @include('_include.newsItem', ['news' => $news])

@endsection
