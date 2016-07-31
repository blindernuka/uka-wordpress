<?php
/**
 * UKA Customizer functionality
 *
 * @package WordPress
 * @subpackage UKA
 * @since UKA 1.0
 */

function uka_custom_header() {
$defaults = array(
	'default-image'          => '',
	'width'                  => 0,
	'height'                 => 0,
	'flex-height'            => false,
	'flex-width'             => false,
	'uploads'                => true,
	'random-default'         => false,
	'header-text'            => true,
	'default-text-color'     => '',
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support('custom-header');
}
add_action( 'after_setup_theme', 'uka_custom_header');


function uka_custom_background() {
	add_theme_support('custom-background');
}
add_action( 'after_setup_theme', 'uka_custom_background');

function uka_custom_logo() {
	add_theme_support('custom-logo');
}
add_action( 'after_setup_theme', 'uka_custom_logo');


function uka_footer_customizer( $wp_customize ) {
	
	$wp_customize->add_section(
		'uka_footer_section', 
		array(
			'title'       => __( 'Footer', 'uka' ),
			'priority'    => 1000,
			'description' => '',
		)
	);

	$wp_customize->add_setting('uka_footer_logo');
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 
			'uka_footer_logo', 
			array(
				'label'    => __( 'Logo', 'uka' ),
				'section'  => 'uka_footer_section',
				'settings' => 'uka_footer_logo',
			)
		)
	);
		
		
	$wp_customize->add_setting('uka_footer_credits');
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 
			'uka_footer_credits', 
			array(
				'label'    => __( 'Credits', 'uka' ),
				'section'  => 'uka_footer_section',
				'settings' => 'uka_footer_credits',
			)
		)
	);
	
	$wp_customize->add_setting('uka_footer_copyright');
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 
			'uka_footer_copyright', 
			array(
				'label'    => __( 'Copyright', 'uka' ),
				'section'  => 'uka_footer_section',
				'settings' => 'uka_footer_copyright',
			)
		)
	);

}

add_action( 'customize_register', 'uka_footer_customizer' );





























