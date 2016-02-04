<?php
/*
 * Product Finder mod
 * /includes/templates/YOUR_TEMPLATE/jscript/jscript_model_year.php
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: jscript_model_year.php 2015-10-03-->
 */
?>

<script type="text/javascript"><!--

  $(document).ready(function () {
    $("#pf_dd1").change(dropdown2);
    $("#pf_dd2").change(dropdown3);
    //$("#select_year").focus();
    $("#cPath").change(function () {
      var pf_base_category = document.getElementById("pf_base_category").value;
      var cPath1 = $("#pf_dd1").val();
      var cPath2 = $("#pf_dd2").val();
      var cPath3 = $("#cPath").val();
      $('#productFinderform').attr('action', "index.php?main_page=index&cPath=" + pf_base_category + "_" + cPath1 + "_" + cPath2 + "_" + cPath3);
      $('#productFinderform').attr('method', "post");
      $('#productFinderform').submit();

    });
  });

  var dropdown2 = function drop_down2() {
    var dd1 = document.getElementById("pf_dd1").value;
    $.ajax({
      type: 'POST',
      url: "product_finder_cats.php",
      data: "dd_cPath=" + dd1,
      success: function (data) {
        if (data != "") {
          arrayVar = new Array();
          arrayVar = data.split("|");
          arrayVarId = new Array();
          arrayVarId = arrayVar[0].split("^");
          arrayVarName = new Array();
          arrayVarName = arrayVar[1].split("^");
          $('#pf_dd2').html("");
          $('#pf_dd2').append("<option value=''><?php echo PF_TEXT_PLEASE_SELECT; ?><\/option>");
          for (i = 1; i < arrayVarId.length - 1; i++) {
            $('#pf_dd2').append($("<option><\/option>").prop("value", arrayVarId[i]).text(arrayVarName[i]));
          }
        }
      }
    });
  };
  var dropdown3 = function drop_down3() {
    var dd2 = document.getElementById("pf_dd2").value;
    $.ajax({
      type: 'POST',
      url: "product_finder_cats.php",
      data: "dd_cPath=" + dd2,
      success: function (data) {
        if (data != "") {
          arrayVar = new Array();
          arrayVar = data.split("|");
          arrayVarId = new Array();
          arrayVarId = arrayVar[0].split("^");
          arrayVarName = new Array();
          arrayVarName = arrayVar[1].split("^");
          $('#cPath').html("");
          $('#cPath').append("<option value=''><?php echo PF_TEXT_PLEASE_SELECT; ?><\/option>");

          for (i = 1; i < arrayVarId.length - 1; i++) {
            $('#cPath').append($("<option><\/option>").prop("value", arrayVarId[i]).text(arrayVarName[i]));
          }
        }
      }
    });
  };
//--></script>