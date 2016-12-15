
<div class="wrap">
	<h1>UKA Panels settings</h1>
	<form method="post" action="options.php">
	<?php settings_fields('uka-panels-group'); ?>
	<?php do_settings_sections('uka-panels-group'); ?>
		<table class="form-table">
			<tr>
				<th scope="row"><label for="panels">Number of panels</label></th>
				<td>
					<input name="panels" type="number" min="0" step="1" id="panels" value="<?php echo esc_attr(get_option('panels')); ?>" class="tiny-text" />
				</td>
			</tr>
		</table>
		<?php submit_button(); ?>
	</form>
</div>