<?php
/*
 *  RETAILGENIUS.COM - Team Innovation 
 *  ---------------------------------
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

////echo "<pre>";
//var_dump($tab_data);
//
//die();
?>


<div class="tab-pane  form-horizontal" id="tab_2">





    <!--    <div class="form-group">
            <label  class="col-sm-2 control-label">Product Serial</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="<?php // echo htmlspecialchars($item_serial)   ?>" name="product_serial"  placeholder="Product Serial">
            </div>
        </div>-->


    <div class="form-group">
        <label  class="col-sm-2 control-label"> ISBN </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" readonly="" value="<?php echo htmlspecialchars($item_isbn) ?>" name="product_isbn"  placeholder="ISBN">
        </div>
    </div>
    <?php
    $locations = explode(',', $item_location);
    ?>


    <div class="form-group">
        <label  class="col-sm-2 control-label"> Location <span style="color:red">*</span></label>
        <div class="col-sm-10">
            <input id="product_location" type="text" class="form-control" value="<?php echo htmlspecialchars($locations[1]) ?>" name="product_location"  placeholder="Location">
        </div>
    </div>

    <div class="form-group" id="product_city" style="">
        <label  class="col-sm-2 control-label"> City <span style="color:red">*</span></label>
        <div class="col-sm-10">
            <div id="loc_city">
                <select class=" form-control" name="select_city" id="kosala_cities">
                    <option>
<?php echo htmlspecialchars($locations[0]) ?>
                    </option>

                </select>
            </div>
        </div>
    </div>

    <!--     <div class="form-group">
            <label  class="col-sm-2 control-label"> Delivery Option <span style="color:red">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="<?php //htmlspecialchars($item_delivery_option)          ?>" name="product_delivery"  placeholder="eg: Free Delivery Colombo 1 to 15">
            </div>
        </div>-->

    <div class="form-group">
        <label  class="col-sm-2 control-label"> Delivery Option <span style="color:red">*</span></label>
        <div class="col-sm-10">
            <!--<input type="text" class="form-control"  name="product_delivery"  placeholder="eg: Free Delivery Colombo 1 to 15">-->

<?php
$options_selected = $this->manage_product->delivery_option_by_id($item_id);

//var_dump($options);

$check_options = array();



foreach ($options_selected as $option_sel) {

    array_push($check_options, $option_sel["option_id"]);

    echo '<div class=" col-md-4"> '
    . '<label> <input checked="" name="product_delivery[]"'
    . ' value="' . htmlspecialchars($option_sel["option_id"]) . '" type="checkbox">  ' . htmlspecialchars($option_sel["option_name"])
    . '</label></div>';
}


$options = $this->manage_product->delivery_option();

//         var_dump($options);


foreach ($options as $option) {
    if (!in_array($option["option_id"], $check_options)) {
        echo '<div class=" col-md-4"> '
        . '<label> <input name="product_delivery[]"'
        . ' value="' . htmlspecialchars($option["option_id"]) . '" type="checkbox">  ' . htmlspecialchars($option["option_name"])
        . '</label></div>';
    }
}
?>


        </div>
    </div>

    <div class="form-group">
        <label  class="col-sm-2 control-label"> Cash on delivery <span style="color:red">*</span></label>
        <div class="col-sm-10">

            <select name="product_payment_option"   class="form-control">


                <option value="1" > Available </option>

                <option value="0" > Not Available </option>

            </select>
            <input type="hidden" id="cash_on" class="form-control" value="<?php echo $item_delivery_option ?>"  name="cash_on"  >

        </div>
    </div>


    <div class="form-group">
        <label  class="col-sm-2 control-label"></label>
        <div class="col-sm-10">
            <div style="width: 100%;" id="cal">
                <div hidden="" class="col-md-6" style="padding: 5px; background-color: rgb(232, 238, 248);">
                    <label class=" col-md-12 control-label">Mark-up Only</label>
                    <div class="clearfix" style="margin-bottom: 5px"></div>
                    <div class="col-md-4"><label class="control-label">Product Price</label></div>
                    <div class="col-md-8">
                        <input type="text" class="form-control mkup setop"  name="x_product_price" id="x_product_price"  placeholder="Product Price">
                    </div>
                    <div class="clearfix" style="margin-bottom: 5px"></div>
                    <div class="col-md-4"><label class="control-label">Mark-up</label></div>
                    <div class="col-md-8">
                        <input type="text" class="form-control mkup"  name="x_mark_up_1" id="x_mark_up_1"  placeholder="(%)">
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-8">
                        <label class="control-label">OR</label>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-8">
                        <input type="text" class="form-control mkup"  name="x_mark_up_2" id="x_mark_up_2"  placeholder="LKR">
                    </div>
                    <div class="clearfix" style="margin-bottom: 5px"></div>
                </div>
                <div class="col-md-6" style="padding: 5px; background-color: #D4DEEF;">
                    <label class=" col-md-12 control-label">Margin Only</label>
                    <div class="clearfix" style="margin-bottom: 5px"></div>
                    <div class="col-md-4"><label class="control-label">Product Price</label></div>
                    <div class="col-md-8">
                        <input type="text" class="form-control mgn setop"  name="y_product_price" id="y_product_price"  placeholder="Product Price">
                    </div>
                    <div class="clearfix" style="margin-bottom: 5px"></div>
                    <div class="col-md-4"><label class="control-label">Margin</label></div>
                    <div class="col-md-8">
                        <input type="text" class="form-control mgn"  name="y_margin_1" id="y_margin_1"  placeholder="(%)">
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-8">
                        <label class="control-label">OR</label>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-8">
                        <input type="text" class="form-control mgn"  name="y_margin_2" id="y_margin_2"  placeholder="LKR">
                    </div>
                    <div class="clearfix" style="margin-bottom: 5px"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label  class="col-sm-2 control-label"></label>
        <div class="col-sm-10" style="color: #3C8DBC; font-weight: bold">
            <div class="col-md-4">
                Old Price On Web : <?php echo number_format($item_price - $item_price * ($item_discount / 100), 2); ?>
            </div>
            <div class="col-md-4">
                Old Commission : <?php echo $item_commission . '%'; ?>
            </div>
            <div class="col-md-4">
                Old Discount : <?php echo $item_discount . '%'; ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label  class="col-sm-2 control-label" style="color: red"> PRICE ON WEBSITE:</label>
        <div class="col-sm-10">
            <input type="text"   class="form-control " name="price_on_web" id="price_on_web" readonly placeholder="-">
        </div>
    </div>

    <div class="form-group">
        <label  class="col-sm-2 control-label" style="color: red"> PAID TO SUPPLIER:</label>
        <div class="col-sm-10">
            <input type="text"   class="form-control " name="paid_to_sup" id="paid_to_sup" readonly placeholder="-">
        </div>
    </div>

    <div class="form-group">
        <label  class="col-sm-2 control-label"> Commission %</label>
        <div class="col-sm-10">
            <input type="text"   class="form-control " value="<?php echo htmlspecialchars($item_commission); ?>" name="commission" id="commission" readonly placeholder="Commission %">
        </div>
    </div>

    <div class="form-group">
        <label  class="col-sm-2 control-label">Quoted Price without discount <span style="color:red">*</span> </label>
        <div class="col-sm-10">
            <input type="text" readonly class="form-control" value="<?php echo htmlspecialchars($item_price) ?>" name="product_price" id="product_price"   placeholder="Price">
        </div>
    </div>



    <div class="form-group">
        <label  class="col-sm-2 control-label"> Product Discount %</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($item_discount) ?>" name="product_discount" id="product_discount"  placeholder="Product Discount %">
        </div>
    </div>

    <div class="form-group">
        <label  class="col-sm-2 control-label">  Item  Quantity </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($item_qty) ?>" name="product_q"  placeholder="Quantity">
            <span> if you have options, keep this filed blank.</span>

        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2">

        </div>
        <div class="col-sm-10">
            <span class="lead" style="cursor: pointer;color: #003bb3" data-toggle="collapse" data-target="#cal_other_option" id="get_cal"><b> Calculator for other options.</b></span>
        </div>
    </div>


    <div  id="cal_other_option" class="form-group collapse" style="background-color: #B5D1D8">
        <div class="form-horizontal" >
            <div class="form-group">
                <label  class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <div style="width: 100%;" id="cal">
                        <div hidden="" class="col-md-6" style="padding: 5px; background-color: rgb(232, 238, 248);">
                            <label class=" col-md-12 control-label">Mark-up Only</label>
                            <div class="clearfix" style="margin-bottom: 5px"></div>
                            <div class="col-md-4"><label class="control-label">Product Price</label></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control mkup setop"  name="x_product_price_other" id="x_product_price_other"  placeholder="Product Price">
                            </div>
                            <div class="clearfix" style="margin-bottom: 5px"></div>
                            <div class="col-md-4"><label class="control-label">Mark-up</label></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control mkup"  name="x_mark_up_1_other" id="x_mark_up_1_other"  placeholder="(%)">
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <label class="control-label">OR</label>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control mkup"  name="x_mark_up_2_other" id="x_mark_up_2_other"  placeholder="LKR">
                            </div>
                            <div class="clearfix" style="margin-bottom: 5px"></div>
                        </div>
                        <div class="col-md-6" style="padding: 5px; background-color: #D4DEEF;">
                            <label class=" col-md-12 control-label">Margin Only</label>
                            <div class="clearfix" style="margin-bottom: 5px"></div>
                            <div class="col-md-4"><label class="control-label">Product Price</label></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control mgn setop"  name="y_product_price_other" id="y_product_price_other"  placeholder="Product Price">
                            </div>
                            <div class="clearfix" style="margin-bottom: 5px"></div>
                            <div class="col-md-4"><label class="control-label">Margin</label></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control mgn"  name="y_margin_1_other" id="y_margin_1_other"  placeholder="(%)">
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <label class="control-label">OR</label>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <input type="text" class="form-control mgn"  name="y_margin_2_other" id="y_margin_2_other"  placeholder="LKR">
                            </div>
                            <div class="clearfix" style="margin-bottom: 5px"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label  class="col-sm-2 control-label" style="color: red"> PRICE ON WEBSITE:</label>
                <div class="col-sm-10">
                    <input type="text"   class="form-control " name="price_on_web_other" id="price_on_web_other" readonly placeholder="-">
                </div>
            </div>

            <div class="form-group">
                <label  class="col-sm-2 control-label" style="color: red"> PAID TO SUPPLIER:</label>
                <div class="col-sm-10">
                    <input type="text"   class="form-control " name="paid_to_sup_other" id="paid_to_sup_other" readonly placeholder="-">
                </div>
            </div>

            <div class="form-group">
                <label  class="col-sm-2 control-label"> Commission %</label>
                <div class="col-sm-10">
                    <input type="text"   class="form-control " name="commission_other" id="commission_other" readonly placeholder="Commission %">
                </div>
            </div>

            <div class="form-group">
                <label  class="col-sm-2 control-label"> Quoted Price without discount <span style="color:red">*</span> </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  name="product_price_other" readonly id="product_price_other"   placeholder="Price">
                </div>
            </div>

            <div class="form-group">
                <label  class="col-sm-2 control-label"> Product Discount %</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control"  name="product_discount_other" id="product_discount_other"  placeholder="Product Discount %">
                </div>
            </div>

        </div>
        <!--kosala script-->
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
                            url: "<?php echo base_url('admin_jsessID/panel/city'); ?>",
                            data: {csrf_rt_secure: csrf, dis_id: id},
                            dataType: "json",
                            success: function (reply) {
//                        console.log(reply);
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



    <div class="form-group" style="padding: 20px;background: #eee; padding-left: 0px; padding-right: 0px">

<?php if (sizeof($version) == 0) { ?>

            <!--<label  class="col-sm-2 control-label">Other Option </label>-->

<!--
            <div>

                <div class="col-sm-2">
                    <input  type="text" class="form-control v-o-name" name="version[0][name]"  placeholder=" Option Name : Eg 16GB ">
                </div>

                <div class="col-sm-2">
                    <input id="version_price0" type="text" class="form-control v-o-price" readonly name="version[0][price]"  placeholder=" Option Price (Quoted Price without discount) : 2000 LKR">
                </div>

                <div class="col-sm-2">
                    <input id="version_discount0" type="text" class="form-control v-o-dis" readonly name="version[0][discount]"  placeholder=" Option Discount">
                </div>

                <div class="col-sm-2">
                    <input id="0" type="text" class="form-control v-o-qty" name="version[0][qty]"  placeholder=" Quantity">
                </div>
                 <div class="col-sm-1">
                        <input class="btn btn-primary set_option" name="0" id="0" type="button" value="Set Option" />
                    </div>
                
             

                <div class="clearfix"></div>

            </div>-->




<?php } ?>

        <div id="version_relations">


<?php
// var_dump($version);
$output = '';

$c = sizeof($version) - 1;

echo '<input name="version_count" value="' . $c . '" type="hidden">';

for ($i = 0; $i < sizeof($version); $i++) {

    $vname = htmlspecialchars($version[$i]["version_name"]);
    $vprice = htmlspecialchars($version[$i]["version_price"]);
    $vdiscount = htmlspecialchars($version[$i]["version_discount"]);
    $vqty = htmlspecialchars($version[$i]["version_qty"]);

    $output .= ' <div style="margin-top:10px;" class="version_' . $i . '">';

    // if ($i != 0) {
    $output .= ' <label  class="col-sm-2 control-label">Other Option  </label>';
    // }

    $output.= ' <div class="col-sm-2">'
            . '    <input type="text" class="form-control" value="' . $vname . '" name="version[' . $i . '][name]"  placeholder=" Option Name : Eg 16GB ">'
            . ' </div> '
            . ' <div class="col-sm-2">  '
            . '     <input type="text" class="form-control v-o-price" readonly value="' . $vprice . '" name="version[' . $i . '][price]" id="version_price' . $i . '" placeholder=" Option Price (Quoted Price without discount) : 2000 LKR">'
            . ' </div> '
            . ' <div class = "col-sm-2"> '
            . ' <input type = "text" class = "form-control v-o-dis" readonly value="' . $vdiscount . '" name = "version[' . $i . '][discount]" id="version_discount' . $i . '" placeholder = " Option Discount"> '
            . ' </div> '
            . ' <div class = "col-sm-2"> '
            . ' <input type = "text" class = "form-control"  value="' . $vqty . '" name = "version[' . $i . '][qty]" placeholder = " Option Quantity"> '
            . ' </div> '
            .'<div class="col-sm-1">'
            . '       <input class="btn btn-primary set_option" name="' . $i . '" id="' . $i . '" type="button" value="Set Option" />'
             . '  </div>'
            . '  <div class="col-sm-1">'
            . '<span class="btn btn-danger delete-version-type" data-id="' . $i . '"> <i class="fa fa-times"></i></span>'
            . ' </div>'
            . ' <div class = "clearfix"></div> '
            . ' </div>';
}

echo $output;
?>








        </div>

        <div style="margin-top:10px;">
            <label class="col-sm-2 control-label"> </label>
            <div class="col-sm-10">
                <span class="btn btn-primary create-version">Add Option</span>
            </div>
        </div>




    </div>


    <div class="form-group" style="display: none">
        <label  class="col-sm-2 control-label"> Max Quantity </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($item_max_qty) ?>" name="product_max_q"  placeholder=" Max Quantity">
        </div>
    </div>

<?php
// echo $item_stock_status"];
?>

    <!--    <div class="form-group">
            <label  class="col-sm-2 control-label"> SEO Keywords </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="<?php //$item_isbn   ?>" name="product_seo_keywords"  placeholder="  SEO Keywords  ">
            </div>
        </div>
    -->

    <div class="form-group">
        <label  class="col-sm-2 control-label"> Stock Status </label>
        <div class="col-sm-10">
<!--                                                <input type="text" class="form-control" id="inputEmail3" placeholder=" Max Quantity">-->

            <select name="product_stock_status"   id="input-stock-status" class="form-control">
                <option value="4">In Stock</option>
                <option value="5">Out Of Stock</option>
            </select>

            <input type="hidden" name="product_stock_status_1" value="<?= htmlspecialchars($item_stock_status) ?>" />

        </div>
    </div>




    <!--        <div class="form-group">
                <label class="col-sm-2 control-label" for="input-status"> Stock Status</label>
                <div class="col-sm-10">
                    <select name="product_status" id="input-status" class="form-control">
                        <option value="1" selected="selected">Enabled</option>
                        <option value="0">Disabled</option>
                    </select>
        
                    <input type="hidden" name="live" value="<?php // echo htmlspecialchars($status)   ?>" />
        
                </div>
            </div>-->
    <!--
        <div class="form-group" style="display: none">
            <label class="col-sm-2 control-label" for="input-sort-order">Sort Order</label>
            <div class="col-sm-10">
                <input name="product_sort_order"  value="<?php // echo htmlspecialchars($item_sort_order)   ?>"  placeholder="Sort Order" id="input-sort-order" class="form-control" type="text">
            </div>
        </div>-->








</div>

<script>

    $(document).ready(function () {

        /*
         * MRGIN MARK UP SET BY KALAN DON"T REMOVE
         */

        var k_comm_type = '<?php echo $commission_type; ?>';
        var k_comm_per = '<?php echo $commission_type_per; ?>';
        var k_comm_val = '<?php echo $commission_type_value; ?>';
        var k_product_price = '<?php echo $item_price; ?>';

        if (k_comm_type === '2') {

            $('input[name=x_product_price]').val(k_product_price);


            if (k_comm_per !== '0.00') {
                $('input[name=x_mark_up_1]').val(k_comm_per);
            } else {
                $('input[name=x_mark_up_2]').val(k_comm_val);
            }

        } else {
            $('input[name=y_product_price]').val(k_product_price);

            if (k_comm_per !== '0.00') {
                $('input[name=y_margin_1]').val(k_comm_per);
            } else {
                $('input[name=y_margin_2]').val(k_comm_val);
            }

        }

        $('input[name=product_discount]').keyup(function () {
            $('.v-o-dis').val($(this).val());

            //console.log($(this).val())
        });

        $('input[name=product_price]').keyup(function () {
            $('.v-o-price').val($(this).val());

            //console.log($(this).val())"
        })

        $('select[name=product_payment_option] > option[value=<?php echo htmlspecialchars($item_payment_options) ?>]').prop('selected', true);
        $('select[name=product_status] > option[value=<?php echo htmlspecialchars($status) ?>]').prop('selected', true);
       // $('select[name=product_payment_option] > option[value=<?php echo htmlspecialchars($item_delivery_option) ?>]').prop('selected', true);
        $('select[name=product_stock_status] > option[value=<?php echo htmlspecialchars($item_stock_status) ?>]').prop('selected', true);

        //$('input[value=<?php echo htmlspecialchars($item_payment_options) ?>]').prop('selected', true);


