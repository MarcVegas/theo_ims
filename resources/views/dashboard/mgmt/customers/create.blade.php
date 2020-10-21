@extends('layouts.app')

@section('content')
@include('inc.sidebar')
@include('inc.navbar')
<div class="pusher">
    <div class="main-content">
        <div class="ui basic segment padded">
            <div class="ui stackable padded grid">
                <div class="ten wide column">
                    <div class="ui raised segment">
                        @include('inc.messages')
                        <h2><i class="user icon"></i> New Customer</h2>
                        <form class="ui equal width form" id="customer-form" action="{{route('customers.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="fields">
                                <div class="field">
                                    <label>Firstname</label>
                                    <input type="text" name="firstname" id="firstname" required>
                                </div>
                                <div class="field">
                                    <label>Lastname</label>
                                    <input type="text" name="lastname" id="lastname" required>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="field">
                                    <label>Address</label>
                                    <input type="text" name="address" id="address" required>
                                </div>
                                <div class="field">
                                    <label>Contact Number (optional)</label>
                                    <input type="tel" name="contact" id="contact" placeholder="+63 xxx xxx xxxx">
                                </div>
                            </div>
                            <input type="hidden" name="type" id="type" value="reseller">
                            <a class="ui button" href="{{route('customers.index')}}"><i class="chevron left icon"></i> Back</a>
                            <button type="submit" class="ui green right floated button"><i class="save icon"></i> Save</button>
                        </form>
                    </div>
                </div>
                <div class="six wide column">
                    <div class="ui raised padded center aligned segment">
                        <img class="ui centered small circular image" src="/storage/uploads/avatar.png" alt=""><br>
                        <input type="file" (change)="fileEvent($event)" form="customer-form" class="inputfile" name="photo" id="photo"/>
                        <label for="photo" class="ui blue button">
                            <i class="camera icon"></i>
                            Upload Photo
                        </label>
                        <div class="ui tertiary segment">
                            <b>IMPORTANT:</b> Image size limit is 5mb. Images with larger sizes will take longer to upload.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('ajax')
    <script>
        $(document).ready(function () {
            $('.green.button').click(function () {
                $('.green.button').addClass('loading disabled');
            });
        });
    </script>
@endpush