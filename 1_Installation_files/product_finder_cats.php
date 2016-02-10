<?php

/* Product Finder mod
 * product_finder_cats.php
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: product_finder_cats.php 2015-10-02
 */
require('includes/application_top.php');

$dd_cPath = $_POST['dd_cPath'];//the id of the category selected and submitted by the change in the dropdown

if ($_POST['dd_cPath']!="") {

  $product_to_categories_query = "select distinct categories_id from " . TABLE_PRODUCTS_TO_CATEGORIES;
  $product_c_result = $db->Execute($product_to_categories_query);
  $categories_array = array();
  $inarray = '';
  $count = 0;
  while (!$product_c_result->EOF) {
    $categories_array[] = $product_c_result->fields['categories_id'];
    if ($count == 0) {
      $inarray.=$product_c_result->fields['categories_id'];
    } else {
      $inarray.=',' . $product_c_result->fields['categories_id'];
    }
    $product_c_result->MoveNext();
    $count = 1;
  }
  $inarray = ' IN (' . $inarray . ')';

  $product_to_categories_query = "SELECT c.categories_id, cd.categories_name, c.parent_id
                                  FROM " . TABLE_CATEGORIES . " c
                                  INNER JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd ON c.categories_id = cd.categories_id
                                  AND cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                                  AND c.categories_id " . $inarray . "
                                  ORDER BY cd.categories_name";

  $product_c_result = $db->Execute($product_to_categories_query);
  $categories_array = array();
  $inarray = '';
  $count = 0;
  while (!$product_c_result->EOF) {
    $categories_array[] = $product_c_result->fields['categories_id'];
    $categories_array1[] = $product_c_result->fields['categories_name'];
    $categories_array2[] = $product_c_result->fields['parent_id'];
    $product_c_result->MoveNext();
  }

  $categories = "SELECT c.categories_id, cd.categories_name, c.parent_id
                 FROM " . TABLE_CATEGORIES . " c
                 INNER JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd ON c.categories_id = cd.categories_id
                 AND c.categories_status = 1
                 AND cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                 AND c.parent_id = '" . $dd_cPath . "'
                 ORDER BY cd.categories_name";

  $expected = $db->Execute($categories);
  $ids = '';
  $name = '';
  $count = 0;
  while (!$expected->EOF) {
    if (in_array($expected->fields['categories_id'], $categories_array2) || in_array($expected->fields['categories_id'], $categories_array)) {
      if ($count == 0) {
        $ids = '^';
        $name = '^';
      }
      $ids.=$expected->fields['categories_id'] . '^';
      $name.=$expected->fields['categories_name'] . '^';
      $count = 1;
    }
    $expected->MoveNext();
  }
  if ($count == 1) {
    echo $ids . '|' . $name;
  }
}
