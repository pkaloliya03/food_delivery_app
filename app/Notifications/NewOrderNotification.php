<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;

    protected Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'new_order',
            'order_id' => $this->order->id,
            'order_no' => $this->order->order_no,
            'restaurant_id' => $this->order->restaurant_id,
            'customer_name' => $this->order->customer_name,
            'message' => 'You have received a new order.',
            'total_amount' => $this->order->total_amount,
        ];
    }
}
