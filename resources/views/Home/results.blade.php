@extends($layout)
@section('stylesheets')
{!! Html::style('/assets/css/general.css') !!}
{!! Html::style('/assets/css/tinymce.css') !!}
{!! Html::style('/assets/css/question_modal.css') !!}
{!! Html::style('assets/css/login_modal.css') !!}
{!! Html::style('/assets/css/home/results.css') !!}

@stop
@section('scripts')
<script src="/assets/js/login_modal.js"></script>
<script src="/packages/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="/assets/js/home/results.js"></script>
<script src="/assets/js/question_modal.js"></script>
@stop
@section('content')
<div class="site-wrapper max-height">
  <div class="container-fluid max-height">
    <!-- LEFT BOX START -->
    <div class="col-md-9 max-height" id="left-box" target="false">
      <!-- Page Flash messages go here -->
      <div class="container" id="left-box-inner">
        <div class="" id="preferences-frame">
          <div class="input-group " id="top-search-bar" >
            <input type="text" class="form-control inpage-search" id="top-search-input" placeholder="Search for ...">
            <span class="input-group-btn">
              <button class="btn btn-default inpage-search-btn" id="top-search-btn" type="button">
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
      <!-- EARCH RESULTS -->
        {!! $searched_results_html !!}
      <!-- ALL THREADS -->
        {!! $threads !!}
      </div>
      <div class="page pull-right">
      {!! $prepared_thread_clone->render() !!}
      </div>

    </div>
  </div>
  <!-- LEFT BOX END -->
  <!-- RIGHT BOX START -->
  <div class="col-md-3 max-height" id="right-box"> 
    <a class="btn btn-primary btn-block ask_q_btn">Ask a Question</a>
    <div class="" id="right-box-inner">

      <div class="list-group list-group-container">
          <div class="input-group" >
            <input type="text" class="form-control inpage-search" id="list-search-input" placeholder="Search for ...">
            <span class="input-group-btn">
              <button class="btn btn-default inpage-search-btn" id="list-search-btn" type="button">
                <i class="glyphicon glyphicon-search">  </i>
              </button>
            </span>
          </div><!-- /input-group -->
        <a href="" class="list-group-item active " id="list-search-bar">

        </a>
        @foreach($categories_for_side as $sbkey => $sbvalue)
          <a  class="list-group-item cat-items" cat-id={{$sbkey}}>{{$sbvalue}}</a>
        @endforeach

      </div>
    </div>
  </div>
  <!-- RIGHT BOX END -->
</div>
</div>

{!! View::make('partials.login_modal') !!}

{!! View::make('partials.question_modal')
                  ->with('categories_for_select',$categories_for_select)
                    ->__toString()
 !!}

@stop