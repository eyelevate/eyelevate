@extends($layout)
@section('stylesheets')
{!! Html::style('assets/css/auth/reset.css') !!}
@stop
@section('scripts')
<script src="assets/js/auth/reset.js"></script>
<script>
$('#cancel_btn').click(function(){
    location.replace('/');
});

</script>
@stop
@section('content')
<div id="main-frame" class="col-md-7"
@if($errors->get('email')||$errors->get('password')||$errors->get('password_confirmation'))
style="height: 400px;"
@endif
>
    <form method="POST" action="/password/reset">
        {!! csrf_field() !!}
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-frame col-md-12">
            <div class="input-section">
                <h3 class="form-title">Enter Your email and your <strong>new password</strong> to continue</h3>
                <div class="info-space form-group {{ $errors->has('email') ? 'has-error' : false }}">
                    <input type="text" class="form-control col-md-12 top-margin email" name="email" id="email_id" placeholder="Email" aria-describedby="sizing-addon2">                   
                    @foreach($errors->get('email') as $message)
                    <span class='help-block'>{{ $message }}</span>
                    @endforeach
                </div>  
                <div class=" info-space form-group {{ $errors->has('password') ? 'has-error' : false }}">
                    <input name="password" class="form-control  col-md-12 top-margin "  id="password_id" placeholder="Enter Password" type="password">

                    @foreach($errors->get('password') as $message)
                    <span class='help-block'>{{ $message }}</span>
                    @endforeach
                </div>
                <div class=" info-space form-group {{ $errors->has('password_confirmation') ? 'has-error' : false }}">
                    <input name="password_confirmation" class="form-control col-md-12 top-margin" id="password_again_id" placeholder="Re-Enter Password" type="password">

                    @foreach($errors->get('password_confirmation') as $message)
                    <span class='help-block'>{{ $message }}</span>
                    @endforeach
                </div>  
                <button class="btn btn-primary pull-right" type="submit" id="reset-btn">Reset Password</button>
                <a class="btn btn-danger pull-left" id="cancel_btn">Cancel</a>
            </div>
        </div>
    </form>
</div>

@stop