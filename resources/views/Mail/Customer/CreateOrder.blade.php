<style>
    p{
        margin: 0;
        padding: 0;
    }
</style>
<x-mail::message>
# Your order

<p><strong>OrderId:</strong> {{ $order["id"] . "-" . $order["subId"] }}</p>
<p><strong>CreatedDate:</strong> {{ $order["createdDate"] }}</p>

<x-mail::table>
|ProductId|Name|Quantity|Price|SubTotal|Unit|
|:--------|:--:|:------:|:---:|:------:|---:|
@foreach($orderDetails as $orderDetail)
    {{ 
        "|" . $orderDetail["product"]["id"] .
        "|" . $orderDetail["product"]["name"] .
        "|" . $orderDetail["quantity"] .
        "|" . App\MyFunction\Utilities::formatCurrency($orderDetail["price"]) .
        "|" . App\MyFunction\Utilities::formatCurrency($orderDetail["subTotal"]) .
        "|" . "VND" . "|"
    }}
@endforeach
</x-mail::table>

<x-mail::panel>
<p><strong>SubTotal:</strong> {{ App\MyFunction\Utilities::formatCurrency($subTotal) }} VND</p>
<p><strong>Sale:</strong> {{ App\MyFunction\Utilities::formatCurrency($sale) }} VND</p>
<p><strong>Total:</strong> {{ App\MyFunction\Utilities::formatCurrency($total) }} VND</p>
</x-mail::panel>
 
<p>Thanks,</p>
<p>Ruper</p>
</x-mail::message>