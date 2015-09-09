@extends($layout)
@section('stylesheets')
<!-- blueimp Gallery styles -->
<link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
{!! Html::style('packages/jQuery-File-Upload-9.11.2/css/jquery.fileupload.css') !!}
{!! Html::style('packages/jQuery-File-Upload-9.11.2/css/jquery.fileupload-ui.css') !!}
<noscript>{!! Html::style('packages/jQuery-File-Upload-9.11.2/css/jquery.fileupload-noscript.css') !!}</noscript>
<noscript>{!! Html::style('packages/jQuery-File-Upload-9.11.2/css/jquery.fileupload-ui-noscript.css') !!}</noscript>
{!! Html::style('/assets/css/tasks/view.css') !!}
@stop
@section('scripts')
<script src="/packages/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/assets/js/tasks/view.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- blueimp Gallery script -->
<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script type="text/javascript" src="/packages/jQuery-File-Upload-9.11.2/js/vendor/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/packages/jQuery-File-Upload-9.11.2/js/jquery.iframe-transport.js"></script>
<script type="text/javascript" src="/packages/jQuery-File-Upload-9.11.2/js/jquery.fileupload.js"></script>
<script type="text/javascript" src="/packages/jQuery-File-Upload-9.11.2/js/jquery.fileupload-process.js"></script>
<script type="text/javascript" src="/packages/jQuery-File-Upload-9.11.2/js/jquery.fileupload-image.js"></script>
<script type="text/javascript" src="/packages/jQuery-File-Upload-9.11.2/js/jquery.fileupload-audio.js"></script>
<script type="text/javascript" src="/packages/jQuery-File-Upload-9.11.2/js/jquery.fileupload-video.js"></script>
<script type="text/javascript" src="/packages/jQuery-File-Upload-9.11.2/js/jquery.fileupload-validate.js"></script>
<script type="text/javascript" src="/packages/jQuery-File-Upload-9.11.2/js/jquery.fileupload-jquery-ui.js"></script>
<script type="text/javascript" src="/packages/jQuery-File-Upload-9.11.2/js/jquery.fileupload-ui.js"></script>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>

        </td>
        <td>
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
	            <button type="button" class="btn btn-danger remove hide" imgSrc="">
	                <i class="glyphicon glyphicon-trash"></i>
	                <span>Delete</span>
	            </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
@stop

@section('content')
	{!! View::make('partials.task_image_modal') !!}
	<div class="jumbotron">
		<h1>View Task</h1>
	</div>
	{!! Form::open(array('action' => 'TasksController@postView', 'id'=>'fileupload', 'class'=>'form-horizontal','role'=>"form")) !!}
	{!! Form::hidden('task_id',$task->id) !!}
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Task Details</h3>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-2 control-label">Issue</label>
				<div class="col-sm-10">
					<p class="form-control-static">{!! $task->title !!}</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Description</label>
				<div class="col-sm-10">
					<div class="form-control-static">{!! $task->description !!}</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Created By</label>
				<div class="col-sm-10">
					<p class="form-control-static">{!! $task->created_by_username !!}</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Assigned To</label>
				<div class="col-sm-10">
					<p class="form-control-static">{!! $task->assigned_username !!}</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Project</label>
				<div class="col-sm-10">
					<p class="form-control-static">{!! $task->project_name !!}</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Status</label>
				<div class="col-sm-10">
					<p class="form-control-static">{!! $task->status !!}</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Created On</label>
				<div class="col-sm-10">
					<p class="form-control-static">{!! $task->created_date !!}</p>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">Images</label>
				<div class="col-sm-10">
					@if(isset($task->image_src))
						@foreach($task->image_src as $image_src)
						<div class="col-sm-6 col-md-4">
							<div class="thumbnail">
								<img class="image-url" style="max-height:140px; max-width:100%; " src="{!! $image_src->path !!}">
								<div class="caption">
									<button type="button" class="btn btn-default btn-sm view-image">View</button>
								</div>
							</div>
						</div>
						@endforeach
					@endif
					
				</div>
			</div>
		</div>
		<div class="panel-heading" style="border-top:1px solid #ddd; border-top-left-radius:0px; border-top-right-radius:0px;">
			<h3 class="panel-title">Task Comments</h3>
		</div>
		<ul class="list-group">
			@if(isset($task_comments))

				{!! $task_comments !!}

			@endif
			
		</ul>
		<div class="panel-body">
			<hr/>
		  	<div class="form-group {{ $errors->has('comment') ? 'has-error' : false }}">
		    	<label class="control-label" for="comment">Add Comment</label>
		    	{!! Form::textarea('comment', null, array('class'=>'form-control','id'=>'comment_textarea', 'placeholder'=>'Add comment here', 'rows'=>'3')) !!}
		        @foreach($errors->get('comment') as $message)
		            <span class='help-block'>{{ $message }}</span>
		        @endforeach
		  	</div>
  			<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
	        <div id="imageDiv" class="hide"></div>
	        <table id="displayImagesTable" role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
	        <div class="file-container">
		        <div class="fileupload-buttonbar">
		            <div class="col-lg-7">
		                <!-- The fileinput-button span is used to style the file input field as button -->
		                <span class="btn btn-success fileinput-button btn-sm">
		                    <i class="glyphicon glyphicon-plus"></i>
		                    <span>Add files...</span>
		                    <input type="file" name="files" multiple>
		                </span>
		                <button type="reset" class="btn btn-warning cancel btn-sm">
		                    <i class="glyphicon glyphicon-ban-circle"></i>
		                    <span>Cancel upload</span>
		                </button>
		                <input type="submit" class="btn btn-info btn-sm" value="Add Comment"/>
		                <!-- The global file processing state -->
		                <span class="fileupload-process"></span>
		            </div>
		        </div>		        	
	        </div>
	
		</div>
		<div class="panel-footer clearfix">
			<a href="{!! route('tasks_index') !!}" class="btn btn-default">Back</a>

			{!! Form::close() !!}
			<a id="task-completed"  class="btn btn-primary pull-right" >Task Completed</a>
			<a id="task-in-process" class="btn btn-info pull-right" >Task In-Process</a>
			{!! Form::open(array('action' => 'TasksController@postTaskCompleted', 'class'=>'form-horizontal competed-form','role'=>"form")) !!}
			{!! Form::hidden('task_id2',$task->id) !!}
			{!! Form::close() !!}
			{!! Form::open(array('action' => 'TasksController@postTaskInProcess', 'class'=>'form-horizontal in-process-form','role'=>"form")) !!}
			{!! Form::hidden('task_id3',$task->id) !!}
			{!! Form::close() !!}

		</div>
	</div>

	
@stop