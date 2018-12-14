<?php

namespace App\Mail\Notifications\Inventory;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DepotStock extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $itemName;
    public $depot;
    public $minStock;
    public $remainingStock;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userName, $itemName, $depot, $minStock, $remainingStock)
    {
        $this->userName = $userName;
        $this->itemName = $itemName;
        $this->depot = $depot;
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
        return $this->markdown('emails.notifications.inventory.depotstock')
                    ->subject('Inventory below minimum stock | '.$this->itemName);
    }
}
