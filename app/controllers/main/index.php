<?php

/*
 * 1 - Get a random station
 * 2 - Get all the info: Number, name, route
 * 3 - If the data was sent, save and retry
 */

function _index() {
	//$data['body'][] = print_r($_POST, TRUE);
	// Get the info from post

	// Station data
	$var['station']['number'] = 1;
	$var['station']['name'] = 'Nombre estación';
	$var['station']['url'] = 'http://ea.net';
	$var['station']['route_name'] = 'Ruta Chafa';

	$data['body'][] = View::do_fetch(VIEW_PATH . 'main/index.php', $var);
	View::do_dump(VIEW_PATH . 'map.php', $data);
	//View::do_dump(VIEW_PATH . 'layout.php', $data);
}