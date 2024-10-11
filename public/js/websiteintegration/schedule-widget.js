(function() {
    var container = document.getElementById('your-schedule-widget-container');
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

    document.getElementsByTagName('head')[0].appendChild(meta);

    var iframe = document.createElement('iframe');
    iframe.src = 'https://dev.fitnessity.co/api/booking_schedule/' + uniqueCode; 
    iframe.style.border = 'none';
    iframe.style.width = '100%';
    iframe.setAttribute('frameborder', '0');
    iframe.setAttribute('allowfullscreen', '');
    iframe.setAttribute('noresize', 'noresize'); 
    iframe.setAttribute('scrolling', 'no');

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

    
    container.appendChild(iframe);



})();