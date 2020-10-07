@if ($orders ?? '')
    <table class="ui tablet stackable selectable definition table">
        <thead class="full-width">
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Qnty</th>
                <th>Price</th>
                <th>Subtotal</th>
                <th>Purchased on</th>
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