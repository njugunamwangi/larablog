<?php

namespace App\Livewire\Site;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Location as Locations;

class Location extends Component
{
    public function render()
    {
        $locations = Locations::query()
            ->join('article_location', 'locations.id', '=', 'article_location.location_id')
            ->select('locations.location', 'locations.slug', DB::raw('count(*) as total'))
            ->groupBy('locations.id', 'locations.location', 'locations.slug')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return view('livewire.site.location', compact('locations'));
    }
}
