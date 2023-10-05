    <!-- Post Section -->
    <section class="w-full md:w-2/3 flex flex-col px-3">

        <article class="flex flex-col shadow my-4">
            <!-- Article Image -->
            <img src="{{ $article->image() }}" class="rounded">
            <div class="bg-white flex flex-col justify-start p-6">

                <p class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $article->title }}</p>

                <div class="flex justify-between pb-4">
                    <p class="">
                        By <a href="{{ route('author', $article->author->slug) }}" class="font-semibold hover:text-gray-800">{{ $article->author->name }}</a>
                    </p>
                    <p class="flex flex-row gap-2 items-center m-1">
                        <x-heroicon-m-calendar class="h-6 w-6 text-blue-600" /> {{$article->getFormattedDate()}}
                    </p>
                    <p>
                        {{ $article->human_read_time }}
                    </p>
                </div>

                <div class="flex flex-row gap-2 justify-between">
                    <div class="flex flex-row gap-2 ">
                        <x-heroicon-m-hashtag class="h-6 w-6 m-1 text-blue-600" />
                        @foreach($article->categories as $category)
                            <a href="{{ route('by-category', $category) }}" class="bg-blue-600 inline-block rounded-full py-1 px-4 text-center text-xs font-semibold leading-loose text-white">
                                {{$category->category}}
                            </a>
                        @endforeach
                    </div>
                    <div class="flex flex-row gap-2 ">
                        <x-heroicon-m-map-pin class="h-6 w-6 m-1 text-lime-700" />
                        @foreach($article->locations as $location)
                            <a href="{{ route('by-location', $location) }}" class="bg-lime-700 inline-block rounded-full py-1 px-4 text-center text-xs font-semibold leading-loose text-white">
                                {{$location->location}}
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="sm:prose prose-sm prose prose-a:text-blue-600">
                    <x-markdown>
                        {!! $article->body !!}
                    </x-markdown>
                </div>

            </div>
        </article>

        <div class="w-full flex flex-col text-center md:text-left md:flex-row shadow bg-white mt-10 mb-10 p-6">
            <div class="w-full md:w-1/5 flex justify-center md:justify-start pb-4">
                <img src="{{ $article->author->getFilamentAvatarUrl() }}" class="rounded-full shadow h-32 w-32">
            </div>
            <div class="flex-1 flex flex-col justify-center md:justify-start">
                <p class="font-semibold text-2xl">{{ $article->author->name }}</p>
                <p class="pt-2">
                    {!! $article->author->bio !!}
                </p>
                <div class="flex items-center justify-center md:justify-start text-2xl no-underline text-blue-800 pt-4">
                    <a class="" href="#">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                    <a class="pl-4" href="#">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="pl-4" href="#">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="pl-4" href="#">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>
        </div>

    </section>

