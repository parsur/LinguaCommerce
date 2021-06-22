<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class SubmittedOrder extends Mailable
{
    use Queueable, SerializesModels;

    // Order Model
    public $order;
    // Course name
    public $carts;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order,$carts)
    {
        $this->order = $order;
        $this->carts = $carts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('vendor.notifications.submittedOrder');
    }
}
