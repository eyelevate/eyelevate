@extends($layout)
@section('stylesheets')

@stop
@section('scripts')
@stop

@section('content')
	<div class="jumbotron">
		<h1>Edit A Task</h1>
	</div>
	{!! Form::open(array('action' => 'TasksController@postEdit', 'class'=>'','role'=>"form")) !!}
	{!! Form::hidden('id',$tasks->id) !!}
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Update A Task</h3>
		</div>
		<div class="panel-body">
		  	<div class="form-group {{ $errors->has('title') ? 'has-error' : false }}">
		    	<label class="control-label" for="title">Issue</label>
		    	{!! Form::text('title', $tasks->title, array('class'=>'form-control', 'placeholder'=>'Issue details')) !!}
		        @foreach($errors->get('title') as $message)
		            <span class='help-block'>{{ $message }}</span>
		        @endforeach
		  	</div>

		  	<div class="form-group {{ $errors->has('description') ? 'has-error' : false }}">
		    	<label class="control-label" for="description">Details</label>
		    	{!! Form::textarea('description', $tasks->description, array('class'=>'form-control', 'placeholder'=>'Description details', 'rows'=>'3')) !!}
		        @foreach($errors->get('description') as $message)
		            <span class='help-block'>{{ $message }}</span>
		        @endforeach
		  	</div>
	  		<div class="form-group {{ $errors->has('type') ? 'has-error' : false }}">
		    	<label class="control-label" for="role_id">Task Type</label>
		    	{!! Form::select('type', $types, $tasks->type ,array('class'=>'form-control')) !!}
		        @foreach($errors->get('type') as $message)
		            <span class='help-block'>{{ $message }}</span>
		        @endforeach
		  	</div>
		  	<div class="form-group {{ $errors->has('assigned_id') ? 'has-error' : false }}">
		    	<label class="control-label" for="assigned_id">Assign To</label>
		    	{!! Form::select('assigned_id', $admins, $tasks->assigned_id ,array('class'=>'form-control')) !!}
		        @foreach($errors->get('type') as $message)
		            <span class='help-block'>{{ $message }}</span>
		        @endforeach
		  	</div>
		</div>
		<div class="panel-heading" style="border-top:1px solid #ddd; border-top-left-radius:0px; border-top-right-radius:0px;">
			<h3 class="panel-title">Manage Images</h3>
		</div>
		<div class="panel-body">
			<div class="col-lg-12 col-md-12">
				@if(isset($tasks->image_src))
					@foreach(json_decode($tasks->image_src) as $image_src)
					<div class="col-sm-6 col-md-4">
						<div class="thumbnail">
							<img style="max-height:10px; max-width:100%;" src="{!! $image_src->path !!}">
							<div class="caption clearfix">
								<button type="button" class="viewImage btn btn-default btn-sm pull-right">View</button>
								<button type="button" class="removeImage btn btn-danger btn-sm">Delete</button>
							</div>
						</div>
					</div>
					@endforeach
				@endif
			</div>
		</div>
		<div class="panel-footer clearfix">
			<a href="{!! route('tasks_index') !!}" class="btn btn-default">Back</a>
			<input type="submit" class="btn btn-primary pull-right" value="Edit Task"/>
		</div>
	</div>
	{!! Form::close() !!}
@stop