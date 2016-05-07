<?php
/*
 *  RETAILGENIUS.COM - Team Innovation 
 *  ---------------------------------
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
?>


<div class="tab-pane  form-horizontal" id="tab_3">


<!--    <div class="form-group">
        <label  class="col-sm-2 control-label">Supplier Email <span style="color:red">*</span></label>
        <div class="col-sm-10">
            <input type="text"  id="select_supplier"  class="form-control "  placeholder="Product Supplier">
            <input type="hidden" name="product_supplier"/>
           <p><a target="_new" title="Link will open in new tab" href="<?php // echo base_url("admin_jsessID/panel/suppliers/add"); ?> ">Create New Supplier</a></p>

        </div>
    </div>-->
    
    
    <div class="form-group">
        <label  class="col-sm-2 control-label">Supplier Note <span style="color:red">*</span></label>
        <div class="col-sm-10">
            <textarea name="product_supplier_note" id="product_supplier_note" placeholder="Ex: One Year Warranty" class="form-control " rows="3" cols="3"> <?php echo $note;?></textarea>
        </div>
    </div>

<!--    <div class="form-group">
        <label  class="col-sm-2 control-label">Product Manufacture <span style="color:red">*</span></label>
        <div class="col-sm-10">
            <input id="select_model" type="text" class="form-control"  placeholder="Eg :  Apple ">
          <p><a target="_new" title="" data-get="#select_tags" data-set=".create_tag" data-toggle="modal" data-target="#create_model">Create New Manufacture</a></p>

         <input type="hidden" name="product_manufacture"/>
        </div>
    </div>-->


    <!--    <div class="form-group">
            <label  class="col-sm-2 control-label"> Manufacture </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="product_m" placeholder="Manufacture">
            </div>
        </div>-->

<!--    <div class="form-group">
        <label  class="col-sm-2 control-label"> Category <span style="color:red">*</span></label>
        <div class="col-sm-10">





            <select class="form-control" name="product_category" >

                <option value="">Select Category </option>-->

                <?php
//                 $category = $this->manage_categories->main_categories();
//
//
//                foreach ($category as $cats) {
//
//                    echo '<option value="' . $cats["category_id"] . '">' . $cats["category_name"] . '</option>';
//                }
                ?>

<!--            </select>


        </div>
    </div>-->

<!--    <div class="form-group">
        <label  class="col-sm-2 control-label"> Sub Category <span style="color:red">*</span></label>
        <div class="col-sm-10">

            <select class="form-control" name="product_sub_cats[]" id="subcat" multiple="">

            </select>

            <div id="subcat"></div>

        </div></div>-->
    
        
<!--    <div class="form-group" id="first_enter_tags">
        <label class="col-sm-2 control-label" for="input-related"><span data-original-title="(Autocomplete)" data-toggle="tooltip" title="">Products Tags <span style="color:red">*</span> </span></label>
        
        <div class="col-sm-10">
           
            <input autocomplete="off" name="product_tags" value="" placeholder="Products Tags" id="select_tags" class="form-control select_tags" type="text">
             <p><a target="_new" title="" data-get="#select_tags" data-set=".create_tag" data-toggle="modal" data-target="#myModal">Create New Product Tag</a></p>

            
            Search Will Be Based On This Tags :
            <div  class="well well-sm all_selected_tags" style="height: 150px; overflow: auto;">
               
            </div>
        </div>
    </div>-->


<!--    <div class="form-group">
        <label class="col-sm-2 control-label" for="input-related"><span data-original-title="(Autocomplete)" data-toggle="tooltip" title="">Related Products</span></label>
        <div class="col-sm-10">
            <input autocomplete="off" name="product_related" value="" placeholder="Related Products" id="input-related" class="form-control" type="text">
            <ul style="top: 35px; left: 15px; display: none;" class="dropdown-menu"><li data-value="42"><a href="#">Apple Cinema 30" fmf store</a></li><li data-value="30"><a href="#">Canon EOS 5D</a></li><li data-value="47"><a href="#">HP LP3065</a></li><li data-value="28"><a href="#">HTC Touch HD</a></li><li data-value="41"><a href="#">iMac</a></li></ul>
            <div id="product-related" class="well well-sm" style="height: 150px; overflow: auto;">
            </div>
        </div>
    </div>-->





</div>