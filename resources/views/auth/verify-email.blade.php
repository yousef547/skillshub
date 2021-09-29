@extends('web.layout')

@section('title')
verfiy email
@endsection

@section('contect')
<div class="alert alert-success">
a verification Email sent successfully please check your inbox
</div>

<form action="{{url('/email/verification-notification')}}" method="POST">
@csrf
<button type="submit">
    Resend email
</button>
</form>
@endsection