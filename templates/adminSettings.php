<div class="wrap">
	<h1 id="hsbe-heading"><?php _e('Hotel-Spider Booking Engine Settings', 'hotel-spider'); ?></h1>
	<div class="hsbe-error-msg-hide" id="hsbe-validation-error">
	</div>
	<?php settings_errors(); ?>

	<form id="hsbe-spider-booking" action="options.php" method="post">
		<?php
		settings_fields('hs_booking_engine_configuration');
		do_settings_sections('hs_booking_engine_settings');
		submit_button();
		?>
	</form>
</div>