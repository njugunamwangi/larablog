<div>
    <form method="get" action="{{ route('search') }}">
        <input wire:model.live="search"
               class="block w-full rounded-md border-0 px-3.5 py-2 t0ext-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 font-medium"
               placeholder="Search"/>
    </form>

    @if(sizeof($articles) > 0)
        <div
            class="absolute right-100 z-10 mt-2 w-112 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
            role="menu"
            aria-orientation="vertical"
            aria-labelledby="menu-button"
            tabindex="-1">
            <div class="py-1" role="none">
                @foreach($articles as $article)
                    <a href="{{ route('article', $article) }}" wire:navigate class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-400 hover:text-white" role="menuitem" tabindex="-1" id="menu-item-0">
                        {{ $article->title }}
                        <small>By {{ $article->author->name }}</small>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
