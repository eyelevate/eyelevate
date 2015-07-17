@extends($layout)
@section('stylesheets')

@stop
@section('scripts')
<script src="assets/js/thread_view.js"></script>
@stop

@section('content')
<div class="outer">
  <div class="container-fluid">
    <div class="col-md-12 left-box" id="zoom" target="false">
      <!-- DUMMY DATA START -->
    <div  id="tread-title-container">
      <i class="glyphicon glyphicon-menu-left pull-left" id="back-arrow"><span class="back-title">Back</span></i>
    </div>

      <div class="bs-example" data-example-id="default-media">
        <!-- TEST 2 -->
        <div class="top-media-padding media-group ">
          <div class="media">
            <div class="media-left">
              <a href="#">
                <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="assets/images/blank_male.png" data-holder-rendered="true" style="width: 64px; height: 64px;">
              </a>
            </div>
            <div class="media-body">
              <div class="dialogbox-container">
                <div class="dialogbox">
                  <div class="body clearfix">
                    <!-- HEADING -->
                    <h4 class="media-heading  clearfix">Pedram kh 1
                      <span class="dash-separator">—</span>
                      <span class="heading-date">Wednesday, July 15, 2015, 03:25 PM <i class="flags fa fa-flag popbutton flag-desktop" data-placement="top" data-container="body"></i></span> 

                      <span class="thumb-group ">
                        <span class="reply-text"><a   class="reply-text-a">Reply</a></span>
                        <span class="dot-separator">.</span>
                        <span class="thumb-set">
                          <i class="thumbs-icon thumb-up glyphicon glyphicon-thumbs-up"></i>
                          <span class="thumbs-text">197</span>
                        </span>
                        <span class="thumb-set">
                          <i class="thumbs-icon thumb-down glyphicon glyphicon-thumbs-down"></i>
                          <span class="thumbs-text ">4</span>
                        </span>
                      </span>

                    </h4>
                    <span class="tip tip-left"></span>
                    <div class="message media-text pull-left " >
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                  </div>
                </div>
                <!-- REPLY BOX -->
                <div class="reply-box clearfix">

                  
                </div>


              </div>

              <!-- CHILD MEDIA -->
              <div class="media-child">
                <div class="media media-reply">
                  <div class="media-left">
                    <a href="#">
                      <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="assets/images/blank_male.png" data-holder-rendered="true" style="width: 64px; height: 64px;">
                    </a>
                  </div>
                  <div class="media-body">
                    <div class="dialogbox-container">
                      <div class="dialogbox">
                        <div class="body clearfix">
                          <!-- HEADING -->
                          <h4 class="media-heading">Pedram kh 
                            <span class="dash-separator">—</span>
                            <span class="heading-date">Wednesday, July 15, 2015, 03:25 PM <i class="flags fa fa-flag popbutton flag-desktop" data-placement="top" data-container="body"></i></span> 
                            <span class="thumb-group ">
                              <span class="thumb-set">
                                <i class="thumbs-icon thumb-up glyphicon glyphicon-thumbs-up"></i>
                                <span class="thumbs-text">197</span>
                              </span>
                              <span class="thumb-set">
                                <i class="thumbs-icon thumb-down glyphicon glyphicon-thumbs-down"></i>
                                <span class="thumbs-text ">4</span>
                              </span>
                            </span>
                          </h4>
                          <span class="tip tip-left"></span>
                          <div class="message media-text pull-left " >
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                          </div>
                        </div>
                      </div>
                      <!-- REPLY BOX -->
                      <div class="reply-box"></div>
                    </div>
                  </div>
                </div>
                <div class="media media-reply">
                  <div class="media-left">
                    <a href="#">
                      <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="assets/images/blank_male.png" data-holder-rendered="true" style="width: 64px; height: 64px;">
                    </a>
                  </div>
                  <div class="media-body">
                    <div class="dialogbox-container">
                      <div class="dialogbox">
                        <div class="body clearfix">
                          <!-- HEADING -->
                          <h4 class="media-heading">Pedram kh 
                            <span class="dash-separator">—</span>
                            <span class="heading-date">Wednesday, July 15, 2015, 03:25 PM <i class="flags fa fa-flag popbutton flag-desktop" data-placement="top" data-container="body"></i></span> 
                            
                            <span class="thumb-group ">
                              <span class="thumb-set">
                                <i class="thumbs-icon thumb-up glyphicon glyphicon-thumbs-up"></i>
                                <span class="thumbs-text">197</span>
                              </span>
                              <span class="thumb-set">
                                <i class="thumbs-icon thumb-down glyphicon glyphicon-thumbs-down"></i>
                                <span class="thumbs-text ">4</span>
                              </span>
                            </span>
                          </h4>
                          <span class="tip tip-left"></span>
                          <div class="message media-text pull-left " >
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                          </div>
                        </div>
                      </div>

                      <!-- REPLY BOX -->
                      <div class="reply-box"></div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- CHILD MEDIA END -->
            </div>
            <!-- MEDIA-BODY END -->
          </div>

          <div class="more-wrapper text-center">
              <span class="more-text">12 Replies View More</span></br>
              <i class="fa fa-angle-double-down more-text"></i>
          </div>

        </div>

        <!-- MEDIA GROUP END -->


        <!-- TEST 2 -->
                <!-- TEST 2 -->
        <div class="media-group ">
          <div class="media">
            <div class="media-left">
              <a href="#">
                <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="assets/images/blank_male.png" data-holder-rendered="true" style="width: 64px; height: 64px;">
              </a>
            </div>
            <div class="media-body">
              <div class="dialogbox-container">
                <div class="dialogbox">
                  <div class="body clearfix">
                    <!-- HEADING -->
                    <h4 class="media-heading  clearfix">Pedram kh 1
                      <span class="dash-separator">—</span>
                      <span class="heading-date">Wednesday, July 15, 2015, 03:25 PM <i class="flags fa fa-flag popbutton flag-desktop" data-placement="top" data-container="body"></i></span> 
                      <span class="thumb-group ">
                        <span class="reply-text"><a   class="reply-text-a">Reply</a></span>
                        <span class="dot-separator">.</span>
                        <span class="thumb-set">
                          <i class="thumbs-icon thumb-up glyphicon glyphicon-thumbs-up"></i>
                          <span class="thumbs-text">197</span>
                        </span>
                        <span class="thumb-set">
                          <i class="thumbs-icon thumb-down glyphicon glyphicon-thumbs-down"></i>
                          <span class="thumbs-text ">4</span>
                        </span>
                      </span>

                    </h4>
                    <span class="tip tip-left"></span>
                    <div class="message media-text pull-left " >
                      Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                    </div>
                  </div>
                </div>
                <!-- REPLY BOX -->
                <div class="reply-box clearfix">

                  
                </div>


              </div>

              <!-- CHILD MEDIA -->
              <div class="media-child">
                <div class="media media-reply">
                  <div class="media-left">
                    <a href="#">
                      <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="assets/images/blank_male.png" data-holder-rendered="true" style="width: 64px; height: 64px;">
                    </a>
                  </div>
                  <div class="media-body">
                    <div class="dialogbox-container">
                      <div class="dialogbox">
                        <div class="body clearfix">
                          <!-- HEADING -->
                          <h4 class="media-heading">Pedram kh 
                            <span class="dash-separator">—</span>
                            <span class="heading-date">Wednesday, July 15, 2015, 03:25 PM <i class="flags fa fa-flag popbutton flag-desktop" data-placement="top" data-container="body"></i></span> 
                            <span class="thumb-group ">
                              <span class="thumb-set">
                                <i class="thumbs-icon thumb-up glyphicon glyphicon-thumbs-up"></i>
                                <span class="thumbs-text">197</span>
                              </span>
                              <span class="thumb-set">
                                <i class="thumbs-icon thumb-down glyphicon glyphicon-thumbs-down"></i>
                                <span class="thumbs-text ">4</span>
                              </span>
                            </span>
                          </h4>
                          <span class="tip tip-left"></span>
                          <div class="message media-text pull-left " >
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                          </div>
                        </div>
                      </div>
                      <!-- REPLY BOX -->
                      <div class="reply-box"></div>
                    </div>
                  </div>
                </div>
                <div class="media media-reply">
                  <div class="media-left">
                    <a href="#">
                      <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="assets/images/blank_male.png" data-holder-rendered="true" style="width: 64px; height: 64px;">
                    </a>
                  </div>
                  <div class="media-body">
                    <div class="dialogbox-container">
                      <div class="dialogbox">
                        <div class="body clearfix">
                          <!-- HEADING -->
                          <h4 class="media-heading">Pedram kh 
                            <span class="dash-separator">—</span>
                            <span class="heading-date">Wednesday, July 15, 2015, 03:25 PM <i class="flags fa fa-flag popbutton flag-desktop" data-placement="top" data-container="body"></i></span> 
                            <span class="thumb-group ">
                              <span class="thumb-set">
                                <i class="thumbs-icon thumb-up glyphicon glyphicon-thumbs-up"></i>
                                <span class="thumbs-text">197</span>
                              </span>
                              <span class="thumb-set">
                                <i class="thumbs-icon thumb-down glyphicon glyphicon-thumbs-down"></i>
                                <span class="thumbs-text ">4</span>
                              </span>
                            </span>
                          </h4>
                          <span class="tip tip-left"></span>
                          <div class="message media-text pull-left " >
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                          </div>
                        </div>
                      </div>

                      <!-- REPLY BOX -->
                      <div class="reply-box"></div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- CHILD MEDIA END -->
            </div>
            <!-- MEDIA-BODY END -->
          </div>

          <div class="more-wrapper text-center">
              <span class="more-text">12 Replies View More</span></br>
              <i class="fa fa-angle-double-down more-text"></i>
          </div>

        </div>
        <!-- MEDIA GROUP END -->
      </div>
      <!-- BS FINISHED -->
      <!-- DUMMY DATA END -->
    </div>
  </div>
