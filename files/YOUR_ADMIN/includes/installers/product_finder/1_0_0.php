<?php
// use $configuration_group_id where needed

// For Admin Pages

$zc150 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= 5));
if ($zc150) { // continue Zen Cart 1.5.0
    $admin_page = 'configProductFinder';
  // delete configuration menu
  $db->Execute("DELETE FROM ".TABLE_ADMIN_PAGES." WHERE page_key = '".$admin_page."' LIMIT 1;");
  // add configuration menu
  if (!zen_page_key_exists($admin_page)) {
    if ((int)$configuration_group_id > 0) {
      zen_register_admin_page($admin_page,
                              'BOX_CONFIGURATION_PRODUCT_FINDER', 
                              'FILENAME_CONFIGURATION',
                              'gID=' . $configuration_group_id, 
                              'configuration', 
                              'Y',
                              $configuration_group_id);
        
      $messageStack->add('Enabled MODULE Configuration Menu.', 'success');
    }
  }
}

/* If your checking for a field
 * global $sniffer;
 * if (!$sniffer->field_exists(TABLE_SOMETHING, 'column'))  $db->Execute("ALTER TABLE " . TABLE_SOMETHING . " ADD column varchar(32) NOT NULL DEFAULT 'both';");
 */
/*
 * For adding a configuration value
 */
  $db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_group_id, configuration_key, configuration_title, configuration_value, configuration_description, sort_order, set_function)
                VALUES
                (" . (int) $configuration_group_id . ", 'PRODUCT_FINDER_PARENT_ID', 'Top-level category', '', 'Enter a category id to tell the code which top-level category to start from.', 2, NULL),
                (" . (int) $configuration_group_id . ", 'PRODUCT_FINDER_ENABLE', 'Enable Product Finder', 'false', 'Enable / disable Product Finder', 1, 'zen_cfg_select_option(array(\'true\', \'false\'),');");
