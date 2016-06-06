// ==== CORE ==== //

//open the become a mystery shopper tab
;(function($){
	$(document).ready(function () {
	    var hash = window.location.hash;
	    console.log(hash);
	    if (hash == '#become-a-mystery-shopper'){
		    $('a[href="#shopping-tabs-2"]').click(); // after you've bound your click listener
	    }
	});
}(jQuery));

