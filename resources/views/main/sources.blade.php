@extends('layouts.base')

@section('content')
    <h3 class="pb-4 mb-4 font-italic border-bottom">
        Источники новостей
    </h3>

    @foreach($sources as $source)
        <div>
            <a href="{{ route('source.id', ['id' => $source->identifier]) }}">{{ $source->name }}</a>
        </div>
    @endforeach
@endsection
