<!-- Popular News -->
<div>
    <h2 class="text-lg sm:text-xl font-bold text-blue-500 uppercase pb-1 border-b-2 border-blue-500 mb-3">
        Popular News
    </h2>
    @foreach($popularArticles  as $article)
        <div class="grid grid-cols-4 gap-2 mb-4">
            <div class="pt-2">
                <a href="{{ route('article', $article) }}">
                    <img src="{{ $article->image() }}" alt="{{$article->title}}" />
                </a>
            </div>
            <div class="col-span-3">
                <a href="{{ route('article', $article) }}">
                    <h3 class="text-bold text-blue-500 whitespace-nowrap truncate">{{$article->title}}</h3>
                </a>
                <div class="text-xs p-2">
                    {{ $article->human_read_time }}
                </div>
                <div class="text-xs">
                        @foreach($article->locations as $location)
                            <a href="{{ route('by-location', $location) }}" class="bg-lime-700 inline-block rounded-full py-1 px-4 text-center text-xs font-semibold leading-loose text-white">
                                {{$location->location}}
                            </a>
                        @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
