@if ($nostocks ?? '')
    <table class="ui tablet stackable selectable definition table" id="product-table">
        <thead class="full-width">
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Selling Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nostocks as $nostock)
                <tr>
                    <td>{{$nostock->name}}</td>
                    <td>{{$nostock->category}}</td>
                    <td>{{$nostock->stock->quantity}}</td>
                    <td>{{$nostock->selling_price}}</td>
                    <td>
                        <label class="ui orange basic label">Out of Stock</label>
                    </td>
                    <td class="collapsing">
                        <a class="ui icon button" href="products/{{$nostock->id}}"><i class="eye icon"></i></a>
                        <a class="ui icon button" href="products/{{$nostock->id}}/edit"><i class="pencil alternate icon"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if (count($nostocks) > 0)
        <input type="hidden" name="stockcount" id="stockcount" value="{{count($nostocks)}}">
    @endif
@else 
    <div class="us basic center aligned segment">
        <h3>No out of stock product</h3>
    </div>
@endif