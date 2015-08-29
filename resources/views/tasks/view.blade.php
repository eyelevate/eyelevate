@extends($layout)
@section('stylesheets')

@stop
@section('scripts')
<script src="/assets/js/tasks/index.js"></script>
@stop

@section('content')
	<div class="jumbotron">
		<h1>View Task</h1>
	</div>
	{!! Form::open(array('action' => 'TasksController@postView', 'class'=>'form-horizontal','role'=>"form")) !!}
	{!! Form::hidden('id',$task->id) !!}
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
					<p class="form-control-static">{!! $task->created_by !!}</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Assigned To</label>
				<div class="col-sm-10">
					<p class="form-control-static">{!! $task->assigned_id !!}</p>
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
					<p class="form-control-static">{!! $task->created_at !!}</p>
				</div>
			</div>
		</div>
		<div class="panel-heading" style="border-top:1px solid #ddd; border-top-left-radius:0px; border-top-right-radius:0px;">
			<h3 class="panel-title">Task Comments</h3>
		</div>
		<div class="panel-body">
		</div>
		<div class="panel-footer clearfix">
			<a href="{!! route('tasks_index') !!}" class="btn btn-default">Back</a>
			<input type="submit" class="btn btn-primary pull-right" value="Update Task"/>
		</div>
	</div>
	{!! Form::close() !!}
@stop