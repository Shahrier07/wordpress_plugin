<?php


function cop_parent_styles() {

wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );

}
add_action( 'wp_enqueue_scripts', 'cop_parent_styles' );

// Load CSS on all admin pages
function cop_admin_styles() {

  wp_enqueue_style(
    'wpplugin-admin',
    WPPLUGIN_URL . 'admin/css/wpplugin-admin-style.css',
    [],
    time()
  );

}
add_action( 'admin_enqueue_scripts', 'cop_admin_styles' );

