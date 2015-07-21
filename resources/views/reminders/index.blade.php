@extends($layout)
@section('stylesheets')
{!! Html::style('assets/css/reminders/index.css') !!}
@stop
@section('scripts')
<script src="assets/js/reminders/index.js"></script>
@stop
@section('content')
<div id="main-frame" class="col-md-7">
	{!! Form::open(array('action' => 'Auth\PasswordController@postEmail','id'=>'reg-form', 'class'=>'','role'=>"form", 'method'=>"post")) !!}
	<div class="form-frame col-md-12">
		<div class="input-section">
			<h3 class="form-title">Enter Your email and we will send you an instructions to recover your password.</h3>
			<input type="text" class="form-control col-md-12 top-margin email" name="email" id="email" placeholder="Email *" aria-describedby="sizing-addon2">
			<div class="error-wrapper">
				<div class="error-email hide error"></div>
			</div>
			
			<button class="btn btn-primary pull-right" type="submit" id="reset-btn">Rest Password</button>
		</div>
	</div>
	{!! Form::close() !!}
</div>

@stop