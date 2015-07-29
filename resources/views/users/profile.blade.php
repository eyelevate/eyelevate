@extends($layout)
@section('stylesheets')
{!! Html::style('assets/css/users/profile.css') !!}
@stop
@section('scripts')
<script src="/assets/js/users/profile.js"></script>
@stop

@section('content')
<div class="site-wrapper">
  <div class="container-fluid">
    <!-- LEFT BOX START -->
    <div class="col-md-9" id="left-box" target="false">
      <div class="container" id="left-box-inner">
          <form class="form-horizontal" action="users/profile" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group ind-box">
              <label for="inputEmail3" class="col-sm-2 control-label">Photo</label>
              <div class="col-sm-8 pull-right">
                  <a href="#">
                    <img class="media-object profile-picture" data-src="holder.js/64x64" alt="64x64" src="/assets/images/profile-images/perm/{{$profile_image}}" data-holder-rendered="true" style="width: 64px; height: 64px;">
                  </a>
                  <div class="file-container"> 
                      <span class="file-wrapper">
                        <input type="file" id="form-submit-btn" />
                        <span class="button" id="sub-btn">Choose File</span>
                      </span>
                      <span id="saved" class="hide" style="color:#5cb85c;">&nbsp&nbsp&nbsp&nbsp<i class="glyphicon glyphicon-ok-sign" style="padding-right: 4px;"></i>Saved</span>
                      <span id="somthing-wrong" class="hide" style="color:#d9534f">&nbsp&nbsp&nbsp&nbsp<i class="glyphicon glyphicon-remove-sign" style="padding-right: 4px;"></i>Somthing went wrong</span>
                  </div>

              </div>
            </div>
            <hr>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">First Name</label>
              <div class="col-sm-8 pull-right">
                <input type="text" name="fname" class="form-control" id="inputEmail3" placeholder="First name" value="{{$fname}}">
              </div>
            </div>
            <hr>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Last Name</label>
              <div class="col-sm-8 pull-right">
                <input type="text" name="lname" class="form-control" id="inputEmail3" placeholder="Last Name" value="{{$lname}}">
              </div>
            </div>
            <hr>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-8 pull-right">
                <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email" value="{{$email}}" disabled="disabled">
              </div>
            </div>
            <button type="submits" class="btn btn-primary pull-right">Save</button>
          </form>

      </div>
  </div>
  <!-- LEFT BOX END -->
  <!-- RIGHT BOX START -->
  <div class="col-md-3 " id="right-box"> 
    <a class="btn btn-primary btn-block ask_q_btn">Ask a Question</a>
    <div class="" id="right-box-inner">

      <div class="list-group list-group-container">
        <a href="#" class="list-group-item active " id="list-search-bar">
          <div class="input-group" >
            <input type="text" class="form-control" id="list-search-input" placeholder="Search for Categories">
            <span class="input-group-btn">
              <button class="btn btn-default " id="list-search-btn" type="button"><i class="glyphicon glyphicon-search">  </i></button>
            </span>
          </div><!-- /input-group -->
        </a>
        @foreach($categories_for_side as $sbkey => $sbvalue)
          <a href="#" class="list-group-item" cat-id={{$sbkey}}>{{$sbvalue}}</a>
        @endforeach

      </div>
    </div>
  </div>
  <!-- RIGHT BOX END -->
</div>
</div>


<div class="modal fade" id="myModal">
  {!! Form::open(array('action' => 'UsersController@postLogin', 'class'=>'','role'=>"form",'id'=>'login-form')) !!}
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Login</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <input type="text" class="form-control form-control-login" name="username" id="username" placeholder="Username" aria-describedby="sizing-addon2">
        </div>
        <div class="form-group">
          <input type="password" class="form-control form-control-login" name="password" id="password" placeholder="Password" aria-describedby="sizing-addon2">     
        </div>
      </div>
      <div class="modal-footer clearfix">
        <div id="forgot-wrapper pull-left">
          <a id="forgot"> I forgot my password</a>
        </div>
        <button type="button" class="btn btn-primary pull-right login-btn">Login</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  {!! Form::close() !!}
