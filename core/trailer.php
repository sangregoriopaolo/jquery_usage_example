<?php
$trailer_url = "http://www.youtube.com/v/" . $_GET['url'];
?>

<html>
 <head>
	<title>Movie db</title>
	<script type="text/javascript" src="./js/swfobject.js"></script>

 </head>
 <body >
 <h1>Movie db - Trailer</h1><input type="button" value="return" onclick="javascript:history.back();" />
 <center>
	<div id="trailer_container" style="width: 600px; height: 400px;" >
			<h1>Get Adobe Flash Player</h1>
			<p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
       
	</div>
 </center>
	
	
	<script type="text/javascript">
	swfobject.embedSWF("<?php echo $trailer_url; ?>", "trailer_container", "600", "400", "9.0.0", false, {}, {play:"true",wmode: "windows",}, {});
	</script>
 </body>
</html>