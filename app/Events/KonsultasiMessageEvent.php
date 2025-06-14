<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class KonsultasiMessageEvent implements ShouldBroadcast
{
   use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $konsultasiId;

    public function __construct($message, $konsultasiId)
    {
        $this->message = $message;
        $this->konsultasiId = $konsultasiId;
    }

    // Gunakan PrivateChannel untuk keamanan
    public function broadcastOn()
    {
        return new PrivateChannel('konsultasi.' . $this->konsultasiId);
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->message->id,
            'isi' => $this->message->isi,
            'sender_type' => $this->message->sender_type,
            'sender_id' => $this->message->sender_type === 'admin' ? $this->message->admin_id : $this->message->user_id,
            'konsultasi_id' => $this->konsultasiId,
            'created_at' => $this->message->created_at->format('d M Y H:i'),
            'is_read' => $this->message->is_read,
        ];
    }
}
