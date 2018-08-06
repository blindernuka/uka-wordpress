<?php
/**
 * UKA Customizer functionality
 *
 * @package WordPress
 * @subpackage UKA
 * @since UKA 1.0
 */


$DEFAULTS = array(
	'BACKGROUND_COLOR' => '#0C0E1F',
	'LIGHT_TEXT_COLOR' => '#fcfcfc',
	'DARK_TEXT_COLOR' => '#030303',
	'LIGHT_LINK_COLOR' => '#fcfcfc',
	'DARK_LINK_COLOR' => '#030303',
	'LINK_HOVER_COLOR' => '#f9dd32',
	'MENU_BACKGROUND_COLOR' => '#0C0E1F',
	'JUSTIFY-CONTENT' => 'flex-end',
	'SCROLLBAR_THUMB' => '#f9dd32',
);

function uka_custom_header() {
	add_theme_support('custom-header');
}
add_action( 'after_setup_theme', 'uka_custom_header');


function uka_custom_background(){
	global $DEFAULTS;
	$defaults = array(
		'default-color'	=> $DEFAULTS['BACKGROUND_COLOR']);
	add_theme_support('custom-background', $defaults);
}
add_action( 'after_setup_theme', 'uka_custom_background');

function uka_custom_logo(){
	add_theme_support('custom-logo');
}
add_action( 'after_setup_theme', 'uka_custom_logo');


function uka_customizer_css(){ 
	global $DEFAULTS;?>
	<style type="text/css">
		body::-webkit-scrollbar-track{background-color:<?php echo get_theme_mod('background-color', $DEFAULTS['BACKGROUND_COLOR']); ?>;}
		body::-webkit-scrollbar-thumb{background-color:<?php echo get_theme_mod('scrollbar-thumb-color', $DEFAULTS['SCROLLBAR_THUMB']); ?>;}
		section#home{background-image:url(<?php echo header_image(); ?>);}
		html{color:<?php echo get_theme_mod('light-text-color', $DEFAULTS['LIGHT_LINK_COLOR']); ?>;}
		a{color:<?php echo get_theme_mod('light-link-color', $DEFAULTS['LIGHT_LINK_COLOR']); ?>;}
		a:visited{color:<?php echo get_theme_mod('light-link-color', $DEFAULTS['LIGHT_LINK_COLOR']); ?>;}
		a:hover{color:<?php echo get_theme_mod('link-hover-color', $DEFAULTS['LINK_HOVER_COLOR']); ?>;}
		nav.main-navigation{color:<?php echo get_theme_mod('light-text-color', $DEFAULTS['LIGHT_TEXT_COLOR']); ?>;}
		nav.main-navigation{background-color:<?php echo get_theme_mod('menu-background-color', $DEFAULTS['MENU_BACKGROUND_COLOR']); ?>;}
		nav.main-navigation ul.sub-menu{background-color:<?php echo get_theme_mod('menu-background-color', $DEFAULTS['MENU_BACKGROUND_COLOR']); ?>;}
		nav.main-navigation a{color:<?php echo get_theme_mod('light-link-color', $DEFAULTS['LIGHT_LINK_COLOR']); ?>;}
		nav.main-navigation a:hover{color:<?php echo get_theme_mod('link-hover-color', $DEFAULTS['LINK_HOVER_COLOR']); ?>;}
		nav.main-navigation > ul.flex{justify-content:<?php echo get_theme_mod('justify-content', $DEFAULTS['JUSTIFY-CONTENT']); ?>;}
		main#page article, div#page article a{color:<?php echo get_theme_mod('light-text-color', $DEFAULTS['LIGHT_TEXT_COLOR']); ?>;}
		<?php if (get_theme_mod('uka_footer_enabled', false)): ?>
		main#page{margin-bottom: -12em;}
		main#page:after { content: ""; display: block; height: 12em;}
		<?php endif; ?>
	</style>
<?php
}
add_action('wp_head', 'uka_customizer_css');


