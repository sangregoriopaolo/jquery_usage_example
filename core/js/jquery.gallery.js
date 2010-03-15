(function($){
	$.fn.extend({
		Gallery: function(opt){
			var defaults={target: "#gallery",
						  close: "#galleryClose",
						  wrap: "#galleryWrap",
						  loader: "#galleryLoad",
						  onError: function(){$(this).Gallery.Close();},
						  expose: {color: '#555' },
						  timeout: 5000,
						};
										
			//extend default options
			opt=$.extend({},defaults,opt);
			
			var setEvent=function (obj,opt){
			  $.each(opt,function(tag,fn){
				  if(typeof(fn)=='function')
					{
					 $(obj).unbind(tag);
					 $(obj).bind(tag,fn);
					}
				});
			}
			
			setEvent(this,opt);
			
			//close handler
			var close_handler=function(){
				$(opt.target).expose().close();
				$(opt.target).fadeOut();
			}
			
		    this.Gallery.Close=function(){
				close_handler();
				return this;
			}
						
			//close event
			$(opt.close,opt.target).click(close_handler);
			
			$(opt.target).hover(function(){
				$(opt.close,opt.target).fadeIn();
			},function(){
				$(opt.close,opt.target).fadeOut();
			});
			
			var handler=this;
			
			this.each(function(){
			 //correct position
				var wHeight=($(window).height())/2;
				var wWidth=($(window).width())/2;
				var x=wWidth-($(opt.target).width()/2);
				$(opt.target).css("left",x);
		
				//open overlay
				$(opt.loader,opt.target).show();
				$(opt.close,opt.target).hide();
				$(opt.wrap,opt.target).hide();
				$(opt.wrap,opt.target).attr("src","");
				$(opt.target).fadeIn();
				$.extend(opt.expose,{api:true,closeOnClick: false, closeOnEsc: false,});
				$(opt.target).expose(opt.expose).load();
				
				//load image
				var img=new Image();
				
				img.onload=function(){
					clearTimeout(Timer);
				    //calc dimension
					var mWidth=img.width/2;
					var mHeight=img.height/2;
					x=wWidth-mWidth;
					var y=wHeight-mHeight;
					//apply dimension
					$(opt.target).animate({top: y,
														left: x,
														width: img.width,
														height: img.height,},500);
					//show image after animation finish
					$(opt.target).queue(function(){
						$(opt.loader,opt.target).fadeOut();
						$(opt.wrap,opt.target).attr("src",img.src);
						$(opt.wrap,opt.target).fadeIn("slow");
						$(opt.target).dequeue();
					});
					delete img;
				}
				img.onerror=function(){
					//close_handler();
					delete img;
				    $(handler).trigger("onError",{src: img.src,msg: "Unable to load image",});
				}
				img.src=$(this).attr("ref");	
				var Timer=setTimeout(function(){
					delete img;
				    $(handler).trigger("onError",{src: img.src,msg: "Unable to load image",});
				},opt.timeout);					
			});
			
			return this.Gallery;
		},
	});
	
})(jQuery);