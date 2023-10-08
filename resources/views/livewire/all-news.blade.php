@php use Illuminate\Pagination\LengthAwarePaginator; @endphp
<?php
/** @var $articles LengthAwarePaginator */
?>

<div class="container mx-auto py-6 flex flex-wrap">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-1 md:w-2/3 flex flex-col px-3">
        <!-- Sort by Locations -->
        <div class="col-span-2">

            <div class="grid grid-cols-2 gap-2 mb-4 justify-between">
                @foreach($articles as $article)
                    <livewire:article-item :article="$article" />
                @endforeach
            </div>
        </div>

        <!-- Pagination -->
        {{$articles->onEachSide(1)->links()}}
    </div>

    <livewire:sidebar />
</div>
