@extends('layouts.app')

@push('datatables')
  <script src="{{ asset('js/datatables.min.js') }}" defer></script>
@endpush
@section('content')
@include('inc.sidebar')
@include('inc.navbar')
<div class="pusher">
    <div class="main-content">
        <div class="ui basic segment padded">
            @include('inc.messages')
            <h2><i class="warehouse icon"></i> Suppliers</h2>
            <div class="ui secondary menu">
                <div class="right menu">
                    <div class="item">
                        <a class="ui teal button" href="{{route('suppliers.create')}}"><i class="plus icon"></i> Add Supplier</a>
                    </div>
                </div>
            </div>
            <div class="ui raised segment">
                @if ($suppliers ?? '')
                    <table class="ui tablet stackable selectable definition table" id="supplier-table">
                        <thead class="full-width">
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Order Cutoff</th>
                                <th>Payment Cutoff</th>
                                <th>Shipment Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $supplier)
                                <tr>
                                    <td>{{$supplier->business_name}}</td>
                                    <td>{{$supplier->address}}</td>
                                    <td>{{$supplier->order_cutoff}}</td>
                                    <td>{{$supplier->payment_cutoff}}</td>
                                    <td>{{$supplier->shipment_date}}</td>
                                    <td class="collapsing">
                                        <a class="ui icon button" href="/restock/{{$supplier->id}}"><i class="cart plus icon"></i></a>
                                        <a class="ui icon button" href="suppliers/{{$supplier->id}}"><i class="eye icon"></i></a>
                                        <a class="ui icon button" href="suppliers/{{$supplier->id}}/edit"><i class="pencil alternate icon"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('ajax')
<script>
    $(document).ready(function (){
        $('#supplier-table').DataTable({
            "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
            "order": [],
            "columnDefs": [ {
                "targets"  : 'no-sort',
                "orderable": false,
            }]
        });
    });
</script>
@endpush