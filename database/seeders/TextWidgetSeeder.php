<?php

namespace Database\Seeders;

use App\Models\TextWidget;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TextWidgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $widgets = [
            [
                'key' => 'header',
                'title' => 'Laravel Blog',
                'content' => 'Laravel 10 Blog',
                'active' => true,
            ],
            [
                'key' => 'about-us-page',
                'title' => 'About Us',
                'active' => true,
            ],
            [
                'key' => 'terms-and-conditions-page',
                'title' => 'Terms & Conditions',
                'active' => true,
            ],
            [
                'key' => 'privacy-policy-page',
                'title' => 'Privacy Policy',
                'active' => true,
            ],
        ];

        foreach($widgets as $widget) {
            TextWidget::create($widget);
        }
    }
}
