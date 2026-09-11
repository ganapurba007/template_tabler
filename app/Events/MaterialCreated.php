<?php

namespace App\Events;

use App\Models\Material;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MaterialCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Material $material;

    public function __construct(Material $material)
    {
        $this->material = $material->load(['subject', 'instructor', 'schoolClass']);
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('class.'.$this->material->class_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'material.created';
    }
}
