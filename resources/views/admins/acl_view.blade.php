@extends($layout)
@section('stylesheets')

@stop
@section('scripts')

@stop

@section('content')
<div class="jumbotron">
	<h1>Access Control List</h1>
</div>
<div class="container">
  <h2>Permissions</h2>
  <ul class="list-group">
    <a class="list-group-item" href="/admins/permissions/add">Add</a>
    <a class="list-group-item">Edit*</a>
    <a class="list-group-item">View*</a>
  </ul>
	<hr>
    <h2>Permission Roles</h2>
  <ul class="list-group">
    <a class="list-group-item" href="/admins/permission-roles/add">Add</a>
    <a class="list-group-item">Edit*</a>
    <a class="list-group-item">View*</a>
  </ul>
  <hr>
    <h2>Roles</h2>
  <ul class="list-group">
    <a class="list-group-item" href="/admins/roles/add">Add</a>
    <a class="list-group-item">Edit*</a>
    <a class="list-group-item">View*</a>
  </ul>
</div>
@stop