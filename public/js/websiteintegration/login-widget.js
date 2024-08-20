(function() {
    var container = $('#your-login-widget-container'); 
    var uniqueCode = container.attr('data-unique-code'); 
    var iframe = document.createElement('iframe');
    // iframe.src = 'http://dev.fitnessity.co/loginuser';
    iframe.src = 'http://dev.fitnessity.co/loginuser/' + uniqueCode;
    iframe.style.border = 'none';
    iframe.style.width = '100%';
    iframe.style.height = '100%';
    
    var container = document.getElementById('your-login-widget-container');
    container.appendChild(iframe);

    window.addEventListener('message', function(event) {
        if (event.origin !== 'http://dev.fitnessity.co') return;        
        if (event.data === 'login_success') {
            console.log('User logged in successfully');
        }
    }, false);
})();