//        $('.create-version').click(function () {
        $(document).on('click', '.create-version', function () {

            $('#cal').hide();
            $('#product_discount').attr('readonly', 'readonly');
            var create_version = parseInt($('input[name=version_count]').val()) + 1;

            var output = '<div class="version_' + create_version + '" style="margin-top:10px; ">';

            // if (create_version !== 0) {
            output += ' <label  class="col-sm-2 control-label"> Other Option </label>';
            // }

            var price = $('input[name=product_price]').val();
            var dis = $('input[name=product_discount]').val();
           


            output += '  <div class="col-sm-2">'
                    + '     <input type="text" class="form-control" name="version[' + create_version + '][name]"  placeholder=" Option Name : Eg 16GB ">'
                    + '  </div>'
                    + '   <div class="col-sm-2">'
                    + '      <input type="text" class="form-control" value="' + price + '" name="version[' + create_version + '][price]" id="version_price'+create_version+'"  placeholder=" Option Price (Selling Price) : 2000 LKR">'
                    + '  </div>'
                    + '  <div class="col-sm-2">'
                    + '       <input type="text" class="form-control" value="' + dis + '" name="version[' + create_version + '][discount]" id="version_discount' + create_version + '"  placeholder=" Option Discount">'
                    + '  </div>'
                    + '  <div class="col-sm-2">'
                    + '       <input type="text" class="form-control"  name="version[' + create_version + '][qty]"  placeholder=" Option Quantity">'
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
        
        
        $(document).on('click', '.set_option', function () {
                    var id = $(this).attr('name');
                    console.log(id);

                    var dis = $('#product_discount_other').val();
                    var pri = $('#product_price_other').val();

//                    $('#'+ id).val(dis);//version[1][discount]
//                    $('#'+id).val(pri);//version[1][price]
                   
                    $('#version_price'+id).val(pri);
                    $('#version_discount'+id).val(dis);
//                    


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