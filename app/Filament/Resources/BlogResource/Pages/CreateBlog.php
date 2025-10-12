<?php

namespace App\Filament\Resources\BlogResource\Pages;

use App\Filament\Resources\BlogResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Carbon;

class CreateBlog extends CreateRecord
{
    protected static string $resource = BlogResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (($data['is_published'] ?? false) && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        return $data;
    }
}

