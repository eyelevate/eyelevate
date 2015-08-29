
@extends($layout)
@section('stylesheets')

@stop
@section('scripts')
<script src="/assets/js/tasks/index.js"></script>
@stop

@section('content')
	<div class="jumbotron">
		<h1>Tasks</h1>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Panel title</h3>
		</div>
		<div class="panel-body">
			<ul id="nav-tasks" class="nav nav-tabs">
				<li role="presentation" class="active"><a href="#tasks-todo">To Do</a></li>
				<li role="presentation" ><a href="#tasks-critical">Critical Bugs</a></li>
				<li role="presentation"><a href="#tasks-system">System</a></li>
				<li role="presentation"><a href="#tasks-style">Style / UX</a></li>
				<li role="presentation"><a href="#tasks-completed">Completed</a></li>
			</ul>
			<div id="tasks-wrapper">
				<div id="tasks-todo" class="tasks-item table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Id</th>
								<th>Issue</th>
								<th>Description</th>
								<th>Creator</th>
								<th>Assigned</th>
								<th>Status</th>
								<th>Created</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@if(isset($tasks['todo']))
							@foreach($tasks['todo'] as $todo)
							<tr>
								<td>{!! $todo->id !!}</td>
								<td>{!! $todo->title !!}</td>
								<td>{!! $todo->description !!}</td>
								<td>{!! $todo->created_username !!}</td>
								<td>{!! $todo->assigned_username !!}</td>
								<td>{!! $todo->status !!}</td>
								<td>{!! $todo->created_date !!}</td>
								<td><a>View</a></td>
							</tr>
							@endforeach
						@endif
						</tbody>
					</table>
				</div>
				<div id="tasks-critical" class="tasks-item hide table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Id</th>
								<th>Issue</th>
								<th>Description</th>
								<th>Creator</th>
								<th>Assigned</th>
								<th>Status</th>
								<th>Created</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@if(isset($tasks['critical']))
							@foreach($tasks['critical'] as $critical)
							<tr>
								<td>{!! $critical->id !!}</td>
								<td>{!! $critical->title !!}</td>
								<td>{!! $critical->description !!}</td>
								<td>{!! $critical->created_username !!}</td>
								<td>{!! $critical->assigned_username !!}</td>
								<td>{!! $critical->status !!}</td>
								<td>{!! $critical->created_date !!}</td>
								<td><a>View</a></td>
							</tr>
							@endforeach
						@endif
						</tbody>
					</table>
				</div>
				<div id="tasks-system" class="tasks-item hide table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Id</th>
								<th>Issue</th>
								<th>Description</th>
								<th>Creator</th>
								<th>Assigned</th>
								<th>Status</th>
								<th>Created</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
				<div id="tasks-style" class="tasks-item hide table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Id</th>
								<th>Issue</th>
								<th>Description</th>
								<th>Creator</th>
								<th>Assigned</th>
								<th>Status</th>
								<th>Created</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
				<div id="tasks-completed" class="tasks-item hide table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>Id</th>
								<th>Issue</th>
								<th>Description</th>
								<th>Creator</th>
								<th>Assigned</th>
								<th>Status</th>
								<th>Created</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="panel-footer clearfix">
			<a href="{!! route('tasks_add') !!}" class="btn btn-primary pull-right">Add Task</a>
		</div>
	</div>
@stop