<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
    </head>
    <body class="font-sans antialiased">
        @livewire(\App\Livewire\Site\Location::class)

        @livewire(\App\Livewire\Site\Category::class)

        <!-- Text Header -->
        <header class="w-full container mx-auto">
            <div class="flex flex-col items-center py-12">
                <a class="font-bold text-gray-800 uppercase hover:text-gray-700 text-5xl" href="/">
{{--                    {!! \App\Models\TextWidget::getTitle('header') !!}--}}
                    Blog
                </a>
                <p class="text-lg text-gray-600">
{{--                    {!! \App\Models\TextWidget::getContent('tagline') !!}--}}
                    Tagline
                </p>
            </div>
        </header>

        <div class="container mx-auto flex flex-wrap py-6">
            {{ $slot }}
        </div>
    </body>
</html>
