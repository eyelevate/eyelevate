
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
				<li role="presentation"><a href="#tasks-improvements">Improvements</a></li>
				<li role="presentation"><a href="#tasks-inprocess">In Process</a></li>
				<li role="presentation"><a href="#tasks-completed">Completed</a></li>
			</ul>
			<div id="tasks-wrapper">
			{!! 
				View::make('partials.tasks.task_index')
					->with('type','todo')
					->with('user_id',$user_id)
					->with('hide','')
					->with('tasks',$tasks['todo'])
                    ->__toString()
            !!}
            {!! 
				View::make('partials.tasks.task_index')
					->with('type','critical')
					->with('user_id',$user_id)
					->with('hide','hide')
					->with('tasks',$tasks['critical'])
                    ->__toString()
            !!}
            {!! 
				View::make('partials.tasks.task_index')
					->with('type','system')
					->with('user_id',$user_id)
					->with('hide','hide')
					->with('tasks',$tasks['system'])
                    ->__toString()
            !!}
            {!! 
				View::make('partials.tasks.task_index')
					->with('type','style')
					->with('user_id',$user_id)
					->with('hide','hide')
					->with('tasks',$tasks['style'])
                    ->__toString()
            !!}
            {!! 
				View::make('partials.tasks.task_index')
					->with('type','improvements')
					->with('user_id',$user_id)
					->with('hide','hide')
					->with('tasks',$tasks['improvements'])
                    ->__toString()
            !!}
            {!! 
				View::make('partials.tasks.task_index')
					->with('type','inprocess')
					->with('user_id',$user_id)
					->with('hide','hide')
					->with('tasks',$tasks['inprocess'])
                    ->__toString()
            !!}
            {!! 
				View::make('partials.tasks.task_index')
					->with('type','completed')
					->with('user_id',$user_id)
					->with('hide','hide')
					->with('tasks',$tasks['completed'])
                    ->__toString()
			!!}

			</div>
		</div>
		<div class="panel-footer clearfix">
			<a href="{!! route('tasks_add') !!}" class="btn btn-primary pull-right">Add Task</a>
		</div>
	</div>
@stop