@if ($columns ?? '' && $products ?? '')
    <table class="ui tablet stackable selectable definition table" id="product-table">
        <thead class="full-width">
            <tr>
                @foreach ($columns as $column)
                    <th>{{$column}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{$product->name}}</td>
                    <td>{{$product->category}}</td>
                    <td>{{$product->stock->supplier_price}}</td>
                    <td>{{$product->selling_price}}</td>
                    <td>{{$product->difference}}</td>
                    <td>{{$product->stock->quantity}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="ui basic center aligned segment">
        <h3>No Orders Made Yet</h3>
    </div>
@endif