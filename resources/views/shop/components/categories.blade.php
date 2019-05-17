<ul class="list-group">
    @foreach($categories as $category)
    <li class="list-group-item">
        <a class="btn btn-outline-warning filter-cat-btn list-group-item text-left" data-slug="{{ $category->slug }}">
            <i class="fa fa-chevron-right"></i>
            {{ $category->name }}
            <span class="badge badge-primary badge-pill">{{ $category->products->count() }}</span>
        </a>
        @if(!$category->children->isEmpty())
            @include('shop.components.categories', ['categories' => $category->children])
        @endif
    </li>
    @endforeach
</ul>
