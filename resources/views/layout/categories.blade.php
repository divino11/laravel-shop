<div class="list-group list-group-flush">
    @foreach($categories as $category)
        <a class="list-group-item list-group-item-action" href="{{ route('category', $category->code) }}">{{ $category->name }}</a>
    @endforeach
</div>
