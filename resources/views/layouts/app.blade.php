<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{!! \App\Models\TextWidget::getTitle('header') !!}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    <!-- Styles -->
</head>
<body class="font-sans antialiased">
<livewire:site.location />

<!-- Text Header -->
<header class="w-full container mx-auto">
    <div class="flex flex-col items-center py-12">
        <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="/">
            {!! \App\Models\TextWidget::getTitle('header') !!}
        </a>
        <p class="text-lg text-gray-600">
            {!! \App\Models\TextWidget::getContent('header') !!}
        </p>
    </div>
</header>

<livewire:site.category />


<div class="container mx-auto items-center justify-center flex flex-wrap py-20">

    {{ $slot }}

</div>

<footer class="w-full border-t bg-white pb-12">
    <div class="w-full container mx-auto flex flex-col items-center">
        <div class="flex flex-col md:flex-row text-center md:text-left md:justify-between py-6">
            <a href="{{ route('about-us') }}" class="uppercase px-3">About Us</a>
            <a href="{{ route('privacy-policy') }}" class="uppercase px-3">Privacy Policy</a>
            <a href="{{ route('terms-and-conditions') }}" class="uppercase px-3">Terms & Conditions</a>
        </div>
        <div class="uppercase pb-6">
            <livewire:site.socials />
            &copy; {{ \App\Models\TextWidget::getTitle('header') }}
        </div>
    </div>
</footer>

@livewireScripts
</body>
</html>
