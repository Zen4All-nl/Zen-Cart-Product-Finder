<?php

/**
 * Product Finder mod
 * /includes/functions/extra_functions/product_finder_functions.php
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: product_finder_functions.php 2019-05-25
 */
function pf_get_subcategories($parent_id)
{
  global $db;

  $subcategory_array[] = array(
    'id' => '-1',
    'text' => PF_TEXT_PLEASE_SELECT
  );

  if (!$parent_id) {
    return $subcategory_array; //return if $parent_id not set
  }

  if ($parent_id != '0') {
    $subcategories = $db->Execute("SELECT c.categories_id, cd.categories_name, c.parent_id
                                   FROM " . TABLE_CATEGORIES . " c
                                   INNER JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd ON cd.categories_id = c.categories_id
                                   AND c.categories_status = 1
                                   AND cd.language_id = " . (int)$_SESSION['languages_id'] . "
                                   AND c.parent_id = " . (int)$parent_id . "
                                   ORDER BY cd.categories_name");

    foreach ($subcategories as $subcategory) {
      $subcategory_array[] = array(
        'id' => $subcategory['categories_id'],
        'text' => $subcategory['categories_name']
      );
    }
  }
  return $subcategory_array;
}
