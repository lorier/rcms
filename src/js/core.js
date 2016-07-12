// ==== CORE ==== //

//open the become a mystery shopper tab
;(function($){
	$(document).ready(function () {

		//get the hash if there is one
	    var hash = window.location.hash;

	    //run the function to select the correct tab
	    test_hash(hash);
	    
	    //if you click the Becoming a Mystery shopper nav item, also run the function to select the correct tab
	    $('#menu-item-194').on('click', function(e){
	    	test_hash(hash);
	    })

	    //if you click the tab, make sure the BCAMS nav item is highlighted or not
	    $('.tabs > li a').on('click', function(){
	    	var tabClick = $(this).attr("href");
			if (tabClick == "#shopping-tabs-2"){
				$('#menu-item-194').addClass('current-menu-item');
			}else{
				$('#menu-item-194').removeClass('current-menu-item');
			}
		})
	});
	
	function test_hash(hash){
	    if (hash == '#become-a-mystery-shopper'){

	    	//activate the second tab
		    $('a[href="#shopping-tabs-2"]').click(); // after you've bound your click listener

		    //make the 'become a mysery shopper' menu item active (orange)
		    $('#menu-item-194').addClass('current-menu-item');
	    }
	    hash = null;
	}

}(jQuery));

