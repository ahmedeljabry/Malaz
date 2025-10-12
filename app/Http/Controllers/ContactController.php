<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\User;
use App\Filament\Resources\ContactMessageResource;
use Filament\Notifications\Actions\Action as NotificationAction;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('pages.contact');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        $message = ContactMessage::create($validated + ['status' => 'new']);

        try {
            $url = ContactMessageResource::getUrl('view', ['record' => $message]);

            FilamentNotification::make()
                ->title('رسالة تواصل جديدة')
                ->body("من: {$message->name} ({$message->email})")
                ->icon('heroicon-o-inbox')
                ->actions([
                    NotificationAction::make('عرض')->url($url)->button(),
                ])
                ->sendToDatabase(User::query()->get());
        } catch (\Throwable $e) {
            throw $e;
        }

        return back()->with('status', __('contact.thanks'));
    }
}
