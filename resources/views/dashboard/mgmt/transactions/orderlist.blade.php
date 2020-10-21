@if ($orders ?? '')
    <table class="ui tablet stackable selectable definition table">
        <thead class="full-width">
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Qnty</th>
                <th>Price</th>
                <th>Subtotal</th>
                <th>Action</th>
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
                    <td>
                        @if ($order->order_quantity > 0)
                            <form action="{{route('returns.product')}}" method="GET">
                                @csrf
                                <input type="hidden" name="transaction_id" value="{{$order->transaction_id}}">
                                <input type="hidden" name="product_id" value="{{$order->product_id}}">
                                <button class="ui button" type="submit">Return</button>
                            </form>
                        @else
                            <button class="ui disabled button" type="submit">Return</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="ui basic center aligned segment">
        <h3>No Orders Made Yet</h3>
    </div>
@endif