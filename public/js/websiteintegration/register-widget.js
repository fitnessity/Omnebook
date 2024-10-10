(function() {
    var container = document.getElementById('your-register-widget-container');
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
    iframe.src = 'https://dev.fitnessity.co/api/business_customer_create/' + uniqueCode; 
    iframe.style.border = 'none';
    iframe.style.width = '100%';  
    iframe.setAttribute('frameborder', '0');
    iframe.setAttribute('allowfullscreen', '');
    iframe.setAttribute('noresize', 'noresize'); 
    iframe.setAttribute('id', 'registerframe');
    iframe.setAttribute('scrolling', 'no');
    // iframe.setAttribute('seamless', 'seamless');
 
    // window.addEventListener('message', function(event) {
    //     if (event.origin !== 'https://dev.fitnessity.co') return;        
    //     if (event.data === 'login_success') {
    //         console.log('User logged in successfully');
    //     }
    // }, false);


    // window.addEventListener('message', function(event) {
    //     if (event.data.type === 'changeSrc') {
    //       document.getElementById('registerframe').src = event.data.src;
    //     }
    //   });


    //   function adjustIframeHeight() {
    //     if (window.matchMedia("(max-width: 650px)").matches) {
    //         iframe.style.height = '2410px'; 
    //     } 
    //   }
    //   adjustIframeHeight();
    //   window.addEventListener('resize', adjustIframeHeight);

    
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