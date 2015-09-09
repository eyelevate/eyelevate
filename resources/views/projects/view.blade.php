
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
		<div class="panel-heading">
			<h3 class="panel-title">Create a Projects</h3>
		</div>
		<div class="panel-body">
				<div class="form-group {{ $errors->has('title') ? 'has-error' : false }}">
			    	<label class="control-label" for="title">Title: </label>&nbsp&nbsp&nbsp{{$all_projects->title}}
			  	</div>

			  	<div class="form-group {{ $errors->has('description') ? 'has-error' : false }}">
			    	<label class="control-label" for="description">Details: </label>&nbsp&nbsp&nbsp{{$all_projects->description}}
			  	</div>
		  		<div class="form-group {{ $errors->has('type') ? 'has-error' : false }}">
			    	<label class="control-label" for="role_id">Project Type: </label> &nbsp&nbsp&nbsp{{$all_projects->type}}
			  	</div>
		  		<div class="form-group {{ $errors->has('type') ? 'has-error' : false }}">
			    	<label class="control-label" for="role_id">Created at: </label> &nbsp&nbsp&nbsp{{$all_projects->created_ats}}
			  	</div>
		</div>
		<div class="panel-footer clearfix">
			<a href="{!! route('projects_index') !!}" class="btn btn-primary pull-right">Back to Index</a>
		</div>

	</div>
@stop