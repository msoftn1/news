<div class="p-4">
    <h4 class="font-italic">Языки</h4>
    <ol class="list-unstyled mb-0">
        @foreach($languages as $language)
        <li><a href="{{ route('language', ['language' => $language->language]) }}">{{ $language->language }}</a></li>
        @endforeach
    </ol>
</div>
