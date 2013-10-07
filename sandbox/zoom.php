<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title>jQuery gzoom plugin</title>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="description" content=""/>
		<meta name="keywords" content="" />
		<meta name="author" content="" />

		<link rel="stylesheet" href="css/jquery-ui-1.7.1.custom.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="css/jquery.gzoom.css" type="text/css" media="screen" />


		<style type="text/css">
		/* page styles */
		a:focus {
			outline:none;
		}
		a {
			color: #ff6600;
		}
		body {
			font-family: Verdana, sans-serif;
			text-align: center;
			margin: 0;
			padding: 0;
			background: #fff;
			color: #000;
			font-size: 62.5%;
		}
		#wrapp {
			width: 90%;
			text-align: left;
			font-size: 1.1em;
			margin: 1em auto;
			padding: 0;
			color: #000;
		}
		h1 {
			padding: 1em 0 0.8em 0;
			border-bottom: 1px solid silver;
			margin: 0 0 1em 0;
			font: bold 1.6em Verdana;
			letter-spacing: -1px;
		}
		hr {
			border:0px;
			border-bottom: 1px solid silver;
			margin:0px;
		}
		img {
			border:0px;
		}
		pre {
			font-size:12px;
		}
		</style>
	</head>
	<body>
		<div id="wrapp">
			<hr />
			<h1>jQuery gzoom plugin</h1>
			<div id="zoom03" class="zoom zoom_no_lbox">
				<img src="21.jpg" alt="" title="" />
			</div>
		</div>
		<script type="text/javascript" src="jquery/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="jquery/ui.core.min.js"></script>
		<script type="text/javascript" src="jquery/ui.slider.min.js"></script>
		<script type="text/javascript" src="jquery/jquery.mousewheel.js"></script> <!-- optional -->
		<script type="text/javascript" src="jquery/jquery.gzoom.js"></script>

		<script type= "text/javascript">
			/*<![CDATA[*/
			$(function() {
				$(".zoom_no_lbox").gzoom({
						sW: 400,
						sH: 600,
						lW: 1024,
						lH: 768,
						lightbox: true
				});
			});
			/*]]>*/
		</script>
	</body>
</html>