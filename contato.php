<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="css/rest.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.css">
	<script>
      function initMap() {
        var uluru = {lat: -22.9653007, lng: -43.1829026};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 18,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCiRKLrjhv7ROdQqNQaPk7VqSpWf2EF7oQ&callback=initMap">
    </script>
    
</head>
<body>

	<header class="row">
		<div class="container col-xs-12 col-sm-12 col-md-12">
			<nav class =" menu tresborda ">
				<ul class= "">
					<li><a href="index.php">menu</a></li>
					<li><a href="sobre.php">sobre</a></li>
					<li><a href="contato.php">contato</a></li>
				</ul>
			</nav>	
		</div>
                    <div class="restimagem" >
                    	<img src="img/casamento51.png" alt="logo fazfesta" class ="imagemlogo">
                    </div>
					
                 <div class= "contato">
					<h2></h2>
					<h3></h3>
					</div>
			
								
			

		
	</header>

	<section class=" fundomenu ">
		<div class="container">
				<div>
				<h1 class ="menudasemana"> mapa</h1>
                <div id="map"></div>
				 
                
		     
				
				
					
				</div>	
       	</div>
    </section>
    
    <footer class= "rodape row">     
           <ul>

           	<li>menu</li>
             <li>sobre</li>
             <li>contato</li>
             <li><a href="login.php">cadastro</a></li>

           </ul>

           <p>rest @2015 alguns direitos reservados</p>

    </footer>

	
</body>
</html>