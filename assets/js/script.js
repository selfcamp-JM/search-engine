$(document).ready(function(){
  
   $(".result").on("click", function(){
      
      var id = $(this).attr("data-linkId");  //to get Id ı used data-link attribute from sitesresultsprovider
      var url = $(this).attr("href"); // href attribute of result class

      if(!id){
      	alert("data-link not found!!!");
      }

      increaseLinkClicks(id, url);

      return false; //dont do default behavior 
   });


   var grid = $(".imageResults");

   grid.masonry({
    itemSelector:".gridItem",
    columnWidth:20,
    gutter:5,
    //isInitLayout:false
   })

});

function increaseLinkClicks(linkId, url){
    $.post("ajax/updateLinkCount.php",{linkId: linkId}) //ajax call
    .done(function(result){
    	if(result !=""){
    		alert(result);
    		return;
    	}
    	window.location.href = url;
     });
};