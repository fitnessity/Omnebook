<!DOCTYPE html>
<head>
    <title>Zoom WebSDK</title>
    <meta charset="utf-8" />
     <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.7.9/css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.7.9/css/react-select.css" />
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>
<style>
    body {
        padding-top: 50px;
    }
</style>

<nav id="nav-tool" class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <img src="https://fitnessity.raursoft.org/public/images/logo-300x63.png" alt="MyMeetingApp">
        </div>
        <div id="navbar">
            <form class="navbar-form navbar-right" id="meeting_form">
                <div class="form-group">
                    <input type="text" name="display_name" id="display_name" value="{{$name}}" placeholder="Name" class="form-control" required>
                </div>
                
          <input type="hidden" value="{{route('oncall',['mid'=>$id])}}" id="url">
			<input type="hidden" value="{{route('homemy')}}" id="rurl">
			<input type="hidden" value="{{$id}}" id="meeting_number">
			<input type="hidden" value="{{$p}}" id="meeting_pwd">
            <input type="hidden" value="{{$role}}" id="meeting_role">
                
                
                <button type="submit" class="btn btn-primary" id="join_meeting">Join</button>
            </form>
        </div><!--/.navbar-collapse -->
    </div>
</nav>

 <script src="https://source.zoom.us/1.7.9/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/1.7.9/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/1.7.9/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/1.7.9/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/1.7.9/lib/vendor/jquery.min.js"></script>
    <script src="https://source.zoom.us/1.7.9/lib/vendor/lodash.min.js"></script>

    <!-- import ZoomMtg -->
    <script src="https://source.zoom.us/zoom-meeting-1.7.9.min.js"></script>
<script src="https://fitnessity.raursoft.org/public/zoom/js/tool.js"></script>
<script src="https://fitnessity.raursoft.org/public/zoom/js/index.js"></script>

<script>
   
</script>
</body>
</html>
