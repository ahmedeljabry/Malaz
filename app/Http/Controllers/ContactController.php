<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\User;
use App\Filament\Resources\ContactMessageResource;
use App\Notifications\NewContactMessageNotification;
use Illuminate\Support\Facades\Notification as NotificationFacade;
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
            NotificationFacade::send(User::query()->get(), new NewContactMessageNotification($message));
        } catch (\Throwable $e) {
            throw $e;
        }

        return back()->with('status', __('contact.thanks'));
    }
}
