@if ($columns ?? '' && $deposits ?? '')
    <table class="ui tablet stackable selectable definition table" id="deposit-table">
        <thead class="full-width">
            <tr>
                @foreach ($columns as $column)
                    <th>{{$column}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($deposits as $deposit)
                <tr>
                    <td>{{$deposit->id}}</td>
                    <td>{{$deposit->initial_balance}}</td>
                    <td>{{$deposit->deposit}}</td>
                    <td>{{$deposit->remaining_balance}}</td>
                    <td>{{$deposit->transaction->customer->firstname}} {{$deposit->transaction->customer->lastname}}</td>
                    <td>{{date('d M Y, h:i A', strtotime($deposit->created_at))}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="ui basic center aligned segment">
        <h3>No Deposits Made Yet</h3>
    </div>
@endif