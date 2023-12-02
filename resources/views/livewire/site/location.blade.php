<!-- Top Bar Nav -->
<nav class="w-full py-4 bg-blue-800 shadow">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between">

        <nav>
            <ul class="flex items-center justify-between font-bold text-sm text-white uppercase no-underline">

                @foreach($locations as $location)
                    <li>
                        <a wire:navigate
                            class="hover:text-gray-200 hover:underline px-4 {{ request('location')?->slug === $location->slug ? 'bg-white-600 text-amber-600' : '' }}"
                            href="{{ route('by-location', $location) }}">
                            {{ $location->location }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <div class="flex items-center text-lg no-underline text-white pr-6">
            <a class="" href="#">
                <x-fab-facebook class="h-6 w-6" />
            </a>
            <a class="pl-6" href="#">
                <x-fab-instagram class="h-6 w-6" />
            </a>
            <a class="pl-6" href="#">
                <x-fab-twitter class="h-6 w-6" />
            </a>
            <a class="pl-6" href="#">
                <x-fab-linkedin class="h-6 w-6" />
            </a>
        </div>
    </div>

</nav>
