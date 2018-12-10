<?php

namespace App\Mail\Notifications\Inventory;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CenterStock extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $itemName;
    public $minStock;
    public $remainingStock;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userName, $itemName, $minStock, $remainingStock)
    {
        $this->userName = $userName;
        $this->itemName = $itemName;
        $this->minStock = $minStock;
        $this->remainingStock = $remainingStock;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.notifications.inventory.centerstock')
                    ->subject('Inventory below minimum stock | '.$this->itemName);
    }
}
