<?php
$techup_enable_callout_section1 = get_theme_mod( 'techup_enable_callout_section1', false );
$techup_co1_image = get_theme_mod( 'techup_co1_image' );

if($techup_enable_callout_section1 == true ) {
$techup_callout_title1 = get_theme_mod( 'techup_callout_title1');
$techup_callout_content1 = get_theme_mod( 'techup_callout_content1');
if($techup_co1_image=="")
{
	$techup_co1_image = esc_url(  get_template_directory_uri() . '/assets/images/banner.jpg' ); 
}
?>
 <section class="cta-7">
	<div class="container-fluid p-0">
		<div class="row">
			<div class="col-md-6">
			  <div class="cta-body">
				<h3 class="c-white"><?php echo esc_html($techup_callout_title1); ?></h3>
				<p class="c-white"><?php echo esc_html($techup_callout_content1); ?></p>
			  </div>
			</div>
			<div class="col-md-6">
			  <div class="cta-img">
				<img src="<?php echo esc_url($techup_co1_image); ?>">
			  </div>
			</div>
		</div>
	</div>
</section>

<?php } ?>