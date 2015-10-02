@extends($layout)
@section('stylesheets')

@stop
@section('scripts')

@stop

@section('content')
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Tax Index</h3>
  </div>
  <div class="panel-body">
    <div class="table-responsive">
      <table class="table table-bordered" style="font-size:18px">
            <thead>
              <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Country</th>
                <th>Rate</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($taxes as $tax)
                <tr>
                  <td scope="row">{!! $tax->title !!}</td>
                  <td>{!! $tax->description !!}</td>
                  <td>{!! $tax->country !!}</td>
                  <td>{!! $tax->rate !!}</td>
                  <td>{!! $tax->status_message !!}</td>
                  <td>{!! $tax->created_at_html !!}</td>
                  <td>
                    <a href="{!! route('taxes_edit',$tax->id) !!}">Edit</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
  </div>
  <div class="panel-footer clearfix">
      <a class="btn btn-primary pull-right" href="{!! route('taxes_add') !!}"> Add Tax</a>
  </div>
</div>
@stop