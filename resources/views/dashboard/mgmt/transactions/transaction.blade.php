@extends('layouts.app')

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
                                25
                                </div>
                            </div>
                            <div class="meta">
                                Credit
                            </div>
                            <div class="description">
                                Number of transactions with unpaid credit
                            </div>
                        </div>
                    </div>
                </div>
                <div class="four wide computer eight wide tablet sixteen wide mobile column">
                    <div class="ui fluid card">
                        <div class="content">
                            <div class="ui right floated header green">
                                <i class="icon handshake"></i>
                            </div>
                            <div class="header">
                                <div class="ui teal header">
                                150
                                </div>
                            </div>
                            <div class="meta">
                                Transactions
                            </div>
                            <div class="description">
                                Total number of transactions listed in the system
                            </div>
                        </div>
                    </div>
                </div>
                <div class="four wide computer eight wide tablet sixteen wide mobile column">
                    <div class="ui fluid card">
                        <div class="content">
                            <div class="ui right floated header teal">
                                <i class="icon money bill alternate"></i>
                            </div>
                            <div class="header">
                                <div class="ui teal header">
                                1500
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
                        <tr>
                            <td>John Doe</td>
                            <td><label class="ui teal label">credit</label></td>
                            <td>1000</td>
                            <td>500</td>
                            <td>500</td>
                            <td><label class="ui basic teal label">partial</label></td>
                            <td class="collapsing">
                                <a class="ui icon button" href="p"><i class="eye icon"></i></a>
                                <a class="ui icon button" href=""><i class="pencil alternate icon"></i></a>
                                <button class="ui icon delete button"><i class="trash icon"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>Jane Doe</td>
                            <td><label class="ui green label">full</label></td>
                            <td>1000</td>
                            <td>1000</td>
                            <td>0</td>
                            <td><label class="ui basic green label">paid</label></td>
                            <td class="collapsing">
                                <a class="ui icon button" href="p"><i class="eye icon"></i></a>
                                <a class="ui icon button" href=""><i class="pencil alternate icon"></i></a>
                                <button class="ui icon delete button"><i class="trash icon"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td><label class="ui blue label">deposit</label></td>
                            <td>500</td>
                            <td>500</td>
                            <td>0</td>
                            <td><label class="ui basic green label">paid</label></td>
                            <td class="collapsing">
                                <a class="ui icon button" href="p"><i class="eye icon"></i></a>
                                <a class="ui icon button" href=""><i class="pencil alternate icon"></i></a>
                                <button class="ui icon delete button"><i class="trash icon"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>Johnny Doe</td>
                            <td><label class="ui teal label">credit</label></td>
                            <td>1000</td>
                            <td>0</td>
                            <td>1000</td>
                            <td><label class="ui basic red label">unpaid</label></td>
                            <td class="collapsing">
                                <a class="ui icon button" href="p"><i class="eye icon"></i></a>
                                <a class="ui icon button" href=""><i class="pencil alternate icon"></i></a>
                                <button class="ui icon delete button"><i class="trash icon"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td><label class="ui teal label">credit</label></td>
                            <td>1000</td>
                            <td>500</td>
                            <td>500</td>
                            <td><label class="ui basic teal label">partial</label></td>
                            <td class="collapsing">
                                <a class="ui icon button" href="p"><i class="eye icon"></i></a>
                                <a class="ui icon button" href=""><i class="pencil alternate icon"></i></a>
                                <button class="ui icon delete button"><i class="trash icon"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td>John Doe</td>
                            <td><label class="ui teal label">credit</label></td>
                            <td>1000</td>
                            <td>500</td>
                            <td>500</td>
                            <td><label class="ui basic teal label">partial</label></td>
                            <td class="collapsing">
                                <a class="ui icon button" href="p"><i class="eye icon"></i></a>
                                <a class="ui icon button" href=""><i class="pencil alternate icon"></i></a>
                                <button class="ui icon delete button"><i class="trash icon"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('ajax')
<script>
    $(document).ready(function (){
        $('#transaction-table').DataTable({
            "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]]
        });
    });
</script>
@endpush