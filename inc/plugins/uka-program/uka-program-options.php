
<div class="wrap">
	<h1>UKA Program settings</h1>
	<form method="post" action="options.php">
	<?php settings_fields('uka-program-group'); ?>
	<?php do_settings_sections('uka-program-group'); ?>
		<table class="form-table">
			<tr>
				<th scope="row"><label for="eventgroup">Eventgroup ID</label></th>
				<td>
					<input name="eventgroup" type="number" min="1" step="1" id="eventgroup" value="<?php echo esc_attr(get_option('eventgroup')); ?>" class="tiny-text" />
				</td>
			</tr>
		</table>
		<p><a href="<?php echo home_url("billett"); ?>">Endre arrangementgruppe</a></p>
		<?php submit_button(); ?>
	</form>
</div>