<?php
function _index() {
	$RenderTime = new RenderTime();
	$RenderTime->startRenderTime();

	/*
	 * 1 - Get a random station
	 * 2 - Get all the info: Number, name, route
	 * 3 - If the data was sent, save and start over again
	 */

	// Get the next
	checkPostData();

	// Station data
	$station_id = getNextStation();
	if ($station_id === -1) {
		// No station available
		$station_id = 5001;
	}

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

function getNextStation() {
	$min_points = 2; // Num of votes to stop requesting points
	$ip_address = $_SERVER['REMOTE_ADDR'];

	// First, get points with 
	$db = getdbh();
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// Get already voted places not submitted by the current user
	$query = "SELECT station_id
		FROM 'points'
		GROUP BY station_id
		HAVING count(1) BETWEEN 1 AND $min_points
			AND sender_ip != '$ip_address'
		;";

	$result = $db->query($query)->fetchAll();

	//print_r($query);
	//print_r($result);

	if (count($result) === 0) {
		// Get avaliable stations not voted by me
		$query = "SELECT DISTINCT s.id AS station_id
			FROM 'stations' AS s
			CROSS JOIN points AS p
			WHERE s.id NOT IN (
				SELECT p.station_id
				FROM 'points' AS p
				WHERE p.sender_ip IS '$ip_address'
				GROUP BY p.station_id
			)
			;";

		$result = $db->query($query)->fetchAll();
	}

	if (count($result) > 0) {
		// Return a random station_id
		return $result[array_rand($result)]['station_id'];
	} else {
		// Show that there aren't available stations
		return -1;
	}
}

function checkPostData() {
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
			// TO DO: Return error
			//echo 'ERROR LAT LON';
		}
	}	
}