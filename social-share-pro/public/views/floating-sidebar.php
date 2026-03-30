<?php
// Ensure this file is loaded within WordPress
if ( ! defined( 'WPINC' ) ) {
	die;
}

$options           = get_option( 'ssp_settings' );
$active_platforms  = isset( $options['platforms'] ) ? $options['platforms'] : array( 'facebook', 'twitter', 'linkedin', 'whatsapp', 'pinterest', 'reddit' );
$button_shape      = isset( $options['button_shape'] ) ? $options['button_shape'] : 'rounded';
$color_scheme      = isset( $options['button_color_scheme'] ) ? $options['button_color_scheme'] : 'official';

$post_url   = urlencode( get_permalink() );
$post_title = urlencode( get_the_title() );

$share_links = array(
	'facebook'  => "https://www.facebook.com/sharer/sharer.php?u={$post_url}",
	'twitter'   => "https://twitter.com/intent/tweet?text={$post_title}&url={$post_url}",
	'linkedin'  => "https://www.linkedin.com/shareArticle?mini=true&url={$post_url}&title={$post_title}",
	'whatsapp'  => "https://api.whatsapp.com/send?text={$post_title}%20{$post_url}",
	'pinterest' => "https://pinterest.com/pin/create/button/?url={$post_url}&description={$post_title}",
	'reddit'    => "https://reddit.com/submit?url={$post_url}&title={$post_title}"
);

