
<div class="wrap">
	<h1>UKA SEO settings</h1>
	<form method="post" action="options.php">
	<?php settings_fields('uka-seo-group'); ?>
	<?php do_settings_sections('uka-seo-group'); ?>
		<h2>Facebook</h2>
		<table class="form-table">
			<tr>
				<th scope="row"><label for="fb-app-id">App ID</label></th>
				<td>
					<input name="fb-app-id" type="text" id="fb-app-id" value="<?php echo esc_attr(get_option('fb-app-id')); ?>" class="regular-text" />
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="fb-admins">Admins</label></th>
				<td>
					<input name="fb-admins" type="text" id="fb-admins" aria-describedby="tagline-description" value="<?php echo esc_attr( get_option('fb-admins')); ?>" class="regular-text" />
					<p class="description" id="tagline-description"><?php _e('Comma delimited.') ?></p>
				</td>
			</tr>
		</table>
		
		<h2>Google</h2>
		<table class="form-table">
			<tr>
				<th scope="row"><label for="google-tracking-id">Tracking ID</label></th>
				<td>
					<input name="google-tracking-id" type="text" id="google-tracking-id" value="<?php echo esc_attr(get_option('google-tracking-id')); ?>" class="regular-text" />
				</td>
			</tr>
		</table>
		<?php submit_button(); ?>
	</form>
</div>