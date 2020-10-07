@if ($carts ?? '')
    @foreach ($carts as $item)
        <div class="item">
            <div class="ui blue circular label">{{$item->cart_quantity}}</div>
            {{$item->product->name}}
        </div>
    @endforeach
    <input type="hidden" name="subtotal" id="subtotal" value="{{$subtotal}}">
@else
    <div class="header item">No items added</div>
@endif