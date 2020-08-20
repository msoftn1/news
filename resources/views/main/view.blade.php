@extends('layouts.base')

@section('content')
    <div class="blog-post">
        <h2 class="blog-post-title">{{ $newsItem->title }}</h2>
        <p class="blog-post-meta">{{ date('F d, Y', strtotime($newsItem->published_at)) }} by <a href="{{ route('author.id', ['id' => $newsItem->author]) }}">{{ $newsItem->author }}</a></p>
        <div>
            <img style="max-width: 700px" src="/{{ $newsItem->image }}"/>
        </div>
        {{ $newsItem->content }}
        <div>
            <br/>
            <a target="_blank" href="{{ $newsItem->url }}">Далее</a>
        </div>
    </div>
@endsection
