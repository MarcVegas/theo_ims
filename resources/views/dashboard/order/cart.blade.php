@if ($carts ?? '')
    @foreach ($carts as $item)
        <div class="item">
            <div class="ui blue circular label">{{$item->cart_quantity}}</div>
            {{$item->name}}
        </div>
    @endforeach
    @if (count($carts) > 0)
        <input type="hidden" name="subtotal" id="subtotal" value="{{$subtotal}}">
    @endif
@else
    <div class="header item">No items added</div>
@endif