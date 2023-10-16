<div>
    <div class="flex mb-3 gap-3">
        <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-full">
            <img src="{{ $comment->user->getFilamentAvatarUrl() }}" class="rounded-full" />
        </div>
        <div>
            <div>
                <a href="" class="text-indigo-600 font-semibold">{{$comment->user->name}}</a>
                - <span class="text-gray-400">
                    {{$comment->created_at->diffForHumans() }}
                </span>
            </div>
            @if($editing)
                <livewire:comments.create-comment :comment-model="$comment" />
            @else
                <div class="text-gray-700">
                    {{$comment->comment}}
                </div>
            @endif
            <div>
                <a wire:click.prevent="startReply" href="" class="text-indigo-600 text-sm mr-3">Reply</a>
                @if(\Illuminate\Support\Facades\Auth::id() === $comment->user_id)
                    <a wire:click.prevent="startCommentEdit" href="" class="text-blue-600 text-sm mr-3">Edit</a>
                    <a wire:click.prevent="deleteComment" href="" class="text-red-600 text-sm">Delete</a>
                @endif
            </div>

            @if($replying)
                <livewire:comments.create-comment :article="$comment->article" :parent-comment="$comment" />
            @endif

            @if($comment->comments->count())
                <div>
                    @foreach($comment->comments as $childComment)
                        <livewire:comments.comment-item :comment="$childComment" wire:key="comment-{{$childComment->id}}"/>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</div>
