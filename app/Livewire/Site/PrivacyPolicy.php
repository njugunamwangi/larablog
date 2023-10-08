<?php

namespace App\Livewire\Site;

use App\Models\TextWidget;
use Livewire\Component;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PrivacyPolicy extends Component
{
    public function render()
    {
        $widget = TextWidget::query()
            ->where('key', '=', 'privacy-policy-page')
            ->where('active', '=', 1)
            ->first();

        if(!$widget) {
            throw new NotFoundHttpException();
        }

        return view('livewire.site.privacy-policy', compact('widget'));
    }
}
