<<<<<<< HEAD
<style>
	   *{ height:100%;}
       body { font-family: Arial, sans-serif; margin: 0; padding: 0px; }
        input { display: block; margin: 10px 0; padding: 5px; width: 100%; }
        button { display: block; margin: 10px 0; padding: 5px; width: 100%; }
        #loom-companion-mv3{
            display: none;
        }
</style>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<div id="your-login-widget-container" data-unique-code="{{$code->unique_code}}"></div>
<script src="http://dev.fitnessity.co/public/js/websiteintegration/login-widget.js"></script>
=======
<!DOCTYPE html>
<html>
<head>
    <title>Login Widget</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 10px; }
        input { display: block; margin: 10px 0; padding: 5px; width: 100%; }
        button { display: block; margin: 10px 0; padding: 5px; width: 100%; }
    </style>
</head>
<body>
    <form id="loginForm">
        <input type="text" id="username" placeholder="Username" required>
        <input type="password" id="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <div id="message"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(e) {
                e.preventDefault();
                var username = $('#username').val();
                var password = $('#password').val();
                
                $.ajax({
                    url: 'https://your-auth-server.com/login',
                    method: 'POST',
                    data: { username: username, password: password },
                    xhrFields: {
                        withCredentials: true
                    },
                    success: function(response) {
                        $('#message').text('Login successful!').css('color', 'green');
                        window.parent.postMessage('login_success', '*');
                    },
                    error: function() {
                        $('#message').text('Login failed.').css('color', 'red');
                    }
                });
            });
        });
    </script>
</body>
</html>
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
