<?php

namespace App\Mail\Customer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderSuccess extends Mailable implements ShouldQueue{
    use Queueable, SerializesModels;

    public function __construct(
        public $order,
        public $orderDetails
    ){}
    public function envelope(): Envelope{
        return new Envelope(
            subject: "Order successfully!",
        );
    }
    public function content(): Content{

        $subTotal = 0;
        foreach($this->orderDetails as $orderDetail){
            $subTotal += $orderDetail["subTotal"];
        }
        $sale = $subTotal * ($this->order["sale"] / 100);
        $total = $subTotal - $sale;

        return new Content(
            markdown: "Mail.Customer.OrderSuccess",
            with: [
                "subTotal" => $subTotal,
                "sale" => $sale,
                "total" => $total
            ]
        );
    }
    public function attachments(): array{
        return [];
    }
}
