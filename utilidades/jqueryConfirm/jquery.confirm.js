(function($){
	
	$.confirm = function(params){
		
		if($('#confirmOverlay').length){
			// A confirm is already shown on the page:
			return false;
		}
		
		var buttonHTML = '';
		$.each(params.buttons,function(name,obj){
			
			// Generating the markup for the buttons:
			
			buttonHTML += '<a href="#" class="button '+obj['class']+'">'+name+'<span></span></a>';
			
			if(!obj.action){
				obj.action = function(){};
			}
		});
		
		var markup = [
			'<div id="confirmOverlay" class="gradvertical">',
                            '<div class="container_12">',
                                '<div id="confirmBox" class="grid_12 fondoplomoclaro">',
                                    '<div class=" prefix_1 suffix_1 grid_10 fondoazul"> <h1>',params.title,'</h1></div>',
                                    '<div class="prefix_1 suffix_1 alpha omega grid_10"><div class="esP grid_10">',params.message,'</div></div>',
                                    '<div id="confirmButtons" class="prefix_1 suffix_1 alpha omega grid_10">',buttonHTML,'</div>',
                        '</div></div></div>'
		].join('');
		
		$(markup).hide().appendTo('body').fadeIn();
		
		var buttons = $('#confirmBox .button'),
			i = 0;

		$.each(params.buttons,function(name,obj){
			buttons.eq(i++).click(function(){
				
				// Calling the action attribute when a
				// click occurs, and hiding the confirm.
				
				obj.action();
				$.confirm.hide();
				return false;
			});
		});
	}

	$.confirm.hide = function(){
		$('#confirmOverlay').fadeOut(function(){
			$(this).remove();
		});
	}
	
})(jQuery);