<?php
/** Product Finder code added from line 108 - @version $Id: 2010-09-29
 * Common Template - tpl_header.php
 *
 * this file can be copied to /templates/your_template_dir/pagename<br />
 * example: to override the privacy page<br />
 * make a directory /templates/my_template/privacy<br />
 * copy /templates/templates_defaults/common/tpl_footer.php to /templates/my_template/privacy/tpl_header.php<br />
 * to override the global settings and turn off the footer un-comment the following line:<br />
 * <br />
 * $flag_disable_header = true;<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_header.php 4813 2006-10-23 02:13:53Z drbyte $
 */
?>
<?php
  // Display all header alerts via messageStack:
  if ($messageStack->size('header') > 0) {
    echo $messageStack->output('header');
  }
  if (isset($_GET['error_message']) && zen_not_null($_GET['error_message'])) {
  echo htmlspecialchars(urldecode($_GET['error_message']));
  }
  if (isset($_GET['info_message']) && zen_not_null($_GET['info_message'])) {
   echo htmlspecialchars($_GET['info_message']);
} else {

}
?>

<!--bof-header logo and navigation display-->
<?php
if (!isset($flag_disable_header) || !$flag_disable_header) {
?>
<div id="headerWrapper"> 
  <!--bof-navigation display-->
  <div id="navMainWrapper">
    <div id="navMain">
      <ul class="back">
        <li><?php echo '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">'; ?><?php echo HEADER_TITLE_CATALOG; ?></a></li>
        <?php if ($_SESSION['customer_id']) { ?>
        <li><a href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>"><?php echo HEADER_TITLE_LOGOFF; ?></a></li>
        <li><a href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>"><?php echo HEADER_TITLE_MY_ACCOUNT; ?></a></li>
        <?php
      } else {
        if (STORE_STATUS == '0') {
?>
        <li><a href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>"><?php echo HEADER_TITLE_LOGIN; ?></a></li>
        <?php } } ?>
        <?php if ($_SESSION['cart']->count_contents() != 0) { ?>
        <li><a href="<?php echo zen_href_link(FILENAME_SHOPPING_CART, '', 'NONSSL'); ?>"><?php echo HEADER_TITLE_CART_CONTENTS; ?></a></li>
        <li><a href="<?php echo zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>"><?php echo HEADER_TITLE_CHECKOUT; ?></a></li>
        <?php }?>
      </ul>
    </div>
    <div id="navMainSearch">
      <?php require(DIR_WS_MODULES . 'sideboxes/search_header.php'); ?>
    </div>
    <br class="clearBoth" />
  </div>
  <!--eof-navigation display--> 
  
  <!--bof-branding display-->
  <div id="logoWrapper">
    <div id="logo"><?php echo '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">' . zen_image($template->get_template_dir(HEADER_LOGO_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . HEADER_LOGO_IMAGE, HEADER_ALT_TEXT) . '</a>'; ?></div>
    <?php if (HEADER_SALES_TEXT != '' || (SHOW_BANNERS_GROUP_SET2 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET2))) { ?>
    <div id="taglineWrapper">
      <?php
              if (HEADER_SALES_TEXT != '') {
?>
      <div id="tagline"><?php echo HEADER_SALES_TEXT;?></div>
      <?php
              }
?>
      <?php
              if (SHOW_BANNERS_GROUP_SET2 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET2)) {
                if ($banner->RecordCount() > 0) {
?>
      <div id="bannerTwo" class="banners"><?php echo zen_display_banner('static', $banner);?></div>
      <?php
                }
              }
?>
    </div>
    <?php } // no HEADER_SALES_TEXT or SHOW_BANNERS_GROUP_SET2 ?>
  </div>
  <br class="clearBoth" />
  <!--eof-branding display--> 
  
  <!--eof-header logo and navigation display--> 
  
  <!--bof-optional categories tabs navigation display-->
  <?php require($template->get_template_dir('tpl_modules_categories_tabs.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_categories_tabs.php'); ?>
  <!--eof-optional categories tabs navigation display--> 
  
  <!--bof-header ezpage links-->
  <?php if (EZPAGES_STATUS_HEADER == '1' or (EZPAGES_STATUS_HEADER == '2' and (strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])))) { ?>
  <?php require($template->get_template_dir('tpl_ezpages_bar_header.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_ezpages_bar_header.php'); ?>
  <?php } ?>
  <!--eof-header ezpage links--> 
</div>
<!--BOF Product Finder-->
<div class="clearBoth"></div>
<div id="product_finder_wrapper">
  <div id="product_finder">
    <?php 
	 echo "<form action=''>";			
?>
    <ul>
      <?php
   echo "<li>";
   $model1[]=array('id'=>'','text'=>TEXT_PLEASE_SELECT);
	 if(isset($_REQUEST['cPath1'])){
	 $value=$_REQUEST['cPath1'];
	 }	 
	 echo '<span id="pf_title">'.strip_tags(TEXT_FIND_ALL_PRODUCTS).'</span>
	 <span class="pf_selectbox_name">'.TEXT_MAKE . '</span>' . zen_draw_pull_down_menu('cPath1',array_merge($model1,zen_get_category_tree()),$value, 'id="cPath" class="pf_selectbox_text"'); 
	 echo "</li>\n";
   
	echo '<li>';   
	echo '<noscript>';
echo zen_my_image_submit(PF_NOSCRIPT_SUBMIT, 'Go');
         if($_REQUEST['cPath1']!=""){
               $value=$_REQUEST['cPath1'];
			   $dropdownArray=zen_get_category_tree($value);
         }
echo "</noscript>";
 echo "</li>\n";    

echo "<li>";
	  $modulePath="".DIR_WS_CATALOG;
	  echo zen_draw_hidden_field('basemodulepath',$modulePath,'id="basemodulepath" ');
	 $model=array();
	 $model[]=array('id'=>'',
	                 'text'=>TEXT_PLEASE_SELECT
					 );
	   if($_REQUEST['cPath1']!=""){
	    $model=array_merge($model,$dropdownArray);
	    }
	if(isset($_REQUEST['select_model'])){
	$value=$_REQUEST['select_model'];
	}
	 echo '<span class="pf_selectbox_name">' . TEXT_MODEL .'</span>' 
	 . zen_draw_pull_down_menu('select_model', $model, $value, 'id="select_model" class="pf_selectbox_text"'); 
 echo "</li>\n";

echo "<li>";
echo "<noscript>";
if($_REQUEST['select_model']!=""){
               $value=$_REQUEST['select_model'];
			   $dropdownArray=zen_get_category_tree($value); 
         }
echo zen_my_image_submit(PF_NOSCRIPT_SUBMIT, 'Go');	 
echo "</noscript>";
 echo "</li>\n";

echo "<li>";
	 $year=array();
	 $year[]=array('id'=>'',
	                 'text'=>TEXT_PLEASE_SELECT
					 );
	  if($_REQUEST['select_model']!=""){
	    $year=array_merge($year,$dropdownArray);
	    }				 				 
if(isset($_REQUEST['cPath'])){
          $value=$_REQUEST['cPath'];
}
if($_REQUEST['select_model']!=""){
	 echo '<span class="pf_selectbox_name">' . TEXT_YEAR . '</span>' . 
	 zen_draw_pull_down_menu('cPath',$year , $value, 'id="select_year" class="pf_selectbox_text"');
	 }
else {
	 echo '<span class="pf_selectbox_name">' . TEXT_YEAR .'</span>' .
	 zen_draw_pull_down_menu('cPath22',$year , $value, 'id="select_year" class="pf_selectbox_text"');
}	 
echo "</li>\n";

echo "<li>";
echo "<noscript>";
if($_REQUEST['cPath']!=""){
         $value=$_REQUEST['cPath'];
	     }
echo zen_my_image_submit(PF_NOSCRIPT_SUBMIT, 'Go');
echo "</noscript>";
 echo "</li>\n";
?>
    </ul>
    </form>
  </div><!--close product_finder div--> 
</div>
<!--close product_finder_wrapper div-->
<div class="clearBoth"></div>
<!--EOF Product Finder-->

<?php } ?>
