<?php

namespace App\Events;

use App\Models\Assignment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AssignmentCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Assignment $assignment;

    public function __construct(Assignment $assignment)
    {
        $this->assignment = $assignment->load(['subject', 'instructor', 'schoolClass']);
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('class.'.$this->assignment->class_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'assignment.created';
    }
}
