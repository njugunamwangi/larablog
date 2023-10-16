<?php

namespace App\Livewire\Comments;

use App\Models\Article;
use App\Models\Comment;
use Livewire\Component;

class CreateComment extends Component
{
    public string $comment = '';

    public Article $article;

    public ?Comment $commentModel = null;
    public ?Comment $parentComment = null;

    public function mount(Article $article, $commentModel = null, $parentComment = null) {

        $this->article = $article;

        $this->commentModel = $commentModel;
        $this->comment = $commentModel ? $commentModel->comment : '';

        $this->parentComment = $parentComment;
    }

    public function render()
    {
        return view('livewire.comments.create-comment');
    }

    public function createComment() {
        $user = auth()->user();

        if (!$user) {
            return $this->redirect('/login');
        }

        if ($this->commentModel) {
            if ($this->commentModel->user_id != $user->id) {
                return response('You cannot perform this action', 403);
            }

            $this->commentModel->comment = $this->comment;
            $this->commentModel->save();

            $this->comment = '';
            $this->dispatch('commentUpdated');
        } else {

            $comment = Comment::create([
                'comment' => $this->comment,
                'article_id' => $this->article->id,
                'user_id' => $user->id,
                'parent_id' => $this->parentComment?->id
            ]);

            $this->dispatch('commentCreated', $comment->id);
            $this->comment = '';
        }
    }
}
