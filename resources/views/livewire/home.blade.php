<div class="container mx-auto py-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Latest News -->
        <div class="col-span-2">
            <h2 class="text-lg sm:text-xl font-bold text-blue-500 uppercase pb-1 border-b-2 border-blue-500 mb-3">
                Latest News
            </h2>

            <div class="grid grid-cols-2 gap-2 mb-4 justify-between">
                @foreach($latestArticles as $article)
                    <article class="flex flex-col shadow my-4">
                        <!-- Article Image -->
                        <a href="{{ route('article', $article) }}" class="hover:opacity-75" >
                            <img src="{{ $article->image() }}" alt="{{ $article->title }}" class="aspect-[4/3] object-contain">
                        </a>
                        <div class="bg-white flex flex-col justify-start p-6">

                            <a href="{{ route('article', $article) }}" class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $article->title }}</a>
                            <p class="text-sm pb-3">
                                By <a href="{{ route('author', $article->author->slug) }}" class="font-semibold hover:text-gray-800">{{ $article->author->name }}</a>
                            </p>
                            <p class="text-sm pb-3">
                                Published on
                                {{$article->getFormattedDate()}} | {{ $article->human_read_time }}
                            </p>
                            <div class="pb-6">
                                {{$article->shortBody()}}
                            </div>
                            <a href="{{ route('article', $article) }}" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</div>
