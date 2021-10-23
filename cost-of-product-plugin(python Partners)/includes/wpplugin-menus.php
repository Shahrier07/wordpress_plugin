<?php 

//Database
global $wpdb;
$table_name = $wpdb->prefix . 'postmeta';


//Add cost price 
add_action( 'woocommerce_product_options_pricing', 'wc_cost_product_field' );
function wc_cost_product_field() {

    //Get product id
    global $product;
    $product = wc_get_product();
    $id = $product->id;
   // echo $id;

    //get cost price
    global $wpdb;
    $table_name = $wpdb->prefix . 'postmeta';
    $result = $wpdb->get_results("SELECT * FROM $table_name WHERE post_id = $id and meta_key = '_cost_price' ");
    foreach($result as $print) {
        
        $cost_price =  $print->meta_value;

     }
     //echo $cost_price;

     //Calculate profit
     $result = $wpdb->get_results("SELECT * FROM $table_name WHERE post_id = $id and meta_key = '_sale_price' ");
    foreach($result as $print) {
        
        $price =  $print->meta_value;

     }
     $profit= $price-$cost_price;
     
     //percentage
     if ($price >0){
        $profit_per = ($profit*100)/$price;
        $profit_per = round($profit_per, 2); 
     }
     //echo  $profit_per ;


    //Add cost price 
    woocommerce_wp_text_input( array( 
        'id' => 'cost_price', 
        'class' => 'wc_input_price short',
        'value' => $cost_price,
        'description' => __( 'Profit: '.$profit.'৳ '.'('.$profit_per.'% )', 'woocommerce' ),
        'label' => __( 'Cost of Product', 'woocommerce' ) . ' (' . get_woocommerce_currency_symbol() . ')' ) );



     
}

add_action( 'save_post', 'wc_cost_save_product' );
function wc_cost_save_product( $product_id ) {

     // stop the quick edit interferring as this will stop it saving properly, when a user uses quick edit feature
     if (wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce'))
        return;

    // If this is a auto save do nothing, we only save when update button is clicked
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
    if ( isset( $_POST['cost_price'] ) ) {
        if ( is_numeric( $_POST['cost_price'] ) )
            update_post_meta( $product_id, '_cost_price', $_POST['cost_price'] );
    } else delete_post_meta( $product_id, '_cost_price' );
}































 ?>