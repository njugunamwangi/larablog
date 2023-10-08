<?php

namespace App\Livewire\Site;

use App\Models\TextWidget;
use Livewire\Component;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class About extends Component
{
    public function render()
    {
        $widget = TextWidget::query()
            ->where('key', '=', 'about-us-page')
            ->where('active', '=', 1)
            ->first();

        if(!$widget) {
            throw new NotFoundHttpException();
        }

        return view('livewire.site.about', compact('widget'));
    }
}
