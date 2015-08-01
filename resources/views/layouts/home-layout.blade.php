<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Admin</title>

<link rel="shortcut icon" href="assets/images/gt_favicon.png">
  
  <!-- Bootstrap itself -->
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles -->
 <link rel="stylesheet" href="/assets/css/home.css">

  <!-- Fonts -->
  <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href='http://fonts.googleapis.com/css?family=Wire+One' rel='stylesheet' type='text/css'>
  @yield('stylesheets')

  <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="theme-invert">
  @include('flash::message')
  <div id="video-wrap">
  </div>

  <div id="overlay">
  </div>
  @yield('content')

  <!-- Load js libs only when the page is loaded. -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
  <script src="/packages/Magister3/assets/js/modernizr.custom.72241.js"></script>
  <!-- Custom template scripts -->
  <!-- <script src="packages/Magister3/assets/js/magister.js"></script> -->

  @yield('scripts')

</body>
</html>
<style>
  video#video-bg{
  position: fixed;
  min-width: 100%;
  min-height: 100%;
  width: 100%;
  height: 100%;
  object-fit: cover;
  top: 0;
  left: 0;
  opacity:1;
  /*SET FOR OLDER BROWSER INCASE THEY COULDNT RENDER VIDEO TAG*/
}

  #video-wrap{
  position: fixed;
  min-width: 100%;
  min-height: 100%;
  width: auto;
  height: auto;
  background-size:cover;
  top: 0;
  left: 0;
  opacity:1;
  z-index: 0;
  /*SET FOR OLDER BROWSER INCASE THEY COULDNT RENDER VIDEO TAG*/
  background: url(/assets/main-background/frames/frame-1-min.png) no-repeat;
}

  #overlay{
  position: fixed;
  min-width: 100%;
  min-height: 100%;
  width: auto;
  height: auto;
  background-size:cover;
  top: 0;
  left: 0;
  opacity:0.1;
  z-index: 0;
  /*SET FOR OLDER BROWSER INCASE THEY COULDNT RENDER VIDEO TAG*/
  background: gray;
}
  #main-content{
  z-index: 2;
}
body, html{
  background: black;
}
</style>