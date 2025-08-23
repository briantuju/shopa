<?php

use App\Models\User;
use App\Notifications\Auth\QueuedVerifyEmail;
use Illuminate\Support\Facades\Notification;

it('queues the verification email notification', function () {
    Notification::fake();

    $user = User::factory()->unverified()->create();

    // Trigger the notification manually (normally sent on Registered event)
    $user->notify(new QueuedVerifyEmail);

    Notification::assertSentTo(
        [$user],
        QueuedVerifyEmail::class,
        function ($notification, $channels) {
            // Assert it goes to the mail channel
            return in_array('mail', $channels, true);
        }
    );

    expect(new QueuedVerifyEmail)->toBeInstanceOf(\Illuminate\Contracts\Queue\ShouldQueue::class);
});

it('dispatches to the queue', function () {
    Queue::fake();

    $user = User::factory()->unverified()->create();

    $user->notify(new QueuedVerifyEmail);

    Queue::assertPushed(\Illuminate\Notifications\SendQueuedNotifications::class);
});
