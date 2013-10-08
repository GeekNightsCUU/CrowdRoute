<h1>Ubicador de paradas en rutas alimentadoras</h1>

<h2>
	<?php echo $station['number'] . ' - ' . $station['name'] ?>
</h2>

<h2>
	<?php echo 'Ruta: ' . $station['route_name'] ?>
</h2>

<object data='<?php echo $station['url'] ?>' 
        type='application/pdf' 
        width='100%' 
        height='300px'>
	<p>
		<a href="<?php echo $station['url'] ?>" target="_blank">
			<img src="imgs/map.png"> Abrir mapa de la ruta
		</a>
	</p>
</object>

<div id="canvas"></div>

<script type="text/javascript" src="script/gmap.js"></script>

<input id="latitude" name="latitude" type="hidden" value="">
<input id="longitude" name="longitude" type="hidden" value="">
<input id="station_id" name="station_id" type="hidden" value="<?php echo $station['id'] ?>">
<button type="submit">Ya definí la posición de la estación</button>