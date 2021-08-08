<?php

  function init_my_template(){
    add_theme_support('post-thumbnails'); // agregar la habilidad de que el theme tenga soporte para usar Featured Image en los Posts
    add_theme_support('title-tag'); // agregar la habilidad de que el theme tenga soporte para usar Menus

    // register_nav_menus(array(location_name => menu_name_created_on_wp_admin))
    register_nav_menus(
      array(
        'my_top_menu' => 'Master menu'
      )
    );
  }

  add_action('after_setup_theme','init_my_template');

  function load_my_assets(){
    // wp_register_style(tagHandle,url_origin,dependencies_as_array,version,media_in_which__will_be_used)
    wp_register_style('bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css','','5.1.0','all'); // Bootstrap’s CSS only
    wp_register_style('montserratAlt','https://fonts.googleapis.com/css2?family=Montserrat+Alternates&display=swap','','1.0','all');

    // wp_enqueue_style(tagHandle,url_origin,dependencies_as_array,version,media_in_which__will_be_used)
    wp_enqueue_style('myStyles',get_stylesheet_uri(),array('bootstrap','montserratAlt'),'1.0','all');

    // wp_enqueue_script(tagHandle,url_origin,dependencies_as_array,version,true_if_will_load_in_footer_false_if_will_load_in_header)
    // tagHandle names could be the same if they are used separate, one in styles and one in script, after been used can not be duplicated in same enqueue type
    wp_enqueue_script('bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js',array('jquery'),'5.1.0',true); //Bootstrap’s JavaScript Bundle with Popper

    wp_enqueue_script('myFunctions',get_template_directory_uri().'/assets/js/custom.js','','1.0',true);
  }

  add_action('wp_enqueue_scripts','load_my_assets');

  function my_sidebar(){
    register_sidebar(
      array(
        'name' => 'Custom footer',
        'id' => 'my_footer',
        'description' => 'Widget zone for Site footer',
        'before_title' => '<p>',
        'after_title' => '</p>',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>'
      )
    );
  }

  add_action('widgets_init','my_sidebar');

  function my_products_custom_post_type(){
    // 'name' => 'All My Products' -> name used as title in the section where all Post Types of this type are listed
    // 'singular_name' => 'My Product' -> name used inside the editor, on the right column to describe the Post Type that it is currently editing
    // 'menu_name' => 'My Products' -> name used in WP Admin Dashboard Menu
    $labels = array (
      'name' => 'All My Products',
      'singular_name' => 'My Product',
      'menu_name' => 'My Products'
    );

    // 'label' => 'My Products (args)' -> Default name
    // 'supports' => array('title','editor','thumbnail','revisions') -> what can do and which opts will have the custom post type, in this case it will be able to have a title, use the editor, assign a feature img and be able to see a history of modifications
    // 'public' => true -> opt to specify what the 'save' btn will do, it will make the item public (true) or it will public it as a draft (false) when it is clicked
    // 'show_in_menu' => true -> 'true' will allow WP to use them as menu items
    // 'menu_position' => 5 -> this is the position in which this new Psrt Type will be positioned inside the WP Admin Dashboard Menu it has an interasy of 5, this means that if we want to present this opt after Posts the value should be 5, after Media should be 10, after Pages should be 15 and so on...
    // 'menu_icon' => 'dashicons-cart' -> more opts in https://developer.wordpress.org/resource/dashicons/
    // 'publicly_queryable' => true -> if we want to call these items with a 'custom_loop' this opt should be true
    // 'rewrite' => true -> Will assign an URL in order to be navigable
    // 'show_in_rest' => true -> To share this data with the WP API and be able to used the 'Guttember editor' in the editor
    $args = array(
      'label' => 'My Products (args)',
      'descripton' => 'Platzi store products',
      'labels' => $labels,
      'supports' => array('title','editor','thumbnail','revisions'), 
      'public' => true,
      'show_in_menu' => true,
      'menu_position' => 5,
      'menu_icon' => 'dashicons-cart',
      'can_export' => true,
      'publicly_queryable' => true,
      'rewrite' => true,
      'show_in_rest' => true
    );

    // WP recomends to have name in singular for the Post Type name
    register_post_type("my_product", $args);
  }

  // init -> this will be an action generated after 'after_setup_theme' hook
  add_action('init','my_products_custom_post_type');

?>