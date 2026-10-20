<?php

namespace Flarum\Pusher;

use Flarum\Notification\Blueprint\BlueprintInterface;
use Flarum\User\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use Pusher\Pusher;

class SendPusherNotificationsJob implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $blueprint;
    private $recipients;

    public function __construct(BlueprintInterface $blueprint, array $recipients)
    {
        $this->blueprint = $blueprint;
        $this->recipients = $recipients;
    }

    public function handle(Pusher $pusher)
    {
        foreach ($this->recipients as $user) {
            if ($user->shouldAlert($this->blueprint::getType())) {
                $pusher->trigger('private-user'.$user->id, 'notification', null);
            }
        }
    }
}