<div>
    <livewire:comments.create-comment :article="$article" />

    @foreach($comments as $comment)
        <livewire:comments.comment-item
            :comment="$comment"
            wire:key="comment-{{ $comment->id }}-{{ $comment->comments }}"
        />
    @endforeach
</div>
