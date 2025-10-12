<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListContactMessages extends ListRecords
{
    protected static string $resource = ContactMessageResource::class;

    protected function getHeaderActions(): array
    {
        // Disable create for ContactMessage
        return [
        ];
    }
}
