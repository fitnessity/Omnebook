<html>
    <head>
        <meta charset="utf-8">
        
       
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
         
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ResponsiveSlides.js/1.55/responsiveslides.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    </head>
    <body>
        <div id="map"></div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ResponsiveSlides.js/1.55/responsiveslides.min.js"></script>
         <script>
  $(function() {
   // $(".rslides").responsiveSlides();
  });
</script>
          
         <script>
           var marker;
           var map;
                  function initMap() 
                {
                  var uluru = {lat:25.92457, lng:73.666087};
                  map = new google.maps.Map(document.getElementById('map'),
                {
                  zoom: 20,
                 center: uluru
                });
                  var icon = {
        url: "https://upload.wikimedia.org/wikipedia/commons/f/f2/678111-map-marker-512.png",
        fillColor : "color",
        strokeColor: '#000', // url
        scaledSize: new google.maps.Size(70, 70), // size
    };
                marker = new google.maps.Marker
                ({ 
                  icon: icon,
                  position: uluru,
                  map: map

                });
                google.maps.event.addListener(marker,'click',function() {
            document.getElementById("highligt").style.color="red";
          });
               
              }
              function markfunction()
                {
                  
  
                marker.setIcon('https://upload.wikimedia.org/wikipedia/commons/f/f2/678111-map-marker-512.png');
                 
                }

              </script>
        
        
        
        
        <!--------------------Google Map Script--------------------->
        
         <script async defer
             src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCK4fSC1gA6qWJTio-djkKgW8WgS9vQG48&callback=initMap">
         </script>

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>