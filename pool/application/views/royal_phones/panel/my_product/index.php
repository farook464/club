<?php
/*
 *  RETAILGENIUS.COM - Team Innovation
 *  ---------------------------------
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

//get userid
$getUserId = $this->session->userdata('rtLogin_userId');
?>

<link href="/RG-Supplier-Profile/dist/supplier/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
<script src="/RG-Supplier-Profile/dist/supplier/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

</head>

<body>
    <!-- Site wrapper -->
    <div class="wrapper">

        <?php $this->load->view("template/nav") ?>

        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <?php //$this->load->view("template/sidebar") ?>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style=" margin:0 auto;  width:90%; box-shadow:0px 0px 7px 0px black;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    PHONES
                </h1>
                
            </section>

            <section class="content">

                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <!--<h3 class="box-title">Title</h3>-->
                        <br><br>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">

                        <div class="alert alert-success product-js-error-list" style="display: none"></div>

                        <?php
                        if ($this->session->flashdata("process_done")) {

                            echo '<div class="alert alert-success"> ' . $this->session->flashdata("process_done") . '</div>';
                        }

                        if ($this->session->flashdata("process_error")) {

                            echo '<div class="alert alert-danger"> ' . $this->session->flashdata("process_error") . '</div>';
                        }
                        ?>

                        <table id="example" class="table table-bordered table-hove" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Item Id</th>
                                    <th>Item Name</th>
                                    <th>Item Brand</th>
                                    <th>Item Supplier</th>
                                    <th>IEMI Number</th>
                                    <th>Item Price</th>
                                    <th>Item Quantity</th>
                                    <!--<th>Item Action</th>-->
<!--                                    <th>review_title</th>
                                    <th>review</th>
                                    <th>review_rating</th>
                                    <th>review_status</th>
                                    <th>date_created</th>
                                    <th>Reply</th>-->
                                </tr>
                            </thead>
                        </table>
                        <div class="summernote"></div>
                    </div><!-- /.box-body -->

                </div><!-- /.box -->

            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->
    </div><!-- ./wrapper -->


    <!-- Modal -->
    <div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <?php echo form_open() ?>
                        <label for="deleteComment" class="control-label">Reason For Delete:</label>
                        <textarea class="form-control" id="deleteComment"></textarea> 
                        <input type="hidden" name="confim_delete_id" />
                        <?php echo form_close() ?>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirm">Confirm</button>
                </div>
            </div>
        </div>
    </div>
   
    
    <!--end of quick edit-->



    <script type="text/javascript">
        $(function () {
      
            $('#example').dataTable({
                "ajax": rt_config.API + "my_products/retrieve_products",
                "columns": [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "brand_name"},
                    {"data": "supplier_name"},
                    {"data": "iemi_number"},
                    {"data": "price"},
                    {"data": "quantity"}
//                    {"data": "action"}
                ],
                "bPaginate": true,
                "sPaginationType": "full_numbers",
                "iDisplayLength": 10,
                "bProcessing": true,
                "bServerSide": true,
                "order": [[0, "desc"]]
            });

//            var pgrid = $('#example').DataTable();


//            $(document).on('click', '.do-delete', function () {
//                var id = $(this).data('product_id');
//                $('input[name=confim_delete_id]').val(id);
//                $('#deleteModel').modal()
//            });

//            $('#confirm').click(function () {
//                var reason = $('#deleteComment').val();
//                var id = $('input[name=confim_delete_id]').val();
//
//                $.ajax({
//                    type: 'POST',
//                    url: "<?php //echo base_url('supplier/admin_panel/delete_product_v2'); ?>",
//                    data: {reason: reason, id: id, csrf_rt_secure: $('input[name=csrf_rt_secure]').val()},
//                    success: function (data) {
//                        document.getElementById("deleteComment").value = "";
//                        $('#deleteModel').modal('hide');
//                    }
//                });
//                return false;
//            });

        });
    </script>

    <!--script of kosala-->
<!--    <script type="text/javascript">
        $(function () {

            $(document).on('click', '.quick_edit', function () {
    //                var quick_edit_id = document.activeElement.name;
                var quick_edit_id = $(this).attr('name');
    //                console.log(id);
                var hidden_id = "#id_" + quick_edit_id;
                var item_id = $(hidden_id).val();
                var csrf = $('input[name=csrf_rt_secure]').val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('admin_jsessID/panel/quick-select'); ?>",
                    data: {csrf_rt_secure: csrf, item_id: item_id},
                    dataType: "json",
                    success: function (reply) {
                        var qty = reply.qty;
                        var stock_status = reply.status;
                        $('#item_qty').val(qty);
                            $('#item_id').val(item_id);

                        if (stock_status == 4) {

                            $('select[name="product_stock_status"]').find('option[value="5"]').attr("selected", false);
                            $('select[name="product_stock_status"]').find('option[value="4"]').attr("selected", true);
                            $('#input_stock_status select').val("4");
                            $('#product_stock_status_1').val('4');
                            //in stock
                        } else {

                            $('select[name="product_stock_status"]').find('option[value="4"]').attr("selected", false);
                            $('select[name="product_stock_status"]').find('option[value="5"]').attr("selected", true);
                            $('#input_stock_status select').val("5");
                            $('#product_stock_status_1').val('5');
                            //out of stock
                        }


    //                        if(status == 1){
    //                            $('select[name="product_status"]').find('option[value="0"]').attr("selected",false);
    //                            $('select[name="product_status"]').find('option[value="1"]').attr("selected",true);
    //                            $('#status').val('1');
    //                            //enable
    //                        }else{
    //                            $('select[name="product_status"]').find('option[value="1"]').attr("selected",false);
    //                            $('select[name="product_status"]').find('option[value="0"]').attr("selected",true);
    //                            $('#status').val('0');
                        //disable
                    }
                });
            });




            $(document).on('click', '#save_edit', function () {
                console.log("kosala");
                var qty = $('#item_qty').val();
                var item_stock = $('#input_stock_status').val();
                var status = $('#input_status').val();
                var id = $('#item_id').val();
                var csrf = $('input[name=csrf_rt_secure]').val();

                console.log(qty);
                console.log(item_stock);
                console.log(status);
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('admin_jsessID/panel/quick-update'); ?>",
                    data: {csrf_rt_secure: csrf, item_qty: qty, stock: item_stock, status: status, id: id},
                    dataType: "json",
                    success: function (data) {
                        if (data) {
                            alert("successfuly updated");
                        } else {
                            alert("not updated");
                        }
                    }
                });
                return false;
            });



        });





    </script>-->
    <!--end of script of kosala-->
