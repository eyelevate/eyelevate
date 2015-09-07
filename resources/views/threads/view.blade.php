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


@if($status_prepared == 2)
<style>
  #panel-data {
    height: calc(100% - 50px) !important;
  }
</style>
@endif



<div class="outer max-height">
  <div class="container-fluid max-height">



      <div class="col-md-3 col-sm-3 col-xs-3 inner swipeable-both max-height" id="new-left-box" this-reply="" this-thread="{{$threads->id}}" state="0">
        <div id="panel-wrapper" class="panel panel-default">
          <div class="panel-heading" id="panel-head">
            <h4>Quotes</h4>
            <div id="quote-image-wrapper">
              <img id="quote-title-btn"  class="" src="/assets/images/icons/swipe_left.png" alt="">
            </div>
          </div>
          <div id="panel-data" class="panel-body">
            <div class="list-group" id="thread-side-group">
              <div id="quote-container">
              </div>
              <div id="loading-container">
                <img id="loading-icons-1" height="30px" width="30px" class="hide" src="/assets/images/icons/gif/loading1.gif" alt="">
              </div>
            </div>
          </div>
          @if($status_prepared != 2)
            <div id="panel-footer-sidebar" class="panel-footer object-fixed-for-keyboard clearfix">
              <textarea placeholder="add response here ..."
              id="quote_text" cols="1"
              class="ui-autocomplete-input editor col-lg-12" autocomplete="off" role="textbox"
              aria-autocomplete="list" aria-haspopup="true"></textarea>   
              <div id="panel-footer-sidebar-inner-wrapper" class="cleafix">
                <div class="btn-group btn-group-md col-md-12 col-sm-12 col-xs-12" role="group" id="btn-group-quote">
                  <button type="button" class="btn btn-info col-md-6 col-sm-6 col-xs-6" id="btn-preview">Preview</button>
                  <button type="button" class="btn btn-success col-md-6 col-sm-6 col-xs-6 " id="btn-send">Send</button>
                </div>
              </div>
            </div>
           @endif
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
          <!-- IF THREAD WASNT CANCELED -->
          @if($status_prepared != 2)
          <div class="" id="add-answer">
            <h4 id="add-answer-title">Add an Answer</h4>
            <div class="media">
              <div id="right-side-media" class="media-left">
                <a href="#">
                  <img class="media-object img-border" data-src="holder.js/64x64" alt="64x64" src="/assets/images/profile-images/perm/{{$this_user_profile_image}}" data-holder-rendered="true" style="width: 64px; height: 64px;">
                </a>
              </div>

              @if(isset($session_data))
               @if(isset($session_data['post_answer']))
                <div class="media-body">
                  <textarea id="answer_text">{!!$session_data['post_answer']!!}</textarea> 
                  <span class="bootstrap-error hide" id="answer-empty">&nbspAnswer field cannot be empty</span>
                </div>
               @endif
              @else
                <div class="media-body">
                  <textarea id="answer_text"></textarea> 
                  <span class="bootstrap-error hide" id="answer-empty">&nbspAnswer field cannot be empty</span>
                </div>                           
              @endif




            </div>
            <div class="row-fluid clearfix">
              <a class="btn btn-primary pull-right" id="post-answer" this-thread="{{$threads->id}}">Post Answer</a>
              <a class="btn btn-info pull-right" id="preview-btn-thread" style="color:white">Preview</a>
            </div>
          </div>
          @endif
        </div>
        <!-- THREAD GROUP END -->
      </div>
      <!-- DUMMY DATA END -->
    </div>
    <!-- RIGHT BOX START -->
  </div>
</div>


<input type="hidden" id="phone_detector">
{!! View::make('partials.setting_modal')
->with('thread_id',$threads->id)
->with('selects',$selects)
->with('status_prepared',$status_prepared)
->with('checked',$checked)
->__toString() !!}
{!! View::make('partials.login_modal') !!}
{!! View::make('partials.flag_modal') !!}
{!! View::make('partials.flag_remove_modal') !!}
{!! View::make('partials.message_preview_modal') !!}
@stop