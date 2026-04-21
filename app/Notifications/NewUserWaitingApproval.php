<?php

namespace App\Notifications;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewUserWaitingApproval extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public User $user)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return FilamentNotification::make()
            ->title('New User Waiting Approval')
            ->body("A new user account ({$this->user->name}) has been created and needs approval.")
            ->icon('heroicon-o-user-plus')
            ->iconColor('success')
            ->actions([
                Action::make('view')
                    ->button()
                    ->url(UserResource::getUrl('index')),
            ])
            ->getDatabaseMessage();
    }
}
