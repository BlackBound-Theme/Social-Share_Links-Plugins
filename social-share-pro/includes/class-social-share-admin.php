<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Social_Share_Pro_Admin {
	private $plugin_name;
	private $version;

	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	public function enqueue_styles( $hook_suffix ) {
		if ( 'toplevel_page_social-share-pro' !== $hook_suffix ) { return; }
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( dirname( __FILE__ ) ) . 'admin/css/admin-style.css', array(), $this->version, 'all' );
	}

	public function enqueue_scripts( $hook_suffix ) {
		if ( 'toplevel_page_social-share-pro' !== $hook_suffix ) { return; }
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( dirname( __FILE__ ) ) . 'admin/js/admin-script.js', array( 'jquery' ), $this->version, false );
	}

	public function add_plugin_admin_menu() {
		add_menu_page( 'Social Share Pro', 'Social Share Pro', 'manage_options', $this->plugin_name, array( $this, 'display_plugin_setup_page' ), 'dashicons-share', 80 );
	}

	public function register_settings() {
		register_setting( 'ssp_option_group', 'ssp_settings', array( $this, 'sanitize' ) );
		add_settings_section( 'ssp_setting_section', 'General Settings', null, 'ssp-settings-page' );
	}

	public function sanitize( $input ) {
		$new_input = array();
		if( isset( $input['platforms'] ) ) { $new_input['platforms'] = array_map( 'sanitize_text_field', $input['platforms'] ); }
		$new_input['inline_enabled'] = isset( $input['inline_enabled'] ) && $input['inline_enabled'] === '1' ? '1' : '0';
		$new_input['sidebar_enabled'] = isset( $input['sidebar_enabled'] ) && $input['sidebar_enabled'] === '1' ? '1' : '0';
		if( isset( $input['button_shape'] ) ) { $new_input['button_shape'] = sanitize_text_field( $input['button_shape'] ); }
		if( isset( $input['button_color_scheme'] ) ) { $new_input['button_color_scheme'] = sanitize_text_field( $input['button_color_scheme'] ); }
		return $new_input;
	}

	public function display_plugin_setup_page() {
		include_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/views/settings-page.php';
	}
}
