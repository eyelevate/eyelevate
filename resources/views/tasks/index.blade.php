
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
								<td>
									<a href="{!! route('tasks_view',[$todo->id]) !!}">View</a>
									@if($user_id == $todo->created_by)
									<a href="{!! route('tasks_edit',[$todo->id]) !!}" >Edit</a>
									@endif
								</td>
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
								<td>
									<a href="{!! route('tasks_view',[$critical->id]) !!}">View</a>
									@if($user_id == $critical->created_by)
									<a href="{!! route('tasks_edit',[$critical->id]) !!}" >Edit</a>
									@endif
								</td>
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
						@if(isset($tasks['system']))
							@foreach($tasks['system'] as $system)
							<tr>
								<td>{!! $system->id !!}</td>
								<td>{!! $system->title !!}</td>
								<td>{!! $system->description !!}</td>
								<td>{!! $system->created_username !!}</td>
								<td>{!! $system->assigned_username !!}</td>
								<td>{!! $system->status !!}</td>
								<td>{!! $system->created_date !!}</td>
								<td>
									<a href="{!! route('tasks_view',[$system->id]) !!}">View</a>
									@if($user_id == $system->created_by)
									<a href="{!! route('tasks_edit',[$system->id]) !!}" >Edit</a>
									@endif
								</td>
							</tr>
							@endforeach
						@endif
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
						@if(isset($tasks['style']))
							@foreach($tasks['style'] as $style)
							<tr>
								<td>{!! $style->id !!}</td>
								<td>{!! $style->title !!}</td>
								<td>{!! $style->description !!}</td>
								<td>{!! $style->created_username !!}</td>
								<td>{!! $style->assigned_username !!}</td>
								<td>{!! $style->status !!}</td>
								<td>{!! $style->created_date !!}</td>
								<td>
									<a href="{!! route('tasks_view',[$style->id]) !!}">View</a>
									@if($user_id == $style->created_by)
									<a href="{!! route('tasks_edit',[$style->id]) !!}" >Edit</a>
									@endif
								</td>
							</tr>
							@endforeach
						@endif
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