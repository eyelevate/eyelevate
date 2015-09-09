
@extends($layout)
@section('stylesheets')
{!! Html::style('/assets/css/projects/index.css') !!}
@stop
@section('scripts')

@stop

@section('content')
	<div class="jumbotron">
		<h1>Projects Add</h1>
	</div>

	<div class="panel panel-default">
		{!! Form::open(array('action' => 'ProjectsController@postEdit',  'class'=>'','role'=>"form")) !!}
		<input type="hidden" name="id" value="{{$all_projects->id}}">
		<div class="panel-heading">
			<h3 class="panel-title">Create a Projects</h3>
		</div>
		<div class="panel-body">
				<div class="form-group {{ $errors->has('title') ? 'has-error' : false }}">
			    	<label class="control-label" for="title">Issue</label>
			    	{!! Form::text('title', $all_projects->title, array('class'=>'form-control', 'placeholder'=>'Issue details')) !!}
			        @foreach($errors->get('title') as $message)
			            <span class='help-block'>{{ $message }}</span>
			        @endforeach
			  	</div>

			  	<div class="form-group {{ $errors->has('description') ? 'has-error' : false }}">
			    	<label class="control-label" for="description">Details</label>
			    	{!! Form::textarea('description', $all_projects->description, array('class'=>'form-control', 'placeholder'=>'Description details', 'rows'=>'3')) !!}
			        @foreach($errors->get('description') as $message)
			            <span class='help-block'>{{ $message }}</span>
			        @endforeach
			  	</div>
		  		<div class="form-group {{ $errors->has('type') ? 'has-error' : false }}">
			    	<label class="control-label" for="role_id">Project Type</label>
			    	{!! Form::select('type', $types, $all_projects->type ,array('class'=>'form-control')) !!}
			        @foreach($errors->get('type') as $message)
			            <span class='help-block'>{{ $message }}</span>
			        @endforeach
			  	</div>
			  	<div class="form-group {{ $errors->has('type') ? 'has-error' : false }}">
			    	<label class="control-label" for="role_id">Status</label>
			    	{!! Form::select('status', $status, $all_projects->status ,array('class'=>'form-control')) !!}
			        @foreach($errors->get('type') as $message)
			            <span class='help-block'>{{ $message }}</span>
			        @endforeach
			  	</div>
		</div>
		<div class="panel-footer clearfix">
			<button type="submit" class="btn btn-primary pull-right">Edit Project</button>
			{!! Form::close() !!}
			{!! Form::open(array('action' => 'ProjectsController@postDelete',  'class'=>'','role'=>"form")) !!}
			<input type="hidden" name="id" value="{{$all_projects->id}}">
			<button type="submit" class="btn btn-warning pull-right">Delete Project</button>
			{!! Form::close() !!}
		</div>
		
	</div>
@stop