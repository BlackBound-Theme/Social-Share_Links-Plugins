<?php
if ( ! current_user_can( 'manage_options' ) ) {
	return;
}
if ( isset( $_GET['settings-updated'] ) ) {
	add_settings_error( 'ssp_messages', 'ssp_message', __( 'Settings Saved', 'social-share-pro' ), 'updated' );
}
settings_errors( 'ssp_messages' );
$options = get_option( 'ssp_settings' );
if ( ! is_array( $options ) ) $options = array();

$default_platforms = array( 'facebook', 'twitter', 'linkedin', 'whatsapp', 'pinterest', 'reddit' );
$active_platforms = isset( $options['platforms'] ) ? $options['platforms'] : $default_platforms;
?>
<div class="wrap ssp-admin-wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<p class="ssp-subtitle">Manage your social sharing preferences and design.</p>
	
	<div class="ssp-admin-container">
		<form action="options.php" method="post" class="ssp-admin-form">
			<?php
			settings_fields( 'ssp_option_group' );
			do_settings_sections( 'ssp_option_group' );
			?>
			
			<div class="ssp-card">
				<h2>Display Settings</h2>
				<table class="form-table">
					<tr>
						<th scope="row">Enable Inline Buttons</th>
						<td>
							<label class="ssp-switch">
								<input type="checkbox" name="ssp_settings[inline_enabled]" value="1" <?php checked( 1, isset( $options['inline_enabled'] ) ? $options['inline_enabled'] : 1, true ); ?>>
								<span class="ssp-slider round"></span>
							</label>
							<p class="description">Show share buttons at the bottom of the post content.</p>
						</td>
					</tr>
					<tr>
						<th scope="row">Enable Floating Sidebar</th>
						<td>
							<label class="ssp-switch">
								<input type="checkbox" name="ssp_settings[sidebar_enabled]" value="1" <?php checked( 1, isset( $options['sidebar_enabled'] ) ? $options['sidebar_enabled'] : 1, true ); ?>>
								<span class="ssp-slider round"></span>
							</label>
							<p class="description">Show sticky share buttons on the side of the screen.</p>
						</td>
					</tr>
				</table>
			</div>

			<div class="ssp-card">
				<h2>Platform Selection</h2>
				<p>Select which social networks to display.</p>
				<div class="ssp-platforms-grid">
					<?php foreach ( $default_platforms as $platform ) : ?>
						<label class="ssp-platform-checkbox p-<?php echo esc_attr( $platform ); ?>">
							<input type="checkbox" name="ssp_settings[platforms][]" value="<?php echo esc_attr( $platform ); ?>" <?php checked( true, in_array( $platform, $active_platforms ) ); ?>>
							<span class="platform-name"><?php echo ucfirst( esc_html( $platform ) ); ?></span>
						</label>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="ssp-card">
				<h2>Design Preferences</h2>
				<table class="form-table">
					<tr>
						<th scope="row">Button Shape</th>
						<td>
							<select name="ssp_settings[button_shape]">
								<option value="rounded" <?php selected( 'rounded', isset( $options['button_shape'] ) ? $options['button_shape'] : 'rounded' ); ?>>Rounded</option>
								<option value="square" <?php selected( 'square', isset( $options['button_shape'] ) ? $options['button_shape'] : '' ); ?>>Square</option>
								<option value="circle" <?php selected( 'circle', isset( $options['button_shape'] ) ? $options['button_shape'] : '' ); ?>>Circle</option>
							</select>
						</td>
					</tr>
					<tr>
						<th scope="row">Color Scheme</th>
						<td>
							<select name="ssp_settings[button_color_scheme]">
								<option value="official" <?php selected( 'official', isset( $options['button_color_scheme'] ) ? $options['button_color_scheme'] : 'official' ); ?>>Official Brand Colors</option>
								<option value="dark" <?php selected( 'dark', isset( $options['button_color_scheme'] ) ? $options['button_color_scheme'] : '' ); ?>>Sleek Dark</option>
								<option value="light" <?php selected( 'light', isset( $options['button_color_scheme'] ) ? $options['button_color_scheme'] : '' ); ?>>Minimal Light</option>
							</select>
						</td>
					</tr>
				</table>
			</div>

			<?php submit_button( 'Save All Settings', 'primary ssp-save-btn' ); ?>
		</form>
	</div>
</div>
