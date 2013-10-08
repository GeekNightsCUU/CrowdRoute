<?php

/*
 * 1 - Get a random station
 * 2 - Get all the info: Number, name, route
 * 3 - If the data was sent, save and start over again
 */

function _index() {
	$RenderTime = new RenderTime();
	$RenderTime->startRenderTime();

	$valid_post_data = isset($_POST['latitude'])
							AND isset($_POST['longitude'])
							AND isset($_POST['station_id']);

	if ($valid_post_data) {
		$station_id = intval($_POST['station_id']);
		$latitude = floatval($_POST['latitude']);
		$longitude = floatval($_POST['longitude']);
		$sender_ip = $_SERVER['REMOTE_ADDR'];

		$valid_latitude_longitude = $_POST['latitude'] != ''
									AND $_POST['longitude'] != '';

		if ($valid_latitude_longitude) {
			// Create a point
			$point = new Point();
			$point->set('station_id', $station_id);
			$point->set('latitude', $latitude);
			$point->set('longitude', $longitude);
			$point->set('sender_ip', $sender_ip);
			$point->create();
		} else {
			//echo 'ERROR LAT LON';
		}
	}

	// Get the next 

	// Station data
	$station_id = 5012; // Hardcoded
	$station = new Station();

	// Get result set for that station ID
	$current_station = $station->retrieve_one('id = ?', $station_id)->rs;

	$route = new Route();
	$current_route = $route->retrieve_one('id = ?', $current_station['route_id'])->rs;

	if ($station->exists()) {
		$var['station']['id'] = $station_id;
		$var['station']['number'] = $current_station['num'];
		$var['station']['name'] = $current_station['name'];
		$var['station']['url'] = $current_route['map_url'];
		$var['station']['route_name'] = $current_route['name'];
	}

	$RenderTime->endRenderTime();
	$data['footer_stats'][] = "\n<!-- Memory usage " . MemoryUsage::getMemoryUsage() . " -->";
	$data['footer_stats'][] = "<!-- Created in " . $RenderTime->getRenderTime() . " seconds-->";

	$data['body'][] = View::do_fetch(VIEW_PATH . 'main/index.php', $var);
	View::do_dump(VIEW_PATH . 'template.php', $data);
	View::do_dump(VIEW_PATH . 'footer_stats.php', $data);
}