<?php

/**
 * Register a custom menu page.
 */
function uka_panels_menu(){
    add_menu_page(
		__('UKA Panels', 'uka' ),
        'UKA Panels',
        'manage_options',
        'uka-panels',
        'uka_panels_options',
        null,
        60
    );
}
//add_action('admin_menu', 'uka_panels_menu' );

function register_uka_panels_settings(){
	register_setting('uka-panels-group', 'panels');
}
add_action('admin_init', 'register_uka_panels_settings');

function uka_panels_options(){
	require_once('uka-panels-options.php');
}

function get_uka_panels_data(){
	global $panels;
	$panels = NULL;
}
add_action('after_setup_theme', 'get_uka_panels_data');

function uka_panels_style(){
	wp_enqueue_style('uka-panels-style', get_template_directory_uri().'/inc/plugins/uka-panels/uka-panels.css');
}
add_action('wp_enqueue_scripts', 'uka_panels_style');

function uka_panels_widget_init(){
	$panels = intval(get_option('panels'));
	if ($panels > 0){			
		for ($i = 1; $i < $panels + 1; $i++){
			$title = get_theme_mod('panel-'.$i.'-title');
			$title = $title == '' ? 'Panel '.$i : 'Panel '.$i.' - '.$title;
			register_sidebar(array(
				'name'          => __($title, 'uka'),
				'id'            => 'panel-'.$i,
				'description'   => __('Add widgets here to appear in your panel.', 'uka'),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			));
		}
	}
}
add_action('widgets_init', 'uka_panels_widget_init');

/**
 * UKA panels widget additions.
 */
#require(get_template_directory().'/inc/widgets/uka-panels/uka-panels-widget.php');
#require(get_template_directory().'/inc/widgets/uka-panels-countdown/uka-panels-countdown.php');







function uka_panels($wp_customize){
	$wp_customize->add_panel(
		'uka_panels', 
		array(
			'title'       => __( 'UKA Panels', 'uka' ),
			'priority'    => 2000
		)
	);
	

	$wp_customize->add_section(
		'panel-options', 
		array(
			'title'       => 'Panel options',
			'panel' 	  => 'uka_panels'
		)
	);
	
	$wp_customize->add_setting('panels');
	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'panels',
			array(
				'label'          => __( 'Number of panels', 'theme_name' ),
				'section'        => 'panel-options',
				'type'           => 'number'
			)
		)
	);

	$panels = intval(get_theme_mod('panels'));
	if ($panels > 0){			
		for ($i = 1; $i < $panels + 1; $i++){
			$title = get_theme_mod('panel-'.$i.'-title');
			$title = $title == '' ? 'Panel '.$i : 'Panel '.$i.' - '.$title;
			$wp_customize->add_section(
				'panel-'.$i, 
				array(
					'title'       => $title,
					'panel' 	  => 'uka_panels'
				)
			);
			
			$wp_customize->add_setting('panel-'.$i.'-title');
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'panel-'.$i.'-title',
					array(
						'label'          => __( 'Title', 'uka' ),
						'section'        => 'panel-'.$i,
						'type'           => 'text'
					)
				)
			);
			
			$wp_customize->add_setting('panel-'.$i.'-show-title');
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'panel-'.$i.'-show-title',
					array(
						'label'          => __( 'Show title in panel?', 'uka' ),
						'section'        => 'panel-'.$i,
						'type'           => 'checkbox'
					)
				)
			);
			
			$wp_customize->add_setting('panel-'.$i.'-title-color', array('default' => '#030303'));
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 
					'panel-'.$i.'-title-color', 
					array(
						'label'    => __( 'Title color', 'uka' ),
						'section'  => 'panel-'.$i,
						'settings' => 'panel-'.$i.'-title-color', 
 					)
				)
			);
			
			$wp_customize->add_setting('panel-'.$i.'-background-color', array('default' => '#121628'));
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 
					'panel-'.$i.'-background-color', 
					array(
						'label'    => __( 'Background color', 'uka' ),
						'section'  => 'panel-'.$i,
						'settings' => 'panel-'.$i.'-background-color', 
 					)
				)
			);

			$wp_customize->add_setting('panel-'.$i.'-text-color', array('default' => '#030303'));
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize, 
					'panel-'.$i.'-text-color', 
					array(
						'label'    => __( 'Text color', 'uka' ),
						'section'  => 'panel-'.$i,
						'settings' => 'panel-'.$i.'-text-color', 
 					)
				)
			);
		}
	}
}
add_action('customize_register', 'uka_panels');

$DEFAULTS = array(
	'BACKGROUND_COLOR' => '#0C0E1F',
	'LIGHT_TEXT_COLOR' => '#fcfcfc',
	'DARK_TEXT_COLOR' => '#030303',
	'LIGHT_LINK_COLOR' => '#fcfcfc',
	'DARK_LINK_COLOR' => '#030303',
	'TITLE_COLOR' => '#030303',
);


function uka_panels_css(){
	$panels = intval(get_theme_mod('panels'));
	if ($panels > 0):
		echo '<style type="text/css">';
		global $DEFAULTS;
		for ($i = 1; $i < $panels + 1; $i++):?>
			section.panel-<?php echo $i; ?>{background-color:<?php echo get_theme_mod('panel-'.$i.'-background-color', $DEFAULTS['BACKGROUND_COLOR']); ?>;}
			section.panel-<?php echo $i; ?>{color:<?php echo get_theme_mod('panel-'.$i.'-text-color', $DEFAULTS['LIGHT_TEXT_COLOR']); ?>;}
			section.panel-<?php echo $i; ?> h1.widget-title{color:<?php echo get_theme_mod('panel-'.$i.'-title-color', $DEFAULTS['TITLE_COLOR']); ?>;}
			section.panel-<?php echo $i; ?> a{color:<?php echo get_theme_mod('panel-'.$i.'-text-color', $DEFAULTS['LIGHT_LINK_COLOR']); ?>;}
			section.panel-<?php echo $i; ?> a:visited{color:<?php echo get_theme_mod('panel-'.$i.'-text-color', $DEFAULTS['LIGHT_LINK_COLOR']); ?>;}
			section.panel-<?php echo $i; ?> a:hover{color:<?php echo get_theme_mod('panel-'.$i.'-text-color', $DEFAULTS['LIGHT_LINK_COLOR']); ?>;}
		<?php
		endfor;
		echo '</style>';
	endif;
}
add_action('wp_head', 'uka_panels_css');



?>
