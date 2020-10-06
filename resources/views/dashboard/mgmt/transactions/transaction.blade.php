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
            <h2><i class="handshake icon"></i> Transactions</h2>
            <div class="ui grid stackable padded">
                <div class="four wide computer eight wide tablet sixteen wide mobile column">
                    <div class="ui fluid card">
                        <div class="content">
                            <div class="ui right floated header teal">
                                <i class="icon credit card"></i>
                            </div>
                            <div class="header">
                                <div class="ui teal header">
                                {{$count}}
                                </div>
                            </div>
                            <div class="meta">
                                Credit
                            </div>
                            <div class="description">
                                Number of transactions with credit type
                            </div>
                        </div>
                    </div>
                </div>
                <div class="four wide computer eight wide tablet sixteen wide mobile column">
                    <div class="ui fluid card">
                        <div class="content">
                            <div class="ui right floated header orange">
                                <i class="icon money bill alternate"></i>
                            </div>
                            <div class="header">
                                <div class="ui orange header">
                                {{$sum}}
                                </div>
                            </div>
                            <div class="meta">
                                Collectible Sum
                            </div>
                            <div class="description">
                                Total collectible sum from credit type transactions
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui raised segment">
                @if ($transactions ?? '')
                    <table class="ui tablet stackable selectable definition table" id="transaction-table">
                        <thead class="full-width">
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Total</th>
                                <th>Cash</th>
                                <th>Balance</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{$transaction->customer->firstname}} {{$transaction->customer->lastname}}</td>
                                    <td><label class="{{($transaction->type == 'credit') ? 'ui teal label' : 'ui green label'}}">{{$transaction->type}}</label></td>
                                    <td>{{$transaction->total}}</td>
                                    <td>{{$transaction->cash}}</td>
                                    <td>{{$transaction->balance}}</td>
                                    <td>
                                        @if ($transaction->status == 'partial')
                                            <label class="ui basic teal label">{{$transaction->status}}</label>
                                        @elseif($transaction->status == 'paid')
                                            <label class="ui basic green label">{{$transaction->status}}</label>
                                        @else 
                                            <label class="ui basic red label">{{$transaction->status}}</label>
                                        @endif
                                    </td>
                                    <td class="center aligned">
                                        <a class="ui button" href="/transactions/{{$transaction->id}}"><i class="eye icon"></i> View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else 
                    <div class="ui basic center aligned segment">
                        <h3>No transactions have been made yet</h3>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('ajax')
<script>
    $(document).ready(function (){
        $('#transaction-table').DataTable({
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