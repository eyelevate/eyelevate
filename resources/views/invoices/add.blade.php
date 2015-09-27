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
			<div class="row-fluid clearfix">
			  	<div class="form-group {{ $errors->has('invoice_item.title') ? 'has-error' : false }}">
			    	<label class="control-label" for="title">Summary</label>
			    	{!! Form::text('invoice_item.title', null, array('class'=>'form-control', 'placeholder'=>'Invoice Item Summary')) !!}
			        @foreach($errors->get('invoice_item.title') as $message)
			            <span class='help-block'>{{ $message }}</span>
			        @endforeach
			  	</div>	
			  	<div class="form-group {{ $errors->has('invoice_item.description') ? 'has-error' : false }}">
			    	<label class="control-label" for="title">Short Description</label>
			    	{!! Form::text('invoice_item.description', null, array('class'=>'form-control', 'placeholder'=>'Invoice Item Description')) !!}
			        @foreach($errors->get('invoice_item.description') as $message)
			            <span class='help-block'>{{ $message }}</span>
			        @endforeach
			  	</div>	
			  	<div class="form-group {{ $errors->has('invoice_item.quantity') ? 'has-error' : false }}">
			    	<label class="control-label" for="invoice_item.quantity">Quantity</label>
			    	{!! Form::text('invoice_item.quantity', null, array('class'=>'form-control', 'placeholder'=>'Quantity')) !!}
			        @foreach($errors->get('invoice_item.quantity') as $message)
			            <span class='help-block'>{{ $message }}</span>
			        @endforeach
			  	</div>
			  	<div class="form-group {{ $errors->has('invoice_item.subtotal') ? 'has-error' : false }}">
			    	<label class="control-label" for="invoice_item.subtotal">Subtotal</label>
			    	{!! Form::text('invoice_item.subtotal', null, array('class'=>'form-control', 'placeholder'=>'Sutbtotal')) !!}
			        @foreach($errors->get('invoice_item.subtotal') as $message)
			            <span class='help-block'>{{ $message }}</span>
			        @endforeach
			  	</div>		
		  		<div class="form-group {{ $errors->has('invoice_item.tax') ? 'has-error' : false }}">
			    	<label class="control-label" for="role_id">Tax</label>
			    	{!! Form::select('invoice_item.tax', $projects, null ,array('class'=>'form-control')) !!}
			        @foreach($errors->get('invoice_item.tax') as $message)
			            <span class='help-block'>{{ $message }}</span>
			        @endforeach
			  	</div>	
			</div>
			<div class="row-fluid clearfix">
				<button type="button" class="btn btn-info">Add Invoice Item</button>
			</div>
			
		</div>
		<div class="panel-heading" style="border-top:1px solid #ddd; border-radius:0px;">
			<h3 class="panel-title">Invoice Summary</h3>
		</div>		
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover table-condensed">
					<thead>
						<tr>
							<th>Item</th>
							<th>Description</th>
							<th>Quantity</th>
							<th>Subtotal</th>
							<th>Tax</th>
							<th>Total</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr class="hide">
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>
								<button type="button" class="btn btn-sm btn-danger">Remove</button>
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr style="">
							<th colspan="5" style="border-bottom:none;"></th>
							<th style="text-align:right;">Total Subtotal</th>
							<th></th>
						</tr>
						<tr>
							<th colspan="5"></th>
							<th style="text-align:right;">Total Tax</th>
							<th></th>
						</tr>
						<tr>
							<th colspan="5"></th>
							<th style="text-align:right;">Total Due</th>
							<th></th>
						</tr>
					</tfoot>
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