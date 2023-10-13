<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TextWidget;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SiteController extends Controller
{
    public function about() : View {
        $widget = TextWidget::query()
            ->where('key', '=', 'about-us-page')
            ->where('active', '=', 1)
            ->first();

        if(!$widget) {
            throw new NotFoundHttpException();
        }

        return view('about', compact('widget'));
    }

    public function terms() : View {
        $widget = TextWidget::query()
            ->where('key', '=', 'terms-and-conditions-page')
            ->where('active', '=', 1)
            ->first();

        if(!$widget) {
            throw new NotFoundHttpException();
        }

        return view('terms-and-conditions', compact('widget'));
    }

    public function privacy() : View {
        $widget = TextWidget::query()
            ->where('key', '=', 'privacy-policy-page')
            ->where('active', '=', 1)
            ->first();

        if(!$widget) {
            throw new NotFoundHttpException();
        }

        return view('privacy-policy', compact('widget'));
    }
}
