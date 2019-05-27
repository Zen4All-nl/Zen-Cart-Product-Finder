<?php
/* Product Finder module
 * ADMIN/includes/installers/product_finder/1_1_0.php
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: 1_1_0.php 2019-05-25
 */

$db->Execute("UPDATE " . TABLE_CONFIGURATION . "
              SET configuration_title = 'Show the Product Finder template block',
                  configuration_key = 'PRODUCT_FINDER_TEMPLATE_ENABLE',
                  configuration_description = 'The Product Finder page <strong>template</strong> block and Product Finder <strong>sidebox</strong> cannot be used on the same page as they share the module code (same ids and javascript). If you enable the Product Finder sidebox, you must also disable this Product Finder template block.<br><br>Show the Product Finder template block.'
              WHERE configuration_key = 'PRODUCT_FINDER_ENABLE'");

$db->Execute("UPDATE " . TABLE_CONFIGURATION . "
              SET configuration_title = 'Parent Category ID',
                  configuration_description = 'The ID of the parent category that contains the drop-down sub-categories.'
              WHERE configuration_key = 'PRODUCT_FINDER_PARENT_ID'");

$db->Execute("UPDATE " . TABLE_CONFIGURATION . "
              SET configuration_title = 'Category Depth',
                  configuration_description = 'Number of drop-downs.<br>Note that the code must be manually modified to support more than three drop-downs.'
              WHERE configuration_key = 'PRODUCT_FINDER_CATEGORY_DEPTH'");