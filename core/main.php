<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link type="text/css" rel="stylesheet" href="css/reset.css" >
		<link type="text/css" rel="stylesheet" href="css/overlay-apple.css">
		<!--themeroller css-->
		<link type="text/css" rel="stylesheet" href="themes/Classic/css/main.css" >
		<link type="text/css" rel="stylesheet" href="themes/Classic/css/sidebar.css" >
		<link type="text/css" rel="stylesheet" href="themes/Classic/css/table.css" >
		<!--favicon-->
	    <link rel="icon" type="image/x-icon" href="./img/favicon.png" />
	    <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.png"/>
		
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.ui.js"></script>
		<script type="text/javascript" src="js/jquery.tools.js"></script>
		<script type="text/javascript" src="js/swfobject.js"></script>
		<script type="text/javascript" src="js/jquery.gallery.js"></script>
		<script type="text/javascript" src="js/main.js"></script>


		<title>Movie DB</title>
	</head>
	
	<body>
		<div id="wrap">
			<div id="header">
				<div id="headerWrap">
					<img title="My Movies" alt="logo" src="img/logo.png" style="margin-left: 50px;">
					
				</div>
			</div>
			<!--end header-->
				
			<div id="container">

				<div id="sidebarWrap">
					<div class="sidebarButton sidebarActive" ref="0" title="My Film"><span class="sidebarButtonText">My Film</span></div>
					<div class="sidebarButton" ref="1" title="Favourites"><span class="sidebarButtonText">Favourites</span></div>
				</div>
				<!--end sidebar-->
				
				<div id="contents">
					
					<div id="categories">
						<span id="new-movie">Add new movie</span>
									
						<span>Select category:</span>
						<select id="categories-list">
						</select>
						<span id="delete-category" >Delete category</span>
					</div>
					<!--end categories-->
					
					<div id="contents-body">
					
					</div>
					<!--end contents-body-->
					
				</div>
				<!--end contents-->
				
			</div>
			<!--end container-->
			
			<div id="footer">
				<span>Ideated and Developed by: Simone Micheli &amp; Paolo Sangregorio</span>
			</div>
			<!--end footer-->

		</div>
		<!--end wrap-->
		
		<!--jQuery object-->
			<!--ajax loader-->
			<div class="ajax-loader">
				<p>Loading Data...</p>
				<img alt="ajax-loader" src="img/ajax-loader.gif" style="margin-top:2px">
			</div>
			
			<!-- overlayed element --> 
    		<div class="apple_overlay" id="overlay"> 
 
     			 <!-- the external content is loaded inside this tag --> 
      			<div class="contentWrap"></div> 
 
    		</div>
			
			<!--gallery-->
			<div id="gallery" style="display: none">
				
				<!-- the external image is loaded inside this img tag-->
				<img id="galleryWrap" alt="external image"/>
				
				<span id="galleryClose" style="display: none">Close</span>
				
				<img id="galleryLoad" alt="loader" src="./img/galleryLoad.gif"/>
			</div>
	
			<!--error ajax overlay -->
			<div id="ajax_error">
				<div>
					<h2>Errore</h2>
					<p id="error_desc">Errrore imprevisto</p>
					<button class="close">Chiudi</button>
				</div>
  			</div>

		<!--end jQuery object-->
		
	</body>
</html>
