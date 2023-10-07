<!-- Latest News -->
<div class="col-span-2">
    <h2 class="text-lg sm:text-xl font-bold text-blue-500 uppercase pb-1 border-b-2 border-blue-500 mb-3">
        Latest News
    </h2>

    <div class="grid grid-cols-2 gap-2 mb-4 justify-between">
        @foreach($latestArticles as $article)
            <livewire:article-item :article="$article" />
        @endforeach
    </div>
</div>

