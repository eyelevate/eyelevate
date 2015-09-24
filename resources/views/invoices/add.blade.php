@extends($layout)
@section('stylesheets')

@stop
@section('scripts')

@stop
@section('content')
	<div class="jumbotron">
		<h1>Add An Invoice</h1>
	</div>
	{!! Form::open(array('action' => 'InvoicesController@postAdd', 'class'=>'','role'=>"form")) !!}
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Invoice Details</h3>
		</div>
		<div class="panel-body">
	  		<div class="form-group {{ $errors->has('project_id') ? 'has-error' : false }}">
		    	<label class="control-label" for="role_id">Project</label>
		    	{!! Form::select('project_id', $projects, null ,array('class'=>'form-control')) !!}
		        @foreach($errors->get('project_id') as $message)
		            <span class='help-block'>{{ $message }}</span>
		        @endforeach
		  	</div>
		  	<div class="form-group {{ $errors->has('title') ? 'has-error' : false }}">
		    	<label class="control-label" for="title">Title</label>
		    	{!! Form::text('title', null, array('class'=>'form-control', 'placeholder'=>'Invoice title details')) !!}
		        @foreach($errors->get('title') as $message)
		            <span class='help-block'>{{ $message }}</span>
		        @endforeach
		  	</div>
		  	<div class="form-group {{ $errors->has('description') ? 'has-error' : false }}">
		    	<label class="control-label" for="description">Description</label>
		    	{!! Form::text('description', null, array('class'=>'form-control', 'placeholder'=>'Invoice description details')) !!}
		        @foreach($errors->get('title') as $message)
		            <span class='help-block'>{{ $message }}</span>
		        @endforeach
		  	</div>

		</div>
		<div class="panel-heading" style="border-top:1px solid #ddd; border-radius:0px;">
			<h3 class="panel-title">Invoice Item Details</h3>
		</div>		
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed">
					<thead>
						<tr>
							<th>Item</th>
							<th>Description</th>
							<th>Subtotal</th>
							<th>Tax</th>
							<th>Total</th>
							<th>Action</th>
						</tr>
					</thead>
				</table>

			</div>
		</div>
		<div class="panel-footer clearfix">
			<a href="{!! route('tasks_index') !!}" class="btn btn-default">Back</a>
			<input type="submit" class="btn btn-primary pull-right" value="Add Invoice"/>
		</div>
	</div>
	{!! Form::close() !!}

@stop