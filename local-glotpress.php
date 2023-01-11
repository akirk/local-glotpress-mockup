<?php
/**
 * Plugin Name: Local GlotPress
 *
 */

add_action( 'admin_menu', function() {
	add_menu_page( 'Local GlotPress', 'GlotPress', 'read', 'glotpress', null, 'dashicons-translation' );
	add_submenu_page( 'Local GlotPress', 'Project List', 'Project List', 'read', 'glotpress', function() {
		global $wp_version;
		$plugins = apply_filters( 'local_glotpress_local_plugins', get_plugins() );
		$themes = apply_filters( 'local_glotpress_local_themes', get_themes() );
		require_once ABSPATH . 'wp-admin/includes/translation-install.php';
		$languages = wp_get_available_translations();
		$language = 'Unknown';
		if ( 'en_US' === get_user_locale() ) {
			$language = 'English (US)';
		} elseif ( isset( $languages[ get_user_locale() ] ) ) {
			$language = $languages[ get_user_locale() ]['english_name'];
		}
		?>
		<div class="wrap">
			<h1>Local GlotPress</h1>
			<p>These are the plugins and themes that you have installed locally. With GlotPress you can change the translations of these.</p>
			<table class="form-table">
				<tr>
					<th>Core</th>
					<td>WordPress <?php echo esc_html( $wp_version ); ?>
					<a href=""><?php echo esc_html( sprintf( 'Translate to %s', $language ) ); ?></a>
				</td>
				</tr>
				<tr>
					<th rowspan="<?php echo count( $plugins ); ?>">Plugins</th>
						<?php foreach ( $plugins as $slug => $plugin ) : ?>
							<td data-slug="<?php echo esc_attr( $slug ); ?>">
								<?php echo esc_html( $plugin['Name'] ); ?>
								<?php echo esc_html( $plugin['Version'] ); ?>
								<a href=""><?php echo esc_html( sprintf( 'Translate to %s', $language ) ); ?></a>
							<p class="description">
								<?php echo esc_html( wp_trim_words( $plugin['Description'] , 20 ) ); ?>
							</p>
						</td>
						</tr>
						<tr>
						<?php endforeach; ?>
				</tr>
				<tr>
					<th rowspan="<?php echo count( $themes ); ?>">Themes</th>
						<?php foreach ( $themes as $slug => $theme ) : ?>
							<td data-slug="<?php echo esc_attr( $slug ); ?>">
								<?php echo esc_html( $theme['Name'] ); ?>
								<?php echo esc_html( $theme['Version'] ); ?>
								<a href=""><?php echo esc_html( sprintf( 'Translate to %s', $language ) ); ?></a>
							<p class="description">
								<?php echo esc_html( wp_trim_words( $theme['Description'] , 20 ) ); ?>
							</p>
						</td>
						</tr>
						<tr>
						<?php endforeach; ?>
				</tr>
			</table>

			<button class="button-primary">Share your translations with WordPress.org</button>
		</div>
		<?php
	} );
});

