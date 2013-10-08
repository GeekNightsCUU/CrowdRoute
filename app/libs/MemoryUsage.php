<?php
/**
 * MemoryUsage Class
 * @author Plent MX
 * @copyright Copyright (c) 2011 MIT Licence
 */
class MemoryUsage
{
	public static function getMemoryUsage() {
		return self::formatBytes(memory_get_usage(), 2);
	}

	private static function formatBytes($bytes, $precision = 2) {
		$units = array('B', 'KB', 'MB', 'GB', 'TB');

		$bytes = max($bytes, 0);
		$pow = floor(($bytes ? log($bytes) : 0) / log(1024));
		$pow = min($pow, count($units) - 1);

		$bytes /= (1 << (10 * $pow));

		return round($bytes, $precision) . ' ' . $units[$pow];
	}
}