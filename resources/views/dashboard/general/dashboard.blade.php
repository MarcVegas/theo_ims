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
                    <div class="ui button">More Info</div>
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
                <div class="ui button">More Info</div>
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
                Total gross income this month
              </div>
            </div>
            <div class="extra content">
              <div class="ui two buttons">
                <div class="ui button">More Info</div>
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
                <div class="ui button">More Info</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="ui grid stackable padded">
        <div class="column">
          @if ($orders ?? '')
            <table class="ui celled striped table">
              <thead>
                <tr>
                  <th colspan="3">
                    Recently sold products
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($orders as $item)
                  <tr>
                    <td>
                      {{$item->order_quantity}}
                    </td>
                    <td>{{$item->product->name}}</td>
                    <td class="right aligned collapsing">{{$item->created_at}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @endif
        </div>
      </div>
    </div>
</div>
@endsection