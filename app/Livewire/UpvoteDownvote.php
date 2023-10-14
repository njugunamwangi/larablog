<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;

class UpvoteDownvote extends Component
{
    public Article $article;

    public function mount(Article $article) {
        $this->article = $article;
    }

    public function render()
    {
        $upvotes = \App\Models\UpvoteDownvote::query()
            ->where('article_id', '=', $this->article->id)
            ->where('is_upvote', '=', 1)
            ->count();

        $downvotes = \App\Models\UpvoteDownvote::query()
            ->where('article_id', '=', $this->article->id)
            ->where('is_upvote', '=', 0)
            ->count();

        $hasUpvote = null;

        /** @var \App\Models\User $user */
        $user = request()->user();

        if($user) {
            $model = \App\Models\UpvoteDownvote::query()
                ->where('article_id', '=', $this->article->id)
                ->where('user_id', '=', $user->id)
                ->first();

            if($model) {
                $hasUpvote = !!$model->is_upvote;
            }
        }

        return view('livewire.upvote-downvote', compact('upvotes', 'downvotes', 'hasUpvote'));
    }

    public function upvoteDownvote($upvote = true) {

        /** @var \App\Models\User $user */
        $user = request()->user();
        if(!$user) {

            return $this->redirect(route('login'));
        }

        if(!$user->hasVerifiedEmail())  {

            return $this->redirect(route('profile.show'));
        }

        $model = \App\Models\UpvoteDownvote::query()
            ->where('article_id', '=', $this->article->id)
            ->where('user_id', '=', $user->id)
            ->first();

        if(!$model) {
            \App\Models\UpvoteDownvote::create([
                'is_upvote' => $upvote,
                'article_id' => $this->article->id,
                'user_id' => $user->id
            ]);

            return;
        }

        if($upvote && $model->is_upvote || !$upvote && !$model->is_upvote) {
            $model->delete();
        } else {
            $model->is_upvote = $upvote;
            $model->save();
        }
    }
}
