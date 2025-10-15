<?php

namespace App\Notifications;

use App\Filament\Resources\ContactMessageResource;
use App\Models\ContactMessage;
use Filament\Actions\Action as FilamentAction;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewContactMessageNotification extends Notification
{
    use Queueable;

    public function __construct(public ContactMessage $message)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        $url = ContactMessageResource::getUrl('view', ['record' => $this->message]);

        return FilamentNotification::make()
            ->title('رسالة تواصل جديدة')
            ->body("من: {$this->message->name} ({$this->message->email})")
            ->icon('heroicon-o-inbox')
            ->actions([
                FilamentAction::make('عرض')->url($url)->button(),
            ])
            ->getDatabaseMessage();
    }
}
