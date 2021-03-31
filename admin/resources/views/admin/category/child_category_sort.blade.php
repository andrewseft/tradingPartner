
    <li class="dd-item dd3-item" data-id="{{ $child_category->id }}">
        <div class="dd-handle dd3-handle"></div>
        <div class="dd3-content">{{ $child_category->detail->name }}</div>
        @if ($child_category->categories)
            <ul>
                @foreach ($child_category->categories as $childCategory)
                    @include('admin.category.child_category_sort', ['child_category' => $childCategory])
                @endforeach
            </ul>
        @endif
    </li>

