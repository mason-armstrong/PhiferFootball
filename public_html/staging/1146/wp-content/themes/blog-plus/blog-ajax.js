jQuery(document).ready(function($) {

  
  /*------------------------------------------------
                        Blog  
    ------------------------------------------------*/
    var LBcontainer = $('#blog .section-content');

    var LBpageNumber = 1;

    function blog_plus_blog_load_latest_posts(){
        LBpageNumber++;

        $.ajax({
            type: "POST",
            dataType: "html",
            url: blog_plus_blog.ajaxurl,
            data: {action: 'blog_plus_blog_posts_ajax_handler',
                LBpageNumber: LBpageNumber,
            },
            success: function(data){               
                LBcontainer.append(data);             
            },
            error : function(jqXHR, textStatus, errorThrown) {
                $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }

        });

        return false;
    }

    $("#LBloadmore").click(function(e){ // When btn is pressed.
        e.preventDefault();
        blog_plus_blog_load_latest_posts();
    });

/*------------------------------------------------
                END JQUERY
------------------------------------------------*/

});