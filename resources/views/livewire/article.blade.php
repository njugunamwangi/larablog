    <!-- Post Section -->
    <div>
        <div class="container mx-auto flex flex-wrap py-6">
            <section class="w-full md:w-2/3 flex flex-col px-3">

                <article class="flex flex-col shadow my-4">
                    <!-- Article Image -->

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

                        <div class="flex flex-row gap-2 mb-4 justify-between">
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
                            <x-markdown class="rounded-md border border-gray-20 bg-gray-200">
                                <p class="font-bold">Ancient Truth: </p>
                                {!! $article->ancient_truth !!}
                            </x-markdown>
                            <x-markdown>
                                {!! $article->body !!}
                            </x-markdown>
                        </div>

                    </div>
                </article>

                <div class="w-full flex pt-6">
                    <div class="w-1/2">
                        @if($prev)
                            <a href="{{ route('article', $prev) }}" class="block w-full bg-white shadow hover:shadow-md text-left p-6">
                                <p class="text-lg text-blue-800 font-bold flex items-center"><x-heroicon-o-arrow-left-circle class="h-6 w-6" /> Previous</p>
                                <p class="pt-2">
                                    {{ \Illuminate\Support\Str::words($prev->title, 5) }}
                                </p>
                            </a>
                        @endif
                    </div>

                    <div class="w-1/2">
                        @if($next)
                            <a href="{{ route('article', $next) }}" class="block w-full bg-white shadow hover:shadow-md text-right p-6">
                                <p class="text-lg text-blue-800 font-bold flex items-center justify-end">Next <x-heroicon-o-arrow-right-circle class="h-6 w-6" /></p>
                                <p class="pt-2">
                                    {{ \Illuminate\Support\Str::words($next->title, 5) }}
                                </p>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="py-4">
                    <h3 class="text-xl font-semibold mb-3">
                        About the Author
                    </h3>
                </div>
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
                            <a class="" href="https://facebook.com/{{ $article->author->social->facebook }}" >
                                <x-fab-facebook class="h-6 w-6" />
                            </a>
                            <a class="pl-4" href="https://instagram.com/{{ $article->author->social->instagram }}">
                                <x-fab-instagram class="h-6 w-6" />
                            </a>
                            <a class="pl-4" href="https://x.com/{{ $article->author->social->x }}">
                                <x-fab-twitter class="h-6 w-6" />
                            </a>
                            <a class="pl-4" href="https://linkedin.com/in/{{ $article->author->social->linkedin }}">
                                <x-fab-linkedin class="h-6 w-6" />
                            </a>
                        </div>
                    </div>
                </div>

            </section>


            <livewire:sidebar :article='$article' />

        </div>

        <!-- Related News -->
        @foreach($article->categories as $category)
            <div>
                <div class="text-lg sm:text-xl font-bold text-blue-500 pb-1 border-b-2 border-blue-500 mb-3 flex justify-between">
                    <div>
                        <h2 class="uppercase">
                            {{$category->category}}
                        </h2>
                    </div>
                    <div class="text-sm">
                        <a href="{{ route('by-category', $category) }}">
                            Read more
                        </a>
                    </div>
                </div>

                <div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        @foreach($category->articles()->where('status', '=', 'published')->limit(3)->get() as $article)
                            <div>
                                <livewire:article-item :article="$article" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach


    </div>

