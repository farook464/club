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
<script src="/RG-Supplier-Profile/dist/supplier/js/lib/typeahead.bundle.js" type="text/javascript"></script>
<script src="/RG-Supplier-Profile/dist/supplier/js/lib/hogan.js" type="text/javascript"></script>

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
                    Edit Product to Supplier
                    <small>it all starts here</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Products</a></li>
                    <li class="active">All</li>
                </ol>
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
                        echo form_open_multipart("admin_jsessID/panel/product-update", $attr);
                        ?>
                        
                        
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a aria-expanded="true" href="#tab_1" data-toggle="tab">Product Informations</a></li>
                                <li class=""><a aria-expanded="false" href="#tab_2" data-toggle="tab">Product Details</a></li>
                                <li class=""><a aria-expanded="false" href="#tab_3" data-toggle="tab">Supplier And Categories</a></li>
                                <!--<li class=""><a aria-expanded="false" href="#tab_4" data-toggle="tab">Images</a></li>-->
                                <li class="pull-right">
                                    
                                    <span id="do_update_product" class="btn btn-primary"> Update Product </span> 
                                    
                                    <!--<input class="btn btn-primary" id="contact-submit" value="Submit" type="submit">-->
                                
                                
                                </li>
                            </ul>
                            <div class="tab-content">
                                
                                <?php
                                $tab_1 = $product_data;
                                $tab_2 = $other_tab;
                                $tab_one = array();
                                $tab_two = array();
                                $tab_three = array();
                                $desc = json_decode($tab_1[0]["description"],TRUE);
                                $tab_one["desc"]= $desc["product_details"];
                                $tab_one["tech"]= $desc["tech_details"];
                                $tab_one["title"] = $tab_1[0]["title"];
                                $tab_one["id"] = $tab_1[0]["id"];
//                                var_dump($desc);die();
                                
                                $tab_three["note"] = $other_tab[0]["item_supplier_note"];
                                
                                $tab_two["tab_data"] = $other_tab;
                                $tab_two["version"] = $version;
//                                
//                                var_dump($tab_two);die();
//                                
//                                ?>
                                
                                <?php
                                
//                                $data_tab_2 = array( "data" => $data,"version"=>$version_data);
//                                $data_tab_2 = array( "data" => $data[0],"version"=>$version_data);//original
                                
                                
                                ?>
                                




                                <?php $this->load->view("supplier/panel/edit_product/tab1",$tab_one); ?>
                                <?php // $this->load->view("supplier/panel/edit_product/tab1",$data[0]); ?>
                                <?php $this->load->view("supplier/panel/edit_product/tab2",$tab_two['tab_data'][0]); ?>
                                <?php $this->load->view("supplier/panel/edit_product/tab3",$tab_three); ?>
                                <?php // $this->load->view("supplier/panel/edit_product/tab3",$data[0]); ?>
                                
                                
                                <input type="hidden" name="id" value="<?php echo $id?>" />

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


        <script src="/RG-Supplier-Profile/dist/supplier/js/product.js"></script>

