
// (function() {
//     var iframe = document.createElement('iframe');
//     var container = document.getElementById('your-login-widget-container');
//     container.appendChild(iframe);
//     // var uniqueCode = container.attr('data-unique-code'); 
//     var iframe = document.createElement('iframe');
//     iframe.src = 'https://dev.fitnessity.co/test';
//     // iframe.src = 'https://dev.fitnessity.co/loginuser/' + uniqueCode;
//     iframe.style.border = 'none';
//     iframe.style.width = '100%';
//     iframe.style.height = '100%';
    
  
  
//     window.addEventListener('message', function(event) {
//         if (event.origin !== 'https://dev.fitnessity.co') return;        
//         if (event.data === 'login_success') {
//             console.log('User logged in successfully');
//         }
//     }, false);
// })();

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
    var meta = document.createElement('meta');
    meta.name = 'viewport';
    meta.content = 'width=device-width, initial-scale=1';

    // Append the meta tag to the <head> section
    document.getElementsByTagName('head')[0].appendChild(meta);

    var iframe = document.createElement('iframe');
    iframe.src = 'https://dev.fitnessity.co/api/loginuser/' + uniqueCode; 
    iframe.style.border = 'none';
    iframe.style.width = '100%';
    iframe.style.height = '100vh';    
    iframe.setAttribute('frameborder', '0');
    iframe.setAttribute('allowfullscreen', '');
    iframe.setAttribute('noresize', 'noresize'); 
    iframe.setAttribute('id', 'loginframe');
    iframe.setAttribute('allow', 'payment');
    iframe.setAttribute('scrolling', 'no');

    window.addEventListener('message', function(event) {
        if (event.origin !== 'https://dev.fitnessity.co') return;        
        if (event.data === 'login_success') {
            console.log('User logged in successfully');
        }
    }, false);

    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('message', function(event) {
            if (event.data.type === 'changeSrc') {
                document.getElementById('loginframe').src = event.data.src;
            }
        });
    });

    window.addEventListener('message', function(event) {
        if (event.origin === 'https://dev.fitnessity.co') {
            iframe.style.height = event.data.height + 'px';
        }
    });
    function adjustIframeHeight(event) {
        if (event.origin === 'https://dev.fitnessity.co') {
            iframe.style.height = event.data.height + 'px';
        }
    }
    window.addEventListener('message', adjustIframeHeight);
    window.addEventListener('resize', function() {
    iframe.contentWindow.postMessage({ action: 'getHeight' }, 'https://dev.fitnessity.co');
});
    // iframe.onload = function() {
    //     iframe.contentWindow.postMessage({
    //         type: 'SET_SRC',
    //         src: iframe.src
    //     }, '*');
    // };
    container.appendChild(iframe);
})();