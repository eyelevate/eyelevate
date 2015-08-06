@extends($layout)
@section('stylesheets')
{!! Html::style('/assets/css/threads/view.css') !!}
{!! Html::style('/assets/css/login_modal.css') !!}
@stop
@section('scripts')
<script src="/assets/js/login_modal.js"></script>
<script src="/assets/js/threads/view.js"></script>
@stop

@section('content')
<div class="outer">
  <div class="container-fluid">
    <div class="col-md-3 inner" id="new-left-box" style="height:100% !important;">
      <div class="list-group left-box-inner" id="tread-side-group">
        <div class="list-group list-group-container">
          <a href="#" class="list-group-item active " id="list-search-bar">
            <div class="clearfix" id="left-top-container" state="0">
              <div class="col-md-3" id="top-left-side">
                <i class="glyphicon glyphicon-triangle-left" id="left-arrow"></i>
              </div>
              <div class="col-md-9" id="top-left-sidee">
                <div class="input-group" >
                  <div id="quote-text-wrapp" class="quote-btnn" state="0">
                    <span id="quote-text">Quote</span><span id="user-name"> Pedram</span>
                  </div>
                  <span class="input-group-btn">
                    <button class="btn btn-default quote-btnn"  id="quote-btn" type="button" state="0">
                      <i class="fa fa-quote-left"></i>
                      &nbsp<i class="fa fa-quote-right"></i>
                    </button>
                  </span>
                </div><!-- /input-group --> 
              </div>
            </div>
          </a>
          <div id="quote-textarea" class="hide">
            <textarea placeholder="type somthing ..."
            id="quote_text" cols="40"
            class="ui-autocomplete-input" autocomplete="off" role="textbox"
            aria-autocomplete="list" aria-haspopup="true"></textarea>   
            <div class="quote-footer">
              <a class="btn btn-primary pull-left quote-cancel">Cancel</a>
              <a class="btn btn-primary pull-right quote-quote" id="quote-reply-btn" this-reply="" this-thread="{{$threads->id}}">Reply</a>
            </div>
          </div>
          <div id="loading-container">
            
            <img id="loading-icons-1" height="30px" width="30px" class="hide" src="/assets/images/icons/gif/loading1.gif" alt="">

          </div>
            <div id="quote-container">

            </div>

        </div>
      </div>
    </div>



    <!-- RIGHT BOX START -->

    <div class="col-md-9 right-box" id="zoom" target="false">
      <!-- DUMMY DATA START -->
      <div class="container" id="right-box-inner">

        <div id="thread-group">

          {!!$threads_html!!}

          <!-- THREAD SINGLE END -->
        </div>
        <!-- THREAD GROUP END -->
        <div class="" id="add-answer">
          <h4 id="add-answer-title">Add an Answer</h4>
          <div class="media">
            <div class="media-left">
              <a href="#">
                <img class="media-object right-box-inner" data-src="holder.js/64x64" alt="64x64" src="/assets/images/profile-images/perm/{{$this_user_profile_image}}" data-holder-rendered="true" style="width: 64px; height: 64px;">
              </a>
            </div>
            <div class="media-body">
              <textarea placeholder="Your Answer..."
              id="answer_text" cols="40"
              class="ui-autocomplete-input add-answer-textarea" autocomplete="off" role="textbox"
              aria-autocomplete="list" aria-haspopup="true"></textarea> 
            </div>
          </div>
          <a class="btn btn-primary " id="post-answer" this-thread="{{$threads->id}}">Post Answer</a>
        </div>

      </div>
      <!-- DUMMY DATA END -->
    </div>
    <!-- RIGHT BOX START -->
  </div>
</div>


{!! View::make('partials.login_modal') !!}
@stop