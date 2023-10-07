<div class="container mx-auto py-6">
    <!-- Latest & Popular Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Latest News -->
        <livewire:site.latest />

        <!-- Popular News -->
        <livewire:site.popular />
    </div>

    <!-- Recommended News -->
    <livewire:site.recommended />

    <!-- Latest Categories -->
    @foreach($categories as $category)
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
                    @foreach($category->articles()->limit(3)->get() as $article)
                        <div>
                            <livewire:article-item :article="$article" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>

