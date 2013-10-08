<?php
class Point extends Model {
	function __construct($id = '') {
		//primary key = id; tablename = points
		parent::__construct('id', 'points'); 
		
		$this->rs['id'] = '';
		$this->rs['station_id'] = '';
		$this->rs['latitude'] = '';
		$this->rs['longitude'] = '';
		$this->rs['time'] = '';
		$this->rs['sender_ip'] = '';

		if ($id) {
			$this->retrieve($id);
		}
	}

	function create() {
		$this->rs['time'] = time();
		return parent::create();
	}
}