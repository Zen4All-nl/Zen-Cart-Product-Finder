<?php

/** Product Finder mod
 * /includes/functions/extra_functions/product_finder.php
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: product_finder.php 2010-08-05
 */
function zen_my_image_submit($image, $alt = '', $parameters = '', $sec_class = '') {
  global $template, $current_page_base, $zco_notifier;
  $zco_notifier->notify('PAGE_OUTPUT_IMAGE_SUBMIT');
  $image_submit = '<input type="image" src="' . zen_output_string($template->get_template_dir($image, DIR_WS_TEMPLATE, $current_page_base, 'buttons/' . $_SESSION['language'] . '/') . $image) . '" alt="' . zen_output_string($alt) . '"';

  if (zen_not_null($alt))
    $image_submit .= ' title=" ' . zen_output_string($alt) . ' "';

  if (zen_not_null($parameters))
    $image_submit .= ' ' . $parameters;

  $image_submit .= ' />';

  return $image_submit;
}

function zen_products_in_category_count($categories_id, $include_child = true, $limit = false) {
  global $db;
  $products_count = 0;

  if ($limit) {
    $limit_count = ' limit 1';
  } else {
    $limit_count = '';
  }


  $products = $db->Execute("select count(*) as total
                                from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                                where p.products_id = p2c.products_id
                                and p.products_status = 1
                                and p2c.categories_id = '" . (int)$categories_id . "'" . $limit_count);



  $products_count += $products->fields['total'];

  if ($include_child) {
    $childs = $db->Execute("select categories_id from " . TABLE_CATEGORIES . "
                              where parent_id = '" . (int)$categories_id . "'");
    if ($childs->RecordCount() > 0) {
      while (!$childs->EOF) {
        $products_count += zen_products_in_category_count($childs->fields['categories_id']);
        $childs->MoveNext();
      }
    }
  }
  return $products_count;
}

function zen_get_category_tree($parent_id = '3', $category_tree_array = '') {
  global $db;

  if (!is_array($category_tree_array))
    $category_tree_array = array();

  $categories = $db->Execute("select c.categories_id, cd.categories_name, c.parent_id
                                from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
                                where c.categories_id = cd.categories_id
                                and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                                and c.parent_id = '" . (int)$parent_id . "'
                                order by c.sort_order, cd.categories_name");

  while (!$categories->EOF) {
    if (zen_products_in_category_count($categories->fields['categories_id'], true, true) >= 1) {
      $category_tree_array[] = array('id' => $categories->fields['categories_id'], 'text' => $categories->fields['categories_name']);
    }
    $categories->MoveNext();
  }

  return $category_tree_array;
}
