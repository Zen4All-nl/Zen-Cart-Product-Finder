<?php
/*
 * Product Finder module
 * /includes/templates/YOUR_TEMPLATE/jscript/jscript_product_finder.php
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: product_finder.php 2019-05-25
 */
/*
 * This code is used by either the template block or the sidebox
 * This javascript only monitors the dropdowns for a change. On a change, the next dropdown is populated with new options and subsequent dropdowns are reset. When a selection is made in the last dropdown, the form is submitted to go to that new category.
 * If  manually navigating through a site, the template code checks the current page cPath to see if it falls within the Product Finder scope of categories and any relevant dropdowns are pre-populated to reflect that current page: manual navigation does not use/trigger this javascript.
 */
?>
<script title="product finder">
    const pfDebug = false;//for debugging...no really. Most info is in the console.
    //////////////////////////////////////////////////
    if (pfDebug) console.log("pfDebug true");
    const pleaseSelect = '<option value="-1"><?php echo PF_TEXT_PLEASE_SELECT; ?></option>';
    const parentID = parseInt('<?php echo PRODUCT_FINDER_PARENT_ID; ?>');
    const categoryDepth = parseInt('<?php echo PRODUCT_FINDER_CATEGORY_DEPTH; ?>');

    $(document).ready(function () {
        $('.pf_selectBoxContent').change(function () {//monitor all the dropdowns
            update(this.id)
        });
    });

    function update(idDropdown) {//the dropdown id is passed (without the #)
        let ddNum = parseInt(idDropdown.replace('pf_dd', ''));//get which dropdown it is, numerically

        if (pfDebug) console.log("initiator=" + idDropdown);

        if (ddNum === categoryDepth) {//if the final dropdown was changed, submit the form to redirect to the new category
            let cPath = parentID;
            for (let i = 1; i < categoryDepth + 1; i++) {//build the full cPath
                cPath += '_' + $('#pf_dd' + i).val();
            }
            if (pfDebug) alert("pfDebug: cPath=" + cPath);//shown as an alert to pause process, or you could change it to console.log and persist the log

            $('#productFinderform').attr({action: 'index.php?main_page=index&cPath=' + cPath, method: 'post'}).submit();
        } else {//a.n.other dropdown was changed: so update the next and reset the rest
            let ddValue = $('#' + idDropdown).val();//get the new value of that dropdown
            if (pfDebug) console.log("dropdown " + '#' + idDropdown + " changed, new value=" + ddValue + ':' + $('#' + idDropdown + ' option:selected').text());
            //get the category tree for the next dropdown
            zcJS.ajax({
                url: 'ajax.php?act=ajaxProductFinderCats&method=getCategories',
                data: {
                    'dd_cPath': ddValue
                }
            }).done(function (data) {
                if (pfDebug) console.log("ajax data.valuesArray for #pf_dd" + (ddNum + 1) + ":\n" + JSON.stringify(data.valuesArray));

                //let options = pleaseSelect;//initial entry in the options list
                let options = '';//initial entry in the options list
                for (let i = 0; i < data.valuesArray.length; i++) {//build the options list
                    options += "\n" + '<option value="' + data.valuesArray[i].id + '">' + data.valuesArray[i].text + '</option>';
                }
                //if (pfDebug) console.log("options:\n" + options);
                $('#pf_dd' + (ddNum + 1)).html(options);//set options for next dropdown
                for (let i = ddNum + 2; i < categoryDepth + 1; i++) {//reset all the subsequent dropdowns
                    if (pfDebug) console.log('reset #pf_dd' + i);
                    $('#pf_dd' + i).html(pleaseSelect);
                }
            })
        }
    }
</script>