</div>

<style>

#zoom{
 width: 100%;
 -webkit-transition: width 1s;
 -moz-transition: width 1s;
 -o-transition: width 1s;
 transition: width 1s;
}

.left-box{
  /*border:1px solid red;*/
  min-height: 700px;
  padding-left: 0;
  padding-right: 0;
}

body,html{
  color:black;
}
.list-group-item:first-child {
  border-top-right-radius: 0px;
  border-top-left-radius: 0px;
}

#tread-title{
  margin-top: 10px;
  margin-bottom: 10px;
  font-size: 27px;
  font: 19px/29px "Gotham Rounded A", "Gotham Rounded B", "Helvetica Neue", Helvetica, Arial, sans-serif;
  
  color: rgb(75, 75, 75);
}
#back-arrow{
  font-size: 20px;
  padding-top: 9px;
  color: #8d9aa5;
  padding-left: 10px;
  cursor: pointer;
}
.back-title{
font-size: 27px;
  color: #8d9aa5;
  padding-left: 3px;
}
#tread-title-container{
  position: fixed;
  right: 0;
   top: 0; 
  text-align: center;
  height: 50px;
  z-index: 100;
  margin-top: 0px;
  background-color: #edeff0;
  width: 100%;
  box-shadow: 0px 1px 9px #9D9B9B;
  
}
#tread-side-title{
  height: 55px;
  border-bottom: 1px solid gray;
}
#tread-side-group{
  overflow: hidden;
}


