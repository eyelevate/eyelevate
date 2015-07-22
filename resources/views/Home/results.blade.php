@extends($layout)
@section('stylesheets')
{!! Html::style('assets/css/home/results.css') !!}
@stop
@section('scripts')
<script src="assets/js/home/results.js"></script>
@stop

@section('content')
<div class="site-wrapper">
  <div class="container-fluid">
    <!-- LEFT BOX START -->
    <div class="col-md-9" id="left-box" target="false">
          <div class="container" id="left-box-inner">

        <div class="" id="preferences-frame">
            <div class="input-group " id="top-search-bar" >
              <input type="text" class="form-control" id="top-search-input" placeholder="Search for Categories">
              <span class="input-group-btn">
                <button class="btn btn-default " id="top-search-btn" type="button">
                  <i class="glyphicon glyphicon-search"> </i>
                </button>
              </span>
            </div><!-- /input-group -->
          </br>
            <ul class="" id="preferences">
              <li class="preferences-li"><a class="preferences-text ask-li">Ask a Question</a></li>
              <li class="preferences-li"><a class="preferences-text preferences-text-first">Newest</a></li>
              <li class="preferences-li"><a class="preferences-text">Active</a></li>
              <li class="preferences-li"><a class="preferences-text">Unanswered</a></li>
              <li class="preferences-li"><a class="preferences-text">Featured</a></li>
            </ul>
        </div>
        <div id="thread-group">
          <div class="thread-single">
            <div class="media">
              <div class="media-left">
                <a href="#">
                  <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="assets/images/blank_male.png" data-holder-rendered="true" style="width: 64px; height: 64px;">
                </a>
              </div>
              <div class="media-body">
                <div class="media-inner-left">
                  <h4 class="media-heading">My small business needs help</h4>
                  <div class="thread-info">Pedram kh . 
                    <span class="thread-date">1 hours ago</span>
                  </div> 
                </br>
                <div class="label-container">
                  <span class="label label-default">Business</span>
                  <span class="label label-default">Social</span>
                  <span class="label label-default">Politics</span>
                </div>
              </div>
              <div class="media-inner-right">
                <div class="right-text"><span class="reply-no"><i class="fa fa-eye-slash"></i></span></br><span class="reply-html">0</span></div>
              </div>
            </div>
          </div>
        </div>
        @for ($i = 1; $i < 5; $i++)
        <div class="thread-single">
          <div class="media">
            <div class="media-left">
              <a href="#">
                <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="assets/images/blank_male.png" data-holder-rendered="true" style="width: 64px; height: 64px;">
              </a>
            </div>
            <div class="media-body">
              <div class="media-inner-left">
                <h4 class="media-heading">My small business needs help</h4>
                <div class="thread-info">Pedram kh . 
                  <span class="thread-date">{{$i}} hours ago</span>
                </div> 
              </br>
              <div class="label-container">
                <span class="label label-default">Business</span>
                <span class="label label-default">Social</span>
                <span class="label label-default">Politics</span>
              </div>
            </div>
            <div class="media-inner-right">
              <div class="right-text"><span class="reply-no"><i class="fa fa-eye"></i></span></br><span class="reply-html">{{$i}}</span></div>
            </div>
          </div>
        </div>
      </div>
      @endfor
    </div>
  </div>
</div>
<!-- LEFT BOX END -->
<!-- RIGHT BOX START -->
<div class="col-md-3 " id="right-box"> 
  <a class="btn btn-primary btn-block" id="ask_q_btn">Ask a Question</a>
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
      <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
      <a href="#" class="list-group-item">Morbi leo risus</a>
      <a href="#" class="list-group-item">Porta ac consectetur ac</a>
      <a href="#" class="list-group-item">Vestibulum at eros</a>
      <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
      <a href="#" class="list-group-item">Morbi leo risus</a>
      <a href="#" class="list-group-item">Porta ac consectetur ac</a>
      <a href="#" class="list-group-item">Vestibulum at eros</a>
      <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
      <a href="#" class="list-group-item">Morbi leo risus</a>
      <a href="#" class="list-group-item">Porta ac consectetur ac</a>
      <a href="#" class="list-group-item">Vestibulum at eros</a>
      <a href="#" class="list-group-item">Porta ac consectetur ac</a>
      <a href="#" class="list-group-item">Vestibulum at eros</a>
      <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
      <a href="#" class="list-group-item">Morbi leo risus</a>
      <a href="#" class="list-group-item">Porta ac consectetur ac</a>
      <a href="#" class="list-group-item">Vestibulum at eros</a>
      <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
      <a href="#" class="list-group-item">Morbi leo risus</a>
      <a href="#" class="list-group-item">Porta ac consectetur ac</a>
      <a href="#" class="list-group-item">Vestibulum at eros</a>
      <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
      <a href="#" class="list-group-item">Morbi leo risus</a>
      <a href="#" class="list-group-item">Porta ac consectetur ac</a>
      <a href="#" class="list-group-item">Vestibulum at eros</a>
      <a href="#" class="list-group-item">Porta ac consectetur ac</a>
      <a href="#" class="list-group-item">Vestibulum at eros</a>
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
               name="comment[text]" id="comment_text" cols="40"
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
              <div class="alert alert-success alert-dark-1 alert-top-margin" role="alert">...</div>
              <hr>
              <span class="inner-title">Existing Questions:</span>
              <div class="alert alert-success alert-dark-2 alert-top-margin" role="alert">...</div>

              <hr>
            </div>
          </div>
          <!-- STEP 2 END -->

          <!-- STEP 3 -->
          <div class="step-3 step hide" step="3">
            <div class="left-modal-inner-3 col-sm-8">
              <div class="alert alert-success alert-dark-1 alert-top-margin" role="alert">...</div>
              <textarea placeholder="Title of your question"
               name="comment[text]" id="comment_text" cols="40"
                class="ui-autocomplete-input" autocomplete="off" role="textbox"
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

        </div>
        <div class="modal-footer clearfix ask-footer">
          <button type="button" class="btn btn-default pull-left back-btn">Back</button>
          <button type="button" class="btn btn-primary pull-right next-btn">Next</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

</div><!-- /.modal -->
@stop