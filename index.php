<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Domaci rad broj 2</title>
        
        <link rel="stylesheet" href="stilovi/stil.css"/>
         <script type="text/template" id="card-template">
		 <?php 
			require_once("PHP/TemplateProvider.php");
			echo(TemplateProvider::getCardTemplate());
        ?>
		 
        </script>
        
    </head>
    
    <body>
        <header>
            <div id="link_container">
            <ul class="menu left">
                    <li><a class="selected" href="esp.html">Španjolska liga</a></li>
                    <li><a href="ita.html">Talijanska liga</a></li>
                    <li><a href="eng.html">Engleska liga</a></li>
                    <li><a href="ger.html">Njemačka liga</a></li>
                </ul>
            </div> 
        </header>
        
        
        
        
        <main>
            
            
                <div id="naslovna">
                    <h1 class="naslov">Najjače nogometne lige</h1><h2 class="naslov">Osnovne informacije</h2>
                </div>
               
                <div id="login" class="right">
                    <img src="slike/users.png" alt="users"/>
                    <a class="blue" href="."><strong>Registriraj se</strong></a>
                    <a href="."><strong>Prijavi se</strong></a>
                </div>   
                    
                
                
                <div id="glavni_natpis">
                    <p><strong>Španjolska nogometna liga</strong></p>
                </div>
				
				<?php 
			require_once("PHP/model/Slider.php");
                        echo(SliderItem::generateSliderItemHTML());

			    ?>
				
         
                <div id="second_container">
					
						
					   
						<?php 
							require_once("PHP/model/Cards.php");
							echo(Card::generateAllCardsHTML()); 
						?>
				   
				   
					
				</div>	
                 
                 
                
                <div id="tipka_add" class="add">
                    Dodaj sliku
                    
                </div>
                
                
                
        </main>
                <footer> 
                    <div id="left-logo">
                        <img src="slike/fb.png" alt="Facebook">
                        <img src="slike/tw.png" alt="Twiter">
                    </div>
                    
                    <div id="autor">
                 
                        <p>Sva prava pridržana</p>
                        <p>Antun Bartolović</p> 
                    </div>    
                           
                        <a class="linkovi">
                            Ostale lige &nbsp; &nbsp; Ostali sportovi
                        </a>
                            
                </footer>
        
        
        
        
        
        <script src="scripts/jquery.js"></script>
        <script src="scripts/mustache.js"></script>
        <script src="scripts/slider.js"></script>
		<script src="scripts/script.js"></script>
          
        
    </body>
    
    
    
    </html>