<?php
class Station extends Model {
	function __construct($id = '') {
		//primary key = id; tablename = users
		parent::__construct('id', 'stations'); 
		
		$this->rs['id'] = '';
		$this->rs['route_id'] = '';
		$this->rs['num'] = '';
		$this->rs['name'] = '';
		$this->rs['points_num'] = '';

		if ($id) {
			$this->retrieve($id);
		}
	}

	function create() {
		return parent::create();
	}
}