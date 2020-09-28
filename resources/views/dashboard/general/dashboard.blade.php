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
                    3958
                    </div>
                </div>
                <div class="meta">
                    orders
                </div>
                <div class="description">
                    Elliot requested permission to view your contact details
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
                <div class="ui header green">57.6%</div>
              </div>
              <div class="meta">
                Expenses
              </div>
              <div class="description">
                Elliot requested permission to view your contact details
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
                <div class="ui teal header">3112</div>
              </div>
              <div class="meta">
                Gross Income
              </div>
              <div class="description">
                Elliot requested permission to view your contact details
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
                <div class="ui purple header">9805</div>
              </div>
              <div class="meta">
                Net Income
              </div>
              <div class="description">
                Elliot requested permission to view your contact details
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
          <table class="ui celled striped table">
            <thead>
              <tr>
                <th colspan="3">
                  Git Repository
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="collapsing">
                  <i class="folder icon"></i> node_modules
                </td>
                <td>Initial commit</td>
                <td class="right aligned collapsing">10 hours ago</td>
              </tr>
              <tr>
                <td><i class="folder icon"></i> test</td>
                <td>Initial commit</td>
                <td class="right aligned">10 hours ago</td>
              </tr>
              <tr>
                <td><i class="folder icon"></i> build</td>
                <td>Initial commit</td>
                <td class="right aligned">10 hours ago</td>
              </tr>
              <tr>
                <td><i class="file outline icon"></i> package.json</td>
                <td>Initial commit</td>
                <td class="right aligned">10 hours ago</td>
              </tr>
              <tr>
                <td><i class="file outline icon"></i> Gruntfile.js</td>
                <td>Initial commit</td>
                <td class="right aligned">10 hours ago</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
@endsection