//document ready
	//$(document).ready(function() {
	
		
	//})
//document ready ends





(function(){
  "use strict";
 $(function () {
        $("[rel='tooltip']").tooltip();
    });
	
	$(document).ready(function() {
		$('.nav-collapse').click(function(){
			$(this).toggleClass('open');
			$('.rightNav').toggleClass('active');
		});
		
	});
	
})();

// Non-strict code... 


