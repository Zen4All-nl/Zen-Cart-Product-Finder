<?php

/* Product Finder module
 * @version 1.1.0
 * @author Zen4All
 * @ Updated by Torvista
 * @copyright (c) 2014-2019, Zen4All
 * @license http://www.gnu.org/licenses/gpl.txt GNU General Public License V2.0
 * @version $Id: product_finder.php 2019-05-25
 */
require($template->get_template_dir('tpl_product_finder.php', DIR_WS_TEMPLATE, $current_page_base, 'sideboxes') . '/tpl_product_finder.php');
$title = BOX_HEADING_PRODUCT_FINDER;
$title_link = false;//do not make the heading into a link
require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base, 'common') . '/' . $column_box_default);
