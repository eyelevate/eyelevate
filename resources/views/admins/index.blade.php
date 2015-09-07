@extends($layout)
@section('stylesheets')

@stop
@section('scripts')

@stop

@section('content')
	<div class="jumbotron">
		<h1>Welcome</h1>
	</div>

	@if(isset($message))
		<div class="alert alert-success" role="alert">
	      <strong>Well done!</strong> {!! $message !!}
	    </div>
	@endif
	<div class=" col-md-4 col-sm-6 col-xs-12">
		<div class="panel panel-default" style="margin: 0;">
			<div class="panel-heading">Flag Notification</div>
			<div class="panel-body">
				<span style="background-color:#d9534f" class="badge">{{$all_flag_count}}</span></a> Pendding Flags
			</div>
			<div class="panel-footer clearfix">
				<a href="{!! route('flags_index') !!}" class='btn btn-primary btn-sm pull-right'> View </a>
			</div>
		</div>
	</div>
	<div class=" col-md-4 col-sm-6 col-xs-12">
		<div class="panel panel-default" style="margin: 0;">
			<div class="panel-heading">Task Notification</div>
			<div class="panel-body">
				<span style="background-color:#d9534f" class="badge">{{$all_tasks_count}}</span></a> Pendding Tasks
			</div>
			<div class="panel-footer clearfix">
				<a href="{!! route('tasks_index') !!}" class='btn btn-primary btn-sm pull-right'> View </a>
			</div>
		</div>
	</div>
	<div class=" col-md-4 col-sm-6 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">Flag Notification</div>
			<div class="panel-body">
				Basic panel example
			</div>
			<div class="panel-footer clearfix">
				<button class='btn btn-primary btn-sm pull-right'> View </button>
			</div>
		</div>
	</div>
	<div class=" col-md-4 col-sm-6 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">Flag Notification</div>
			<div class="panel-body">
				Basic panel example
			</div>
			<div class="panel-footer clearfix">
				<button class='btn btn-primary btn-sm pull-right'> View </button>
			</div>
		</div>
	</div>
	<div class=" col-md-4 col-sm-6 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">Flag Notification</div>
			<div class="panel-body">
				Basic panel example
			</div>
			<div class="panel-footer clearfix">
				<button class='btn btn-primary btn-sm pull-right'> View </button>
			</div>
		</div>
	</div>
	<div class=" col-md-4 col-sm-6 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">Flag Notification</div>
			<div class="panel-body">
				Basic panel example
			</div>
			<div class="panel-footer clearfix">
				<button class='btn btn-primary btn-sm pull-right'> View </button>
			</div>
		</div>
	</div>

@stop