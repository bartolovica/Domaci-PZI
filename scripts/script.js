$(document).ready(function()
{
	function handleDeleteClick()
   {
      var $this = $(this);
      
      var $card = $this.parents(".liga");

      var id = $card.attr("data-id");
	  
	  $.getJSON
	  (
		"API.php",
		{
			action: "removeImage",
			id: id
		}
	  ).done(function()
	  {
		$card.remove();
	  }).fail(function(e)
	  {
		alert("Error:" + JSON.stringify(e));
	  });
   }

   $("#second_container  .liga  .iks").on("click", handleDeleteClick);
   
  
   
   var cardTemplate = $("#card-template").text();
   $("#tipka_add").on("click", function()
   {
      var title = prompt("Enter title", "");
      if(!title) { return; }
      
      var url = prompt("Enter url", "slike/bundesliga.jpg");
      if(!url) { return; }
      
     
	  
	  $.getJSON
	  (
		"API.php",
		{
			action: "addImage",
			title: title,
			imageUrl: url
			
			
			
			
		}
	  ).done(function(data)
	  {
	  	//Use the data sent from the server to obtain the id of the new card
		var $card = $(Mustache.render(cardTemplate, 
	    {
	        imageUrl: url,
	        title: title,
			id: data.id
	        
	        
	    }));
	      
	    $("#second_container").append($card);
	    $card.find(".iks").on("click", handleDeleteClick);
	  }).fail(function(e)
	  {
		  alert("Error:" + JSON.stringify(e));
	  });
   });
  
});