<?php
/**
 * RenderTime Class
 * @author Plent MX
 * @copyright Copyright (c) 2011 MIT Licence
 */

class RenderTime
{
	private $_start_time;
	private $_end_time;
	private $_total_time;

	private function getCurrentTime() {
		$mtime = microtime(); 
		$mtime = explode(' ', $mtime); 
		$mtime = $mtime[1] + $mtime[0]; 

		return $mtime;
	}

	public function startRenderTime() {
		$this->_start_time = $this->getCurrentTime();; 
	}

	public function endRenderTime() {
		$this->_end_time = $this->getCurrentTime();;
		$this->_total_time = ($this->_end_time - $this->_start_time);
	}

	public function getRenderTime() {
		return $this->_total_time;
	}
}