function uka_custom_colors($wp_customize){
	
	global $DEFAULTS;
	
	$wp_customize->add_setting('light-text-color', array('default' => $DEFAULTS['LIGHT_TEXT_COLOR']));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 
			'light-text-color', 
			array(
				'label'    => __( 'Light text color', 'uka' ),
				'section'  => 'colors',
				'settings' => 'light-text-color', 
			)
		)
	);

	$wp_customize->add_setting('dark-text-color', array('default' => $DEFAULTS['DARK_TEXT_COLOR']));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 
			'dark-text-color', 
			array(
				'label'    => __( 'Dark text color', 'uka' ),
				'section'  => 'colors',
				'settings' => 'dark-text-color', 
			)
		)
	);	
	
	$wp_customize->add_setting('light-link-color', array('default' => $DEFAULTS['LIGHT_LINK_COLOR']));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 
			'light-link-color', 
			array(
				'label'    => __( 'Light link color', 'uka' ),
				'section'  => 'colors',
				'settings' => 'light-link-color', 
			)
		)
	);	
	
	$wp_customize->add_setting('dark-link-color', array('default' => $DEFAULTS['DARK_LINK_COLOR']));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 
			'dark-link-color', 
			array(
				'label'    => __( 'Dark link color', 'uka' ),
				'section'  => 'colors',
				'settings' => 'dark-link-color', 
			)
		)
	);	
	
	$wp_customize->add_setting('link-hover-color', array('default' => $DEFAULTS['LINK_HOVER_COLOR']));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 
			'link-hover-color', 
			array(
				'label'    => __( 'Link hover color', 'uka' ),
				'section'  => 'colors',
				'settings' => 'link-hover-color', 
			)
		)
	);	
	
	$wp_customize->add_setting('menu-background-color', array('default' => $DEFAULTS['MENU_BACKGROUND_COLOR']));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 
			'menu-background-color', 
			array(
				'label'    => __( 'Menu background color', 'uka' ),
				'section'  => 'colors',
				'settings' => 'menu-background-color', 
			)
		)
	);	
	
	$wp_customize->add_setting('scrollbar-thumb-color', array('default' => $DEFAULTS['SCROLLBAR_THUMB']));
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 
			'scrollbar-thumb-color', 
			array(
				'label'    => __( 'Scrollbar thumb color', 'uka' ),
				'section'  => 'colors',
				'settings' => 'scrollbar-thumb-color', 
			)
		)
	);	
}
add_action('customize_register', 'uka_custom_colors');

function uka_post_layout_customizer($wp_customize){
	$wp_customize->add_section(
		'uka_post_layout_section', 
		array(
			'title'			=> __( 'Post Layout', 'uka' ),
			'priority'		=> 900,
			'description'	=> '',
		)
	);

	$wp_customize->add_setting(
		'uka_post_ratio',
		array(
			'default' => '3x2',
		)
	);
	
	$wp_customize->add_control(
		'uka_post_ratio', 
		array(
			'type'		=> 'select',
			'label'		=> __( 'Post ratio', 'uka' ),
			'section'	=> 'uka_post_layout_section',
			'settings'	=> 'uka_post_ratio',
			'choices'	=> array(
				'5x2'	=> '5x2',
				'2x1'	=> '2x1',
				'5x3'	=> '5x3',
				'3x2'	=> '3x2',
				'4x3'	=> '4x3',
			)
		)
	);
}
add_action('customize_register', 'uka_post_layout_customizer');



function uka_footer_customizer($wp_customize){
	
	$wp_customize->add_section(
		'uka_footer_section', 
		array(
			'title'       => __( 'Footer', 'uka' ),
			'priority'    => 1000,
			'description' => '',
		)
	);
	
	$wp_customize->add_setting('uka_footer_enabled');
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize, 
			'uka_footer_enabled', 
			array(
				'label'    => __( 'Footer enabled', 'uka' ),
				'section'  => 'uka_footer_section',
				'settings' => 'uka_footer_enabled',
				'type'     => 'checkbox',
			)
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
add_action('customize_register', 'uka_footer_customizer');
	





function uka_menu($wp_customize){
	
	global $DEFAULTS;

	$wp_customize->add_section(
		'menu-options', 
		array(
			'title'       => 'Menu options',
			'panel' 	  => 'nav_menus'
		)
	);
	
	$wp_customize->add_setting('justify-content', array('default' => 1));
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'justify-content',
			array(
				'label'          => __( 'Justify content', 'uka' ),
				'section'        => 'menu-options',
				'type'           => 'select',
				'choices' 		 => array('flex-start', 'flex-end', 'center', 'space-between', 'space-around'),
				'settings' 		 => 'justify-content',
			)
		)
	);
}
add_action('customize_register', 'uka_menu');







