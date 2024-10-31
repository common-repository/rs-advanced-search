<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://ratkosolaja.info/
 * @since      1.0.0
 *
 * @package    RS_Advanced_Search
 * @subpackage RS_Advanced_Search/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap rs-plugin-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="rs-page-header">
					<h1 class="rs-page-heading"><?php _e( 'RS Advanced Search', 'rs-advanced-search' ); ?></h1>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				<div class="rs-box">
					<div class="rs-box-title">
						<h3><?php _e( 'Settings', 'rs-advanced-search' ); ?></h3>
					</div>
					<div class="rs-box-container">
						<form method="post" action="options.php">
							<?php
								settings_fields( 'rs-advanced-search-settings' );
								do_settings_sections( 'rs-advanced-search-settings' );
								submit_button();
							?>
						</form>
					</div>
				</div>
				<div class="rs-box">
					<div class="rs-box-title">
						<h3><?php _e( 'Customization', 'rs-advanced-search' ); ?></h3>
					</div>
					<div class="rs-box-container">
						<p><?php _e( 'If you want to use Advanced Search anywhere on the website, you can use our shortcode:', 'rs-advanced-search' ); ?></p>
						<input type="text" value="[rs-advanced-search]" readonly>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
				<div class="rs-box">
					<div class="rs-box-title">
						<h3><?php _e( 'Subscribe', 'rs-advanced-search' ); ?></h3>
					</div>
					<div class="rs-box-container">
						<p><?php _e( 'This plugin as well some others that will come are coded with the best pratices in mind. Sign up to be notified when we release a new plugin.', 'rs-advanced-search' ); ?></p>
						<!-- Begin MailChimp Signup Form -->
						<div id="mc_embed_signup">
							<form action="//ratkosolaja.us6.list-manage.com/subscribe/post?u=ed91120c333b3927a45945822&amp;id=69eb9bce3b" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
								<div id="mc_embed_signup_scroll">
									<div class="mc-field-group">
										<label for="mce-EMAIL">Email Address </label>
										<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
									</div>
									<div class="mc-field-group">
										<label for="mce-FNAME">First Name </label>
										<input type="text" value="" name="FNAME" class="" id="mce-FNAME">
									</div>
									<div class="mc-field-group">
										<label for="mce-LNAME">Last Name </label>
										<input type="text" value="" name="LNAME" class="" id="mce-LNAME">
									</div>
									<div id="mce-responses" class="clear">
										<div class="response" id="mce-error-response" style="display:none"></div>
										<div class="response" id="mce-success-response" style="display:none"></div>
									</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
									<div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_ed91120c333b3927a45945822_69eb9bce3b" tabindex="-1" value=""></div>
									<div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button button-primary"></div>
								</div>
							</form>
						</div>

						<!--End mc_embed_signup-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>