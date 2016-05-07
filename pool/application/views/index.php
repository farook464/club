<?php
/*
 *  RETAILGENIUS.COM - Team Innovation
 *  ---------------------------------
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
?>

<link href="/dist/admin/js/lib/summernote/summernote-bs3.css" rel="stylesheet" type="text/css"/>

</head>

<body class="skin-blue">
    <!-- Site wrapper -->
    <div class="wrapper">

        <?php $this->load->view("template/nav") ?>

        <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <?php $this->load->view("template/sidebar") ?>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Search Terms 
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Products</a></li>
                    <li class="active">Insert</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">




                <!-- Default box -->
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Title</h3>

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
                                    <th>search_id</th>
                                    <th>search_key</th>
                                    <th>result_count</th>
                                    <th>search_count</th>
                                    <th>date_created</th>

                                </tr>
                            </thead>

                        </table>




                        <div class="summernote"></div>
                    </div><!-- /.box-body -->

                </div><!-- /.box -->

            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->


    </div><!-- ./wrapper -->


    <script type="text/javascript">
        $(function () {

            $('#example').dataTable({
                "ajax": "/admin/admin_jsessID/panel/search_terms/getdata",
                "columns": [
                    {"data": "search_id"},
                    {"data": "search_key"},
                    {"data": "result_count"},
                    {"data": "search_count"},
                    {"data": "date_created"}



                ],
                "bPaginate": true,
                "sPaginationType": "full_numbers",
                "iDisplayLength": 10,
                "bProcessing": true,
                "bServerSide": true,
                "order": [[0, "desc"]]
            });

            $(document).on('click', '.do-inactiv-product', function () {
                var getDeleteURL = $(this).data('url');

                var is = $(this);

                //alert(getDeleteURL);

                $.ajax({
                    url: getDeleteURL,
                    type: "GET",
                    success: function (data) {

                        is.parent().parent().hide();

                        $('.product-js-error-list').html(data).show();

                        setTimeout(function () {
                            $('.product-js-error-list').hide();
                        }, 3000);




                    }
                })


            })


        });
    </script>


