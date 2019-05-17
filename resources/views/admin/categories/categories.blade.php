<ul class="list-group">
    @foreach($categories as $category)
    <li class="list-group-item">
        <a href="{{ route('categories.show', $category->id) }}">
            <i class="fa fa-chevron-right"></i>
            {{ $category->name }}({{ $category->products->count() }})
        </a>
        @if(!$category->children->isEmpty())
            @include('admin.categories.categories', ['categories' => $category->children])
        @endif
    </li>
    @endforeach
</ul>
