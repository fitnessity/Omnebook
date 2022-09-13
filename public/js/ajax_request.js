//$(document).ready(function(){
    console.log("run")
   $('#mdp-demo').multiDatesPicker({
        	separator: ", "
        });
      $('#markcalendar').click(function() {
          console.log("casdert")
          $('#mdp-demo').multiDatesPicker({
        	separator: ", "
        });
           $("#mdp-demo").multiDatesPicker("show");
          $("#mdp-demo").focus();
        });
 
//});