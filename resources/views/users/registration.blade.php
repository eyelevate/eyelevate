@extends($layout)
@section('stylesheets')
	<link href='http://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet' type='text/css'>
@stop
@section('scripts')
<script src="assets/js/users/registration.js"></script>
@stop

@section('content')
<div id="main-frame" class="col-md-7">
	{!! Form::open(array('action' => 'UsersController@postRegistration', 'class'=>'','role'=>"form")) !!}
	<div class="form-frame col-md-12">
		<div class="input-section">
			<h3 >Basic Information</h3>
			<div class="form-single">
				<input type="text" class="form-style col-md-4" name="first_name" placeholder="First name *" id="first_name" aria-describedby="sizing-addon2">
			</div>
			<div class="form-single">
				<input type="text" class="form-style col-md-5" name="last_name" id="last_name" placeholder="Last name *" aria-describedby="sizing-addon2">
			</div>
			<div class="form-single">
				<select class="form-style col-md-2" name="age" id="age">
				  <option >Age</option>
				  <option value="1">Below 18</option>
				  <option value="2">18 or older</option>
				</select>
			</div>

		</div>
		<div class="input-section">
			<h3>Credentials</h3>
			<input type="text" class="form-style col-md-12" name="email" id="email" placeholder="Email *" aria-describedby="sizing-addon2">
			<input type="text" class="form-style col-md-12" name="company" id="company" placeholder="Company Name" aria-describedby="sizing-addon2">
		</div>
		<button class="btn btn-primary pull-right" id="submit-btn" type="submit">Join Us</button>
	</div>
	{!! Form::close() !!}
</div>

<style>
#main-frame{
	/*background-color: rgb(241, 241, 241);*/
	background-color: #fff;
  	min-height: 340px;
  	display: block;
	margin: 20px auto;
	float: none;
	border-radius: 5px;
	padding-top: 5px;
	padding-left: 30px;
	padding-right: 30px;
}
.background-color{
	background-color: #fff;
}
h3{
	font: 19px/29px "Gotham Rounded A", "Gotham Rounded B", "Helvetica Neue", Helvetica, Arial, sans-serif;
}
.form-style{
	display: inline;
  height: 34px;
  padding: 6px 12px;
  font-size: 14px;
  line-height: 1.42857143;
  color: #555;
  background-color: #fff;
  background-image: none;
  border: 1px solid #ccc;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
  -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
  -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
  transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
#last-name{
	margin-left: 27px;
}
#age{
	margin-left: 4%;
}
.form-frame{
	left: 0;
	margin: 0 auto;
	float: none;
	position: absolute;
}
#email{
	
}
.input-section{
	height: 90px;
}
#company{
	  margin-top: 15px;
}
#submit-btn{
	margin-top: 15px;
}
#join{

}
@media (max-width: 1148px) {
	#age{
		margin-left: 3%;
	}
}
@media (max-width: 991px) {
	.form-frame{
		  width: 100%;
	}
	#first_name{width: 100%;}
	#last_name{width: 100%;}
	#age{width: 100%;}
	#email{width: 100%;}
	#company{width: 100%;}
	.input-section {
	  height: 150px;
	}
	#age {
	   margin-left: 0; 
	}

}
.has-error{
	  border-color: #a94442;
  -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
  box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
}
</style>


@stop