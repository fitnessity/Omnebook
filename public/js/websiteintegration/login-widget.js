(function() {
    var iframe = document.createElement('iframe');
    iframe.src = 'http://dev.fitnessity.co/login_integration';
    iframe.style.border = 'none';
    iframe.style.width = '300px';
    iframe.style.height = '200px';
    
    var container = document.getElementById('your-login-widget-container');
    container.appendChild(iframe);

    window.addEventListener('message', function(event) {
        if (event.origin !== 'http://dev.fitnessity.co') return;        
        if (event.data === 'login_success') {
            console.log('User logged in successfully');
        }
    }, false);
})();