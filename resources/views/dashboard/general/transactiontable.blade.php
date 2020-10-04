@if ($columns ?? '' && $transactions ?? '')
    <table class="ui tablet stackable selectable definition table" id="transaction-table">
        <thead class="full-width">
            <tr>
                @foreach ($columns as $column)
                    <th>{{$column}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{date('d M Y, h:i A', strtotime($transaction->created_at))}}</td>
                    <td>{{$transaction->type}}</td>
                    <td>{{$transaction->total}}</td>
                    <td>{{$transaction->cash}}</td>
                    <td>{{$transaction->balance}}</td>
                    <td>{{$transaction->change}}</td>
                    <td>{{$transaction->status}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="ui basic center aligned segment">
        <h3>No Transactions Made Yet</h3>
    </div>
@endif