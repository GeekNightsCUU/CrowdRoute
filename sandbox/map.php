<?php
define('INSTRUCTIONS', 'Coloca el puntero azul en la posición de la parada que te indicamos luego haz clic en Continuar');
if (isset($_POST['latitude']) AND isset($_POST['longitude'])) {
	$latitude = floatval($_POST['latitude']);
	$longitude = floatval($_POST['longitude']);
	$sender_ip = $_SERVER['REMOTE_ADDR'];
	$station_id = 1;
	$time = time();

	$file_db = new PDO('sqlite:crowdroute.sqlite');
	$file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$insert = "INSERT INTO points (station_id, latitude, longitude, time, sender_ip) 
					VALUES (:station_id, :latitude, :longitude, :time, :sender_ip)";
	$stmt = $file_db->prepare($insert);

	// Bind parameters to statement variables
	$stmt->bindParam(':station_id', $station_id);
	$stmt->bindParam(':latitude', 	$latitude);
	$stmt->bindParam(':longitude', 	$longitude);
	$stmt->bindParam(':time', 		$time);
	$stmt->bindParam(':sender_ip', 	$sender_ip);

	$stmt->execute();
}
?>
</pre>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Rutas alimentadoras</title>

	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

	<style>
		html, body, div, span, applet, object, iframe,
		h1, h2, h3, h4, h5, h6, p, blockquote, pre,
		a, abbr, acronym, address, big, cite, code,
		del, dfn, em, img, ins, kbd, q, s, samp,
		small, strike, strong, sub, sup, tt, var,
		b, u, i, center,
		dl, dt, dd, ol, ul, li,
		fieldset, form, label, legend,
		table, caption, tbody, tfoot, thead, tr, th, td,
		article, aside, canvas, details, embed, 
		figure, figcaption, footer, header, hgroup, 
		menu, nav, output, ruby, section, summary,
		time, mark, audio, video {
			margin: 0;
			padding: 0;
			border: 0;
			font-size: 100%;
			font: inherit;
			vertical-align: baseline;
		}
		/* HTML5 display-role reset for older browsers */
		article, aside, details, figcaption, figure, 
		footer, header, hgroup, menu, nav, section {
			display: block;
		}
		body {
			line-height: 1;
		}
		ol, ul {
			list-style: none;
		}
		blockquote, q {
			quotes: none;
		}
		blockquote:before, blockquote:after,
		q:before, q:after {
			content: '';
			content: none;
		}
		table {
			border-collapse: collapse;
			border-spacing: 0;
		}
		body { 
			background: #eee; 
		}

		#canvas {
			width: 560px;
			height: 420px;
		}

		#signup {
			width: 560px;
			height: 600px;
			margin: 20px auto 10px auto;
			padding: 15px;
			position: relative;
			background: #fafafa;
			border: 1px solid #ccc;
			-moz-border-radius: 3px;
			-webkit-border-radius: 3px; 
			border-radius: 3px;  
		}

		#signup::before, 
		#signup::after {
			content: "";
			position: absolute;
			bottom: -3px;
			left: 2px;
			right: 2px;
			top: 0;
			z-index: -1;
			background: #fff;
			border: 1px solid #ccc;			
		}

		#signup::after {
			left: 4px;
			right: 4px;
			bottom: -5px;
			z-index: -2;
			-moz-box-shadow: 0 8px 8px -5px rgba(0,0,0,.3);
			-webkit-box-shadow: 0 8px 8px -5px rgba(0,0,0,.3);
			box-shadow: 0 8px 8px -5px rgba(0,0,0,.3);
		}

		#signup h1 {
			position: relative;
			font: 1.2em/1.2em Arial, Helvetica;
			color: #555;
			text-align: center;
			margin: 0 0 5px;
			/*text-shadow: 0 -1px 0 rgba(0,0,0,.1);*/
		}

		#signup h2 {
			position: relative;
			font: 1em/1em Arial, Helvetica;
			color: #777;
			text-align: center;
			margin: 0 0 5px;
		}

		::-webkit-input-placeholder {
		   color: #bbb;
		}
		
		:-moz-placeholder {
		   color: #bbb;
		} 				    	

		.placeholder{
			color: #bbb; /* polyfill */
		}		

		#signup input{
			margin: 5px 0;
			padding: 15px;
			width: 100%;
			*width: 518px;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			border: 1px solid #ccc;
			-moz-border-radius: 3px;
			-webkit-border-radius: 3px;
			border-radius: 3px;	
		}

		#signup input:focus{
			outline: 0;
			border-color: #aaa;
			-moz-box-shadow: 0 2px 1px rgba(0, 0, 0, .3) inset;
			-webkit-box-shadow: 0 2px 1px rgba(0, 0, 0, .3) inset;
			box-shadow: 0 2px 1px rgba(0, 0, 0, .3) inset;
		}		

		#signup button{
			margin: 10px 0 0 0;
			padding: 10px 8px;			
			width: 100%;
			cursor: pointer;
			border: 1px solid #2493FF;
			overflow: visible;
			display: inline-block;
			color: #fff;
			font: bold 1.4em arial, helvetica;
			text-shadow: 0 -1px 0 rgba(0,0,0,.4);		  
			background-color: #2493ff;
			background-image: -webkit-gradient(linear, left top, left bottom, from(rgba(255,255,255,.5)), to(rgba(255,255,255,0)));
			background-image: -webkit-linear-gradient(top, rgba(255,255,255,.5), rgba(255,255,255,0));
			background-image: -moz-linear-gradient(top, rgba(255,255,255,.5), rgba(255,255,255,0));
			background-image: -ms-linear-gradient(top, rgba(255,255,255,.5), rgba(255,255,255,0));
			background-image: -o-linear-gradient(top, rgba(255,255,255,.5), rgba(255,255,255,0));
			background-image: linear-gradient(top, rgba(255,255,255,.5), rgba(255,255,255,0));
			-webkit-transition: background-color .2s ease-out;
			-moz-transition: background-color .2s ease-out;
			-ms-transition: background-color .2s ease-out; 
			-o-transition: background-color .2s ease-out;  
			transition: background-color .2s ease-out;
			-moz-border-radius: 3px;
			-webkit-border-radius: 3px;
			border-radius: 3px;
			-moz-box-shadow:  0 2px 1px rgba(0, 0, 0, .3),
							  0 1px 0 rgba(255, 255, 255, .5) inset;
			-webkit-box-shadow: 0 2px 1px rgba(0, 0, 0, .3),
								0 1px 0 rgba(255, 255, 255, .5) inset;
			box-shadow: 0 2px 1px rgba(0, 0, 0, .3),
						0 1px 0 rgba(255, 255, 255, .5) inset;			  						  
		}

		#signup button:hover{
			background-color: #7cbfff;
			border-color: #7cbfff;
		}

		#signup button:active{
			position: relative;
			top: 3px;
			text-shadow: none;
			-moz-box-shadow: 0 1px 0 rgba(255, 255, 255, .3) inset;
			-webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, .3) inset;
			box-shadow: 0 1px 0 rgba(255, 255, 255, .3) inset;
		}

		#about{
			color: #999;
			text-align: center;
			font: 0.9em Arial, Helvetica;
		}

		#about a{
			color: #777;
		}		
	</style>
</head>
<body>
	<form action="" method="post" id="signup">
		<h2><a href="http://rutabus.com/pdf/Tarahumara%20(RA-05).pdf" target="_blank"><img src="imgs/map.png"> Abre el plano de ruta</a></h2>

		<p><?php if(isset($latitude)) echo $latitude ?></p>
		<!--
		<p><?php echo $longitude ?></p>
		<p><?php echo $ip_address ?></p>
		-->
		<h2>Localiza esta estación en el mapa</a></h2>
		<h1>_Nombre Estacion_</h1>
		<div id="canvas"></div>
		<script type="text/javascript" src="script/gmap.js"></script>
		<input id="latitude" name="latitude" type="hidden" value="">
		<input id="longitude" name="longitude" type="hidden" value="">			
		<button type="submit">Continuar</button>	
	</form>
</body>
</html>