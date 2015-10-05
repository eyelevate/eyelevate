@extends($layout)
@section('stylesheets')

@stop
@section('scripts')

@stop

@section('content')
<div class="jumbotron">
  <div class="container">
	<h1>Invoices</h1>
	<p>Search for all your invoices here</p>    
	<a href="{{ route('invoices_add') }}" class="btn btn-lg btn-primary">Add Invoice</a>
  </div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Invoice Query</h3>
	</div>
	<div class="panel-body">
	    <div class="form-group {{ $errors->has('query') ? 'has-error' : false }}">
	      <label class="control-label" for="query">Search Query</label>
	      {!! Form::text('query', null, array('class'=>'form-control', 'placeholder'=>'Search Query')) !!}
	        @foreach($errors->get('query') as $message)
	            <span class='help-block'>{{ $message }}</span>
	        @endforeach
	    </div>		
		<div class="form-group">
			<div class="radio">
				<label>
					<input type="radio" name="by_query"  value="id" checked> 
					Search by invoice id.
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="by_query" value="project"> 
					Search by project name.
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="by_query" value="title"> 
					Search by title.
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="by_query" value="description"> 
					Search by description.
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="by_query" value="country"> 
					Search by country.
				</label>
			</div>
		</div>
		<button type="button" class="btn btn-info">Search</button>
	</div>

	<div class="panel-heading clearfix" style="border-top:1px solid #ddd; border-radius:0px;">
		<h3 class="panel-title">Invoice Results</h3>
	</div>	
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table table-bordered" style="font-size:18px">
				<thead>
				<tr>
					<th>Invoice</th>
					<th>Project</th>
					<th>Title</th>
					<th>Description</th>
					<th>Country</th>
					<th>Due</th>
					<th>Status</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
				</thead>
			<tbody>

			</tbody>
			</table>
		</div>
	</div>
	<div class="panel-heading clearfix" style="border-top:1px solid #ddd; border-radius:0px;">
		<a class="btn btn-default" href="{!! route('invoices_index') !!}"> Back</a>
		<a class="btn btn-primary pull-right" href="{!! route('invoices_add') !!}"> Add Invoice</a>
	</div>		
</div>
@stop