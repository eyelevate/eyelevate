@extends($layout)
@section('stylesheets')
{!! Html::style('/assets/css/general.css') !!}
{!! Html::style('/assets/css/home/results.css') !!}
@stop
@section('scripts')
<script src="/assets/js/login_modal.js"></script>
<script src="/assets/js/home/results.js"></script>
@stop
@section('content')
<div class="site-wrapper">
  <div class="container-fluid">
    <!-- LEFT BOX START -->
    <div class="col-md-9" id="left-box" target="false">
      <!-- Page Flash messages go here -->
      @include('flash::message')
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
          <li class="preferences-li"><a class="preferences-text ask-li ask_q_btn">Ask a Question</a></li>
          <li class="preferences-li op active-li"  this-pre="1"><a class="preferences-text preferences-text-first ">Newest</a></li>
          <li class="preferences-li op"  this-pre="2"><a class="preferences-text">Most Viewed</a></li>
          <li class="preferences-li op"  this-pre="3"><a class="preferences-text">Featured</a></li>
        </ul>
      </div>
      <div id="thread-group">
        {!! $threads !!}
      </div>
      <div class="pag pull-right">
      {!! $prepared_thread_clone->render() !!}
      </div>

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
          <a href="#" class="list-group-item cat-items" cat-id={{$sbkey}}>{{$sbvalue}}</a>
        @endforeach

      </div>
    </div>
  </div>
  <!-- RIGHT BOX END -->
</div>
</div>


{!! View::make('partials.login_modal') !!}

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