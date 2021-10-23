<?php

/*Remove Filed*/
function my_custom_admin_styles() {
  
}
add_action('admin_head', 'my_custom_admin_styles');


/* Display the custom text field */
function create_custom_field() {
 $args_1 = array(
 'id' => 'cost_product',
 'label' => __( "Cost of Product(৳ )", 'cfwc' ),
 'class' => 'cfwc-custom-field',
 'desc_tip' => true,
 'description' => __( 'Enter the cost of product', 'ctwc' ),
 );
 
 
 woocommerce_wp_text_input( $args_1 );


 
}
add_action( 'woocommerce_product_options_general_product_data', 'create_custom_field' );

/*update into db*/

function save_fields( $id, $post ){
 
    update_post_meta( $id, '_cost_of_product', $_POST['scost_product'] );
    
  
}
add_action( 'woocommerce_process_product_meta', 'save_fields', 10, 2 );







        























?>
