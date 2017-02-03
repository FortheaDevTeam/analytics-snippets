<?php
/**
---
Snippet: Product Data to DataLayer for Google Tag Manager
Purpose: Remarketing - Product specific - only execute on single product view
Goal: Call attributes ID, PRICE & push to datalayer for GTM
---
Author: Chad Ostroff (Forthea Interactive Marketing)
Version: 1.0
---
Dependencies: WordPress, WooCommerce, WooCommerce Google Product Feed, GTM
Placement: header.php of current theme or child theme, do not include <?php and ?> tags
Instructions: place in header.php file after wp_head() call and before initial GTM script
---
Future versions: push into custom function and add to wp_head();
---
**/

global $post, $product;

if (is_product()) {

    // For testing only
    // echo '<!--// Single Product //-->';
    
    // get product id and price
    $postid = get_the_ID();
    $dlProdID = "'".'woocommerce_gpf_'.$postid."'";
    $dlPrice = $product->get_price();

    // FOR TESTING ONLY - echo out the results in comments - uncomment for testing
    // echo '<!--// Product ID is ' . $postid . ' //-->';
    // echo '<!--// Datalayer Product ID is ' . $dlProdID . ' -->';
    // echo '<!--// Product Price is ' . $dlPrice . ' //-->';

    // Set the datalayer output
    $output = '<script>' . "\n";
    $output .= 'dataLayer = [{'. "\n";
    $output .= "\t" . "'product_ids'".': ';
    $output .= $dlProdID . ',' . "\n";
    $output .= "\t". "'page_type'".': ';
    $output .= "'product'" . ',' . "\n";
    $output .= "\t" . "'total_value'".': ';
    $output .= $dlPrice . "\n";
    $output .= '}]'. "\n";
    $output .= '</script>';

    // Echo output
    echo '<!--// DataLayer //-->';
    echo $output;

} else {
    
    // FOR TESTING ONLY
    // echo '<!--// Not a Product Page //-->';

}
?>