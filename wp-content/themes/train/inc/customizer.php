<?php

/**
 * train Theme Customizer
 *
 * @package Train
 * @since   1.0.10
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function train_theme_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
     $wp_customize->get_setting( 'header_textcolor' )->transport  = 'refresh';
   
      
}
add_action( 'customize_register', 'train_theme_customize_register' );
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */

function train_theme_customize_preview_js() {
  wp_enqueue_script( 'train_theme_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), true );
}
add_action( 'customize_preview_init', 'train_theme_customize_preview_js' );


/**
 * Enqueue scripts for customizer
 */
function train_customizer_pro_js() {
    wp_enqueue_script('train-customizer', get_template_directory_uri() . '/js/train-customizer.js', array('jquery'), '1.3.0', true);

    wp_localize_script( 'train-customizer', 'train_customizer_pro_js_obj', array(
        'pro' => __('Upgrade To Train Pro','train')
    ) );
    wp_enqueue_style( 'train-customizer', get_template_directory_uri() . '/css/train-customizer.css');
}
add_action( 'customize_controls_enqueue_scripts', 'train_customizer_pro_js' );




function train_theme_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
function train_theme_sanitize_textarea( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
function train_theme_sanitize_category($input){
  $output=intval($input);
  return $output;
}

function train_theme_customizer_register( $wp_customize ) 
    {
      $wp_customize->add_panel( 'theme_option', array(
        'priority' => 200,
        'title' => __( 'Train Theme Option', 'train' ),
        'description' => __( 'Train Theme Option.', 'train' ),
      ));

     /**********************************************/
      /*************** HEADER TOP BAR SECTION ***************/
      /**********************************************/
      $wp_customize->add_section('header_section',array(
        'priority' => 40,
        'title' => __('Topbar Header Section','train'),
        'description' => __('Configure Your Email and Telephone, and Social Icons','train'),
        'panel' => 'theme_option'
      ));

      /* ------ For Top Email Section ------ */

      $wp_customize->add_setting(
        'top_email',
            array(
              'sanitize_callback' => 'sanitize_email',
              'default' => __('info@example.com','train')
          )
      );
      $wp_customize->add_control(
        'top_email',
         array(
          'label' => __('Top Email Address Url','train'),
          'section' => 'header_section',
          'settings' => 'top_email',
          'type' => 'text',
         )
      );
      /* ------ For Top Phone Section ------ */
      $wp_customize->add_setting(
        'top_phone',
          array(
            'sanitize_callback' => 'train_theme_sanitize_text',
            'default' => __('(123)-123-1234','train')
          )
      );
      $wp_customize->add_control(
        'top_phone',
          array(
          'label' => __('Topbar Phone','train'),
          'section' => 'header_section',
          'settings' => 'top_phone',
          'type' => 'text',
         )
      );
      /* ------ For Top Social Icons Section ------ */
      $wp_customize->add_setting('header_socialicon_display',array(
        'sanitize_callback' => 'train_theme_sanitize_text',
        'default' => '1'
      ));
      $wp_customize->add_control(new WP_Customize_Control($wp_customize,'header_socialicon_display',array(
        'label' => __('Show social icons','train'),
        'section' => 'header_section',
        'settings' => 'header_socialicon_display',
        'type'=> 'checkbox',
        ))
      );
      $wp_customize->add_setting(
        'facebook_textbox1',
          array(
            'sanitize_callback' => 'esc_url_raw',
            'default' => __('#','train')
          )
      );
      $wp_customize->add_control(
        'facebook_textbox1',
          array(
            'label' => __('Facebook','train'),
            'section' => 'header_section',
            'settings' => 'facebook_textbox1',
           'type' => 'text',
          )
      );
      $wp_customize->add_setting(
        'twitter_textbox1',
          array(
            'sanitize_callback' => 'esc_url_raw',
            'default' => __('#','train')          )
      );
      $wp_customize->add_control(
        'twitter_textbox1',
        array(
          'label' => __('Twitter','train'),
          'section' => 'header_section',
          'settings' => 'twitter_textbox1',
          'type' => 'text',
         )
      );
      $wp_customize->add_setting(
        'googleplus_textbox1',
          array(
            'sanitize_callback' => 'esc_url_raw',
            'default' => '',
          )
      );
      $wp_customize->add_control(
        'googleplus_textbox1',
          array(
          'label' => __('Googleplus','train'),
          'section' => 'header_section',
          'settings' => 'googleplus_textbox1',
          'type' => 'text',
         )
      );
      $wp_customize->add_setting(
        'skype_textbox1',
          array(
            'sanitize_callback' => 'esc_url_raw',
          'default' => __('skype:yourskypeidhere?call','train')
          )
      );
      $wp_customize->add_control(
        'skype_textbox1',
          array(
            'label' => __('Skype','train'),
            'section' => 'header_section',
            'settings' => 'skype_textbox1',
            'type' => 'text',
         )

      );
      $wp_customize->add_setting(
        'linkedin_textbox1',
            array(
              'sanitize_callback' => 'esc_url_raw',
              'default' => '',
          )
      );
      $wp_customize->add_control(
        'linkedin_textbox1',
         array(
          'label' => __('Linkedin','train'),
          'section' => 'header_section',
          'settings' => 'linkedin_textbox1',
          'type' => 'text',
         )
      );     
      /**********************************************/
      /************* MAIN SLIDER SECTION *************/
      /**********************************************/     
      $wp_customize->add_section('main_slider_category',array(
        'priority' => 50,
        'title' => __('Slider Categories','train'),
        'description' => __('Select the Slide Category for Homepage.','train'),
        'panel' => 'theme_option'
      ));
      $wp_customize->add_setting('slider_category_display',array(
        'sanitize_callback' => 'train_theme_sanitize_category',
        'default' => ''
      ));
      $wp_customize->add_control(new train_theme_Customize_Dropdown_Taxonomies_Control($wp_customize,'slider_category_display',array(
        'label' => __('Choose category','train'),
        'section' => 'main_slider_category',
        'settings' => 'slider_category_display',
        'type'=> 'dropdown-taxonomies',
        )  

      ));
      $wp_customize->add_setting('slider_category_display_num',array(
        'capability'=>'edit_theme_options',
        'sanitize_callback' => 'train_theme_sanitize_text',
        'default'=>'2',
        ));
       $wp_customize->add_control( 'slider_category_display_num', array(
       'settings' => 'slider_category_display_num',
       'label'    =>  __( 'No Of Posts To Show On Slider Section', 'train' ),
       'section'  => 'main_slider_category',
       'type'     => 'select',
       'choices'  => array(
           '1' => __( '1', 'train' ),
           '2' => __( '2', 'train' ),
           '3' => __( '3', 'train' ),
            '4' => __( '4', 'train' ),
           '5' => __( '5', 'train' ),
           '6' => __( '6', 'train' ),

           ),

        ) );
      $wp_customize->add_setting(
        'slider_button',
            array(
              'sanitize_callback' => 'train_theme_sanitize_text',
              'default' => __('Read More','train')
          )
      );
      $wp_customize->add_control(
        'slider_button',
         array(
          'label' => __('Contact Us  Text','train'),
          'section' => 'main_slider_category',
          'settings' => 'slider_button',
          'type' => 'text',
         )
      );
      $wp_customize->add_setting(
        'slider_button_link',
            array(
              'sanitize_callback' => 'esc_url_raw',
              'capability' => 'edit_theme_options',
              'default' => '',
          )
      );
      $wp_customize->add_control(
        'slider_button_link',
         array(
          'label' => __('Contact Us Link','train'),
          'section' => 'main_slider_category',
          'settings' => 'slider_button_link',
          'type' => 'text',
         )
      );
     
      /**********************************************/

      /*************** WELCOME SECTION ***************/

      /**********************************************/

      $wp_customize->add_section('welcome_text',array(
        'priority' => 60,
        'title' => __('Welcome Section','train'),
        'description' => __('Write Some Words for Welcome Section in Homepage','train'),
        'panel' => 'theme_option'
      ));
      $wp_customize->add_setting(
        'welcome_textbox1',
          array(
            'sanitize_callback' => 'train_theme_sanitize_text',
            'default' => __('Welcome to Train Theme','train')
          )
      );
      $wp_customize->add_control(
        'welcome_textbox1',
          array(
         'label' => __('Welcome Heading','train'),
          'section' => 'welcome_text',
          'settings' => 'welcome_textbox1',
          'type' => 'text',
         )

      );
      $wp_customize->add_setting(
        'welcome_textbox2',
          array(
            'sanitize_callback' => 'train_theme_sanitize_text',
            'default' => __('FREE RESPONSIVE, MULTIPURPOSE BUSINESS AND CORPORATE THEME PERFECT FOR ANY ONE.','train')
          )
      );
      $wp_customize->add_control(
        'welcome_textbox2',
          array(
          'label' => __('Welcome Second Heading','train'),
          'section' => 'welcome_text',
          'settings' => 'welcome_textbox2',
          'type' => 'text',
         )

      );

      $wp_customize->add_setting( 
        'textarea_setting' ,
          array(
            'sanitize_callback' => 'train_theme_sanitize_text',
            'default' => __('Train Theme is a simple, clean, beautifully designed responsive WordPress business theme. It is minimal but mostly used features will help you setup your website easily and quickly. Full width layout, featured slider,services/features layout, blog layout, social media integration, full width page layout and woocommerce ready. ','train') 
        )); 

      $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'textarea_setting', array( 
        'label' => __( 'Welcome Text Content', 'train' ),
        'section' => 'welcome_text',
        'settings' => 'textarea_setting', 
        'type'     => 'textarea', 
        )));    

      $wp_customize->add_section('content' , array(
        'title' => __('Content','train'),
      ));

      $wp_customize->add_setting(
        'welcome_button',
            array(
              'sanitize_callback' => 'esc_url_raw',
              'default' => __('#','train')
          )

      );
      $wp_customize->add_control(
        'welcome_button',
         array(
          'label' => __('Welcome Button Link','train'),
          'section' => 'welcome_text',
          'settings' => 'welcome_button',
          'type' => 'text',
         )

      );      
      /**********************************************/
      /*************** FEATURES SECTION ****************/
      /**********************************************/
     $wp_customize->add_section('features_category',array(
        'priority' => 70,
        'title' => __('Features Categories','train'),
        'description' => __('Select the Category for Features Section in Homepage','train'),
        'panel' => 'theme_option'
      ));

     $wp_customize->add_setting(
        'featured_title',
          array(
            'sanitize_callback' => 'train_theme_sanitize_text',
            'default' => __('Featured Contents','train')
          )
      );
      $wp_customize->add_control(
        'featured_title',
          array(
         'label' => __('Featured Title ','train'),
          'section' => 'features_category',
          'settings' => 'featured_title',
          'type' => 'text',
         ));

      $wp_customize->add_setting('features_display',array(
        'sanitize_callback' => 'train_theme_sanitize_category',
        'default' => ''
      ));

      $wp_customize->add_control(new train_theme_Customize_Dropdown_Taxonomies_Control($wp_customize,'features_display',array(
        'label' => __('Choose category','train'),
        'section' => 'features_category',
        'settings' => 'features_display',
        'type'=> 'dropdown-taxonomies',
        )  

      )); 
      $wp_customize->add_setting('feature_category_display_num',array(
        'capability'=>'edit_theme_options',
        'sanitize_callback' => 'train_theme_sanitize_text',
        'default'=>'3',
        ));

       $wp_customize->add_control( 'feature_category_display_num', array(
       'settings' => 'feature_category_display_num',
       'label'    =>  __( 'No Of Posts To Show On Feature Section', 'train' ),
       'section'  => 'features_category',
       'type'     => 'select',
       'choices'  => array(
           '3' => __( '3', 'train' ),
           '6' => __( '6', 'train' ),
           '9' => __( '9', 'train' ),           
           ),

        ) ); 

      /**********************************************/

      /*************** FOOTER SECTION ***************/

      /**********************************************/
       $wp_customize->add_section(
        'footer_section',
          array(
            'priority' => 80,
            'title' => __('Other Settings','train'),
            'description' => __('Customize your Footer section.','train'),
            'panel' => 'theme_option'
        )
      );
      /**********************************************/

      /*************** COPYRIGHTS SECTION **************/

      /**********************************************/
    $wp_customize->add_setting(
        'copyright_textbox',
          array(
            'sanitize_callback' => 'train_theme_sanitize_text',
            'default' => __('Copyright &copy; 2016. Your Theme. All Rights Reserved.','train')
          )
      );

      $wp_customize->add_control(
        'copyright_textbox',
          array(
          'label' => __('Copyright text','train'),
          'section' => 'footer_section',
          'settings' => 'copyright_textbox',
          'type' => 'text',
         )
      );

      $wp_customize->add_setting('enable_featuredimage',array(
        'capability'=>'edit_theme_options',
        'sanitize_callback' => 'train_theme_sanitize_text',
        'default'=>'enable',
        ));

       $wp_customize->add_control( 'enable_featuredimage', array(
       'settings' => 'enable_featuredimage',
       'label'    =>  __( 'Enable/Disable Featured Image On Single Page', 'train' ),
       'section'  => 'footer_section',
       'type'     => 'radio',
       'choices'  => array(
           'enable' => __( 'Enable', 'train' ),
           'disable' => __( 'Disable', 'train' ),
                
           ),

        ) ); 

      /**********************************************/

      /***** ADJUSTMENT OF SIDEBAR POSITION SECTION *****/

      /**********************************************/
      $wp_customize->add_panel( 'layout', array(
        'priority' => 220,
        'title' => __( 'Train Sidebar Layout', 'train' ),
        'description' => __( '', 'train' ),
      ));
      $wp_customize->add_section('category_sidebar' , array(
        'priority' => 10,
        'title' => __('Category Sidebar','train'),
        'panel' => 'layout'
      ));
   $wp_customize->add_setting('category_sidebar_position', array(
        'sanitize_callback' => 'train_theme_sanitize_text',
          'default' => __('right','train')
        ));
      $wp_customize->add_control('category_sidebar_position', array(
        'label'      => __('Category Sidebar position', 'train'),
        'section'    => 'category_sidebar',
        'settings'   => 'category_sidebar_position',
        'type'       => 'radio',
        'choices'    => array(
          'both'   => __('both','train'),
          'left'   => __('left','train'),
          'right'  => __('right','train'),
        ),

      ));

      /**********************************************/

      /********** SINGLE POST SIDEBAR SECTION ***********/

      /**********************************************/    

      $wp_customize->add_section('single_post_sidebar' , array(
        'priority' => 20,
        'title' => __('Single Post Sidebar','train'),
        'panel' => 'layout'
      ));
      $wp_customize->add_setting('single_post_sidebar_position', array(
        'sanitize_callback' => 'train_theme_sanitize_text',
         'default' => __('right','train')
      ));
      $wp_customize->add_control('single_post_sidebar_position', array(
        'label'      => __('Single Post Sidebar position', 'train'),
        'section'    => 'single_post_sidebar',
        'settings'   => 'single_post_sidebar_position',
        'type'       => 'radio',
        'choices'    => array(
           'both'   => __('both','train'),
          'left'   => __('left','train'),
          'right'  => __('right','train'),
        ),

      ));
    /**********************************************/

      /********** SINGLE PAGE SIDEBAR SECTION ***********/

      /**********************************************/     
     $wp_customize->add_section('single_page_sidebar' , array(
        'priority' => 30,
        'title' => __('Single Page Sidebar','train'),
        'panel' => 'layout'
      ));
     $wp_customize->add_setting('single_page_sidebar_position', array(
        'sanitize_callback' => 'train_theme_sanitize_text',
         'default' => __('right','train')
      ));
     $wp_customize->add_control('single_page_sidebar_position', array(
        'label'      => __('Single Page Sidebar position', 'train'),
        'section'    => 'single_page_sidebar',
        'settings'   => 'single_page_sidebar_position',
        'type'       => 'radio',
        'choices'    => array(
           'both'   => __('both','train'),
          'left'   => __('left','train'),
          'right'  => __('right','train'),
        ),

      ));
     /**********************************************/

      /******** SEARCH PAGE SIDEBAR SECTION *********/

      /**********************************************/     
     $wp_customize->add_section('search_page_sidebar' , array(
        'priority' => 40,
        'title' => __('Search Page Sidebar','train'),
        'panel' => 'layout'
      ));
    $wp_customize->add_setting('search_page_sidebar_position', array(
        'sanitize_callback' => 'train_theme_sanitize_text',
          'default' => __('right','train')
      ));
     $wp_customize->add_control('search_page_sidebar_position', array(
        'label'      => __('Search Page Sidebar position', 'train'),
        'section'    => 'search_page_sidebar',
        'settings'   => 'search_page_sidebar_position',
        'type'       => 'radio',
        'choices'    => array(
           'both'   => __('both','train'),
          'left'   => __('left','train'),
          'right'  => __('right','train'),
        ),

      ));
     /**********************************************/
      /******** PAGE NOT FOUND SIDEBAR SECTION *********/
      /**********************************************/     
     $wp_customize->add_section('page_not_found_sidebar' , array(
        'priority' => 50,
        'title' => __('Page Not Found Sidebar','train'),
        'panel' => 'layout'
      ));
    $wp_customize->add_setting('page_not_found_sidebar_position', array(
        'sanitize_callback' => 'train_theme_sanitize_text',
          'default' => __('right','train')
      ));
    $wp_customize->add_control('page_not_found_sidebar_position', array(
        'label'      => __('Page Not Found Sidebar position', 'train'),
        'section'    => 'page_not_found_sidebar',
        'settings'   => 'page_not_found_sidebar_position',
        'type'       => 'radio',
        'choices'    => array(
           'both'   => __('both','train'),
          'left'   => __('left','train'),
          'right'  => __('right','train'),
        ),

      )); 

    }

add_action( 'customize_register', 'train_theme_customizer_register' );