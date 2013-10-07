<!--
<p><strong>Instrucciones</strong><br/>
	(1) Haz clic en el ícono del mapa para abrir la ruta<br />
	(2) Mueve el apuntador azul a la dirección de la estación que te indicamos</br>
	(3) Pulsa en continuar
</p>
-->
<h1>Ubicador de paradas en rutas alimentadoras</h1>

<p>
	<a href="<?php echo $station['url'] ?>" target="_blank">
		<img src="imgs/map.png"> Abrir mapa de la ruta
	</a>
</p>

<h2>
	<?php echo $station['number'] . ' - ' . $station['name']
		. ' (' . $station['route_name'] . ')' ?>
</h2>

<div id="canvas"></div>
<!--
<iframe src="http://docs.google.com/gview?url=http://rutabus.com/pdf/2%20de%20Octubre%20(RC-22).pdf&embedded=true" style="width:400px; height:400px;" frameborder="0"></iframe>
<embed src="http://rutabus.com/pdf/2%20de%20Octubre%20(RC-22).pdf" width="400" height="375" type='application/pdf' >
-->

<script type="text/javascript" src="script/gmap.js"></script>

<input id="latitude" name="latitude" type="hidden" value="">
<input id="longitude" name="longitude" type="hidden" value="">			
<button type="submit">Ya definí la posición de la estación</button>	