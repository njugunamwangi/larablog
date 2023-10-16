<article class="flex flex-col shadow my-4">
    <!-- Article Image -->
    <a href="{{ route('article', $article) }}" class="hover:opacity-75" >
        <img src="{{ $article->image() }}" alt="{{ $article->title }}" class="aspect-[4/3] object-contain">
    </a>
    <div class="bg-white flex flex-col justify-start p-6">

        <a href="{{ route('article', $article) }}" class="text-3xl font-bold hover:text-gray-700 pb-4">
            {{ Str::words($article->title, 4) }}
        </a>
        <p class="text-sm pb-3">
            By <a href="{{ route('author', $article->author->slug) }}" class="font-semibold hover:text-gray-800">{{ $article->author->name }}</a>

        </p>
        <p class="text-sm pb-3">
            Published on
            {{$article->getFormattedDate()}} | {{ $article->human_read_time }}
        </p>
        <div>
            @foreach($article->categories as $category)
                <a href="{{ route('by-category', $category) }}" class="bg-blue-500 mb-5 inline-block rounded-full py-1 px-4 text-center text-xs font-semibold leading-loose text-white">
                    {{$category->category}}
                </a>
            @endforeach
        </div>

        <div class="pb-6 sm:prose prose-sm prose">
            <x-markdown>
                {!! $article->shortBody(20) !!}
            </x-markdown>
        </div>

        <a href="{{ route('article', $article) }}" class="flex gap-2 uppercase text-gray-800 hover:text-black">
            Continue Reading <x-heroicon-o-arrow-right class="h-6 w-6" />
        </a>
    </div>
</article>
