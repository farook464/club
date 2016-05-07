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

    <div class="form-group">
        <label  class="col-sm-2 control-label"> Type <span style="color:red">*</span></label>
        <div class="col-sm-10">
            <!--<input type="text" class="form-control"  name="product_delivery"  placeholder="eg: Free Delivery Colombo 1 to 15">-->
            
             <select id="select_type" class="form-control" name="select_type" >
                 <option value="0"> Select</option>

                                            <?php $type = $this->manage_product->product_type();
                                            
                                            foreach ($type as $row) { ?>

                                                <option value="<?php echo $row["id"] ?>"> 

                                                    <?php echo $row["type_name"]; ?>

                                                </option>
                                            <?php } ?>
                                        </select>     
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-2 control-label"> Brand <span style="color:red">*</span></label>
        <div class="col-sm-10">
            <!--<input type="text" class="form-control"  name="product_delivery"  placeholder="eg: Free Delivery Colombo 1 to 15">-->
           <select id="select_brand" class="form-control" name="select_brand" >
                 <option value="0"> Select</option>

                                            <?php $brand = $this->manage_product->product_brand();
                                            
                                            foreach ($brand as $row) { ?>

                                                <option value="<?php echo $row["id"] ?>"> 

                                                    <?php echo $row["brand_name"]; ?>

                                                </option>
                                            <?php } ?>
                                        </select>   
        </div>
    </div>
    <div class="form-group">
        <label  class="col-sm-2 control-label"> Category <span style="color:red">*</span></label>
        <div class="col-sm-10">
            <select id="select_category" class="form-control" name="select_category" >
                 <option value="0"> Select</option>

                                            <?php $category = $this->manage_product->product_categories();
                                            
                                            foreach ($category as $row) { ?>

                                                <option value="<?php echo $row["id"] ?>"> 

                                                    <?php echo $row["category_name"]; ?>

                                                </option>
                                            <?php } ?>
                                        </select> 
        </div>
    </div>

    <div class="form-group">
        <label  class="col-sm-2 control-label">Product Name <span style="color:red">*</span> </label>
        <div class="col-sm-10">
            <input type="text" name="product_name" id="product_name" class="form-control"  placeholder="Product Name">
            <input type="hidden" name="product_id" id="product_id" />
        </div>
    </div>

    <div class="form-group">
        <label  class="col-sm-2 control-label"> Supplier <span style="color:red">*</span></label>
        <div class="col-sm-10">
            <select id="select_supplier" class="form-control" name="select_supplier" >
                 <option value="0"> Select</option>

                                            <?php $supplier = $this->manage_product->product_supplier();
                                                    
                                            foreach ($supplier as $row) { ?>

                                                <option value="<?php echo $row["id"] ?>"> 

                                                    <?php echo $row["supplier_name"]; ?>

                                                </option>
                                            <?php } ?>
                                        </select>   
        </div>
    </div>
    
    <div class="form-group">
        <label  class="col-sm-2 control-label">IEMI Number<span style="color:red">*</span></label>
        <div class="col-sm-10">

            <input type="text" name="c" id="v" class="form-control"  placeholder="IEMI Number">
               </div>
    </div>

     <div class="form-group">
        <label  class="col-sm-2 control-label">Price <span style="color:red">*</span> </label>
        <div class="col-sm-10">
            <input type="text" name="product_price" id="product_price" class="form-control"  placeholder="Price">
         
        </div>
    </div>
     <div class="form-group">
        <label  class="col-sm-2 control-label">Quantity<span style="color:red">*</span> </label>
        <div class="col-sm-10">
            <input type="number" name="product_quantity" id="product_quantity" class="form-control"  placeholder="Quantity  ">
            
        </div>
    </div>

    <div class="form-group" style="margin: 10px"> 
      <span id="do_save_product" class="btn btn-primary col-sm-12"> Save Product </span> 
</div>


    <script>

        $(function () {

            var search = new Bloodhound({
                datumTokenizer: function (datum) {
                    return Bloodhound.tokenizers.whitespace(datum.value);
                },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    url: rt_config.API + 'product/product_title/?query=%QUERY',
                    wildcard: "%QUERY",
                    filter: function (s) {
                        return $.map(s, function (search) {
                            return {
                                value: search.title,
                                key: search.id
                            };
                        });
                    }
                }
            });

            search.initialize();

            $('#product_name').typeahead(null, {
                displayKey: 'value',
                hint: false,
                limit: 50,
                highlight: true,
                minLength: 1,
                source: search.ttAdapter(),
                templates: {
                    empty: [
                        '<div class="noitems">',
                        'No Items Found </br>',
                        '</div>'
                    ].join('\n'),
                    suggestion: function (data) { // data is an object as returned by suggestion engine

                        //console.log(data)

                        return '<div class="tt-suggest-page ">' + data.value + ' <span class="hide tag-value">' + data.key + '</span></div>';
                    }
                }
            });

            $('#product_name').bind('typeahead:select', function (ev, data) {
                if(data.key){
//                    console.log(data.key);
                    var product_id = data.key;
                    $('#product_id').val(product_id);
                    var csrf = $('input[name=csrf_rt_secure]').val();
                    
                    $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('admin_jsessID/panel/get-product-details'); ?>",
                    data: {csrf_rt_secure:csrf , product_id:product_id},
                    dataType: "json",
                    success: function (reply) {                       
//                        console.log(reply);
//                        console.log(reply.product_details);
//                        console.log(reply.tech_details);

                        if(reply != ""){
                        $('input[name=description_id]').val(product_id);    
                        }
                        
                        $('.summernote').code(reply.product_details);
                        $('.summernote2').code(reply.tech_details);
                        $('div.note-editable').eq(0).attr('contenteditable',false);
                        $('div.note-editable').eq(1).attr('contenteditable',false)
                        
//                        $('.tech_details').val(reply.tech_details)
//                        $('.product_details').val(reply.tech_details)
                        
                    }
                });
                return false;
                    
                }else{
//                    console.log("false");
                    
                }

            });
            
            $('#product_name').keyup(function (){            
            var pruduct_name = $('#product_name').val();
            
                  //  if(pruduct_name.length === 0 ){
//                        console.log('value zero');
                        $('.summernote').code('');
                        $('.summernote2').code('');
                        $('div.note-editable').eq(0).attr('contenteditable',false);
                        $('div.note-editable').eq(1).attr('contenteditable',false)
                        $('input[name=description_id]').val(''); 
                 //   }
            
            });
            
            
            
            $('.summernote').destroy();
            
            
            
            
          
        });








    </script>


</div>
