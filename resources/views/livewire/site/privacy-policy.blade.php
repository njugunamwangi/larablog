<section class="w-full flex flex-col items-center px-3">

    <article class="flex flex-col shadow my-4">
        <a href="#" class="hover:opacity-75">
            <img src="{{ $widget->getMedia('text-widgets')->isEmpty() ? "https://placehold.co/600x400?text=" . 'Privacy Policy' : $widget->getMedia('text-widgets')->first()->getUrl() }}">
        </a>
        <div class="bg-white flex flex-col justify-start p-6">
            <a href="#" class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $widget->title }}</a>
            <div>
                {!! $widget->content !!}
            </div>
        </div>
    </article>
</section>
