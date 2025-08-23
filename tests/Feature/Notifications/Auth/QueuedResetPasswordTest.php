<?php

use App\Models\User;
use App\Notifications\Auth\QueuedResetPassword;
use Illuminate\Support\Facades\Notification;

it('queues reset password notification', function () {
    Notification::fake();

    $user = User::factory()->create();

    // Act: send notification
    $user->notify(new QueuedResetPassword('dummy-token'));

    // Assert: notification was sent
    Notification::assertSentTo(
        $user,
        QueuedResetPassword::class,
        function ($notification, $channels) {
            expect($notification->token)->toBe('dummy-token');

            return true;
        }
    );
});

use Illuminate\Support\Facades\Password;

it('sends queued reset password notification via broker', function () {
    Notification::fake();

    $user = User::factory()->create();

    $status = Password::sendResetLink(['email' => $user->email]);

    expect($status)->toBe(Password::RESET_LINK_SENT);

    Notification::assertSentTo($user, QueuedResetPassword::class);
});
