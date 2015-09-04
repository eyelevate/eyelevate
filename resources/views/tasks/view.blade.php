@extends($layout)
@section('stylesheets')
{!! Html::style('/assets/css/tasks/view.css') !!}
@stop
@section('scripts')
<script src="/packages/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/packages/ImageLightbox/imagelightbox.min.js"></script>
<script src="/assets/js/tasks/index.js"></script>

@section('content')
	<div class="jumbotron">
		<h1>View Task</h1>
	</div>
	{!! Form::open(array('action' => 'TasksController@postView', 'class'=>'form-horizontal','role'=>"form")) !!}
	{!! Form::hidden('task_id',$task->id) !!}
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Task Details</h3>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-2 control-label">Issue</label>
				<div class="col-sm-10">
					<p class="form-control-static">{!! $task->title !!}</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Description</label>
				<div class="col-sm-10">
					<p class="form-control-static">{!! $task->description !!}</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Created By</label>
				<div class="col-sm-10">
					<p class="form-control-static">{!! $task->created_by_username !!}</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Assigned To</label>
				<div class="col-sm-10">
					<p class="form-control-static">{!! $task->assigned_username !!}</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Status</label>
				<div class="col-sm-10">
					<p class="form-control-static">{!! $task->status !!}</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Created On</label>
				<div class="col-sm-10">
					<p class="form-control-static">{!! $task->created_date !!}</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Images</label>
				<div class="col-sm-10">
					@if(isset($task->image_src))
						@foreach($task->image_src as $image_src)
						<div class="col-sm-6 col-md-4">
							<div class="thumbnail">
								<img style="max-height:140px; max-width:100%;" src="{!! $image_src->path !!}">
								<div class="caption">
									
									<button type="button" class="viewImage btn btn-default btn-sm">View</button>
								</div>
							</div>
						</div>
						@endforeach
					@endif
					
				</div>
			</div>
		</div>
		<div class="panel-heading" style="border-top:1px solid #ddd; border-top-left-radius:0px; border-top-right-radius:0px;">
			<h3 class="panel-title">Task Comments</h3>
		</div>
		<ul class="list-group">
			@if(isset($task_comments))

				{!! $task_comments !!}

			@endif
			
		</ul>
		<div class="panel-body">
			<hr/>
		  	<div class="form-group {{ $errors->has('comment') ? 'has-error' : false }}">
		    	<label class="control-label" for="comment">Add Comment</label>
		    	{!! Form::textarea('comment', null, array('class'=>'form-control','id'=>'comment_textarea', 'placeholder'=>'Add comment here', 'rows'=>'3')) !!}
		        @foreach($errors->get('comment') as $message)
		            <span class='help-block'>{{ $message }}</span>
		        @endforeach
		  	</div>		
		</div>
		<div class="panel-footer clearfix">
			<a href="{!! route('tasks_index') !!}" class="btn btn-default">Back</a>
			<input type="submit" class="btn btn-primary pull-right" value="Add Comment"/>
		</div>
	</div>
	{!! Form::close() !!}
@stop