@extends($layout)
@section('stylesheets')
{!! Html::style('assets/css/users/login.css') !!}
@stop
@section('scripts')
<script src="/assets/js/users/login.js"></script>
@stop

@section('content')



<div class="container">

  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    <div class="col-md-4">

    	<div class="alert alert-warning alert-dismissible" role="alert" style="margin-top:100px">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <strong>Warning!</strong> You are not authorized to view this page. Please Login.
		</div>
      <section class="login-form">
        <form method="post" action="#" role="login">
          <input type="email" name="email" placeholder="Email" required class="form-control input-lg" value="joestudent@gmail.com" />
          <input type="password" class="form-control input-lg" id="password" placeholder="Password" required="" />
          <div class="pwstrength_viewport_progress"></div>
          <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Sign in</button>
          <div>
            <a href="#">Create account</a> or <a href="#">reset password</a>
          </div>
        </form>
      </section>  
      </div>
      <div class="col-md-4"></div>
  </div>
</div>
@stop