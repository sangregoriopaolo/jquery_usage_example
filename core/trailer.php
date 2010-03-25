<?php
$trailer_url = "http://www.youtube.com/v/" . $_GET['url'];
?>

<html>
 <head>
	<title>Movie db</title>
	<script type="text/javascript" src="./js/swfobject.js"></script>
	<script type="text/javascript">
		function load(){
		 alert("mario");
	         swfobject.embedSWF("<?php echo $trailer_url; ?>",
             "trailer_container",
             "600",
             "385",
             "9.0.0",
             false,
             {},
             {wmode:"opaque"},
         );
		 alert("ciao");
	 }
	</script>
 </head>
 <body onload="load()">
 <h1>Movie db - Trailer</h1>
	<div class="trailer_container" >
			<h1>Get Adobe Flash Player</h1>
			<p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
       
	</div>
 </body>
</html>