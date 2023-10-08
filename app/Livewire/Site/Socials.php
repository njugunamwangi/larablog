<?php

namespace App\Livewire\Site;

use App\Models\OurSocial;
use Livewire\Component;

class Socials extends Component
{
    public function render()
    {
        $socials = OurSocial::query()
            ->where('active', '=', 1)
            ->get();

        return view('livewire.site.socials', compact('socials'));
    }
}
