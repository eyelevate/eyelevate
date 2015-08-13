@extends($layout)
@section('stylesheets')
{!! Html::style('/assets/css/home/index.css') !!}
{!! Html::style('/assets/css/login_modal.css') !!}
@stop
@section('scripts')
<script src="/assets/js/login_modal.js"></script>
<script src="/assets/js/home/home.js"></script>
@stop

@section('content')
<div id="main-content">
	<nav class="mainmenu">
	<div class="container">
		<div class="dropdown">
			<button type="button" class="navbar-toggle burger" data-toggle="dropdown">
				<span class="icon-bar" id="icon-1"></span> 
				<span class="icon-bar" id="icon-2"></span> 
				<span class="icon-bar" id="icon-3"></span> 
			</button>
			<!-- <a data-toggle="dropdown" href="#">Dropdown trigger</a> -->
			<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
				 @if(Auth::user())
				 	<li><a href="/users/profile/{!!Auth::user()->username!!}" style="font-weight: bold;">View Profile</a></li>
					<li>{!! Html::link('/logout', 'Logout') !!}</li>
				 @else
					<li><a class="active" id="login">Login</a></li>
					<li><a class="active" href="/registration">Sign Up</a></li>
				 @endif
			</ul>
		</div>
	</div>
</nav>
<!-- Main (Home) section -->
<section class="section" id="head">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1 text-center">	
				<!-- Site Title, your name, HELLO msg, etc. -->
				<h2 class="subtitle"  style="color:white;">Eyelevate</h2>
				<!-- Short introductory (optional) -->
				<!-- #778899 -->
				<!-- #FFE800 -->
				<!-- #5A5A5A -->
				<!-- rgb(86, 62, 125); -->
				<h3 class="tagline" style="color:white">
					Potentially, the best place to tell people why they are here.<br>
					So, this is a demo page built to showcase the beauty of the template.
				</h3>
			{!! Form::open(array('action' => 'HomeController@postIndex', 'class'=>'','role'=>"form",'id'=>'index-form')) !!}
			  <div class="" id="search-input">
			    <div class="input-group">
			      <input name="searched-content" type="text" class="form-control" placeholder="Search for...">
			      <span class="input-group-btn">
			        <button class="btn btn-default" type="submit">Go!</button>
			      </span>
			    </div><!-- /input-group -->
			  </div><!-- /.col-lg-6 -->
			{!! Form::close() !!}
			</div> <!-- /col -->
		</div> <!-- /row -->
	</div>
</section>
</div>
{!! View::make('partials.login_modal') !!}


<div class="modal fade" id="reset_modal">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-body">
	      	<h4>Your password has been reset successfully.</h4>
		@if(isset($username))
	      	<h5>You are logged on as {{$username}}</h5>
	    @endif
	      </div>
	      <div class="modal-footer clearfix">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


	@if(isset($reset_success))
		<input type="hidden" id="reset_success" value="{{ $reset_success }}">
    @endif

	@if(isset($login_failed))
		<div class="modal fade in" id="failed_modal"  style="display: block;">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-body">
			      	<h4>Login Failed</h4>
			      	<h5>Incorrect username or password</h5>
			      </div>
			      <div class="modal-footer clearfix">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<input type="hidden" id="login_failed" value="{{ $login_failed }}">
	@endif
@stop