@extends('layouts.app')

@section('content')
@include('inc.sidebar')
@include('inc.navbar')
<div class="pusher">
    <div class="main-content">
      <div class="ui grid stackable padded">
        <div class="four wide computer eight wide tablet sixteen wide mobile column">
            <div class="ui fluid card">
                <div class="content">
                <div class="ui right floated header red">
                    <i class="icon shopping cart"></i>
                </div>
                <div class="header">
                    <div class="ui red header">
                    {{($orderCount ?? '') ? $orderCount : '0'}}
                    </div>
                </div>
                <div class="meta">
                    Orders
                </div>
                <div class="description">
                    Total number of orders this month
                </div>
                </div>
                <div class="extra content">
                <div class="ui two buttons">
                    <div class="ui order button">More Info</div>
                </div>
                </div>
            </div>
        </div>
        <div class="four wide computer eight wide tablet sixteen wide mobile column">
          <div class="ui fluid card">
            <div class="content">
              <div class="ui right floated header green">
                <i class="bullseye icon"></i>
              </div>
              <div class="header">
                <div class="ui header green">
                  {{($expense ?? '') ? $expense : '0'}}
                </div>
              </div>
              <div class="meta">
                Expenses
              </div>
              <div class="description">
                Total expense amount this month
              </div>
            </div>
            <div class="extra content">
              <div class="ui two buttons">
                <div class="ui expense button">More Info</div>
              </div>
            </div>
          </div>
        </div>
        <div class="four wide computer eight wide tablet sixteen wide mobile column">
          <div class="ui fluid card">
            <div class="content">
              <div class="ui right floated header teal">
                <i class="icon money alternate"></i>
              </div>
              <div class="header">
                <div class="ui teal header">
                  {{($gross ?? '') ? $gross : '0'}}
                </div>
              </div>
              <div class="meta">
                Gross Income
              </div>
              <div class="description">
                Gross income from sales this month
              </div>
            </div>
            <div class="extra content">
              <div class="ui two buttons">
                <div class="ui gross button">More Info</div>
              </div>
            </div>
          </div>
        </div>
        <div class="four wide computer eight wide tablet sixteen wide mobile column">
          <div class="ui fluid card">
            <div class="content">
              <div class="ui right floated header purple">
                <i class="dollar sign icon"></i>
              </div>
              <div class="header">
                <div class="ui purple header">
                  {{($net ?? '') ? $net : '0'}}
                </div>
              </div>
              <div class="meta">
                Net Income
              </div>
              <div class="description">
                Income deducted with expenses
              </div>
            </div>
            <div class="extra content">
              <div class="ui two buttons">
                <div class="ui net button">More Info</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="ui stackable two column padded grid">
        <div class="column">
          <div class="ui segments">
            <div class="ui inverted teal clearing segment">
              <h3><i class="certificate icon"></i> Best Products</h3>
            </div>
            <div class="ui raised segment">
              @if ($bestProducts ?? '')
                <table class="ui blue striped table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Units Sold</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($bestProducts as $item)
                      <tr>
                        <td>{{$item->product->name}}</td>
                        <td>{{$item->sum}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              @else 
                <div class="ui basic center aligned segment">
                  <h3>waiting for data</h3>
                </div>
              @endif
            </div>
          </div>
        </div>
        <div class="column">
          <div class="ui segments">
            <div class="ui inverted blue clearing segment">
              <h3><i class="trophy icon"></i> Top Customers</h3>
            </div>
            <div class="ui raised segment">
              @if ($bestCustomers ?? '')
                <table class="ui blue striped table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Amount Spent</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($bestCustomers as $item2)
                      <tr>
                        <td>{{$item2->customer->firstname}} {{$item2->customer->lastname}}</td>
                        <td>{{$item2->sum}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              @else 
                <div class="ui basic center aligned segment">
                  <h3>waiting for data</h3>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<div class="ui mini order modal">
  <i class="close icon"></i>
    <div class="header"><i class="info blue icon"></i> More Info</div>
    <div class="content">
      <div class="ui large message">
        <p style="font-weight: bolder">This counts the total number of orders made during the current month. Please take note that these include 
          orders from the supplier.</p>
      </div>
    </div>
    <div class="actions">
      <div class="ui deny button">Ok, got it!</div>
    </div>
</div>
<div class="ui mini expense modal">
  <i class="close icon"></i>
    <div class="header"><i class="info blue icon"></i> More Info</div>
    <div class="content">
      <div class="ui large message">
        <p style="font-weight: bolder">This sums the total expenses made during the current month. Please take note that this automatically
          includes orders from supplier as a business expense.<br><br> For a more detailed summation please visit the report tab.</p>
      </div>
    </div>
    <div class="actions">
      <div class="ui deny button">Ok, got it!</div>
    </div>
</div>
<div class="ui mini gross modal">
  <i class="close icon"></i>
    <div class="header"><i class="info blue icon"></i> More Info</div>
    <div class="content">
      <div class="ui large message">
        <p style="font-weight: bolder">This sums total amount from orders made this month. Please take note that this does not include orders with 
          credit type transactions.<br><br> For a more detailed summation please visit the report tab.</p>
      </div>
    </div>
    <div class="actions">
      <div class="ui deny button">Ok, got it!</div>
    </div>
</div>
<div class="ui mini net modal">
  <i class="close icon"></i>
    <div class="header"><i class="info blue icon"></i> More Info</div>
    <div class="content">
      <div class="ui large message">
        <p style="font-weight: bolder">This is the result of deducting expenses from gross income. 
          <br><br> For a more detailed summation please visit the report tab.</p>
      </div>
    </div>
    <div class="actions">
      <div class="ui deny button">Ok, got it!</div>
    </div>
</div>
@endsection

@push('ajax')
  <script>
    $(document).ready(function () {
      $('.order.modal').modal('attach events', '.order.button', 'show');
      $('.expense.modal').modal('attach events', '.expense.button', 'show');
      $('.gross.modal').modal('attach events', '.gross.button', 'show');
      $('.net.modal').modal('attach events', '.net.button', 'show');
    });
  </script>
@endpush