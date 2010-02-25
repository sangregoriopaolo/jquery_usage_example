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
		<script type="text/javascript" src="js/jquery-ui.js"></script>
		<script type="text/javascript" src="js/jquery-tools.js"></script>
		<script type="text/javascript" src="js/main.js"></script>
		
		<style type="text/css">
		  body #gallery{
			 position: absolute;
			 z-index: 1000;
			 display: block;
			 background: #333;
			 top: 100px;
			 left:0px;
			 width: 200px;
			 height: 400px;
			}
			
			#gallery #galleryClose{
			 display: block;
			 float: right;
			 top: 0px;
			 height: 30px;
			 width: 100px;
			 left: 50%;
			 margin-left: -50px;
			 color: #fff;
			 font-weight: bold;
			 position: absolute;
			 text-align: center;
			 line-height: 30px;
			 background: #333;
			 background: rgba(100,100,100,0.6);
			 border: 1px solid #666;
			 -moz-border-radius: 5px;
			 -webkit-border-radius: 5px;
			 cursor: pointer;
			}
			
			#gallery #galleryLoad{
			position: absolute;
			left: 50%;
			top: 50%;
			margin-left: -25px;
			margin-top: -12px;
			}
		</style>
		<title>Movie DB</title>
	</head>
	
	<body>
		<div id="wrap">
			<div id="header">
				<div id="headerWrap">
					<img title="My Movies" alt="logo" src="img/logo.png" style="margin-left: 50px;">
					<div id="themeRoller">
						<span>Select theme:</span>
						<select style="width: 100px; border: none; color: #777;">
							<option>Classic</option>
							<option>Film</option>
						</select>
					</div>
				</div>
			</div>
			<!--end header-->
				
			<div id="container">

				<div id="sidebar">
					<div id="sidebarWrap">
					  <div class="sidebarButton sidebarActive" title="0"><span class="sidebarButtonText">My Film</span></div>
					  <div class="sidebarButton" title="1"><span class="sidebarButtonText">Favourites</span></div>
					</div>
				</div>
				<!--end sidebar-->
				
				<div id="contents">
					
					<div id="categories">
						<span id="new-movie">Add new movie</span>
									
						<span>Select category:</span>
						<select id="categories-list">
						</select>
						<span id="delete-category" style="display:none;">Delete category</span>
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
				
				<img id="galleryWrap"></img>
				
				<span id="galleryClose" style="display: none">Close</span>
				
				<img id="galleryLoad" alt="loader" src="./img/galleryLoad.gif"/>
			</div>
	
			<!--error ajax overlay -->
			<div id="ajax_error">
				<div>
					<h2>Errore</h2>
					<p id="error_desc">errrore imprevisto</p>
					<button class="close">Chiudi</button>
				</div>
  			</div>

		<!--end Jquery object-->
		
	</body>
</html>
