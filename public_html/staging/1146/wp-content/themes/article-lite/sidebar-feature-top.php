<?php
/**
 * Feature Bottom 
 * @package article lite
 */


if (   ! is_active_sidebar( 'ftop1'  )
	&& ! is_active_sidebar( 'ftop2' )
	&& ! is_active_sidebar( 'ftop3'  )	
		
	)

		return;
	// If we get this far, we have widgets. Let do this.
?>


	<div class="container-fluid">
  		<div class="row">
       
            <aside id="sidebar-feature-top" class="widget-area clearfix">
                   
                <?php if ( is_active_sidebar( 'ftop1' ) ) : ?>
                    <div id="ftop1" <?php article_lite_ftop(); ?>>
                        <?php dynamic_sidebar( 'ftop1' ); ?>
                    </div>
                <?php endif; ?>
                
                <?php if ( is_active_sidebar( 'ftop2' ) ) : ?>      
                    <div id="ftop2" <?php article_lite_ftop(); ?>>
                        <?php dynamic_sidebar( 'ftop2' ); ?>
                    </div>         
                <?php endif; ?>
                
                <?php if ( is_active_sidebar( 'ftop3' ) ) : ?>        
                    <div id="ftop3" <?php article_lite_ftop(); ?>>
                        <?php dynamic_sidebar( 'ftop3' ); ?>
                    </div>
                <?php endif; ?>
                
               </aside>         
    
      	</div>
	</div>    