.container-fluid {
  padding-right: 0;
  padding-left: 0;
}
.media-box {
  background: #fff;
  padding: 15px 20px 15px 25px;
  border: 1px solid #ddd;d
  border-radius: 3px;
  font-size: 16px;
  line-height: 1.6;
  margin-right: -12px;
  color: rgb(10, 10, 10);
}
.outer{
  background-color: #fff;

}
.dash-separator{
  color: #807676;
  margin: 0 8px;
}
.heading-date{
  font-size: 0.8em;
  color: #807676;
  letter-spacing: 0.6px;
}
.media-text {
  padding-top: 10px;
}

.thumb-up {
  cursor: pointer;
}
.thumb-down {
  cursor: pointer;
}

.flags {
  cursor: pointer;
  margin-left: 10px;
}

.thumbs-text {
  background: #FFFFFF;
  padding: 0px 3px 3px 3px;
  border: 1px solid #E6E6E6;
  border-radius: 3px;
}
.thumbs-icon{
  font-size: 16px;
}
.thumb-set{
  margin-left:5px;
  margin-right: 5px;
  vertical-align: top;
}

/*TEST*/
.tip {
  width: 0px;
  height: 0px;
  position: absolute;
  background: transparent;
  border: 10px solid #FFF;
}

.tip-left {
  top: 10px;
  left: -20px;
  border-top-color: transparent;
  border-left-color: transparent;
  border-bottom-color: transparent;
}

