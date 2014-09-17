<?php
/*
Plugin Name: Light - Responsive LightBox
Plugin URI: http://bryceadams.com/
Description: Automatically makes all images that link to other images into a responsive lightbox, using FancyBox from FancyApps.
Author: Captain Theme
Author URI: http://bryceadams.com/
Version: 1.0
License: GPL
*/

/*
|--------------------------------------------------------------------------
| SCRIPTS/STYLES
|--------------------------------------------------------------------------
*/

function light_load_scripts() {
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'fancybox', plugin_dir_url( __FILE__ ) . 'js/jquery.fancybox.pack.js', array( 'jquery' ), false, true );
	wp_enqueue_style( 'fancybox-style', plugin_dir_url( __FILE__ ) . 'css/jquery.fancybox.css' );
}
add_action('wp_enqueue_scripts', 'light_load_scripts');

function light_load_inline_script() {
	if ( wp_script_is( 'fancybox', 'done' ) ) {

		// 'light_fancy_classes' Hook for easy filtering of the classes that fancybox gets applied to
		$fancybox_class = apply_fitlers( 'light_fancy_classes', array(
			'.fancybox',
		) );

		?>
		<script type="text/javascript">
		(function ($) {
			'use strict';

			// Make all images that link to images into a lightbox
			$("a[href$='.jpg'],a[href$='.png'],a[href$='.gif'],a[href$='.jpeg']").fancybox();

			// Make all images within a Wordpress gallery that link to an image into a lightbox gallery
			$(".gallery a[href$='.jpg'],.gallery a[href$='.png'],.gallery a[href$='.gif'],.gallery a[href$='.jpeg']").attr('rel', 'gallery');

			// Make all items in the $fancybox_class var into a lightbox
			$("<?php echo $fancybox_class; ?>").fancybox();

		})(jQuery);
		</script>
		<?php
	}
}
add_action( 'wp_footer', 'light_load_inline_script', 20 );