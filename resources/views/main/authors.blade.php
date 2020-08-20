@extends('layouts.base')

@section('content')
    <h3 class="pb-4 mb-4 font-italic border-bottom">
        Авторы новостей
    </h3>

    @foreach($authors as $author)
        <div>
            <a href="{{ route('author.id', ['id' => $author->author]) }}">{{ $author->author }}</a>
        </div>
    @endforeach

    <div style="margin-top: 50px">
        {{ $authors->links() }}
    </div>
@endsection