.dialogbox .body {
  position: relative;
  /* max-width: 300px; */
  height: auto;
  margin-left: 9px;
  background: #fff;
  padding: 15px 11px 20px 25px;
  border: 1px solid #ddd;
  border-radius: 3px;
  font-size: 16px;
  line-height: 1.6;

}
.body .message {
  font-size: 16px;
  line-height: 1.6;
  color: rgb(10, 10, 10);
}
.reply-text{
  color: #555;
  cursor: pointer;
  font-size: 11px;
  font-weight: bold;
  opacity: .75;
  /*  vertical-align: top;*/
}
.reply-text-a:hover{
  color: black;
  text-decoration: none;
}
a{
  color: #555;
}
.spam-popup{
  cursor: pointer;
  white-space: nowrap;
  list-style-type:none;
  margin-left: 5px;
  margin-right: 5px;
  background:#fff;
  color: black;
  padding:3px;
  border:none;
}
.spam-popup:hover{
  white-space: nowrap;
  list-style-type:none;
  background:rgb(28, 27, 27);
  color: white;
  border:1px gray solid;
}

.popover-content {
  padding: 9px 0px;
}
.popover{
  padding:0;

}
.top-media-padding{
  margin-top: 75px !important;
}
/*MEDIA*/
.media-group{
  border-top: 1px solid rgb(219, 219, 219);;
  border-bottom: 1px solid rgb(219, 219, 219);
  margin-top: 30px;
  margin-bottom: 25px;
  padding: 15px;
  background-color: #edeff0;

}
.media {
 margin-top: 0; 
}
.media-child{

}
.media-reply{
  padding-top: 10px;
}

.right-box{
  overflow: auto;
  /*border:1px solid red;*/

}

.message-header{
  font-size: 16px;
  line-height: 1.6;
  color: rgb(10, 10, 10);
  cursor: pointer;
  font-weight: bold;
  opacity: .75;
}
.message-header:hover{
  text-decoration: underline;
}
.message-body{

}
.reply-box{
  padding-top: 10px;
}
textarea{
  resize: vertical;
}
.reply-form{
  margin-bottom: 5px;
}
.left-btn{
  margin-right: 10px;

}

.more-wrapper{
height: 45px;

}
.more-text{
  cursor: pointer;
}

.thumb-group{
   float: right;
}

@media (max-width: 400px) {
.heading-date{
  display:inline-flex !important;
  font-size: 0.6em !important;
  }
}


@media (max-width: 850px) {

  .media-heading{
  display: block;
  }
  .heading-date{
  display: block;
  padding-top: 10px;
  padding-bottom: 10px;
  line-height: 1.6;
  }
  .flags{
  display: block;
  float:right;
  }
  .dash-separator{
    display: none;
  }
  .thumb-group{
    float: left;
  }
}
}

</style>


@stop