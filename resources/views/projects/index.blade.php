
@extends($layout)
@section('stylesheets')
{!! Html::style('/assets/css/projects/index.css') !!}
@stop
@section('scripts')
<script src="/assets/js/projects/index.js"></script>
@stop

@section('content')
	<div class="jumbotron">
		<h1>Projects</h1>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Projects</h3>
		</div>
		<div class="panel-body">

			<div id="projects-wrapper">

					<table class="table">
						<thead>
							<tr>
								<th>Id</th>
								<th>Title</th>
								<th>Description</th>
								<th>Status</th>
								<th>Created</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@if(isset($all_projects))
							@foreach($all_projects as $t)
							<tr>
								<td>{!! $t->id !!}</td>
								<td>{!! $t->title !!}</td>
								<td>{!! $t->description !!}</td>
								<td>{!! $t->status !!}</td>
								<td>{!! $t->created_ats !!}</td>
								<td>
									<a href="{!! route('projects_view',[$t->id]) !!}">View</a>
									/
									<a href="{!! route('projects_edit',[$t->id]) !!}">Edit</a>
								</td>
							</tr>
							@endforeach
						@endif
						</tbody>
					</table>
				</div>

		</div>
		<div class="panel-footer clearfix">
			<a href="{!! route('projects_add') !!}" class="btn btn-primary pull-right">Add Project</a>
		</div>
	</div>
@stop