<?php

/** Product Finder mod
 * modellist.php
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: modellist.php 2010-09-29
 */
require('includes/application_top.php');
$manufacturers_id = $_REQUEST['cPath'];
if ($_REQUEST['cPath'] != "") {
  $categories = "select c.categories_id, cd.categories_name, c.parent_id
                                from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
                                where c.categories_id = cd.categories_id
                                and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                                and c.parent_id = '" . $manufacturers_id . "' 
                                order by c.sort_order, cd.categories_name";
  $product_to_categories_query = "select distinct categories_id from " . TABLE_PRODUCTS_TO_CATEGORIES;
  $product_c_result = $db->Execute($product_to_categories_query);
  $categories_array = array();
  $inarray = "";
  $count = 0;
  while (!$product_c_result->EOF) {
    $categories_array[] = $product_c_result->fields['categories_id'];
    if ($count == 0) {
      $inarray.=$product_c_result->fields['categories_id'];
    } else {
      $inarray.="," . $product_c_result->fields['categories_id'];
    }
    $product_c_result->MoveNext();
    $count = 1;
  }
  $inarray = " IN (" . $inarray . ")";
  $product_to_categories_query = "select c.categories_id, cd.categories_name, c.parent_id
                                from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
                                where c.categories_id = cd.categories_id
                                and cd.language_id = '" . (int)$_SESSION['languages_id'] . "' and c.categories_id " . $inarray . " 
                                order by c.sort_order, cd.categories_name";
  $product_c_result = $db->Execute($product_to_categories_query);
  $categories_array = array();
  $inarray = "";
  $count = 0;
  while (!$product_c_result->EOF) {
    $categories_array[] = $product_c_result->fields['categories_id'];
    $categories_array1[] = $product_c_result->fields['categories_name'];
    $categories_array2[] = $product_c_result->fields['parent_id'];
    $product_c_result->MoveNext();
  }
  $expected = $db->Execute($categories);
  $ids = "";
  $name = "";
  $count = 0;
  while (!$expected->EOF) {
    if (in_array($expected->fields['categories_id'], $categories_array2) || in_array($expected->fields['categories_id'], $categories_array)) {
      if ($count == 0) {
        $ids = "^";
        $name = "^";
      }
      $ids.=$expected->fields['categories_id'] . "^";
      $name.=$expected->fields['categories_name'] . "^";
      $count = 1;
    }
    $expected->MoveNext();
  }
  if ($count == 1)
    echo $ids . "|" . $name;
}
?>