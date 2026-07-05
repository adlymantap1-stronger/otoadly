<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;

    public function __construct(public Order $order) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'order_id'   => $this->order->id,
            'car_brand'  => $this->order->car->brand,
            'car_model'  => $this->order->car->model,
            'buyer_name' => $this->order->name,
            'buyer_phone'=> $this->order->phone,
            'message'    => $this->order->name . ' ingin membeli ' . $this->order->car->brand . ' ' . $this->order->car->model,
        ];
    }
}