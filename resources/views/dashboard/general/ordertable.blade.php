@if ($columns ?? '' && $orders ?? '')
    <table class="ui tablet stackable selectable definition table" id="order-table">
        <thead class="full-width">
            <tr>
                @foreach ($columns as $column)
                    <th>{{$column}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{$order->product->name}}</td>
                    <td>{{$order->product->category}}</td>
                    <td>{{$order->order_quantity}}</td>
                    <td>{{$order->order_price}}</td>
                    <td>{{$order->subtotal}}</td>
                    <td>{{date('d M Y, h:i A', strtotime($order->created_at))}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="ui basic center aligned segment">
        <h3>No Orders Made Yet</h3>
    </div>
@endif