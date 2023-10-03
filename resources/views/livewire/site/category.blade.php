<!-- Topic Nav -->
<nav class="w-full py-4 border-t border-b bg-gray-100" x-data="{ open: false }">
    <div class="block sm:hidden">
        <a
            href="#"
            class="block md:hidden text-base font-bold uppercase text-center flex justify-center items-center"
            @click="open = !open"
        >
            Topics <i :class="open ? 'fa-chevron-down': 'fa-chevron-up'" class="fas ml-2"></i>
        </a>
    </div>
    <div :class="open ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
        <div class="w-full container mx-auto flex flex-wrap sm:flex-row items-center justify-between text-sm font-bold uppercase mt-0 px-6 py-2">
            <div>
{{--                <a href="{{ route('all-news')}}" class="hover:bg-blue-600 hover:text-white rounded py-2 px-4 mx-2">All News</a>--}}
                @foreach($categories as $category)
                    <a href="{{ route('by-category', $category) }}"
                       class="hover:bg-blue-600 hover:text-white rounded py-2 px-4 mx-2 {{ request('category')?->slug === $category->slug ? 'bg-blue-600 text-white' : '' }}">
                        {{ $category->category }}
                    </a>
                @endforeach
{{--                <a href="{{route('about-us')}}" class="hover:bg-blue-600 hover:text-white rounded py-2 px-4 mx-2">About us</a>--}}
            </div>

{{--            <div class="flex items-center">--}}
{{--                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">--}}
{{--                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />--}}
{{--                </svg>--}}
{{--                <form method="get" action="{{ route('search') }}">--}}
{{--                    <input name="q" value="{{request()->get('q')}}"--}}
{{--                           class="block w-full rounded-md border-0 px-3.5 py-2 t0ext-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 font-medium"--}}
{{--                           placeholder="Type and hit enter"/>--}}
{{--                </form>--}}
{{--                @auth--}}
{{--                    <div class="flex sm:items-center sm:ml-6">--}}
{{--                        <x-dropdown align="right" width="48">--}}
{{--                            <x-slot name="trigger">--}}
{{--                                <button--}}
{{--                                    class="hover:bg-blue-600 hover:text-white flex items-center rounded py-2 px-4 mx-2">--}}
{{--                                    <div>{{ Auth::user()->name }}</div>--}}

{{--                                    <div class="ml-1">--}}
{{--                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"--}}
{{--                                             viewBox="0 0 20 20">--}}
{{--                                            <path fill-rule="evenodd"--}}
{{--                                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"--}}
{{--                                                  clip-rule="evenodd"/>--}}
{{--                                        </svg>--}}
{{--                                    </div>--}}
{{--                                </button>--}}
{{--                            </x-slot>--}}

{{--                            <x-slot name="content">--}}
{{--                                <x-dropdown-link :href="route('profile.edit')">--}}
{{--                                    {{ __('Profile') }}--}}
{{--                                </x-dropdown-link>--}}

{{--                                <!-- Authentication -->--}}
{{--                                <form method="POST" action="{{ route('logout') }}">--}}
{{--                                    @csrf--}}

{{--                                    <x-dropdown-link :href="route('logout')"--}}
{{--                                                     onclick="event.preventDefault();--}}
{{--                                                this.closest('form').submit();">--}}
{{--                                        {{ __('Log Out') }}--}}
{{--                                    </x-dropdown-link>--}}
{{--                                </form>--}}
{{--                            </x-slot>--}}
{{--                        </x-dropdown>--}}
{{--                    </div>--}}
{{--                @else--}}
{{--                    <a href="{{route('login')}}"--}}
{{--                       class="hover:bg-blue-600 hover:text-white rounded py-2 px-4 mx-2">Login</a>--}}
{{--                    <a href="{{route('register')}}" class="bg-blue-600 text-white rounded py-2 px-4 mx-2">Register</a>--}}
{{--                @endauth--}}
{{--            </div>--}}
        </div>
    </div>
</nav>