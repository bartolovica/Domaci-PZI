$(document).ready(function()
{
   var thumbnails = [];
   
   $.getJSON("API.php",
   {
		action:"getSliderItems"
   }).done(function(data)
   {
		//items = jQuery.extend({}, data);
		//items = JSON.parse(JSON.stringify(data));
		var lastIndex=data.length;
		for(var i=0;i<lastIndex;i++){
	    
				thumbnails.push({title:data[i].naslov,url_slika:data[i].url_slika,text:data[i].opis,ocjena:data[i].ocjena});
				//alert(items[i].Description);
		}
	
	
	}).fail(function(e)
	{ 
		alert("Error:" + JSON.stringify(e));
	});
  
thumbnails.currentIndex = 0;  
 /*
   thumbnails.forEach(function(thumbnail)
   {
      var image = new Image();
      image.src = thumbnail.Image;
   });
   
   var $thumbnails = $("#liga > .thumbnail");
   */
  
   
   
   var $stars = $(".rating-star");
   
   $stars.on("click",function(){
		var $this = $(this);
		var currentItem= thumbnails[thumbnails.currentIndex];
		currentItem.ocjena = $stars.index($this) + 1;
		//currentItem.Grade = parseInt(currentItem.Grade);
		//alert(currentItem.Grade);
		$.getJSON
		(
		    "API.php",
			{
			     action: "starsSet",
			     title: currentItem.title,
			     grade: currentItem.ocjena
			}
		).done(function()
		{
			starsSet(currentItem.Grade);
		}).fail(function()
		{
			alert("Problem sa zvijezdama");	
		});
   
   });
   
   
   function updateSliderUI()
   {
      var $sliderImage = $("#slider");
      
      var currentThumbnail = thumbnails[thumbnails.currentIndex];
      
      $sliderImage.fadeOut(function()
      {
         $sliderImage.attr("src", currentThumbnail.Image);
         
         $sliderImage.fadeIn();
      });
      
      updateStars();
   };
   
   function updateTitle()
   {
      var $title = $("#main_content .naslov_2");
      var currentThumbnail = thumbnails[thumbnails.currentIndex];
      
      $title.text(currentThumbnail.title);
   };
   
   function updateText()
   {
      var $text = $("#laliga .text");
      var currentThumbnail = thumbnails[thumbnails.currentIndex];
      
      $text.text(currentThumbnail.text);
   };
   
   function updateStars()
   {
      var $star = $(".rating-star");
      $star.removeClass("selectedStar");
       
      for(var i=0; i < thumbnails[thumbnails.currentIndex].grade; i++)
         $star.eq(i).addClass("selectedStar");
         
   };
   
   $("#main_container .left").on("click", function()
   {
      thumbnails.currentIndex--;
      
      if(thumbnails.currentIndex < 0)
      {
         thumbnails.currentIndex = thumbnails.length - 1;
      }
      
      updateSliderUI();
      updateTitle();
      updateText();
   });
   
   $("#main_container .right").on("click", function()
   {
      thumbnails.currentIndex++;
      
      if(thumbnails.currentIndex > thumbnails.length - 1)
      {
         thumbnails.currentIndex = 0;
      }
      
      updateSliderUI();
      updateTitle();
      updateText();
   });
   
   
   $("#tipka").on("click",function() {
      var currentThumbnail = thumbnails[thumbnails.currentIndex];
      
      var title=prompt("Uredi naslov",currentThumbnail.title);
      if(!title) {return;}
      var text=prompt("Uredi text",currentThumbnail.text);
      if(!text) {return;}
      var image=prompt("Link slike:",currentThumbnail.Image);
      if(!image) {return;}
      
      currentThumbnail.title=title;
      currentThumbnail.text=text;
      currentThumbnail.Image=image;
      
      updateSliderUI();
      updateTitle();
      updateText();
      
   });
   
   var $zvijezda = $("#rating-stars-container > .rating-star");
   $zvijezda.on("click",function() {
      var $this = $(this);

      thumbnails[thumbnails.currentIndex].grade = $zvijezda.index($this)+1;
      
      updateStars();
   });
   
   
});