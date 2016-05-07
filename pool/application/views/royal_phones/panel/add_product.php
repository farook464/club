<?php
/*
 *  RETAILGENIUS.COM - Team Innovation 
 *  ---------------------------------
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
?>

<script src="/RG-Supplier-Profile/dist/supplier/js/lib/summernote/summernote.min.js" type="text/javascript"></script>
<link href="/RG-Supplier-Profile/dist/supplier/js/lib/summernote/summernote.css" rel="stylesheet" type="text/css"/>
<script src="/Royal-Mobiles/dist/mobiles/js/lib/typeahead.bundle.js" type="text/javascript"></script>
<script src="/Royal-Mobiles/dist/mobiles/js/lib/hogan.js" type="text/javascript"></script>

</head>

<body style="">
    <!-- Site wrapper -->
    <div class="wrapper" >

        <?php $this->load->view("template/nav") ?>

        <!-- =============================================== -->

    

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style=" margin:0 auto;  width:90%;  box-shadow:0px 0px 7px 0px black;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Add New Item
                </h1>

            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="box">

                    <div class="box-body">
                        
                        <div style="display: none" class="alert alert-danger js-errors-list"></div>
                    



                        <?php
                        if ($this->session->flashdata("process_done")) {

                            echo '<div class="alert alert-success"> ' . $this->session->flashdata("process_done") . '</div>';
                        }

                        if ($this->session->flashdata("process_error")) {

                            echo '<div class="alert alert-danger"> ' . $this->session->flashdata("process_error") . '</div>';
                        }
                        ?>



                        <?php
                        $attr = array("id" => "form-product");
                        echo form_open_multipart("royal/panel/add-product", $attr);
                        ?>
                        
                        
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a aria-expanded="true" href="#tab_1" data-toggle="tab">Phone & Accessory</a></li>
                                <li class=""><a aria-expanded="false" href="#tab_2" data-toggle="tab">Brands & Categories</a></li>
                                <li class=""><a aria-expanded="false" href="#tab_3" data-toggle="tab">Suppliers</a></li>
                                <!--<li class=""><a aria-expanded="false" href="#tab_4" data-toggle="tab">Images</a></li>-->
                                <li class="pull-right">
                                    
<!--                                    <span id="do_save_product" class="btn btn-primary"> Save Product </span> -->
                                    
                                    <!--<input class="btn btn-primary" id="contact-submit" value="Submit" type="submit">-->
                                
                                
                                </li>
                            </ul>
                            <div class="tab-content">




                                <?php $this->load->view("royal_phones/panel/add_product/tab1"); ?>
                                <?php $this->load->view("royal_phones/panel/add_product/tab2"); ?>
                                <?php $this->load->view("royal_phones/panel/add_product/tab3"); ?>



                                <?php echo form_close(); ?>


                                <?php // $this->load->view("supplier/panel/add_product/tab4"); ?>



                            </div><!-- /.tab-content -->
                        </div>


                        <?php // $this->load->view("admin/popup/create_tag") ?>
                          <?php // $this->load->view("admin/popup/create_model") ?>


                        <!--<div class="summernote"></div>-->
                    </div><!-- /.box-body -->
                   
                </div><!-- /.box -->

            </section><!-- /.content -->
        </div>

        <style>
            
            
    .tt-menu{
        max-height:300px;
        overflow-y: auto;
    }


            .typeahead,
            .tt-query {
                width: 396px;
                height: 30px;
                padding: 8px 12px;
                font-size: 24px;
                line-height: 30px;
                border: 2px solid #ccc;
                -webkit-border-radius: 8px;
                -moz-border-radius: 8px;
                border-radius: 8px;
                outline: none;
            }

            .typeahead {
                background-color: #fff;
            }

            .typeahead:focus {
                border: 2px solid #0097cf;
            }

            .tt-query {
                -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
            }

            .tt-hint {
                color: #999
            }

            .tt-menu {
                width: 422px;
                margin: 12px 0;
                padding: 8px 0;
                background-color: #fff;
                border: 1px solid #ccc;
                border: 1px solid rgba(0, 0, 0, 0.2);
                -webkit-border-radius: 8px;
                -moz-border-radius: 8px;
                border-radius: 8px;
                -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
                -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
                box-shadow: 0 5px 10px rgba(0,0,0,.2);
            }

            .tt-suggestion {
                padding: 3px 20px;
                font-size: 18px;
                line-height: 24px;
            }

            .tt-suggestion:hover {
                cursor: pointer;
                color: #fff;
                background-color: #0097cf;
            }

            .tt-suggestion.tt-cursor {
                color: #fff;
                background-color: #0097cf;

            }

            .tt-suggestion p {
                margin: 0;
            }

            .gist {
                font-size: 14px;
            }

        </style>


        <script src="/Royal-Mobiles/dist/mobiles/js/product.js"></script>

