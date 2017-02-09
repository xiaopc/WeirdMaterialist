jQuery(document).ready(function($) { 
    /**
    * Remove empty nav
    */
    $(".btn").each(function(){
        if ( $(this).children().length === 0 ) $(this).remove();
    });

    /**
    * Apply side nav
    */
    $("#buttonCollapse").sideNav({
        menuWidth: 240,
        edge: 'left',
        closeOnClick: true
        }
      );
    
    /**
    * Add waves on navbar, add wave effect.
    * Holy shit!!! dropdown-button CAN NOT add wave effect!!!
    */
    dropdowncount = 0;
    navlink = $(".menu-item-has-children a:first");
    navlink.each(function(){
        ++dropdowncount;
        $(this).addClass("dropdown-button");
        $(this).attr("data-activates","dropdown" + dropdowncount.toString());
        $(this).append('<i class="material-icons right">arrow_drop_down</i>');
        thisnext = $(this).next();
        thisnext.attr("id","dropdown" + dropdowncount.toString());
        thisnext.addClass("dropdown-content");
        $(this).dropdown();
    });
    allnav = $("#nav-mobile li");
    allnav.each(function(){
        if (!( $(this).hasClass("menu-item-has-children") )) $(this).addClass("waves-effect waves-light");
    });

    /**
     * Add badget to comment name
    */
    $(".comment-author-admin .title a").after(' <i class="material-icons" style="color: #f9a825;font-size: 14px;">beenhere</i>');
    $(".bypostauthor .title a").after(' <i class="material-icons" style="color: #1976d2;font-size: 14px;">account_box</i>');
    
    /**
     * Loader
     */
    $("#loader").removeClass("active");
    window.onbeforeunload = (function(){
        $("#loader").addClass("active");
    });

    /** Upbtn
     */
    $("#topbtn").click(function(e) {
        $('body,html').animate({scrollTop:0},1000);
    });
    topbtn();

    
    /**
     * Conteng img box
     */
    $("article .card-content img.box").addClass("materialboxed");
    
	/**
	* Detect touch device
	*/
	if( is_touch_device() === false ){
		$('body').addClass( 'not-touch-device' );
	}

	/**
	* Scrolling state
	*/
	$(window).scroll( function(){

		var window_offset = $(window).scrollTop();

		// Adding scroll state
		if( window_offset > 5 ){
			$('body').addClass( 'scrolling' );
		} else {
			$('body').removeClass( 'scrolling' );			
		}
	});


	/**
	* Civil Footnotes Support
	* Slide the window instead of jumping it
	*/
	$('#main').on( 'click', 'a[rel="footnote"], a.backlink', function(e){
		e.preventDefault();
		var target_id = $(this).attr('href');
		var respond_offset = $(target_id).offset();

		$('html, body').animate({
			scrollTop : respond_offset.top - 100
		});
	});	
});

/**
* Detect touch device
*/
function is_touch_device() {
	return 'ontouchstart' in window // works on most browsers 
		|| 'onmsgesturechange' in window; // works on ie10
}

/**
 * topbtn
 */
function topbtn()
{
    jQuery(window).scroll(function(e) {
        if(jQuery(window).scrollTop()>100)
            jQuery("#topbtn").fadeIn(500);
        else
            jQuery("#topbtn").fadeOut(500);
    });
}
