<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Social_Share_Pro_Core {
	protected $plugin_name;
	protected $version;

	public function __construct() {
		$this->plugin_name = 'social-share-pro';
		$this->version = SOCIAL_SHARE_PRO_VERSION;

		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	private function load_dependencies() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-social-share-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-social-share-public.php';
	}

	private function define_admin_hooks() {
		$plugin_admin = new Social_Share_Pro_Admin( $this->get_plugin_name(), $this->get_version() );
		add_action( 'admin_menu', array( $plugin_admin, 'add_plugin_admin_menu' ) );
		add_action( 'admin_init', array( $plugin_admin, 'register_settings' ) );
		add_action( 'admin_enqueue_scripts', array( $plugin_admin, 'enqueue_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $plugin_admin, 'enqueue_scripts' ) );
	}

	private function define_public_hooks() {
		$plugin_public = new Social_Share_Pro_Public( $this->get_plugin_name(), $this->get_version() );
		add_action( 'wp_enqueue_scripts', array( $plugin_public, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $plugin_public, 'enqueue_scripts' ) );
		add_filter( 'the_content', array( $plugin_public, 'add_inline_buttons' ) );
		add_action( 'wp_footer', array( $plugin_public, 'add_floating_sidebar' ) );
	}

	public function run() {}
	public function get_plugin_name() { return $this->plugin_name; }
	public function get_version() { return $this->version; }
}
