<?php

namespace App\Events\Customer;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateBlogComment implements ShouldBroadcast{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public $blogComment,
        public $customer
    ){}

    public function broadcastOn(): array{
        return [
            new Channel("UpdateBlogCommentChannel_" . $this->blogComment->blogId),
        ];
    }
}
