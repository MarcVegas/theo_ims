@if ($products ?? '')
    <table class="ui tablet stackable selectable definition striped table" id="product-table">
        <thead class="full-width">
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Supplier Price</th>
                <th>Qnty</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{$product->name}}</td>
                    <td>{{$product->category}}</td>
                    <td>{{$product->stock->supplier_price}}</td>
                    <td>{{$product->stock->quantity}}</td>
                    <td><a class="ui fluid button" href="/products/{{$product->id}}">View</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="ui basic center aligned segment">
        <h3>No Orders Made Yet</h3>
    </div>
@endif