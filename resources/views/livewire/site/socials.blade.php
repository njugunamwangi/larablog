<div class="flex flex-row justify-between mb-4">
    @foreach($socials as $social)
        @if($social->platform == 'X')
            <a href="{{ $social->link }}" > <x-fab-twitter class="h-6 w-6" /> </a>
        @elseif($social->platform == 'LinkedIn')
            <a href="{{ $social->link }}" > <x-fab-linkedin class="h-6 w-6" /> </a>
        @elseif($social->platform == 'Telegram')
            <a href="{{ $social->link }}" > <x-fab-telegram class="h-6 w-6" /> </a>
        @endif
    @endforeach
</div>
