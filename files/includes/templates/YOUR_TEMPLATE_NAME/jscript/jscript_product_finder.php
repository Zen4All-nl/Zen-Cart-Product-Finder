<!-- Product Finder mod
/includes/templates/YOUR_TEMPLATE/jscript/jscript_model_year.php
@license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
@version $Id: jscript_model_year.php 2010-09-29-->

<script type="text/javascript"><!--

  $(document).ready(function () {
    $("#cPath").change(modelList);
    $("#select_model").change(yearList);
    //$("#select_year").focus();
    $("#select_year").change(function ()
    {
      var baseDirectory = document.getElementById("basemodulepath").value;
      var cPath1 = $("#cPath").val();
      var cPath2 = $("#select_model").val();
      var cPath3 = $("#select_year").val();
      window.location = (baseDirectory + "index.php?main_page=index&cPath=" + cPath1 + "_" + cPath2 + "_" + cPath3);
    }
    );
  });
  var modelList = function model_list() {
    var baseDirectory = document.getElementById("basemodulepath").value;
    var cPath = document.getElementById("cPath").value;
    $.ajax({
      type: 'POST',
      url: baseDirectory + "modellist.php",
      data: "cPath=" + cPath + "&my=1",
      success: function (data) {
        // alert(data);
        if (data != "") {
          arrayVar = new Array();
          arrayVar = data.split("|");
          arrayVarId = new Array();
          arrayVarId = arrayVar[0].split("^");
          arrayVarName = new Array();
          arrayVarName = arrayVar[1].split("^");
          $('#select_model').html("");
          $('#select_model').append("<option value=''><?php echo TEXT_PLEASE_SELECT; ?><\/option>");
          for (i = 1; i < arrayVarId.length - 1; i++)
          {
            $('#select_model').append($("<option><\/option>").attr("value", arrayVarId[i]).text(arrayVarName[i]));
          }
        }
      }
    });
  };
  var yearList = function year_list() {
    var baseDirectory = document.getElementById("basemodulepath").value;
    var cPath = document.getElementById("select_model").value;
    $.ajax({
      type: 'POST',
      url: baseDirectory + "modellist.php",
      data: "cPath=" + cPath + "&my=2",
      success: function (data) {
        if (data != "") {
          arrayVar = new Array();
          arrayVar = data.split("|");
          arrayVarId = new Array();
          arrayVarId = arrayVar[0].split("^");
          arrayVarName = new Array();
          arrayVarName = arrayVar[1].split("^");
          $('#select_year').html("");
          $('#select_year').append("<option value=''><?php echo TEXT_PLEASE_SELECT; ?><\/option>");

          for (i = 1; i < arrayVarId.length - 1; i++)
          {
            $('#select_year').append($("<option><\/option>").attr("value", arrayVarId[i]).text(arrayVarName[i]));
          }
        }
      }
    });
  };
//--></script>