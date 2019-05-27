<?php

/* Product Finder module
 * @version 1.1.0
 * @author Zen4All
 * @updated by TorVista & Zen4All
 * @copyright (c) 2014-2019, Zen4All
 * @license http://www.gnu.org/licenses/gpl.txt GNU General Public License V2.0
 * @version $Id: zcAjaxProductFinderCats.php 2019-05-25
 */

class zcAjaxProductFinderCats extends base {

  public function getCategories()
  {
    global $db;
    $valuesArray = pf_get_subcategories((int)$_POST['dd_cPath']); //the id of the category selected and submitted by the change in the dropdown
    return ([
      'valuesArray' => $valuesArray
    ]);
  }

}
