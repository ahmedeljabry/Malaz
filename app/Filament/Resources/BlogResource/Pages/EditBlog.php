<?php

namespace App\Filament\Resources\BlogResource\Pages;

use App\Filament\Resources\BlogResource;
use Filament\Resources\Pages\EditRecord;

class EditBlog extends EditRecord
{
    protected static string $resource = BlogResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (($data['is_published'] ?? false) && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        return $data;
    }
}

