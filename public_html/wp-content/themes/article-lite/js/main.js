jQuery(document).ready(function($) {
  
	if ($(window).width() > 900){
        jQuery('.stickey_wrap_main_cont, .sidebar_stickey_wrap')
            .theiaStickySidebar({
                additionalMarginTop: 30
            });
	}
    
    // for search show hide header
  $(".article_search").click(function(){
    $(".header_search_form").toggleClass("slow_search_header");
    return false;
  });
  $(".header_search_close").click(function(){
    $(".header_search_form").toggleClass("slow_search_header");
  });


  jQuery(function($) {
      $('.menu-item a').focus( function () {
        $(this).parents('.sub-menu').parent('li').addClass('focus');
      }).blur(function(){
        $(this).siblings('.sub-menu').removeClass('focused');
        $(this).parents('.menu-item-has-children').addClass('focus');
        $('.menu-item-has-children a').not(this).parent().removeClass('focus');
        $(this).parents('li').addClass('focus');
      });
     
    // Sub Menu
      $('.sub-menu a').focus( function () {
        $(this).parents('.sub-menu').parent('li').addClass('focus');
      }).blur(function(){
        $(this).parents('.sub-menu').removeClass('focused');
        $(this).parents('.menu-item-has-children').addClass('focus');
        //$('.menu-item-has-children a').not(this).parents().removeClass('focus');
      });
    });

  

});