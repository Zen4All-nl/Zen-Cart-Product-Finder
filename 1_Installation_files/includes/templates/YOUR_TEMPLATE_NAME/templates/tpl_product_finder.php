<?php
/*
 * Product Finder module
 * /includes/functions/extra_functions/product_finder.php
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: product_finder.php 2010-08-05
 */
$pf_base_category = PRODUCT_FINDER_PARENT_ID; //USER defined base category
$pf_category_depth = PRODUCT_FINDER_CATEGORY_DEPTH; //USER defined base category
?>
<div class="clearBoth"></div>
<div id="product_finder_wrapper">
  <div id="product_finder">
    <?php
//check the current page location and separate the category and subcategory cPaths into an array
    if (isset($_GET['cPath']) && $_GET['cPath'] != '') {
      $pf_cPaths = explode("_", $_GET['cPath']);
    }

//check if the current page is a possible Product Finder category to pre-populate the dropdowns with the current category id/values
    if ((int)$pf_cPaths['0'] == $pf_base_category && count($pf_cPaths) == $pf_category_depth) {
//do nothing
    } else {//otherwise it is some other category 
      unset($pf_cPaths); //this location is NOT a Product Finder category so do not pre-populate the dropdowns
    }
//unset($pf_cPaths);//stop all pre-loading
//the product finder form action shown here is overwritten when js in use.
//when js is disabled, the PF form redirects the page by using the final dd to pass a complete $_GET['cPath']
//we only want this variable to be passed under certain conditions, otherwise invalid category paths are used.
//so, while building the complete cPath path using dd1,dd2 we pass the dd1 and dd2 values by POST so they don't appear in the URL, and when they are both set and only dd3 is left, we change the form action to GET to pass the last dd variable on submission.
//current page is outside PF cats and dd1 and dd2 have been selected
//if ( !isset($pf_cPaths) && (int)$_REQUEST['pf_dd1'] != 0 && (int)$_REQUEST['pf_dd2'] != 0){$pf_form_get = true;}
//current page is inside PF cats and dd1 AND dd2 are different/have been changed from the current page 
    if (isset($_POST['pf_dd1']) && $_POST['pf_dd1'] > 0 && isset($_POST['pf_dd2']) && $_POST['pf_dd2'] > 0) {
      echo zen_draw_form('productFinderform', FILENAME_DEFAULT, 'get', 'id="productFinderform"'); //action link required if CEON URI mapper in use
    } else {
      echo zen_draw_form('productFinderform', '', 'post', 'id="productFinderform"'); //while the first two are not set, use post to keep page url tidy
    }
    echo '<ul>' . "\n";
    echo '<li>' . "\n";
    if (isset($_POST['pf_dd1'])) {
      $pf_dd1_selected = (int)$_POST['pf_dd1'];
    } elseif ($pf_cPaths) {
      $pf_dd1_selected = $pf_cPaths['1'];
    }
    echo '<span id="pf_title">' . PF_TEXT_TITLE . '</span>' . "\n";
    echo '<span class="pf_selectbox_name"><label for="pf_dd1">' . PF_TEXT_DD1 . '</label></span>' . "\n";
    $pf_dd1_array = pf_get_category_tree((int)$pf_base_category);
    echo zen_draw_pull_down_menu('pf_dd1', $pf_dd1_array, $pf_dd1_selected, 'id="pf_dd1" class="pf_selectbox_text"');
    echo '</li>' . "\n";
    echo '<li class="pf_go">' . "\n";
    echo '<noscript>' . "\n";
    echo zen_image_submit(PF_NOSCRIPT_SUBMIT, PF_NOSCRIPT_SUBMIT_ALT);
    echo '</noscript>' . "\n";
    echo '</li>' . "\n";
    echo '<li>' . "\n";

    if (isset($_POST['pf_dd2'])) {
      $pf_dd2_selected = (int)$_POST['pf_dd2'];
    } elseif ($pf_cPaths) {
      $pf_dd2_selected = $pf_cPaths['2'];
    }
    echo '<span class="pf_selectbox_name"><label for="pf_dd2">' . PF_TEXT_DD2 . '</label></span>' . "\n";
    $pf_dd2_array = pf_get_category_tree((int)$pf_dd1_selected);
    echo zen_draw_pull_down_menu('pf_dd2', $pf_dd2_array, $pf_dd2_selected, 'id="pf_dd2" class="pf_selectbox_text"');
    echo '</li>' . "\n";
    echo '<li class="pf_go">' . "\n";
    echo '<noscript>' . "\n";
    echo zen_image_submit(PF_NOSCRIPT_SUBMIT, PF_NOSCRIPT_SUBMIT_ALT);
    echo '</noscript>' . "\n";
    echo '</li>' . "\n";
    echo '<li>' . "\n";
    echo '<span class="pf_selectbox_name"><label for="cPath">' . PF_TEXT_DD3 . '</label></span>' . "\n";

    $pf_dd3_array = pf_get_category_tree((int)$pf_dd2_selected); //build the array of subcategories
    $pf_dd3_array[0]['id'] = '';
    foreach ($pf_dd3_array as $key => $subarray) {
      if ($pf_dd3_array[$key]['id'] == 0) {
        $pf_dd3_array[$key]['id'] = '';
      } else {
        $pf_dd3_array[$key]['id'] = $pf_base_category . '_' . $pf_dd1_selected . '_' . $pf_dd2_selected . '_' . $pf_dd3_array[$key]['id']; //prefix the dd3 cPath values with the pre-selected dd1_dd2 cPath values. Only needed for noscript submit button to pass as a GET parameter, the js version does the same thing and inserts the action into the form.
      }
    }
    echo zen_draw_pull_down_menu('cPath', $pf_dd3_array, $pf_dd3_selected, 'id="cPath" class="pf_selectbox_text"');
    echo zen_draw_hidden_field('pf_base_category', $pf_base_category, 'id="pf_base_category" '); //to pass to js
    echo '</li>' . "\n";
    echo '<li class="pf_go">' . "\n";
    echo '<noscript>' . "\n";
    echo zen_image_submit(PF_NOSCRIPT_SUBMIT, PF_NOSCRIPT_SUBMIT_ALT);
    echo '</noscript>' . "\n";
    echo '</li>' . "\n";
    echo '</ul>' . "\n";
    echo '</form>' . "\n";
    ?>
  </div><!--close product_finder div-->
</div>
<!--close product_finder_wrapper div-->
<div class="clearBoth"></div>
