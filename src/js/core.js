// ==== CORE ==== //

//open the become a mystery shopper tab
;(function($){
	$(document).ready(function () {

		//get the hash if there is one
	    var hash = window.location.hash;

	    //if you select the BAMS menu item, select the tab and add the hash
	    if (hash == '#become-a-mystery-shopper'){
	   		select_becoming_ams(hash);
	   	//if you are getting to the page any other way, you'll land on the MSFB tab, so remove the orange highlight from the BAMS menu item
	   	}else if ( $('#menu-item-194').hasClass('current-menu-item') ) {
	    	$('#menu-item-194').removeClass('current-menu-item');
	    }
	   
	    //if you click the BAMS menu item run the function to select the correct tab
	    $('#menu-item-194').on('click', function(e){
	    	select_becoming_ams(hash);
	    	if ( $('#menu-item-194').hasClass('current-menu-item') ) {
	    		return;
	    	}else{
	    		$('#menu-item-194').addClass('current-menu-item');
	    	}
	    })

		//if you click the BAMS tab, make sure the BCAMS nav item is highlighted
	    $('.iw-so-tab-title a').on('click', function(){
	    	var tabClick = $(this).attr("href");
			if (tabClick == "#shopping-tabs-2-content"){
				$('#menu-item-194').addClass('current-menu-item');
			}else{
				$('#menu-item-194').removeClass('current-menu-item');
			}
		})
	});
	
	function select_becoming_ams(hash){
    	//activate the second tab
	    $('a[href="#shopping-tabs-2-content"]').click(); // after you've bound your click listener
	}

}(jQuery));

