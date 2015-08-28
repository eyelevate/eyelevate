@extends($layout)
@section('stylesheets')
{!! Html::style('/assets/css/tinymce.css') !!}
{!! Html::style('/assets/css/threads/view.css') !!}
{!! Html::style('/assets/css/login_modal.css') !!}
@stop
@section('scripts')
<script src="/packages/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/assets/js/login_modal.js"></script>
<script src="/assets/js/threads/view.js"></script>
@stop

@section('content')
<div class="outer max-height">
  <div class="container-fluid max-height">







    <div class="col-md-3 col-sm-3 col-xs-3 inner swipeable-both max-height" id="new-left-box" this-reply="" this-thread="{{$threads->id}}" state="0">
      <div class="panel panel-default" id="panel-wrapper">
        <div class="panel-heading" id="panel-head">

          <h4 style="text-align:center;">Quotes</h4>
            <div id="quote-image-wrapper">
              <img id="quote-title-btn"  class="" src="/assets/images/icons/swipe_left.png" alt="">
            </div>
        </div>
        <div class="panel-body" id="panel-data">
        <div class="list-group" id="tread-side-group">
          <div id="quote-container">
          </div>
          <div id="loading-container">
            <img id="loading-icons-1" height="30px" width="30px" class="hide" src="/assets/images/icons/gif/loading1.gif" alt="">
          </div>
        </div>
      </div>
        <div id="quote-textarea" class="hide">
          <textarea placeholder="type somthing ..."
          id="quote_text" cols="40"
          class="ui-autocomplete-input editor" autocomplete="off" role="textbox"
          aria-autocomplete="list" aria-haspopup="true"></textarea>   
        </div>
      <button type="button" class="btn btn-primary btn-block quote-btnn panel-foot" state="0">Message</button>
      <div class="btn-group btn-group-md col-md-12 col-sm-12 col-xs-12 panel-foot  hide" role="group" id="btn-group-quote">
        <button type="button" class="btn btn-danger col-md-6 col-sm-6 col-xs-6 panel-foot" id="btn-cancel">Cancel</button>
        <button type="button" class="btn btn-success col-md-6 col-sm-6 col-xs-6 panel-foot" id="btn-send">Send</button>
      </div>
    </div> 
  </div>


  <!-- RIGHT BOX START -->
  <div class="col-md-9 right-box swipeable-both max-height" id="zoom" target="false">
    <!-- DUMMY DATA START -->
    <div class="container" id="right-box-inner">
      <div id="swipe-left">
      </div>
      <div id="thread-group">

        {!!$threads_html!!}

        <!-- THREAD SINGLE END -->

        <div class="" id="add-answer">
          <h4 id="add-answer-title">Add an Answer</h4>
          <div class="media">
            <div class="media-left">
              <a href="#">
                <img class="media-object right-box-inner" data-src="holder.js/64x64" alt="64x64" src="/assets/images/profile-images/perm/{{$this_user_profile_image}}" data-holder-rendered="true" style="width: 64px; height: 64px;">
              </a>
            </div>
            <div class="media-body">
              <textarea
              id="answer_text"
              ></textarea> 
            </div>
          </div>
          <a class="btn btn-primary " id="post-answer" this-thread="{{$threads->id}}">Post Answer</a>
        </div>

      </div>
      <!-- THREAD GROUP END -->

    </div>
    <!-- DUMMY DATA END -->
  </div>






  <!-- RIGHT BOX START -->
</div>
</div>



{!! View::make('partials.setting_modal')->with('checked',$checked)->__toString() !!}
{!! View::make('partials.login_modal') !!}
{!! View::make('partials.flag_modal') !!}
{!! View::make('partials.flag_remove_modal') !!}
@stop