</div><!-- /.modal -->

<div class="modal fade" id="ask_modal">
  {!! Form::open(array('action' => 'ThreadsController@postAdd', 'class'=>'','role'=>"form",'id'=>'question_add')) !!}
  <div class="modal-dialog ask-dialog">
    <div class="modal-content" style="padding: 20px;">
      <div class="modal-header ask-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Your Question</h4>
      </div>
      <div class="modal-body">
        <!-- STEP 1 -->
        <div class="step-1 step" step="1" state="active">
          <div class="left-modal-inner col-sm-8">
            <textarea placeholder="Title of your question"
            id="comment_text" cols="40"
            class="ui-autocomplete-input" autocomplete="off" role="textbox"
            aria-autocomplete="list" aria-haspopup="true"></textarea>
          </div>
          <div class="right-modal-inner col-sm-4">
            <span>Did you search first to make sure your question is unique?</span>
          </div>
        </div>
        <!-- STEP 1 END -->

        <!-- STEP 2 -->
        <div class="step-2 step hide" step="2">
          <div class="model-inner-2 col-sm-12">
            <span class="inner-title">You Asked:</span>
            <div class="alert alert-success alert-dark-1 alert-top-margin" id="you-asked" role="alert"></div>
            <hr>
            <span class="inner-title">Existing Questions:</span>
            <div class="alert alert-success alert-dark-2 alert-top-margin existing-query" role="alert">
            </div>
            <hr>
          </div>
        </div>
        <!-- STEP 2 END -->

        <!-- STEP 3 -->
        <div class="step-3 step hide" step="3">
          <div class="left-modal-inner-3 col-sm-8">
            <textarea placeholder="Title of your question"
            name="question[title]" id="question-title"
            class="ui-autocomplete-input textarea-title" autocomplete="off" role="textbox"
            aria-autocomplete="list" aria-haspopup="true"></textarea>

            <textarea placeholder="Description of your question"
            name="question[description]" id="question-description" cols="40"
            class="ui-autocomplete-input textarea-description" autocomplete="off" role="textbox"
            aria-autocomplete="list" aria-haspopup="true"></textarea>
          </div>
          <div class="right-modal-inner-3 col-sm-4">
            <div class="module secondary-module">
              <div class="secondary-heading">
                <h4>Notifications</h4>
              </div>
              <ul class="options-list">
                <li class="options-list-item"> 
                  <input checked="checked" id="notify-me" name="notify-me" type="checkbox" value="1" class="placeholder-processed">
                  <label for="notify-me" class="notify-me">Email me when someone replies to this discussion</label>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- STEP 3 END -->

        <!-- STEP 4 -->
        <div class="step-4 step hide" step="4">
          <div class="form-group padding-categories">
            <span class="custom-dropdown custom-dropdown--white">
              <select class="custom-dropdown__select custom-dropdown__select--white">
                @foreach($categories_for_select as $ckey => $category)
                  <option value={{$ckey}}>{!!$category!!}</option>
                @endforeach
              </select>
            </span>
          </div>
          <span id="duplicate-error" class="hide">Category has been selected!</span>
          <div class="cat-wrapper col-md-12"> 
            <h3 id="h3-wrapper">

            </h3>
          </div>
        </div>
        <!-- STEP 4 END -->

      </div>
      <div class="modal-footer clearfix ask-footer">
        <button type="button" class="btn btn-default pull-left back-btn hide">Back</button>
        <button type="button" id="nxt-btn" class="btn btn-primary pull-right next-btn">Next</button>
        <button type="button" id="qst-submit" class="btn btn-primary pull-right next-btn hide">Submit</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  {!! Form::close() !!}
</div><!-- /.modal -->
@stop