
@extends($layout)
@section('stylesheets')
{!! Html::style('/assets/css/tasks/index.css') !!}
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
			<h3 class="panel-title">Tasks</h3>
		</div>
		<div class="panel-body">
			<ul id="nav-tasks" class="nav nav-tabs">
				<li role="presentation" class="active"><a href="#tasks-todo"><span class="badge" style="color: #d9534f">{{$tasks['count']['todo']}}</span> To Do</a></li>
				<li role="presentation" ><a href="#tasks-critical"><span class="badge" style="color: #d9534f">{{$tasks['count']['critical']}}</span> Critical Bugs</a></li>
				<li role="presentation"><a href="#tasks-system"><span class="badge" style="color: #d9534f">{{$tasks['count']['system']}}</span> System</a></li>
				<li role="presentation"><a href="#tasks-style"><span class="badge" style="color: #d9534f">{{$tasks['count']['style']}}</span> Style / UX</a></li>
				<li role="presentation"><a href="#tasks-improvements"><span class="badge" style="color: #d9534f">{{$tasks['count']['improvements']}}</span> Improvements</a></li>
				<li role="presentation"><a href="#tasks-inprocess"><span class="badge" style="color: #d9534f">{{$tasks['count']['inprocess']}}</span> In Process</a></li>
				<li role="presentation"><a href="#tasks-completed"><span class="badge" style="color: #d9534f">{{$tasks['count']['completed']}}</span> Completed</a></li>
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