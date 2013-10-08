<?php
class Route extends Model {
	function __construct($id = '') {
		//primary key = id; tablename = routes
		parent::__construct('id', 'routes'); 
		
		$this->rs['id'] = '';
		$this->rs['name'] = '';
		$this->rs['map_url'] = '';

		if ($id) {
			$this->retrieve($id);
		}
	}

	function create() {
		return parent::create();
	}
}