<div class="p-4">
    <h4 class="font-italic">Источники</h4>
    <ol class="list-unstyled mb-0">
        @foreach($sources as $item)
        <li><a href="#">{{ $item->name }}</a></li>
        @endforeach
    </ol>
</div>
