<?php
if (isset($footer_stats) AND is_array($footer_stats)) {
	foreach ($footer_stats as $html) {
		echo "$html\n";
	}
}
?>