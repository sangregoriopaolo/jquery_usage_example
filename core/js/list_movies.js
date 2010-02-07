 $(document).ready(function(){
  var count=0;	
	
   $(".movie_drag").draggable({
	   revert: 'invalid',
	   scroll: 'false',
	   cursor: 'move',
	   cursorAt: { top: -5, left: -5 },
	   helper: function(event) {
		   return $('<div class="helper">Titolo: '+$('.movie_title',this).html()+'</div>');
	   }

	 });
	 
	 $(".trash").droppable({
	   accept: '.movie_drag',
	   activeClass: 'trash_active',
	   drop: function(event,ui){
		   ui.draggable.fadeOut();
		   count=count+1;
		   $(".trash .count").html(count);
		   //$.print(ui.draggable.serializeArray());
	   },
	 });
	
	//set default option for overlay
	overlay=$("#overlay").overlay({
	 	api: true,
		oneInstance: true,
		top: '2%',
		expose: '#ddd',
		effect: 'apple',
	});
	
	 //set default option for ajax request
	 $.ajaxSetup({
	    timeout: 5000,
	 });
	 
	 $(".ajax-loader").ajaxSend(function(){
	   $(this).fadeIn();
	 });
	 
	 $(".ajax-loader").ajaxComplete(function(){
	  $(this).fadeOut({speed: 'fast',});
	 });
	 
	 //load ajax request 
	 $('#new_movie').click(function(event){
	 	event.preventDefault();
		$.ajax({
			dataType: 'html',
			type: 'GET',
			url: $(this).attr("href"),
			success: function(data,status,XHR){
				overlay.getOverlay().find(".contentWrap").html(data);
				overlay.load();
			},
			error: function(XHR,Status){
			  ajax_error(status+" code: "+XHR.status+" description: "+XML.statusText);
			},
		});
	 });
	 
	 function ajax_error(msg){
	   	$("#ajax_error p:first").text(msg);
			$("#ajax_error").overlay({api: true,}).load();
	 }
 });