<?php
add_action( 'admin_menu', 'gatsby_form_add_admin_menu' );
add_action( 'admin_init', 'gatsby_form_settings_init' );


function gatsby_form_add_admin_menu() { 
	add_menu_page(
		'Gatsby Forms', // page_title
		'Gatsby Forms', // menu_title
		'manage_options', // capability
		'gatsby_forms', // menu_slug
		'gatsby_forms_options_page', // function
		'dashicons-admin-generic' // icon_url
	);
}

function gatsby_form_settings_init(  ) { 

	register_setting( 'gatsbyPluginPage', 'gatsby_form_settings' );

	add_settings_section(
		'gatsby_form_pluginPage_section', 
		__( '', 'wp-tracking' ), 
		'gatsby_form_settings_section_callback', 
		'gatsbyPluginPage'
	);
	add_settings_field( 
		'gatsby_email_to', 
		__( 'Send Email To', 'wp-gatsby' ), 
		'gatsby_email_to_address', 
		'gatsbyPluginPage', 
		'gatsby_form_pluginPage_section' 
	);
}


function gatsby_email_to_address(  ) { 
	$options = get_option( 'gatsby_form_settings' );
	?>
	<input class="large" type="email" id="gatsby_email_to" placeholder="" name="gatsby_form_settings[gatsby_email_to_address]" value="<?php echo $options['gatsby_email_to_address']; ?>"/>
	<?php
}

function gatsby_form_settings_section_callback() {
	// redirect();
	// commits();
}


function gatsby_forms_options_page(  ) { 

		?>
		<form action='options.php' method='post'>

			<h1>Gatsby Form Settings</h1>

			<?php
			settings_fields( 'gatsbyPluginPage' );
			do_settings_sections( 'gatsbyPluginPage' );
			submit_button();
			?>

		</form>
		<?php

}
