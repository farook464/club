$(document).ready(function () {
    


    var csrf = $('input[name=csrf_rt_secure]').val();

    $('.summernote').summernote({
        height: 300,
        minHeight: null, // set minimum height of editor
        maxHeight: null, // set maximum height of editor

        onImageUpload: function (files, editor, welEditable) {
            // console.log('image upload:', files[0][0][0], editor, welEditable);

            sendFile(files[0][0][0], editor, welEditable, 0);
        }


    });


    function sendFile(file, editor, welEditable, id) {
        data = new FormData();
        data.append("file", file);
        data.append("csrf_rt_secure", csrf)
        $.ajax({
            data: data,
            type: "POST",
            url: "/admin/admin_jsessID/summer_uploads",
            cache: false,
            contentType: false,
            processData: false,
            success: function (url) {
//                var editor = $.summernote.eventHandler.getEditor();
//                editor.insertImage(welEditable, url);
//                console.log(url)

            if(id === 0){
                $('div.note-editable').eq(0).append(url);
                 $('.product_details').val($('div.note-editable').eq(0).html())
            }else{
                $('div.note-editable').eq(1).append(url);
                 $('.tech_details').val($('div.note-editable').eq(1).html())
            }

                



            }
        });
    }

    $('.summernote2').summernote({
        height: 300,
        minHeight: null, // set minimum height of editor
        maxHeight: null, // set maximum height of editor
        onImageUpload: function (files, editor, welEditable) {
            // console.log('image upload:', files[0][0][0], editor, welEditable);

            sendFile(files[0][0][0], editor, welEditable, 1);
        }

    });
    
    
        $('.note-image-url').parent().hide();


    $('div.note-editable').eq(0).keyup(function () {

        $('.product_details').val($(this).html())

    });
    
     $('div.note-editable').eq(0).blur(function () {
         console.log($(this).html())

        $('.product_details').val($(this).html())

    });
    
    $('div.note-editable').eq(1).blur(function () {

        $('.tech_details').val($(this).html())

    });

    $('div.note-editable').eq(1).keyup(function () {

        $('.tech_details').val($(this).html())

    });






    cache_data = [];

    var suppliers = new Bloodhound({
        datumTokenizer: function (datum) {
            return Bloodhound.tokenizers.whitespace(datum.value);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: {
            url: rt_config.API + 'users/supplier_by_email/?query=%QUERY&csrf_rt_secure=' + csrf,
            wildcard: "%QUERY",
            filter: function (data) {
                cache_data = [];
                cache_data.push(data);

                return data;
            }

        },
    });

    suppliers.initialize();




// Instantiate the Typeahead UI
    $('#select_supplier').typeahead({
        displayKey: 'value',
        hint: false,
        highlight: true,
        minLength: 2,
    }, {
        source: suppliers.ttAdapter(),
        templates: {
            empty: [
                '<div class="noitems">',
                'No Items Found </br>',
                '<a target="_new"  title="Link will open in new tab" href="' + rt_config.SITEURL + 'admin_jsessID/panel/suppliers/add">Create New Supplier</a>',
                '</div>'
            ].join('\n'),
            suggestion: function (data) { // data is an object as returned by suggestion engine
                return '<div class="tt-suggest-page ">' + data.user_email + ' <span class="hide tag-value">' + data.user_id + '</span></div>';
            }
        }
    }).blur(function () {

        var val = $('#select_supplier').val();

        //console.log($('#select_supplier').val())




        cache_data.forEach(function (items, i) {


            if (items[i].user_email !== val) {
                $('input[name=product_supplier]').val('');
            }

        });





    });




    $('#select_supplier').bind('typeahead:select', function (ev, data) {

        $('input[name=product_supplier]').val(data.user_id);
        $(this).typeahead('val', data.user_email);

    });



    cache_product_tags = [];
    cache_models = [];
    
    
//    var models = new Bloodhound({
//        datumTokenizer: function (datum) {
//            return Bloodhound.tokenizers.whitespace(datum.value);
//        },
//        queryTokenizer: Bloodhound.tokenizers.whitespace,
//        remote: {
//            url: rt_config.API + 'product/product_models/?query=%QUERY',
//            wildcard: "%QUERY",
//            filter: function (data) {
//                return $.map(data, function (tag) {
//                    cache_models = [];
//                    cache_models.push(data)
//                    return data;
//                });
//            },
//            cache: false
//
//        }
//    });
    
     var models = new Bloodhound({
            datumTokenizer: function (datum) {
                return Bloodhound.tokenizers.whitespace(datum.value);
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: rt_config.API + 'product/product_models/?query=%QUERY',
                wildcard: "%QUERY",
                filter: function (s) {
                    return $.map(s, function (data) {
                        
                      // cache_models = [];
                       cache_models.push(data);
                        
                        return {
                            value: data.brand_name,
                            key : data.brand_id
                        };
                    });
                }
            }
        });

    models.initialize();



    tags = [];
     var final_cache_models = [];
    
     $('#select_model').typeahead(null, {
            displayKey: 'value',
            hint:false,
            limit:50,
            highlight: true,
            minLength: 1,
            source: models.ttAdapter(),
            templates: {
                empty: [
                    '<div class="noitems">',
                    'No Items Found </br>',
                    '</div>'
                ].join('\n'),
                suggestion: function (data) { // data is an object as returned by suggestion engine
                    
                 //   console.log(data)
                    
                return '<div class="tt-suggest-page ">' + data.value + ' <span class="hide tag-value">' + data.key + '</span></div>';
            }
            }
        }).blur(function () {

        var val = $('#select_model').val();
        
        
        for(var i = 0; i < cache_models.length; i++){
            
            if (cache_models[i].brand_name !== val) {
//               
                console.log('fuck u')
              $('input[name=product_manufacture]').val('');
            }else{
               console.log('corrected'+cache_models[i].brand_name);
               
               $('input[name=product_manufacture]').val(cache_models[i].brand_id);
               
              break;
            }
            
        }


    });

    $('#select_model').bind('typeahead:select', function (ev, data) {
        
        console.log('select')
        
        console.log(data)

        $('input[name=product_manufacture]').val(data.key);
        $(this).typeahead('val', data.value);

    });
 
     
    
    var search = new Bloodhound({
            datumTokenizer: function (datum) {
                return Bloodhound.tokenizers.whitespace(datum.value);
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: rt_config.API + 'product/product_tags/?query=%QUERY',
                wildcard: "%QUERY",
                filter: function (s) {
                    return $.map(s, function (search) {
                        return {
                            value: search.tag_name,
                            key : search.tag_id
                        };
                    });
                }
            }
        });

        search.initialize();

        $('#select_tags').typeahead(null, {
            displayKey: 'value',
            hint:false,
            limit:50,
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

    $('#select_tags').bind('typeahead:select', function (ev, data) {
        //console.log(suggestion);
        
        //console.log(data.key)


        var val = data.key;

        if ($.inArray(val, tags) == -1) {
            tags.push(val);

            var elem = $('.all_selected_tags');

            var set = '<div class=" col-md-4"> <label> <input class="remove_tag" type="checkbox" checked name="product_tags_all[]" value="' + data.key + '" />' + data.value + ' </div>                        ';


            elem.append(set);



        }

        $('#select_tags').typeahead('val', '');






    });

    function remove_array_elem(rArray, elem) {

        var array = rArray;
        var index = array.indexOf(elem);

        if (index > -1) {
            array.splice(index, 1);
        }

    }

    $(document).on('click', '.remove_tag', function () {

        var value = $(this).val();
        remove_array_elem(tags, value)
        $(this).parent().parent().remove();

    });



    $("#first_enter_tags").on('keyup', function (e) {
        if (e.which == 13) {
            $(".tt-suggestion:first-child", this).trigger('click');
        }
    });

    




    $(document).find('.set_data').click(function () {


        alert()

        var get = $(this).data("get").val();

        $(set).val(get)

    })


    $('select[name=product_category]').change(function () {

        $('#subcat').html("")

        var cid = $(this).val();
        var csrf = $('input[name=csrf_rt_secure]').val();
        $.ajax({
            url: rt_config.API + "category/sub_category/",
            data: {id: cid, csrf_rt_secure: csrf},
            success: function (data) {

                var opt = '';
                for (var i = 0; i < data.length; i++) {

                    var id = data[i].category_id;

                    opt += '<div class=" col-md-4"> <label> <input  class="subbcc" data-comm="' + data[i].commission + '"  type="checkbox" name="product_sub_cats[]" value="' + id + '" />' + data[i].category_name + ' </div>                        ';

                }

                $('#subcat').append(opt);



            }

        })

    });
    
    $(document).on('click','.subbcc',function(){
        
        var checked = $(this).prop('checked');
        var comm = $(this).data("comm");
        
        if(checked){
            //$('input[name=commission]').val(comm);
        }else{
            //$('input[name=commission]').val('');
        }
        
        
    })


    $('.save-ajax-data').click(function () {

        var input = $('input[name=create_tag]').val();
        var csrf = $('input[name=csrf_rt_secure]').val();

        $.ajax({
            url: rt_config.API + "product/save_product_tag",
            type: "POST",
            data: {tag: input, csrf_rt_secure: csrf},
            success: function (data) {
                $('.create_tag_msg').html(data.msg).show();
                $('input[name=create_tag]').val("");
                
                setTimeout(function(){
                    $('.create_tag_msg').hide();
                },3000)
                
                
            }
        });



    });

    $('.save-model').click(function () {

        var input = $('input[name=create_model]').val();
        var csrf = $('input[name=csrf_rt_secure]').val();

        $.ajax({
            url: rt_config.API + "product/save_product_model",
            type: "POST",
            data: {tag: input, csrf_rt_secure: csrf},
            success: function (data) {
                $('.create_model_msg').html(data.msg).show();
                
                
                 $('input[name=create_model]').val("");
                
                setTimeout(function(){
                    $('.create_model_msg').hide();
                },3000)
                
            }
        })

    });

    $('#do_save').click(function () {
        
        $('#form-product').submit();
        

        var product_name = $('input[name=product_name]').val();
        var product_desc = $('.product_details').val().trim();
        var product_price = $('input[name=product_price]').val();
        var product_supplier = $('input[name=product_supplier]').val();
        var product_manu = $('input[name=product_manufacture]').val();
        var product_cat = $('select[name=product_category]').val();
        var product_subcat = $("input[name^='product_sub_cats']:checked:enabled", '#subcat').val();
        var product_tags = $("input[name^='product_tags_all']:checked:enabled", '.all_selected_tags').val();

        var product_delivery = $("input[name^='product_delivery']:checked:enabled").val();
        var product_payment = $('input[name=product_payment_option]').val();

        var isEdit = $('input[name=edit]').val();

        if (isEdit === "true") {
            product_cat = $('select[name=product_category_edit]').val();
        }

        var errors = [];

//        console.log(
//                'name ===> ' + product_name + ' ,, ' +
//                'desc  ===> ' + product_desc + ' ,, ' +
//                'price ===> ' + product_price + ' ,, ' +
//                'supplier ===> ' + product_supplier + ' ,, ' +
//                'manufacture ===> ' + product_manu + ' ,, ' +
//                'cat ===> ' + product_cat + ' ,, ' +
//                'subcat ===> ' + product_subcat + ' ,, ' +
//                'tags ===> ' + product_tags + ' ,, '
//                );






        if (product_name === "") {
            errors.push('<p>The product name field is required.</p>')
        }

        if (product_desc === "" || product_desc === "<br>" || product_desc === "<p><br></p>") {
            errors.push('<p>The Product Description field is required.</p>')
        }

        if (product_price === "") {
            errors.push('<p>The Product Price field is required.</p>')
        }

        if (product_supplier === "") {
            errors.push('<p>The Product Supplier field is required.</p>')
        }

        if (product_manu === "") {
            errors.push('<p>The Product Manufacture field is required.</p>')
        }

        if (product_cat === "") {
            errors.push('<p>The Product Category field is required.</p>')
        }

        if (typeof product_subcat === "undefined") {
            errors.push('<p>The Product Sub Catgeory field is required.</p>')
        }

        if (typeof product_tags === "undefined") {
            errors.push('<p>The Product Tags field is required</p>')
        }

        if (typeof product_delivery === "undefined") {
            errors.push('<p>The Product Delivery field is required.</p>')
        }

        if (product_payment === "") {
            errors.push('<p>The Product Payment Option field is required.</p>')
        }



        if (errors.length === 0) {
            $('.js-errors-list').hide();
			$(this).css("pointer-events","none");
            $(this).text("Please Wait..");
            $('#form-product').submit();
        } else {
            $('.js-errors-list').html(errors).show();
        }











    });
    
     
         $(document).on('click','#do_save_product',function(){
        
        
//        alert('product_supplier_note');
//        $('#form-product').submit();
//        $('input[name=description_id]').val(product_id); 

        var product_name = $('input[name=description_id]').val();
//        var product_desc = $('.product_details').val().trim();
        var product_price = $('input[name=product_price]').val();
        var product_location = $('input[name=product_location]').val();
//        var product_supplier_note = $('input[name=product_supplier_note]').val();
        var product_supplier_note = $('#product_supplier_note').val();
//        var product_supplier = $('input[name=product_supplier]').val();
//        var product_manu = $('input[name=product_manufacture]').val();
//        var product_cat = $('select[name=product_category]').val();
//        var product_subcat = $("input[name^='product_sub_cats']:checked:enabled", '#subcat').val();
//        var product_tags = $("input[name^='product_tags_all']:checked:enabled", '.all_selected_tags').val();

        var product_delivery = $("input[name^='product_delivery']:checked:enabled").val();
//        var product_payment = $('input[name=product_payment_option]').val();
        var product_q = $('input[name=product_q]').val();

//        var isEdit = $('input[name=edit]').val();
//
//        if (isEdit === "true") {
//            product_cat = $('select[name=product_category_edit]').val();
//        }
//        var sup_note = $.trim(product_supplier_note);
//        console.log(product_supplier_note);

        var errors = [];

//        console.log(
//                'name ===> ' + product_name + ' ,, ' +
//                'desc  ===> ' + product_desc + ' ,, ' +
//                'price ===> ' + product_price + ' ,, ' +
//                'supplier ===> ' + product_supplier + ' ,, ' +
//                'manufacture ===> ' + product_manu + ' ,, ' +
//                'cat ===> ' + product_cat + ' ,, ' +
//                'subcat ===> ' + product_subcat + ' ,, ' +
//                'tags ===> ' + product_tags + ' ,, '
//                );






        if (product_name === "") {
            errors.push('<p>The product name not Seleteced</p>')
        }
        if (product_q === "") {
            errors.push('<p>The Item Quantity field is required</p>')
        }
        if (product_location === "") {
            errors.push('<p>The product location field is required.</p>')
        }

//        if (product_desc === "" || product_desc === "<br>" || product_desc === "<p><br></p>") {
//            errors.push('<p>The Product Description field is required.</p>')
//        }

        if (product_price === "") {
            errors.push('<p>The Product Price field is required.</p>')
        }

//        if (sup_note === "") {
//            errors.push('<p>The Product Supplier note field is required.</p>')
//        }
        if (product_supplier_note === "") {
            errors.push('<p>The Product Supplier note field is required.</p>')
        }

//        if (product_manu === "") {
//            errors.push('<p>The Product Manufacture field is required.</p>')
//        }

//        if (product_cat === "") {
//            errors.push('<p>The Product Category field is required.</p>')
//        }

//        if (typeof product_subcat === "undefined") {
//            errors.push('<p>The Product Sub Catgeory field is required.</p>')
//        }

//        if (typeof product_tags === "undefined") {
//            errors.push('<p>The Product Tags field is required</p>')
//        }

        if (typeof product_delivery === "undefined") {
            errors.push('<p>The Product Delivery field is required.</p>')
        }

//        if (product_payment === "") {
//            errors.push('<p>The Product Payment Option field is required.</p>')
//        }



        if (errors.length === 0) {
            $('.js-errors-list').hide();
			$(this).css("pointer-events","none");
            $(this).text("Please Wait..");
            $('#form-product').submit();
        } else {
            $('.js-errors-list').html(errors).show();
        }











    });
    
    
    $(document).on('click','#do_update_product',function(){
        
        
//        alert('kosala');
//        $('#form-product').submit();
        

        var product_name = $('input[name=product_name]').val();
//        var product_desc = $('.product_details').val().trim();
        var product_price = $('input[name=product_price]').val();
        var product_location = $('input[name=product_location]').val();
        var product_supplier_note = $('#product_supplier_note').val();
//        var product_supplier_note = $('input[name=product_supplier_note]').val();
//        var product_supplier = $('input[name=product_supplier]').val();
//        var product_manu = $('input[name=product_manufacture]').val();
//        var product_cat = $('select[name=product_category]').val();
//        var product_subcat = $("input[name^='product_sub_cats']:checked:enabled", '#subcat').val();
//        var product_tags = $("input[name^='product_tags_all']:checked:enabled", '.all_selected_tags').val();

        var product_delivery = $("input[name^='product_delivery']:checked:enabled").val();
        var product_payment = $('input[name=product_payment_option]').val();
        
        var product_q = $('input[name=product_q]').val();

//        var isEdit = $('input[name=edit]').val();
//
//        if (isEdit === "true") {
//            product_cat = $('select[name=product_category_edit]').val();
//        }

        var errors = [];

//        console.log(
//                'name ===> ' + product_name + ' ,, ' +
//                'desc  ===> ' + product_desc + ' ,, ' +
//                'price ===> ' + product_price + ' ,, ' +
//                'supplier ===> ' + product_supplier + ' ,, ' +
//                'manufacture ===> ' + product_manu + ' ,, ' +
//                'cat ===> ' + product_cat + ' ,, ' +
//                'subcat ===> ' + product_subcat + ' ,, ' +
//                'tags ===> ' + product_tags + ' ,, '
//                );






        if (product_name === "") {
            errors.push('<p>The product name field is required.</p>')
        }
        if (product_location === "") {
            errors.push('<p>The product location field is required.</p>')
        }

//        if (product_desc === "" || product_desc === "<br>" || product_desc === "<p><br></p>") {
//            errors.push('<p>The Product Description field is required.</p>')
//        }

        if (product_price === "") {
            errors.push('<p>The Product Price field is required.</p>')
        }

        if (product_supplier_note === "") {
            errors.push('<p>The Product Supplier note field is required.</p>')
        }

//        if (product_manu === "") {
//            errors.push('<p>The Product Manufacture field is required.</p>')
//        }

//        if (product_cat === "") {
//            errors.push('<p>The Product Category field is required.</p>')
//        }

//        if (typeof product_subcat === "undefined") {
//            errors.push('<p>The Product Sub Catgeory field is required.</p>')
//        }

//        if (typeof product_tags === "undefined") {
//            errors.push('<p>The Product Tags field is required</p>')
//        }

        if (typeof product_delivery === "undefined") {
            errors.push('<p>The Product Delivery field is required.</p>')
        }

        if (product_payment === "") {
            errors.push('<p>The Product Payment Option field is required.</p>')
        }
        if (product_q === "") {
            errors.push('<p>The Item Quantity field is required.</p>')
        }



        if (errors.length === 0) {
            $('.js-errors-list').hide();
			$(this).css("pointer-events","none");
            $(this).text("Please Wait..");
            $('#form-product').submit();
        } else {
            $('.js-errors-list').html(errors).show();
        }











    });










});