$icons = array(
	'facebook'  => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.04c-5.5 0-10 4.49-10 10.02 0 5 3.65 9.12 8.43 9.87v-6.98h-2.53v-2.89h2.53v-2.2c0-2.5 1.5-3.88 3.77-3.88 1.09 0 2.23.19 2.23.19v2.45h-1.25c-1.24 0-1.63.77-1.63 1.56v1.88h2.78l-.44 2.89h-2.34v6.98C18.34 21.18 22 17.06 22 12.06c0-5.53-4.5-10.02-10-10.02z"/></svg>',
	'twitter'   => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98-3.56-.18-6.73-1.89-8.84-4.48-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.9 3.56-.71 0-1.37-.2-1.95-.5v.05c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.52 8.52 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/></svg>',
	'linkedin'  => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-11.5 6h-3v9h3V9m-1.5-3.5c-.9 0-1.5.6-1.5 1.4 0 .8.6 1.4 1.5 1.4s1.5-.6 1.5-1.4c0-.8-.6-1.4-1.5-1.4m11 7.1c0-2.8-1.5-4.1-3.5-4.1-1.6 0-2.3.9-2.7 1.5V9h-3v9h3v-5c0-1.3.3-2.6 1.9-2.6 1.6 0 1.6 1.5 1.6 2.7v4.9h3v-5.6z"/></svg>',
	'whatsapp'  => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.47 16.3c-.2.6-1.18 1.15-1.67 1.25-.43.08-.98.15-2.87-.63-2.27-.93-3.71-3.23-3.83-3.38-.11-.15-.92-1.22-.92-2.33s.58-1.64.79-1.87c.2-.23.44-.28.59-.28.15 0 .31.01.44.02.14.01.32-.05.49.36.18.43.6 1.48.65 1.58.05.1.09.22.02.37-.08.15-.12.24-.24.38-.11.14-.24.3-.34.42-.11.13-.23.27-.1.49.12.22.54.91 1.16 1.47.8.72 1.47.95 1.68 1.05.22.1.34.08.47-.06.13-.14.54-.63.69-.85.15-.22.3-.18.5-.11.21.07 1.31.62 1.53.73.23.11.38.16.44.25.06.09.06.52-.14 1.1zM12 20.35c-1.45 0-2.87-.39-4.12-1.13l-.3-.18-3.07.8.82-2.99-.19-.31a8.33 8.33 0 0 1-1.26-4.47c0-4.63 3.77-8.4 8.4-8.4s8.4 3.77 8.4 8.4c0 4.64-3.77 8.4-8.4 8.4m0-10.22z"/><path d="M12 2C6.48 2 2 6.48 2 12c0 1.76.46 3.42 1.25 4.88L2 22l5.3-1.4A9.9 9.9 0 0 0 12 22c5.52 0 10-4.48 10-10S17.52 2 12 2z"/></svg>',
	'pinterest' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.1C6.5 2.1 2 6.6 2 12.1c0 4.2 2.6 7.9 6.4 9.3-.1-.8-.2-2 0-2.9.2-.8 1.3-5.4 1.3-5.4s-.3-.6-.3-1.6c0-1.5.9-2.6 2-2.6 1 0 1.5.7 1.5 1.6 0 1-.6 2.5-.9 3.9-.3 1.1.6 2 1.6 2 2 0 3.5-2.1 3.5-5.1 0-2.7-1.9-4.5-4.6-4.5-3.1 0-4.9 2.3-4.9 4.7 0 1 .4 2 1 2.6.1.1.1.3.1.4l-.3 1.3c0 .2-.2.2-.4.1-1.4-.7-2.3-2.8-2.3-4.5 0-3.7 2.7-7.1 7.7-7.1 4 0 7.1 2.9 7.1 6.7 0 4-2.5 7.2-6 7.2-1.2 0-2.3-.6-2.6-1.3 0 0-.6 2.2-.7 2.7-.2.9-.8 2-1.2 2.7 1.1.3 2.3.5 3.5.5 5.5 0 10-4.5 10-10S17.5 2.1 12 2.1z"/></svg>',
	'reddit'    => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M22 11.5c0-1.4-1.1-2.5-2.5-2.5-.9 0-1.6.4-2 1a12.1 12.1 0 0 0-5.3-1.5l1.1-5.1 3.5.7c.1 1 1 1.9 2.1 1.9 1.2 0 2.2-1 2.2-2.2 0-1.2-1-2.2-2.2-2.2-.8 0-1.6.5-2 1.2l-4-.8c-.3 0-.6.2-.6.5l-1.3 6.1c-2.4.1-4.7.7-6.2 1.8-.4-.7-1.2-1.1-2.1-1.1-1.4 0-2.5 1.1-2.5 2.5 0 1 .6 1.9 1.5 2.3-.1.3-.1.6-.1.9 0 3.5 3.9 6.4 8.6 6.4s8.6-2.9 8.6-6.4c0-.3 0-.6-.1-.9.9-.4 1.5-1.3 1.5-2.3zm-14.7 2c.9 0 1.6.7 1.6 1.6s-.7 1.6-1.6 1.6-1.6-.7-1.6-1.6.7-1.6 1.6-1.6zm7.2 4.1c-1 .8-2.6 1-3.6 1-1.1 0-2.6-.2-3.6-1-.2-.2-.2-.5 0-.7.2-.2.5-.2.7 0 .5.5 1.6.6 2.9.6s2.4-.1 2.9-.6c.2-.2.5-.2.7 0 .2.2.2.5 0 .7zm-.6-2.5c-.9 0-1.6-.7-1.6-1.6s.7-1.6 1.6-1.6 1.6.7 1.6 1.6-.7 1.6-1.6 1.6z"/></svg>'
);
?>

<div class="ssp-floating-container ssp-theme-<?php echo esc_attr( $color_scheme ); ?> ssp-shape-<?php echo esc_attr( $button_shape ); ?>">
	<?php 
	// DEMO LOGO HOOK
	if ( defined( 'SSP_DEMO_MODE' ) && SSP_DEMO_MODE ) {
		echo '<div class="ssp-demo-logo-wrap"><img src="' . plugin_dir_url( dirname( dirname( __FILE__ ) ) ) . 'assets/img/blank-logo-placeholder.png" alt="Blackbound Logo" class="temp-demo-logo"></div>';
	}
	?>
	<div class="ssp-button-wrap-vertical">
		<?php foreach ( $active_platforms as $platform ) : 
			if ( ! isset( $share_links[ $platform ] ) ) continue;
		?>
			<a href="<?php echo esc_url( $share_links[ $platform ] ); ?>" class="ssp-btn ssp-<?php echo esc_attr( $platform ); ?>" target="_blank" rel="noopener noreferrer" aria-label="Share on <?php echo ucfirst( esc_attr( $platform ) ); ?>">
				<?php echo $icons[ $platform ]; ?>
			</a>
		<?php endforeach; ?>
	</div>
</div>
