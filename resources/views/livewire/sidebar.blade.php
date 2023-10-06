<!-- Sidebar Section -->
<aside class="w-full md:w-1/3 flex flex-col items-center px-3">

    <img src="{{ $article->image() }}" class="rounded">

    <div class="w-full bg-white shadow flex flex-col my-4 p-6">
        <h3 class="text-xl font-semibold mb-3">
            All Categories
        </h3>
        @foreach($categories as $category)
            <a href="{{ route('by-category', $category) }}"
                class="text-semibold hover:bg-blue-600 hover:text-white block py-2 px-3 rounded {{ request('category')?->slug === $category->slug ? 'bg-blue-600 text-white' : '' }} "
            >
                {{$category->category}} ({{ $category->total }})
            </a>
        @endforeach
    </div>

</aside>
