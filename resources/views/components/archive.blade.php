<div class="p-4">
    <h4 class="font-italic">Архивы</h4>
    <ol class="list-unstyled mb-0">
        @foreach($archive as $item)
        <li><a href="{{ route('date', ['dateStart' => $item->dateStart, 'dateEnd' => $item->dateEnd]) }}">{{ $item->date }}</a></li>
        @endforeach
    </ol>
</div>
