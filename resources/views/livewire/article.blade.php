
    <!-- Post Section -->
    <section class="w-full md:w-2/3 flex flex-col px-3">

        <article class="flex flex-col shadow my-4">
            <!-- Article Image -->
            <img src="{{ $article->getMedia('articles')->first()->getUrl() }}">
            <div class="bg-white flex flex-col justify-start p-6">
                <p class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $article->title }}</p>
                <p class="text-sm pb-8">
                    By <a href="#" class="font-semibold hover:text-gray-800">{{ $article->author->name }}</a>,
                    Published on {{$article->getFormattedDate()}} | {{ $article->human_read_time }}
                </p>
                <div class="sm:prose prose-sm prose">
                    <x-markdown>
                        {!! $article->body !!}
                    </x-markdown>
                </div>

            </div>
        </article>

        <div class="w-full flex flex-col text-center md:text-left md:flex-row shadow bg-white mt-10 mb-10 p-6">
            <div class="w-full md:w-1/5 flex justify-center md:justify-start pb-4">
                <img src="https://source.unsplash.com/collection/1346951/150x150?sig=1" class="rounded-full shadow h-32 w-32">
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

