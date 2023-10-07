@if(count($recommendedArticles) > 1)
    <!-- Recommended News -->
    <div>
        <h2 class="text-lg sm:text-xl font-bold text-blue-500 uppercase pb-1 border-b-2 border-blue-500 mb-3">
            Recommended News
        </h2>
        <div class="grid grid-cols-3 gap-2 mb-4 justify-between">
            @foreach($recommendedArticles as $article)
                <div>
                    <livewire:article-item :article="$article" />
                </div>
            @endforeach
        </div>
    </div>
@endif
