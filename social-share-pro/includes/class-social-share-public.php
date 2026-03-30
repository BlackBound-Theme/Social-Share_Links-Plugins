<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Social_Share_Pro_Public {
	private $plugin_name;
	private $version;
	private $options;

	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->options = get_option( 'ssp_settings' );
	}

	public function enqueue_styles() {
		if ( ! is_singular() ) { return; }
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/public-style.css', array(), $this->version, 'all' );
	}

	public function enqueue_scripts() {
		if ( ! is_singular() ) { return; }
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( dirname( __FILE__ ) ) . 'public/js/public-script.js', array( 'jquery' ), $this->version, false );
	}

	public function add_inline_buttons( $content ) {
		if ( ! is_singular() || is_front_page() ) { return $content; }
		if ( isset( $this->options['inline_enabled'] ) && $this->options['inline_enabled'] === '1' ) {
			ob_start();
			include plugin_dir_path( dirname( __FILE__ ) ) . 'public/views/inline-buttons.php';
			$buttons_html = ob_get_clean();
			$content .= $buttons_html;
		}
		return $content;
	}

	public function add_floating_sidebar() {
		if ( ! is_singular() || is_front_page() ) { return; }
		if ( isset( $this->options['sidebar_enabled'] ) && $this->options['sidebar_enabled'] === '1' ) {
			include plugin_dir_path( dirname( __FILE__ ) ) . 'public/views/floating-sidebar.php';
		}
		
		// Add Demo Buy Now button
		if ( defined( 'SSP_DEMO_MODE' ) && SSP_DEMO_MODE ) {
			echo '<a href="https://www.codester.com/blackbound" target="_blank" class="ssp-demo-buy-btn">
				<svg viewBox="0 0 24 24" fill="currentColor"><path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.14 0-.25-.11-.25-.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.08-.14.12-.31.12-.48 0-.55-.45-1-1-1H5.21l-.94-2H1zm16 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/></svg>
				Buy Now
			</a>';
		}
	}
}
