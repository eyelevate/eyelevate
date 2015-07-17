@extends($layout)
@section('stylesheets')
	
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
				<li><a href="#head" class="active">Hello</a></li>
				<li><a href="#about">About me</a></li>
				<li><a href="#themes">Themes</a></li>
				<li><a href="#contact">Get in touch</a></li>
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
<style>
/*ICON BAR COLOR*/
#search-input{
	width:80%;
	margin-left: auto;
	margin-right: auto;
}

@media (max-width: 767px) {
	#search-input { 
			width:100%;
			margin-left: auto;
			margin-right: auto;
	}
}
.theme-invert .navbar-toggle .icon-bar {
	background:MintCream;
}

.theme-invert .mainmenu .dropdown-menu a {
	color:MintCream;
}
.theme-invert .mainmenu .dropdown-menu a:hover { 
	color:white;
	/*TOP DROPDOWN MENU LI BACKGROUND*/
	background:none;
	border: 1px solid rgba(206, 210, 255, 0.27)
}
/*TOP DROP DOWN BTN BACKGROUND*/
.theme-invert .navbar-toggle {
  background: rgba(255, 255, 255, 0.19);
}
.dropdown-menu>li>a:hover, .dropdown-menu>li>a:focus {
  color: #262626;
  text-decoration: none;
  background-color: rgba(0, 0, 0, 0.18);
  }
 .burger:hover{
  background-color: rgba(171, 171, 171, 0.43);
 }

</style>


@stop