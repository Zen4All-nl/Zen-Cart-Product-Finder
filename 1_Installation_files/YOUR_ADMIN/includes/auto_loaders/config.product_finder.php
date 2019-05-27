<?php

/**
 * @package functions
 * @copyright Copyright 2003-2014 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: config.product_finder.php 2019-05-10
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

$autoLoadConfig[999][] = array(
  'autoType' => 'init_script',
  'loadFile' => 'init_product_finder.php'
);
