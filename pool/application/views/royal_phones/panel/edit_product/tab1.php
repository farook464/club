<?php
/*
 *  RETAILGENIUS.COM - Team Innovation 
 *  ---------------------------------
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
?>



<div class="tab-pane active form-horizontal" id="tab_1">

    <!--                                    <div id="the-basics">
                                            <input class="typeahead" type="text" placeholder="States of USA">
                                        </div>-->




    <div class="form-group">
        <label  class="col-sm-2 control-label">Product Name <span style="color:red">*</span></label>
        <div class="col-sm-10">
            <input readonly="" type="text" name="product_name" value="<?= htmlspecialchars($title); ?>" class="form-control"  placeholder="Product Name">
        </div>
    </div>

     <div class="form-group">
        <label  class="col-sm-2 control-label">Product Description <span style="color:red">*</span></label>
        <div class="col-sm-10">

            <div class="summernote" contenteditable="false"></div>
            <textarea readonly name="product_desc[product_details]"  class="product_details" style="display: none"></textarea>
        </div>
    </div>
    
     <div class="form-group">
        <label  class="col-sm-2 control-label">Product Technical Details</label>
        <div class="col-sm-10">

            <div class="summernote2" contenteditable="false"></div>
            <textarea readonly name="product_desc[tech_details]" class="tech_details"  style="display: none"></textarea>
            
            <div id="content"></div>
        </div>
    </div>
    
<!--    <div class="form-group">
        <label  class="col-sm-2 control-label">Meta Tag Title</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="<?= $meta_title; ?>" name="product_meta_title"  placeholder="Meta Tag Title">
        </div>
    </div>

    <div class="form-group">
        <label  class="col-sm-2 control-label">Meta Tag Description</label>
        <div class="col-sm-10">
            <textarea class="form-control"  name="product_meta_desc"  rows="3" placeholder="Meta Tag Description"><?= $meta_description; ?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label  class="col-sm-2 control-label">Meta Tag Keywords</label>
        <div class="col-sm-10">
            <textarea class="form-control" name="product_meta_keyword"  rows="3"placeholder="Meta Tag Keywords"><?= $meta_keywords; ?></textarea>
        </div>
    </div>
-->







</div>

<?php


//$desc = json_decode($item_description,TRUE);


?>

<textarea class="product_details_js_edit" style="display: none;"><?= htmlspecialchars($desc) ?></textarea>
<textarea class="tech_details_js_edit" style="display: none;"><?= htmlspecialchars($tech) ?></textarea>

<script>

    $(document).ready(function () {
        var data = $('.product_details_js_edit').val();
//         $('.summernote2').summernote('editor.insertText', data2);
      
        $('.summernote').html(data);
		
		$('.product_details').val(data);
        
        
        
        var data2 = $('.tech_details_js_edit').val();
        $('.summernote2').html(data2);
		$('.tech_details').val(data2);
                
                $('div.note-editable').eq(0).attr('contenteditable',false);
                        $('div.note-editable').eq(1).attr('contenteditable',false);
    });

</script>


<?php


?>