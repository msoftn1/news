@foreach($news as $newsItem)
    <div class="blog-post">
        <h2 class="blog-post-title" onclick="window.location.href='{{ route('view', ['id' => $newsItem->id]) }}';" style="cursor: pointer">{{ $newsItem->title }}</h2>
        <p class="blog-post-meta">{{ date('F d, Y', strtotime($newsItem->published_at)) }} by <a href="{{ route('author.id', ['id' => $newsItem->author]) }}">{{ $newsItem->author }}</a></p>

        {{ $newsItem->content }}
        <div>
            <br/>
            <a href="{{ route('view', ['id' => $newsItem->id]) }}">Читать далее</a>
        </div>
    </div><!-- /.blog-post -->
@endforeach

@if(empty($withoutPaginate))
{{ $news->links() }}
@endif

@if(count($news) === 0)
    Новости не найдены
@endif
