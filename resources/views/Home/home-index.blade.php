@extends($layout)
@section('stylesheets')
{!! Html::style('assets/css/home/index.css') !!}
@stop
@section('scripts')
<script src="assets/js/home/home.js"></script>
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
					{!! Form::open(array('action' => 'UsersController@postLogout', 'class'=>'','role'=>"form",'id'=>'logout-form')) !!}
						<li><a class="active" id="logout">Logout</a></li>
					{!! Form::close() !!}
				 @else
					<li><a class="active" id="login">Login</a></li>
				 @endif

				<li><a>About Us</a></li>
				<li><a>Themes</a></li>
				<li><a>Get in touch</a></li>
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



<div class="modal fade" id="myModal">
	{!! Form::open(array('action' => 'UsersController@postLogin', 'class'=>'','role'=>"form",'id'=>'login-form')) !!}
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Login</h4>
	      </div>
	      <div class="modal-body">
			<div class="form-group">
				<input type="text" class="form-control form-control-login" name="username" id="username" placeholder="Username" aria-describedby="sizing-addon2">
			</div>
			<div class="form-group">
				<input type="password" class="form-control form-control-login" name="password" id="password" placeholder="Password" aria-describedby="sizing-addon2">			
			</div>
	      </div>
	      <div class="modal-footer clearfix">
	      	<div id="forgot-wrapper pull-left">
	        	<a id="forgot"> I forgot my password</a>
	        </div>
	        <button type="button" class="btn btn-primary pull-right login-btn">Login</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	{!! Form::close() !!}
</div><!-- /.modal -->

<div class="modal fade" id="reset_modal">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-body">
	      	<h4>Your password has been reset successfully.</h4>
	      	<h5>You are logged on as {{$username}}</h5>
	      </div>
	      <div class="modal-footer clearfix">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<input type="hidden" id="reset_success" value="{{ $reset_success }}">
@stop