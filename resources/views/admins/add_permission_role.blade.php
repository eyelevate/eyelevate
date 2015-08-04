@extends($layout)
@section('stylesheets')

@stop
@section('scripts')

@stop

@section('content')

	<div class="jumbotron">
		<h1>Permissions Add</h1>
		<a href="" id="url" class="hide" target="_blank"></a>
		<div class="alert alert-warning delivery-area-alert hide clearfix">
		</div>
	</div>
	@if(isset($message_feedback))
		<div class="alert alert-success" role="alert">
	      <strong>Well done!</strong> {!! $message_feedback !!}
	    </div>
	@endif
	<div class="alert alert-danger {{isset($validator)?'':'hide'}}" role="alert">
	  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
	  <span class="sr-only">Error:</span>
	  	Validation Failed
	</div>


	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title">Information</h3>
	  </div>
	  <div class="panel-body">
    		{!! Form::open(array('action' => 'AdminsController@postAddPermissionRole', 'class'=>'','role'=>"form")) !!}
		  	<div class="form-group {{ $errors->has('permission_id') ? 'has-error' : false }}">
		    	<label class="control-label" for="permission_id">Permission</label>
		    	{!! Form::select('permission_id', $permissions, null ,array('id'=>'permission_id','class'=>'form-control')) !!}
		        @foreach($errors->get('permission_id') as $message)
		            <span class='help-block'>{{ $message }}</span>
		        @endforeach
		  	</div>
		  	<div class="form-group {{ $errors->has('role_id') ? 'has-error' : false }}">
		    	<label class="control-label" for="role_id">Role</label>
		    	{!! Form::select('role_id', $roles, null ,array('id'=>'role_id','class'=>'form-control')) !!}
		        @foreach($errors->get('role_id') as $message)
		            <span class='help-block'>{{ $message }}</span>
		        @endforeach
		  	</div>
				  <button class="btn btn-primary pull-right">Save</button>
			{!! Form::close() !!}
	  </div>
	</div>
@stop