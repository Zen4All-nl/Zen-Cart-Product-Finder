<?php

/* Product Finder module
 * @version 1.0.0
 * @author Zen4All
 * @copyright (c) 2014-2019, Zen4All
 * @license http://www.gnu.org/licenses/gpl.txt GNU General Public License V2.0
 */

class zcAjaxProductFinderCats extends base {

  public function getCategories()
  {
    global $db;

    $dd_cPath = $_POST['dd_cPath']; //the id of the category selected and submitted by the change in the dropdown

    if ($_POST['dd_cPath'] != '') {

      $allProductToCategoriesQuery = "SELECT DISTINCT categories_id
                                      FROM " . TABLE_PRODUCTS_TO_CATEGORIES;
      $allProductToCategories = $db->Execute($allProductToCategoriesQuery);
      $categoriesArray = array();
      foreach ($allProductToCategories as $result) {
        $categoriesArray[] = $result['categories_id'];
      }

      $productToCategoriesQuery = "SELECT c.categories_id, cd.categories_name, c.parent_id
                                   FROM " . TABLE_CATEGORIES . " c
                                   INNER JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd ON c.categories_id = cd.categories_id
                                   AND cd.language_id = " . (int)$_SESSION['languages_id'] . "
                                   AND c.categories_id IN (" . implode(',', $categoriesArray) . ")
                                   ORDER BY cd.categories_name";

      $productToCategories = $db->Execute($productToCategoriesQuery);
      $categories_array = array();
      foreach ($productToCategories as $result) {
        $categories_array[] = $result['categories_id'];
        $categories_array1[] = $result['categories_name'];
        $categories_array2[] = $result['parent_id'];
      }

      $categories = "SELECT c.categories_id, cd.categories_name, c.parent_id
                     FROM " . TABLE_CATEGORIES . " c
                     INNER JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd ON cd.categories_id = c.categories_id
                     AND c.categories_status = 1
                     AND cd.language_id = " . (int)$_SESSION['languages_id'] . "
                     AND c.parent_id = " . $dd_cPath . "
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
          $ids .= $expected->fields['categories_id'] . '^';
          $name .= $expected->fields['categories_name'] . '^';
          $count = 1;
        }
        $expected->MoveNext();
      }
      if ($count == 1) {
        $values = $ids . '|' . $name;
      }
    }
    return([
      'categories_array' => $categories_array,
      'categories_array2' => $categories_array2,
      'cats' => $expected,
      'data' => $dd_cPath,
      'values' => $values
    ]);
  }

}
