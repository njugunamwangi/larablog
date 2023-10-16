<?php

namespace App\Livewire\Comments;

use App\Models\Comment;
use Livewire\Component;

class CommentItem extends Component
{
    public Comment $comment;

    public bool $editing = false;

    public bool $replying = false;

    protected $listeners = [
        'cancelEditing' => 'cancelEditing',
        'commentUpdated' => 'commentUpdated',
        'commentCreated' => 'commentCreated',
    ];

    public function mount(Comment $comment) {
        $this->comment = $comment;
    }

    public function render()
    {
        return view('livewire.comments.comment-item');
    }

    public function deleteComment() {

        $user = auth()->user();

        if (!$user) {
            return $this->redirect('/login');
        }

        if ($this->comment->user_id != $user->id) {
            return response('You cannot perform this action', 403);
        }

        $id = $this->comment->id;
        $this->comment->delete();
        $this->dispatch('commentDeleted', $id);
    }

    public function startCommentEdit() {

        $this->editing = true;
    }

    public function cancelEditing() {

        $this->editing = false;

        $this->replying = false;
    }

    public function commentUpdated() {

        $this->editing = false;
    }

    public function startReply() {

        $this->replying = true;
    }

    public function commentCreated() {

        $this->replying = false;
    }
}
