<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function (Actions\DeleteAction $action) {
                    // Prevent self-deletion
                    if ($this->record->id === auth()->id()) {
                        $action->cancel();
                        throw new \Exception('لا يمكنك حذف حسابك الخاص!');
                    }
                }),
        ];
    }
}
