<?php

/**
 * blank sidebox - allows a blank sidebox to be added to your site
 *
 * @package templateSystem
 * @copyright 2007 Kuroi Web Design
 * @copyright Portions Copyright 2003-2007 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: blank_sidebox.php 2007-05-26 kuroi $
 */
// test if box should display
$show_product_finder = true;

if ($show_product_finder == true) {
  require($template->get_template_dir('tpl_product_finder.php', DIR_WS_TEMPLATE, $current_page_base, 'sideboxes') . '/tpl_product_finder.php');
  $title = BOX_HEADING_PRODUCT_FINDER;
  $title_link = false;
  require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base, 'common') . '/' . $column_box_default);
}
