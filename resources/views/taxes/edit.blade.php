@extends($layout)
@section('stylesheets')

@stop
@section('scripts')
  <script type="text/javascript" src="/assets/js/taxes/add.js"></script>
  <script type="text/javascript" src="/packages/numeric/jquery.numeric.js"></script>
@stop

@section('content')
<div class="jumbotron">
  <h1>Taxes Add</h1>
</div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Edit Tax</h3>
  </div>
  <div class="panel-body">
  {!! Form::open(array('action' => 'TaxesController@postEdit', 'class'=>'','role'=>"form")) !!}
    {!! Form::hidden('id',$taxes->id) !!}
    <div class="form-group {{ $errors->has('title') ? 'has-error' : false }}">
      <label class="control-label" for="title">Title</label>
      {!! Form::text('title', $taxes['title'], array('class'=>'form-control', 'placeholder'=>'Title')) !!}
        @foreach($errors->get('title') as $message)
            <span class='help-block'>{{ $message }}</span>
        @endforeach
    </div>

    <div class="form-group {{ $errors->has('description') ? 'has-error' : false }}">
      <label class="control-label" for="description">Description</label>
      {!! Form::text('description', $taxes['description'], array('class'=>'form-control', 'placeholder'=>'Description')) !!}
        @foreach($errors->get('description') as $message)
            <span class='help-block'>{{ $message }}</span>
        @endforeach
    </div>

    <div class="form-group {{ $errors->has('country') ? 'has-error' : false }}">
      <label class="control-label" for="kr_cities">Country</label>
      {!! Form::select('country',$country_code ,$taxes->country, ['class'=>'form-control','status'=>false]) !!}
        @foreach($errors->get('country') as $message)
            <span class='help-block'>{{ $message }}</span>
        @endforeach
    </div>

    <div class="form-group {{ $errors->has('rate') ? 'has-error' : false }}">
      <label class="control-label" >Rate</label>
      <div class="input-group">
        <input type="text" value="{{ $taxes->rate }}" name="rate" class="form-control" id="rate" placeholder="Amount">
        <div class="input-group-addon"><span id="rateSpan">{{ ($taxes->rate * 100) }}</span>%</div>
      </div>
        @foreach($errors->get('rate') as $message)
            <span class='help-block'>{{ $message }}</span>
        @endforeach
    </div>

    <div class="form-group {{ $errors->has('status') ? 'has-error' : false }}">
      <label class="control-label" for="kr_cities">Status</label>
      {!! Form::select('status',$status ,$taxes['status'], ['class'=>'form-control','status'=>false]) !!}
        @foreach($errors->get('status') as $message)
            <span class='help-block'>{{ $message }}</span>
        @endforeach
    </div>
 

  </div>
  <div class="panel-footer clearfix">
    <button class="btn btn-primary pull-right">Edit</button>
  </div>

    {!! Form::close() !!}
</div>
@stop