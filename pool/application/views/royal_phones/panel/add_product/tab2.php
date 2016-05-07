<?php
/*
 *  RETAILGENIUS.COM - Team Innovation 
 *  ---------------------------------
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
?>


<div class="tab-pane  form-horizontal" id="tab_2">


    <div class="form-group">
        <label  class="col-sm-2 control-label"> Type <span style="color:red">*</span></label>
        <div class="col-sm-10">
            <!--<input type="text" class="form-control"  name="product_delivery"  placeholder="eg: Free Delivery Colombo 1 to 15">-->

            <select id="select_brand_or_category" class="form-control" name="selectoffer" >
                <option value="0"> Select</option>
                <option value="1"> Brand</option>
                <option value="2"> Category</option>
            </select>     
        </div>
    </div>
    
    <div class="form-group">
        <label  class="col-sm-2 control-label">Brand or Category Name <span style="color:red">*</span> </label>
        <div class="col-sm-10">
            <input type="text" name="name" id="product_name" class="form-control"  placeholder="Name">
        </div>
    </div>

  <div class="form-group" style="margin: 10px"> 
      <span id="do_save_brand_or_category" class="btn btn-primary col-sm-12"> Save Brand or Category </span> 
</div>
    <!--kosala script-->
    <script>

        $(document).ready(function () {


            //markup
            $("#x_mark_up_1_other").keyup(function () {// x_mark_up_1 replace to x_mark_up_1_other
                $('#x_mark_up_2_other').val(''); // x_mark_up_2 replace to x_mark_up_2_other
                markup_other(); //edit markup_other
                clear_margin_other();//edit clear_margin_other
            });

            $("#x_mark_up_2_other").keyup(function () {
                $('#x_mark_up_1_other').val('');
                markup_other();//edit markup_other
                clear_margin_other(); //edit clear_margin_other
            });

            $("#x_product_price_other").keyup(function () { // x_product_price replace to x_product_price_other
//                     clear_margin_other(); //edit clear_margin_other
                markup_other();//edit markup_other
                clear_margin_other(); //edit clear_margin_other
            });

            //margin
            $("#y_margin_1_other").keyup(function () { // y_margin_1 replace to y_margin_1_other
                $('#y_margin_2_other').val('');
                margin_other(); // margin_other
                clear_markup_other();//clear_markup_other
            });

            $("#y_margin_2_other").keyup(function () { // y_margin_2 replace to y_margin_2_other
                $('#y_margin_1_other').val('');
                margin_other();// margin_other
                clear_markup_other();//clear_markup_other
            });

            $("#y_product_price_other").keyup(function () { // y_product_price replace to y_product_price_other
                margin_other();// margin_other
                clear_markup_other();//clear_markup_other
            });

            $('#product_discount_other').keyup(function () {  // product_discount replace to product_discount_other
                if (!isNaN($('#product_discount_other').val())) {
                    var res_other = (parseFloat($('#price_on_web_other').val()) * 100) / (100 - parseFloat($('#product_discount_other').val())); // price_on_web replace to price_on_web_other
                    $('#product_price_other').val(parseFloat(res_other).toFixed(2)); // product_price replace to product_price_other
//                        $('.v-o-price').val($('#product_price').val());
                }
                else {
                    $('#product_price_other').val($('#price_on_web_other').val());
//                        $('.v-o-price').val($('#product_price').val());
                }

                if ($('#product_discount_other').val() === '') {
                    $('#product_price_other').val($('#price_on_web_other').val());
//                        $('.v-o-price').val($('#product_price').val());
                }

            });

            //margin

            $(document).on('click', '.set_option', function () {
                var id = document.activeElement.id;

                var dis = $('#product_discount_other').val();
                var pri = $('#product_price_other').val();

                $('#discount' + id).val(dis);
                $('#price' + id).val(pri);


            });

//                $('#get_cal').click(function (){
//                    $('#cal_other_option').show();
//                });



        });

        function markup_other() {//edit markup_other
            clear_fill_other();// clear_fill_other

            var product_price_other = $('#x_product_price_other').val();

            if (!isNaN(product_price_other)) {
                var per_other = $('#x_mark_up_1_other').val();
                var val_other = $('#x_mark_up_2_other').val();

                if (!isNaN(per_other) && per_other !== '') {
                    $('#paid_to_sup_other').val(parseFloat(product_price_other).toFixed(2));
                    $('#price_on_web_other').val((parseFloat(product_price_other) + parseFloat(product_price_other) * parseFloat(per_other) / 100).toFixed(2));
                    $('#commission_other').val(((100 - ($('#paid_to_sup_other').val() * 100 / $('#price_on_web_other').val()))).toFixed(2)); // commission replace to commission_other  , paid_to_sup replace to paid_to_sup_other
                    $('#product_price_other').val($('#price_on_web_other').val());
//                        $('.v-o-price').val($('#product_price').val());
                }
                else if (!isNaN(val_other) && val_other !== '') {
                    $('#paid_to_sup_other').val(parseFloat(product_price_other).toFixed(2));
                    $('#price_on_web_other').val((parseFloat(product_price_other) + parseFloat(val_other)).toFixed(2));
                    var commi_other = parseFloat(val_other) * 100 / parseFloat($('#price_on_web_other').val());
                    $('#commission_other').val(parseFloat(commi_other).toFixed(2));
                    $('#product_price_other').val($('#price_on_web_other').val());
//                        $('.v-o-price').val($('#product_price_other').val());
                } else {
                    clear_fill_other();// clear_fill_other
                }
            } else {
                clear_fill_other();// clear_fill_other
            }
        }

        function margin_other() {// margin_other
            clear_fill_other();// clear_fill_other

            var product_price_other = $('#y_product_price_other').val();

            if (!isNaN(product_price_other)) {
                var per_other = $('#y_margin_1_other').val();
                var val_other = $('#y_margin_2_other').val();

                if (!isNaN(per_other) && per_other !== '') {
                    $('#price_on_web_other').val(parseFloat(product_price_other).toFixed(2));
                    $('#paid_to_sup_other').val((parseFloat(product_price_other) - parseFloat(product_price_other) * parseFloat(per_other) / 100).toFixed(2));
                    $('#commission_other').val(parseFloat(per_other).toFixed(2));
                    $('#product_price_other').val($('#price_on_web_other').val());
//                        $('.v-o-price').val($('#product_price').val());
                }
                else if (!isNaN(val_other) && val_other !== '') {
                    $('#price_on_web_other').val(parseFloat(product_price_other).toFixed(2));
                    $('#paid_to_sup_other').val((parseFloat(product_price_other) - parseFloat(val_other)).toFixed(2));
                    var commi_other = parseFloat(val_other) * 100 / parseFloat(product_price_other);
                    $('#commission_other').val(parseFloat(commi_other).toFixed(2));
                    $('#product_price_other').val($('#price_on_web_other').val());
//                        $('.v-o-price').val($('#product_price').val());
                } else {
                    clear_fill_other();// clear_fill_other
                }
            } else {
                clear_fill_other();// clear_fill_other
            }
        }

        function clear_fill_other() { // clear_fill_other
            $('#price_on_web_other').val('');
            $('#paid_to_sup_other').val('');
            $('#commission_other').val('');
            $('#product_price_other').val('');
            $('#product_discount_other').val('');
//                $('.v-o-price').val('');
//                $('.v-o-dis').val('');
        }

        function clear_markup_other() {//clear_markup_other
            $('#x_product_price_other').val('');
            $('#x_mark_up_1_other').val('');
            $('#x_mark_up_2_other').val('');
        }

        function clear_margin_other() { //edit clear_margin_other
            $('#y_product_price_other').val('');
            $('#y_margin_1_other').val('');
            $('#y_margin_2_other').val('');
        }
    </script>
    <!--end of kosala's script-->
</div>


<!--end of cal-->






<script>

    $(document).ready(function () {

        $('#product_location').bind('typeahead:select', function (ev, data) {

            $('#product_city').show();

            if (data.key) {
                var id = data.key;
                var csrf = $('input[name=csrf_rt_secure]').val();
//                console.log(id);
//                console.log(csrf);
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('admin_jsessID/panel/get-city'); ?>",
                    data: {csrf_rt_secure: csrf, dis_id: id},
                    dataType: "json",
                    success: function (reply) {
                        var len = reply.length;
                        var i = 0;
                        var output = '';
                        for (i = 0; i < len; i++) {
//                            console.log(reply[i].city_name +" id :"+reply[i].city_id);                           
                            output += '<option value="' + reply[i].city_name + '">' + reply[i].city_name + ' </option>';

                        }
                        $('#kosala_cities').html(output)
                    }
                });

            }
        });


        var search = new Bloodhound({
            datumTokenizer: function (datum) {
                return Bloodhound.tokenizers.whitespace(datum.value);
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: rt_config.API + 'product/location/?query=%QUERY',
                wildcard: "%QUERY",
                filter: function (s) {
                    return $.map(s, function (search) {
                        return {
                            value: search.district_name,
                            key: search.district_id
                        };
                    });
                }
            }
        });

        search.initialize();

        $('#product_location').typeahead(null, {
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







        //////////////////////////////////////////////////////////////////////////

        $('input[name=product_discount]').keyup(function () {
            $('.v-o-dis').val($(this).val());

            //console.log($(this).val())
        });

        $('input[name=product_price]').keyup(function () {
            $('.v-o-price').val($(this).val());

            //console.log($(this).val())
        })


        $('.create-version').click(function () {

            $('#cal').hide();
            $('#product_discount').attr('readonly', 'readonly');
            var price = $('input[name=product_price]').val();
            var dis = $('input[name=product_discount]').val();

            var create_version = parseInt($('input[name=version_count]').val()) + 1;

            var output = '<div class="version_' + create_version + '" style="margin-top:10px; ">'
                    + ' <label  class="col-sm-2 control-label"> </label>'
                    + '  <div class="col-sm-2">'
                    + '     <input type="text" class="form-control" name="version[' + create_version + '][name]"  placeholder=" Option Name : Eg 16GB ">'
                    + '  </div>'
                    + '   <div class="col-sm-2">'
                    + '      <input id="price' + create_version + '" readonly type="text" value="' + price + '" class="form-control v-o-price" name="version[' + create_version + '][price]"  placeholder=" Option Price (Quoted Price without discount) : 2000 LKR">'
                    + '  </div>'
                    + '  <div class="col-sm-2">'
                    + '       <input id="discount' + create_version + '" type="text" readonly value="' + dis + '" class="form-control v-o-dis" name="version[' + create_version + '][discount]"  placeholder=" Discount">'
                    + '  </div>'
                    + '  <div class="col-sm-2">'
                    + '       <input type="text"  class="form-control" name="version[' + create_version + '][qty]"  placeholder=" Quantity">'
                    + '  </div>'
                    + '  <div class="col-sm-1">'
                    + '       <input class="btn btn-primary set_option" name="' + create_version + '" id="' + create_version + '" type="button" value="Set Option" />'
                    + '  </div>'
                    + '  <div class="col-sm-1">'
                    + '<span class="btn btn-danger delete-version-type" data-id="' + create_version + '"> <i class="fa fa-times"></i></span>'
                    + ' </div>'
                    + '    <div class="clearfix"></div>'
                    + '</div>';


            $('#version_relations').append(output);
            $('input[name=version_count]').val(create_version);

        });


        $(document).on('click', '.delete-version-type', function () {

            var get_id = $(this).data("id");

            var update_count = get_id - 1;

            $('.version_' + get_id).remove();

            $('input[name=version_count]').val(update_count);




        });

        //markup
        $("#x_mark_up_1").keyup(function () {
            $('#x_mark_up_2').val('');
            markup();
            clear_margin();
        });

        $("#x_mark_up_2").keyup(function () {
            $('#x_mark_up_1').val('');
            markup();
            clear_margin();
        });

        $("#x_product_price").keyup(function () {
            markup();
            clear_margin();
        });

        //margin
        $("#y_margin_1").keyup(function () {
            $('#y_margin_2').val('');
            margin();
            clear_markup();
        });

        $("#y_margin_2").keyup(function () {
            $('#y_margin_1').val('');
            margin();
            clear_markup();
        });

        $("#y_product_price").keyup(function () {
            margin();
            clear_markup();
        });

        $('#product_discount').keyup(function () {
            if (!isNaN($('#product_discount').val())) {
                var res = (parseFloat($('#price_on_web').val()) * 100) / (100 - parseFloat($('#product_discount').val()));
                $('#product_price').val(parseFloat(res).toFixed(2));
                $('.v-o-price').val($('#product_price').val());
            }
            else {
                $('#product_price').val($('#price_on_web').val());
                $('.v-o-price').val($('#product_price').val());
            }

            if ($('#product_discount').val() === '') {
                $('#product_price').val($('#price_on_web').val());
                $('.v-o-price').val($('#product_price').val());
            }

        });

        //margin

    });

    function markup() {
        clear_fill();

        var product_price = $('#x_product_price').val();

        if (!isNaN(product_price)) {
            var per = $('#x_mark_up_1').val();
            var val = $('#x_mark_up_2').val();

            if (!isNaN(per) && per !== '') {
                $('#paid_to_sup').val(parseFloat(product_price).toFixed(2));
                $('#price_on_web').val((parseFloat(product_price) + parseFloat(product_price) * parseFloat(per) / 100).toFixed(2));
                $('#commission').val(((100 - ($('#paid_to_sup').val() * 100 / $('#price_on_web').val()))).toFixed(2));
                $('#product_price').val($('#price_on_web').val());
                $('.v-o-price').val($('#product_price').val());
            }
            else if (!isNaN(val) && val !== '') {
                $('#paid_to_sup').val(parseFloat(product_price).toFixed(2));
                $('#price_on_web').val((parseFloat(product_price) + parseFloat(val)).toFixed(2));
                var commi = parseFloat(val) * 100 / parseFloat($('#price_on_web').val());
                $('#commission').val(parseFloat(commi).toFixed(2));
                $('#product_price').val($('#price_on_web').val());
                $('.v-o-price').val($('#product_price').val());
            } else {
                clear_fill();
            }
        } else {
            clear_fill();
        }
    }

    function margin() {
        clear_fill();

        var product_price = $('#y_product_price').val();

        if (!isNaN(product_price)) {
            var per = $('#y_margin_1').val();
            var val = $('#y_margin_2').val();

            if (!isNaN(per) && per !== '') {
                $('#price_on_web').val(parseFloat(product_price).toFixed(2));
                $('#paid_to_sup').val((parseFloat(product_price) - parseFloat(product_price) * parseFloat(per) / 100).toFixed(2));
                $('#commission').val(parseFloat(per).toFixed(2));
                $('#product_price').val($('#price_on_web').val());
                $('.v-o-price').val($('#product_price').val());
            }
            else if (!isNaN(val) && val !== '') {
                $('#price_on_web').val(parseFloat(product_price).toFixed(2));
                $('#paid_to_sup').val((parseFloat(product_price) - parseFloat(val)).toFixed(2));
                var commi = parseFloat(val) * 100 / parseFloat(product_price);
                $('#commission').val(parseFloat(commi).toFixed(2));
                $('#product_price').val($('#price_on_web').val());
                $('.v-o-price').val($('#product_price').val());
            } else {
                clear_fill();
            }
        } else {
            clear_fill();
        }
    }

    function clear_fill() {
        $('#price_on_web').val('');
        $('#paid_to_sup').val('');
        $('#commission').val('');
        $('#product_price').val('');
        $('#product_discount').val('');
        $('.v-o-price').val('');
        $('.v-o-dis').val('');
    }

    function clear_markup() {
        $('#x_product_price').val('');
        $('#x_mark_up_1').val('');
        $('#x_mark_up_2').val('');
    }

    function clear_margin() {
        $('#y_product_price').val('');
        $('#y_margin_1').val('');
        $('#y_margin_2').val('');
    }
</script>
