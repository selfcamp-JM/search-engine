$(document).ready(function(){
  
   $(".result").on("click", function(){
      
      $url = $(this).attr("href"); // href attribute of result class
      console.log($url);
      return false; //dont do default behavior 
   });

});

function increaseLinkClicks(linkId, url){

};