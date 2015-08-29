@extends($layout)
@section('stylesheets')

@stop
@section('scripts')
<script src="/assets/js/tasks/index.js"></script>
@stop

@section('content')
	<div class="jumbotron">
		<h1>Add A Task</h1>
	</div>
	{!! Form::open(array('action' => 'TasksController@postAdd', 'class'=>'','role'=>"form")) !!}
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Create A Task</h3>
		</div>
		<div class="panel-body">
		  	<div class="form-group {{ $errors->has('title') ? 'has-error' : false }}">
		    	<label class="control-label" for="title">Issue</label>
		    	{!! Form::text('title', null, array('class'=>'form-control', 'placeholder'=>'Issue details')) !!}
		        @foreach($errors->get('title') as $message)
		            <span class='help-block'>{{ $message }}</span>
		        @endforeach
		  	</div>

		  	<div class="form-group {{ $errors->has('description') ? 'has-error' : false }}">
		    	<label class="control-label" for="description">Details</label>
		    	{!! Form::textarea('description', null, array('class'=>'form-control', 'placeholder'=>'Description details', 'rows'=>'3')) !!}
		        @foreach($errors->get('description') as $message)
		            <span class='help-block'>{{ $message }}</span>
		        @endforeach
		  	</div>
	  		<div class="form-group {{ $errors->has('type') ? 'has-error' : false }}">
		    	<label class="control-label" for="role_id">Task Type</label>
		    	{!! Form::select('type', $types, null ,array('class'=>'form-control')) !!}
		        @foreach($errors->get('type') as $message)
		            <span class='help-block'>{{ $message }}</span>
		        @endforeach
		  	</div>
		  	<div class="form-group {{ $errors->has('assigned_id') ? 'has-error' : false }}">
		    	<label class="control-label" for="assigned_id">Assign To</label>
		    	{!! Form::select('assigned_id', $admins, null ,array('class'=>'form-control')) !!}
		        @foreach($errors->get('type') as $message)
		            <span class='help-block'>{{ $message }}</span>
		        @endforeach
		  	</div>
		</div>
		<div class="panel-footer clearfix">
			<a href="{!! route('tasks_index') !!}" class="btn btn-default">Back</a>
			<input type="submit" class="btn btn-primary pull-right" value="Add Task"/>
		</div>
	</div>
	{!! Form::close() !!}
@stop