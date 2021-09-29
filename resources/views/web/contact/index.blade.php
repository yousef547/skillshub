@extends('web.layout')

@section('title')
Contact_Us
@endsection

@section('contect')
	
    <!-- Hero-area -->
	<div class="hero-area section">

	    <!-- Backgound Image -->
	    <div class="bg-image bg-parallax overlay" style="background-image:url({{asset('web/img/page-background.jpg') }})"></div>
	    <!-- /Backgound Image -->

	    <div class="container">
	        <div class="row">
	            <div class="col-md-10 col-md-offset-1 text-center">
	                <ul class="hero-area-tree">
	                    <li><a href="{{url('/')}}">{{__('web.home')}}</a></li>
	                    <li>{{__('web.contact')}}</li>
	                </ul>
	                <h1 class="white-text">{{__('web.getInTouch')}}</h1>

	            </div>
	        </div>
	    </div>

	</div>
	<!-- /Hero-area -->

	<!-- Contact -->
	<div id="contact" class="section">

	    <!-- container -->
	    <div class="container">

	        <!-- row -->
	        <div class="row">

	            <!-- contact form -->
	            <div class="col-md-6">
	                <div class="contact-form">
	                    <h4>{{__('web.sendMsg')}}</h4>
						@include('web.inc.massage-ajax')
						<form id="contact-form">
                            @csrf
                            <input class="input" type="text" name="name" placeholder="{{ __('web.name') }}">
                            <input class="input" type="email" name="email" placeholder="{{ __('web.email') }}">
                            <input class="input" type="text" name="subject" placeholder="{{ __('web.subject') }}">
                            <textarea class="input" name="body" placeholder="{{ __('web.msg') }}"></textarea>
                            <button id="contact-form-btn" type="submit" class="main-button icon-button pull-right">{{ __('web.send') }}</button>
                        </form>
	                </div>
	            </div>
	            <!-- /contact form -->

	            <!-- contact information -->
	            <div class="col-md-5 col-md-offset-1">
	                <h4>{{__('web.contactInfo')}}</h4>
	                <ul class="contact-details">
	                    <li><i class="fa fa-envelope"></i>{{$satt->email}}</li>
	                    <li><i class="fa fa-phone"></i>{{$satt['phone']}}</li>
	                </ul>

	            </div>
	            <!-- contact information -->

	        </div>
	        <!-- /row -->

	    </div>
	    <!-- /container -->

	</div>
	<!-- /Contact -->
@endsection    
@section('scripts')
<script>
	console.log('kdl;gkdl');
        $('#success-div').hide();
        $('#errors-div').hide();

        $('#contact-form-btn').click(function (e) {
            $('#success-div').hide();
            $('#errors-div').hide();
            $('#success-div').empty();
            $('#errors-div').empty();

            e.preventDefault();
            let formData = new FormData($('#contact-form')[0]);
			console.log(formData);

            $.ajax({
                type: 'POST',
                url: "{{ url('contact/massage/send') }}",
                data: formData,
                contentType: false,
                processData: false,

                success: function (data) {
                    $('#success-div').show();
                    $('#success-div').text(data.success);
                },
                error: function (xhr, status, error) {
                    $('#errors-div').show();

                    $.each(xhr.responseJSON.errors, function (key, item) {
                        $('#errors-div').append('<p>' + item + '</p>');
                    })
                },
            });
        });
    </script>
@endsection