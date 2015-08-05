@extends($layout)
@section('stylesheets')
{!! Html::style('/assets/css/categories/edit.css') !!}
@stop
@section('scripts')
<script src="/assets/js/categories/edit.js"></script>
@stop

@section('content')
<div class="jumbotron">
	<h1>Categories Edit</h1>
</div>
	@if(isset($message_feedback))
		<div class="alert alert-success" role="alert">
	      <strong>Well done!</strong> {!! $message_feedback !!}
	    </div>
	@endif
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title">Information</h3>
	  </div>
	  <div class="panel-body">
    		{!! Form::open(array('action' => 'CategoriesController@postEdit', 'class'=>'','role'=>"form")) !!}
				<div class="form-group {{ $errors->has('cats') ? 'has-error' : false }}">
			    	<label class="control-label" for="cats">Categories</label>
			    	{!! Form::select('cats', $all_cats, null ,array('id'=>'cats','class'=>'form-control custom-dropdown__select')) !!}
			    	<span id="duplicate-error" class="hide">Category has been selected!</span>
			  	</div>

			  	<hr>
			  	<h4>Active Categories</h4>
				<div class="well clearfix cat-wrapper">
					{!! $categories_prepared !!}
				</div>

			

	  </div>

	   <div class="panel-footer clearfix">

			 <button class="btn btn-primary pull-right">Add</button>
	   </div>
	</div>
	{!! Form::close() !!}
@stop