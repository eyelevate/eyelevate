@extends($layout)
@section('stylesheets')
{!! Html::style('/assets/css/threads/view.css') !!}
@stop
@section('scripts')
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



              <div class="col-md-9" id="top-right-side">
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
            id="comment_text" cols="40"
            class="ui-autocomplete-input" autocomplete="off" role="textbox"
            aria-autocomplete="list" aria-haspopup="true"></textarea>   
            <div class="quote-footer">
              <a class="btn btn-primary pull-left quote-cancel">Cancel</a>
              <a class="btn btn-primary pull-right quote-quote">Reply</a>
            </div>
          </div>
          <a  class="list-group-item right-data" expended="0">
            <span class="message-header">
              <span class="message-sender" id="">Pedram kh</span> <span class="quote-details">— Wednesday, July 15, 2015, 03:25 PM</span>
            </br></span>
            <span class="message-body">
              <span class="btn btn-primary view-quote">view</span>
              197  4
              Cras sit amet nibh libero, in gravida nulla. Nulla vel metusscelerisque
              ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at,
              tempus viverra turpis.Fusce condimentum nunc ac nisi vulputate fringi
              lla. Donec lacinia congue felis in faucibus.
              <span class="more fa fa-expand"></span> 
            </span>
          </a>
          <a  class="list-group-item right-data" expended="0">
            <span class="message-header">
              <span class="message-sender" id="">Pedram kh</span> <span class="quote-details">— Wednesday, July 15, 2015, 03:25 PM</span>
            </br></span>
            <span class="message-body">
              <span class="btn btn-primary view-quote" thread-id="">view</span>
              197  4
              Cras sit amet nibh libero, in gravida nulla. Nulla vel metusscelerisque
              ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at,
              tempus viverra turpis.Fusce condimentum nunc ac nisi vulputate fringi
              lla. Donec lacinia congue felis in faucibus.
              <span class="more fa fa-expand"></span> 
            </span>
          </a>



        </div>
      </div>
    </div>



    <!-- RIGHT BOX START -->

    <div class="col-md-9 right-box" id="zoom" target="false">
      <!-- DUMMY DATA START -->
      <div class="container" id="right-box-inner">

        <div id="thread-group">


          <div class="thread-single " id="main-thread">
            <div class="media">
              <div class="media-left">
                <a href="#">
                  <img class="media-object media-image" data-src="holder.js/64x64" alt="64x64" src="/assets/images/profile-images/perm/1438229768-i.jpeg" data-holder-rendered="true" style="width: 64px; height: 64px;">
                </a>
              </div>
              <div class="media-body">
                <div class="media-inner-left">
                  <div class="thread-info">Pedram 
                    <span class="thread-date">1 hour ago</span>
                  </div> 
                  <h4 ><a href="/threads/view/'.$davalue->id.'">I need help with my business</a></h4>
                </br>
                <div class="thread-description">
                  <p>I'm working on the song array challenge in the iOS track and am having trouble getting it to work proper.  I'm getting a notification that says string:string is not convertible to int, which I understand what it means, but unsure how to fix it since I can't designate the array as a string.</p>
                  <p>import UIKit</p>
                  <p>let songOne = ["Title": "Summer Highland Falls", "Artist": "Billy Joel", "Album": "Turnstiles"]
                    let songTwo = ["Title": "Angry Young Man", "Artist": "Billy Joel", "Album": "Turnstiles"]
                    let songThree = ["Title": "Zanzibar", "Artist": "Billy Joel", "Album": "52nd Street"]
                    let songFour = ["Title": "Vienna", "Artist": "Billy Joel", "Album": "The Stranger"]
                    let songFive = ["Title": "All for Leyna", "Artist": "Billy Joel", "Album": "Glass Houses"]
                    let songSix = ["Title": "I Don't Want to Be Alone", "Artist": "Billy Joel", "Album": "Glass Houses"]
                    let songSeven = ["Title": "Sleeping with the Televsion On", "Artist": "Billy Joel", "Album": "Glass Houses"]
                    let songEight = ["Title": "Piano Man", "Artist": "Billy Joel", "Album": "The Essential Billy Joel"]
                    let songNine = ["Title": "An Innocent Man", "Artist": "Billy Joel", "Album": "The Essential Billy Joel"]
                    let songTen = ["Title": "A Matter Of Trust", "Artist": "Billy Joel", "Album": "The Essential Billy Joel"]</p>
                    <p>var songArray = [songOne, songTwo, songThree, songFour, songFive, songSix, songSeven, songEight, songNine, songTen]</p>
                    <p>songArray [songOne]</p>
                  </div>
                  <div class="label-container">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="thread-single">
            <div class="media">
              <div class="media-left">
                <a href="#">
                  <img class="media-object media-image" data-src="holder.js/64x64" alt="64x64" src="/assets/images/profile-images/perm/1438229768-i.jpeg" data-holder-rendered="true" style="width: 64px; height: 64px;">
                </a>
              </div>
              <div class="media-body">
                <div class="media-inner-left">
                  <div class="thread-info">Pedram 
                    <span class="thread-date">1 hour ago</span>
                  </div> 
                  <h4 ><a href="/threads/view/'.$davalue->id.'">I need help with my business</a></h4>
                </br>
                <div class="thread-description">
                  <p>I'm working on the song array challenge in the iOS track and am having trouble getting it to work proper.  I'm getting a notification that says string:string is not convertible to int, which I understand what it means, but unsure how to fix it since I can't designate the array as a string.</p>
                  <p>import UIKit</p>
                  </div>
                  <div class="label-container">
                  </div>
                </div>
                <div class="media-inner-right">
                  <div class="right-text btn btn-primary show-quote">Quoted 2 times</div>
                </div>
              </div>
            </div>
          </div>
          <!-- THREAD SINGLE END -->
        </div>
        <!-- THREAD GROUP END -->
        <div class="" id="add-answer">
          <h4 id="add-answer-title">Add an Answer</h4>
          <div class="media">
            <div class="media-left">
              <a href="#">
                <img class="media-object right-box-inner" data-src="holder.js/64x64" alt="64x64" src="/assets/images/profile-images/perm/1438154195-F.jpg" data-holder-rendered="true" style="width: 64px; height: 64px;">
              </a>
            </div>
            <div class="media-body">
              <textarea placeholder="Your Answer..."
              id="comment_text" cols="40"
              class="ui-autocomplete-input add-answer-textarea" autocomplete="off" role="textbox"
              aria-autocomplete="list" aria-haspopup="true"></textarea> 
            </div>
          </div>
          <a class="btn btn-primary " id="post-answer">Post Answer</a>
        </div>

      </div>
      <!-- DUMMY DATA END -->
    </div>
    <!-- RIGHT BOX START -->
  </div>
</div>



@stop