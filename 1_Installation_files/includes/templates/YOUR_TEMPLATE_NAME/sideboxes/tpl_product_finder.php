<?php
/**
 *  Product Finder module
 * includes/templates/YOURTEMPLATE/sideboxes/tpl_product_finder.php
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: product_finder.php 2019-05-25
 */
$content = '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent">' . "\n";
ob_start();//start output buffer
include(DIR_WS_MODULES . zen_get_module_directory('product_finder.php'));//get common code output
$content .= ob_get_contents();//add buffer to output
ob_end_clean();//close output buffer
$content .= '</div>';

