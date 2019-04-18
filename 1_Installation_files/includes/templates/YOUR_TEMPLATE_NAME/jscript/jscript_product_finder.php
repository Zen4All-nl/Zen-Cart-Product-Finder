<?php
/*
 * Product Finder mod
 * /includes/templates/YOUR_TEMPLATE/jscript/jscript_model_year.php
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: jscript_model_year.php 2015-10-03-->
 */
?>

<script type="text/javascript">

  $(document).ready(function () {
      $('#pf_dd1').change(drop_down2);
      $('#pf_dd2').change(drop_down3);
      $('#cPath').change(cpath);
  });

  function drop_down2() {
      var dd1 = $('#pf_dd1').val();
      zcJS.ajax({
          url: 'ajax.php?act=ajaxProductFinderCats&method=getCategories',
          data: {
              'dd_cPath': dd1
          }
      }).done(function (data) {
          $('#pf_dd2').empty();
          $('#cPath').empty();
          $('#pf_dd2').append('<option value="-1"><?php echo PF_TEXT_PLEASE_SELECT; ?><\/option>');
          $('#cPath').append('<option value="-1"><?php echo PF_TEXT_PLEASE_SELECT; ?></option>');
          for (let i = 0; i < data.valuesArray.length; i++) {
              $('#pf_dd2').append('<option> value="' + data.valuesArray[i].id + '">' + data.valuesArray[i].name + '</option>');
          }
      });
  }
  function drop_down3() {
      var dd2 = $('#pf_dd2').val();
      zcJS.ajax({
          url: 'ajax.php?act=ajaxProductFinderCats&method=getCategories',
          data: {
              'dd_cPath': dd2
          }
      }).done(function (data) {
          $('#cPath').empty();
          $('#cPath').append('<option value="-1"><?php echo PF_TEXT_PLEASE_SELECT; ?></option>');
          for (let i = 0; i < data.valuesArray.length; i++) {
              $('#cPath').append('<option value="' + data.valuesArray[i].id + '">' + data.valuesArray[i].name + '</option>');
          }
      });
  }
  function cpath() {
      var pf_base_category = $('#pf_base_category').val();
      var cPath1 = $('#pf_dd1').val();
      var cPath2 = $('#pf_dd2').val();
      var cPath3 = $('#cPath').val();
      $('#productFinderform').attr('action', 'index.php?main_page=index&cPath=' + pf_base_category + '_' + cPath1 + '_' + cPath2 + '_' + cPath3);
      $('#productFinderform').attr('method', 'post');
      $('#productFinderform').submit();

  }
</script>