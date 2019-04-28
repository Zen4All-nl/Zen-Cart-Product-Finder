<?php

/**
 * Product Finder sidebox
 *
 * @package templateSystem
 * @copyright Portions Copyright 2003-2007 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: product_finder.php 2010-08-05
 */
$content = '';
$content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent">' . "\n";
//<!--BOF Product Finder-->
if (isset($_POST['pf_dd1']) && $_POST['pf_dd1'] > 0 && isset($_POST['pf_dd2']) && $_POST['pf_dd2'] > 0) {
  $content .= zen_draw_form('productFinderform', FILENAME_DEFAULT, 'get', 'id="productFinderform"');
} else {
  $content .= zen_draw_form('productFinderform', '', 'post', 'id="productFinderform"');
}
$content .= '<div>' . "\n";
$content .= '<div>' . "\n";
if (isset($_POST['pf_dd1'])) {
  $pf_dd1_selected = (int)$_POST['pf_dd1'];
} elseif ($pf_cPaths) {
  $pf_dd1_selected = $pf_cPaths['1'];
}
$content .= '<span id="pf_title">' . PF_TEXT_TITLE . '</span>' . "\n";
$content .= '<br />';
$content .= '<span class="pf_selectbox_name"><label for="pf_dd1">' . PF_TEXT_DD1 . '</label></span>' . "\n";
$pf_dd1_array = pf_get_category_tree((int)$pf_base_category);
$content .= zen_draw_pull_down_menu('pf_dd1', $pf_dd1_array, $pf_dd1_selected, 'id="pf_dd1" class="pf_selectbox_text"');
$content .= '</div>' . "\n";
$content .= '<div class="pf_go">' . "\n";
$content .= '<noscript>' . "\n";
$content .= zen_image_submit(PF_NOSCRIPT_SUBMIT, PF_NOSCRIPT_SUBMIT_ALT);
$content .= '</noscript>' . "\n";
$content .= '</div>' . "\n";
$content .= '<div>' . "\n";

if (isset($_POST['pf_dd2'])) {
  $pf_dd2_selected = (int)$_POST['pf_dd2'];
} elseif ($pf_cPaths) {
  $pf_dd2_selected = $pf_cPaths['2'];
}
$content .= '<span class="pf_selectbox_name"><label for="pf_dd2">' . PF_TEXT_DD2 . '</label></span>' . "\n";
$pf_dd2_array = pf_get_category_tree((int)$pf_dd1_selected);
$content .= zen_draw_pull_down_menu('pf_dd2', $pf_dd2_array, $pf_dd2_selected, 'id="pf_dd2" class="pf_selectbox_text"');
$content .= '</div>' . "\n";
$content .= '<div class="pf_go">' . "\n";
$content .= '<noscript>' . "\n";
$content .= zen_image_submit(PF_NOSCRIPT_SUBMIT, PF_NOSCRIPT_SUBMIT_ALT);
$content .= '</noscript>' . "\n";
$content .= '</div>' . "\n";
$content .= '<div>' . "\n";
$content .= '<span class="pf_selectbox_name"><label for="cPath">' . PF_TEXT_DD3 . '</label></span>' . "\n";
$pf_dd3_array = pf_get_category_tree((int)$pf_dd2_selected); //build the array of subcategories
$pf_dd3_array[0]['id'] = '';
foreach ($pf_dd3_array as $key => $subarray) {
  if ($pf_dd3_array[$key]['id'] == 0) {
    $pf_dd3_array[$key]['id'] = '';
  } else {
    $pf_dd3_array[$key]['id'] = $pf_base_category . '_' . $pf_dd1_selected . '_' . $pf_dd2_selected . '_' . $pf_dd3_array[$key]['id']; //prefix the dd3 cPath values with the pre-selected dd1_dd2 cPath values. Only needed for noscript submit button to pass as a GET parameter, the js version does the same thing and inserts the action into the form.
  }
}
$content .= zen_draw_pull_down_menu('cPath', $pf_dd3_array, $pf_dd3_selected, 'id="cPath" class="pf_selectbox_text"');
$content .= zen_draw_hidden_field('pf_base_category', $pf_base_category, 'id="pf_base_category" '); //to pass to js
$content .= '</div>' . "\n";
$content .= '<div class="pf_go">' . "\n";
$content .= '<noscript>' . "\n";
$content .= zen_image_submit(PF_NOSCRIPT_SUBMIT, PF_NOSCRIPT_SUBMIT_ALT);
$content .= '</noscript>' . "\n";
$content .= '</div>' . "\n";
$content .= '</div>' . "\n";
$content .= '</form>' . "\n";
//<!--EOF Product Finder-->
$content .= '</div>';
