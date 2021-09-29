@extends('web.layout')

@section('title')
Forget Password
@endsection

@section('contect')

<!-- Contact -->
<div id="contact" class="section">

<!-- container -->
<div class="container">

    <!-- row -->
    <div class="row">

        <!-- login form -->
        <div class="col-md-6 col-md-offset-3">
            <div class="contact-form">
                <h4>Forget Password</h4>
                @include('web.inc.massage')
                <form method="POST" action="{{url('/forgot-password')}}">
                    @csrf
                    <input class="input" type="email" name="email" placeholder="Email">

                    <button type="submit" class="main-button icon-button pull-right">Sign In</button>
                </form>
            </div>
        </div>
        <!-- /login form -->

    </div>
    <!-- /row -->

</div>
<!-- /container -->

</div>
<!-- /Contact -->
@endsection