jQuery(document).ready(function() {

        // SCROLL LOG BLOCK
        var logsBlock = document.getElementById( "logs-block" );
        if( logsBlock ) {
            logsBlock.scrollTop = 100000;
        }

        currentApi = jQuery('#general-options .chosen_api input:checked').val();
    
        /* SETTINGS TABS */
        jQuery(function(){
                jQuery('#tabs').tabs();
        });
	
	
	/* SELECT ALL */
	jQuery('#select-all-pt').click(function(event) {   
		if(this.checked) {
			// Iterate each checkbox
			jQuery('td.post-type :checkbox').each(function() {
				this.checked = true;                        
			});
		} else {
			jQuery('td.post-type :checkbox').each(function() {
				this.checked = false;                       
			});
		}
	});
	jQuery('#select-all-tx').click(function(event) {   
		if(this.checked) {
			// Iterate each checkbox
			jQuery('td.taxonomy :checkbox').each(function() {
				this.checked = true;                        
			});
		} else {
			jQuery('td.taxonomy :checkbox').each(function() {
				this.checked = false;                       
			});
		}
	});

    /* TAB CHOSEN */
    jQuery("#general-options .chosen_api input").change(function(){

            /* Rechecked the good input */
            if( jQuery('#general-options .chosen_api input:checked')
                    .not( "[value='youtube'], [value='shutterstock'], [value='gettyimages'], [value='unsplash']" )
                    .val() != null 
            ) {
                currentApi = jQuery('#general-options .chosen_api input:checked').val();
            }

            if( jQuery(this).val() == 'youtube' || 
                jQuery(this).val() == 'shutterstock' || 
                jQuery(this).val() == 'gettyimages' || 
                jQuery(this).val() == 'unsplash'  
            ) {
                    alert('Only available with the pro version');
                    jQuery("#general-options .chosen_api input[value='"+currentApi+"']")
                        .attr('checked',true);

                    return false;
            }

            var tab = '#'+jQuery(this).val();
            var link_tab = '.nav-tab-wrapper span[href="'+tab+'"]';

            jQuery(link_tab)
                .addClass("nav-tab-active")
                .css( "opacity", "1" )
                .removeAttr('disabled');
            jQuery(link_tab)
                .siblings()
                .removeClass("nav-tab-active")
                .css( "opacity", "0.4" )
                .attr('disabled', 'disabled');

            jQuery("#wpbody-content .form-table")
                .not(tab)
                .not('#general-options')
                .css("display", "none");
            jQuery(tab).fadeIn();

    });

    /* BASED ON */
    jQuery("#general-options .based_on input[type='radio']").change(function(){
            if( jQuery(this).val() == 'title' ) {
                    jQuery( ".section_title" ).show( 'slow' );
                    jQuery( ".section_text_analyser" ).hide( 'fast' );
                    jQuery( ".section_tags" ).hide( 'fast' );
                    jQuery( ".section_categories" ).hide( 'fast' );
                    jQuery( ".section_custom_field" ).hide( 'fast' );
            }
            
            if( jQuery(this).val() == 'text_analyser' ) {
                    jQuery( ".section_text_analyser" ).show( 'slow' );
                    jQuery( ".section_title" ).hide( 'fast' );
                    jQuery( ".section_tags" ).hide( 'fast' );
                    jQuery( ".section_categories" ).hide( 'fast' );
                    jQuery( ".section_custom_field" ).hide( 'fast' );
            }

            if( jQuery(this).val() == 'tags' ) {
                    alert('Only available with the pro version');
                    jQuery("#general-options .based_on input[value='title']").attr('checked',true);
            }

            if( jQuery(this).val() == 'categories' ) {
                    alert('Only available with the pro version');
                    jQuery("#general-options .based_on input[value='title']").attr('checked',true);
            }

            if( jQuery(this).val() == 'custom_field' ) {
                    alert('Only available with the pro version');
                    jQuery("#general-options .based_on input[value='title']").attr('checked',true);
            }

    });

    /* CRON */
    jQuery("#general-options .enable_cron input[type='radio']").change(function(){
            if( jQuery(this).val() == 'enable' ) {
                    alert('Only available with the pro version');
                    jQuery("#general-options .enable_cron input[value='disable']").attr('checked',true);
            }
    });
	
	/* PROXY */
    jQuery("#general-options .enable_proxy input[type='radio']").change(function(){
            if( jQuery(this).val() == 'enable' ) {
                    alert('Only available with the pro version');
                    jQuery("#general-options .enable_proxy input[value='disable']").attr('checked',true);
            }
    });

	/* FEATURED / POST IMAGE */
    jQuery("#general-options .image_location input[type='radio']").change(function(){

            if( ( jQuery(this).val() == 'post_top' ) || ( jQuery(this).val() == 'post_end' ) ) {
                    alert('Only available with the pro version');
                    jQuery("#general-options .image_location input[value='featured']").attr('checked',true);
            }
    });

    /* TITLE SELECTION */
    jQuery("#general-options .chosen_title input[type='radio']").change(function(){

            if( jQuery(this).val() == 'cut_title' ) {
                    jQuery( "input[name='MPT_plugin_main_settings[title_length]']" ).removeAttr('disabled');
            } else {
                    jQuery( "input[name='MPT_plugin_main_settings[title_length]']" ).attr('disabled', 'disabled');
            }
    });
	

    /* SELECTED IMAGES */
    jQuery("#general-options .selected_image input[type='radio']").change(function(){

            if( jQuery(this).val() == 'random_result' ) {
                    alert('Only available with the pro version');
                    jQuery("#general-options .selected_image input[value='first_result']").attr('checked',true);
            }

    });

    /* Google scrap domains textarea */
    jQuery('#restricted_domains').click(function() {
            alert('Only available with the pro version');
    }); 
    jQuery('#blacklisted_domains').click(function() {
            alert('Only available with the pro version');
    }); 
});