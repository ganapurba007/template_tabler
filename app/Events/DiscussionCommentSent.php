<?php

namespace App\Events;

use App\Models\MaterialDiscussion;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DiscussionCommentSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public MaterialDiscussion $discussion;

    public function __construct(MaterialDiscussion $discussion)
    {
        $this->discussion = $discussion->load(['user.role', 'material']);
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('material.'.$this->discussion->material_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'comment.sent';
    }
}
