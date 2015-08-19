@extends($layout)
@section('stylesheets')

@stop
@section('scripts')

@stop

@section('content')
<div class="panel panel-default">
  <div class="panel-body">
<table class="table table-bordered" style="font-size:18px">
      <thead>
        <tr>
          <th>Thread Id</th>
          <th>Reply Id</th>
          <th>Title</th>
          <th>Flag Count</th>
          <th>Flag Status</th>
          <th>Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($flags as $flag)
        <tr>
          <th scope="row">{{$flag['thread_id']}}</th>
          <td>{{$flag['reply_id']}}</td>
          <td>{{$flag['title']}}</td>
          <td>{{$flag['count']}}</td>
          <td>{!!$flag['status']!!}</td>
          <td>{{$flag['created_at']}}</td>
          <td>
            <a href="{!! route('flag_view',$flag['payload']['id']) !!}">View</a>
            |
            <a href="">Delete all</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="panel-footer clearfix">
      <a class="btn btn-primary" href="{!! route('flags_index') !!}"> View Flagged </a>
      <a class="btn btn-primary" href="{!! route('flags_app') !!}"> View Approved </a>
      <a class="btn btn-primary" href="{!! route('flags_rej') !!}"> View Rejected </a>
      <a class="btn btn-primary" href="{!! route('flags_re') !!}"> View Re-Flagged </a>
      <a class="btn btn-primary" href="{!! route('flags_f_app') !!}"> View Final Approved </a>
      <a class="btn btn-primary" href="{!! route('flags_f_rej') !!}"> View Final Rejected </a>
      <a class="btn btn-primary" href="{!! route('flags_banned') !!}"> View Banned </a>
  </div>
</div>
@stop