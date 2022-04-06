<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class orderNotification extends Notification
{
    use Queueable;


    public function __construct(Order $order)
    {
        $this->order = $order;
    }


    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'type'=>'order_assigned',
            'created_at'=> $this->order->created_at
        ];
    }
}
