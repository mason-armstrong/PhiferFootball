<?php
/**
 * Feature Bottom 
 * @package article lite
 */


if (   ! is_active_sidebar( 'fbottom1'  )
	&& ! is_active_sidebar( 'fbottom2' )
	&& ! is_active_sidebar( 'fbottom3'  )
	&& ! is_active_sidebar( 'fbottom4'  )		
		
	)

		return;
	// If we get this far, we have widgets. Let do this.
?>


	<div class="container-fluid">
  		<div class="row">
       
            <aside id="sidebar-feature-bottom" class="widget-area clearfix">
                   
                <?php if ( is_active_sidebar( 'fbottom1' ) ) : ?>
                    <div id="fbottom1" <?php article_lite_fbottom(); ?>>
                        <?php dynamic_sidebar( 'fbottom1' ); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ( is_active_sidebar( 'fbottom2' ) ) : ?>      
                    <div id="fbottom2" <?php article_lite_fbottom(); ?>>
                        <?php dynamic_sidebar( 'fbottom2' ); ?>
                    </div>         
                <?php endif; ?>
                
                <?php if ( is_active_sidebar( 'fbottom3' ) ) : ?>        
                    <div id="fbottom3" <?php article_lite_fbottom(); ?>>
                        <?php dynamic_sidebar( 'fbottom3' ); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ( is_active_sidebar( 'fbottom4' ) ) : ?>     
                    <div id="fbottom4" <?php article_lite_fbottom(); ?>>
                        <?php dynamic_sidebar( 'fbottom4' ); ?>
                    </div>
                 <?php endif; ?>
               </aside>         
    
      	</div>
	</div>    