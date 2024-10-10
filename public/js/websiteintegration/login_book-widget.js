(function() {
    var container = document.getElementById('your-login-widget-container');
    document.body.style.margin = '0';
    if (!container) {
        console.error('Container element not found');
        return;
    }
    var uniqueCode = container.getAttribute('data-unique-code');
    if (!uniqueCode) {
        console.error('Unique code not found in container');
        return;
    }    
    var iframe = document.createElement('iframe');
    iframe.src = 'https://dev.fitnessity.co/api/login/' + uniqueCode; 
    iframe.style.border = 'none';
    iframe.style.width = '100%';
    iframe.style.height = '100vh';    
    container.appendChild(iframe);
    window.addEventListener('message', function(event) {
        if (event.origin !== 'https://dev.fitnessity.co') return;        
        if (event.data === 'login_success') {
            console.log('User logged in successfully');
        }
    }, false);
})();