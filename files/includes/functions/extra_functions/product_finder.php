<?php

/** Product Finder mod
 * /includes/functions/extra_functions/product_finder.php
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: product_finder.php 2015-10-02
 */

function pf_get_category_tree($parent_id) {
  global $db;

  $category_tree_array[] = array('id' => '0', 'text' => PF_TEXT_PLEASE_SELECT);

if (!$parent_id) return $category_tree_array;//return if $parent_id not set

if ($parent_id != '0') {
  $categories = $db->Execute("SELECT c.categories_id, cd.categories_name, c.parent_id
                              FROM " . TABLE_CATEGORIES . " c
                              INNER JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd ON c.categories_id = cd.categories_id
                              AND c.categories_status = 1
                              AND cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                              AND c.parent_id = '" . (int)$parent_id . "'
                              ORDER BY cd.categories_name");

  while (!$categories->EOF) {
      $category_tree_array[] = array('id' => $categories->fields['categories_id'], 'text' => $categories->fields['categories_name']);

    $categories->MoveNext();
  }
}
  return $category_tree_array;
}
