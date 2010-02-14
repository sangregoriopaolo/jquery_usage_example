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
 
function delete_movie(movie_id) {
     if(confirm("Do you really want to delete this movie?")) {
         movieContent = jQuery("#movie_" + movie_id).html();
         jQuery.ajax({
                      type: 'POST',
                      url: 'db_delete_movie.php?movie_id=' + movie_id,
                      dataType: 'json',
                      beforeSend: function() {
                          jQuery("#movie_" + movie_id).css("background-color", "#FFAAAA");
                          jQuery("#movie_" + movie_id).html("<li>Deleting movie..</li>");
                      },
                      error: function(data, text_status, XHR) {
                          jQuery("#movie_" + movie_id).css("background-color", "");
                          jQuery("#movie_" + movie_id).html(movieContent);
                          alert("Unable to delete this movie");
                      },
                      success: function(data, text_status, XHR) {
                          if(data.status == 'ok') {
                              jQuery("#movie_" + movie_id).slideUp();
                          }
                      }
	                });
    }
}