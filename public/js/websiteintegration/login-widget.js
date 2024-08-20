(function() {
<<<<<<< HEAD
    var container = $('#your-login-widget-container'); 
    var uniqueCode = container.attr('data-unique-code'); 
    var iframe = document.createElement('iframe');
    // iframe.src = 'http://dev.fitnessity.co/loginuser';
    iframe.src = 'http://dev.fitnessity.co/loginuser/' + uniqueCode;
    iframe.style.border = 'none';
    iframe.style.width = '100%';
    iframe.style.height = '100%';
=======
    var iframe = document.createElement('iframe');
    iframe.src = 'http://dev.fitnessity.co/login_integration';
    iframe.style.border = 'none';
    iframe.style.width = '300px';
    iframe.style.height = '200px';
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
    
    var container = document.getElementById('your-login-widget-container');
    container.appendChild(iframe);

    window.addEventListener('message', function(event) {
        if (event.origin !== 'http://dev.fitnessity.co') return;        
        if (event.data === 'login_success') {
            console.log('User logged in successfully');
        }
    }, false);
<<<<<<< HEAD
})();


=======
})();
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
