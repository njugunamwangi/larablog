<?php

namespace App\Filament\Resources\OurSocialResource\Pages;

use App\Filament\Resources\OurSocialResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageOurSocials extends ManageRecords
{
    protected static string $resource = OurSocialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
