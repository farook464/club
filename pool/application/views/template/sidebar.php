<?php
/*
 *  RETAILGENIUS.COM - Team Innovation 
 *  ---------------------------------
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/RG-Supplier-Profile/dist/supplier/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?= $this->session->userdata('userName'); ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            <li><a href="<?= base_url("admin_jsessID/panel/order-history"); ?>"><i class="fa fa-circle-o"></i> Order History </a></li>
            
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-circle-o"></i> <span> Products</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    
                    <li><a href="<?= base_url("admin_jsessID/panel/add-product"); ?>"><i class="fa fa-circle-o"></i> Add Product </a></li>
                    <li><a href="<?= base_url("admin_jsessID/panel/my_products"); ?>"><i class="fa fa-circle-o"></i> My Product </a></li>
                    <li><a href="<?= base_url("admin_jsessID/panel/sales_by_cat"); ?>"><i class="fa fa-circle-o"></i> Sales By Category </a></li>
                    <li><a href="<?= base_url("admin_jsessID/panel/sales_by_duration"); ?>"><i class="fa fa-circle-o"></i> Sales By Duration </a></li>
                    <li><a href="<?= base_url("admin_jsessID/panel/most_sales_of_month"); ?>"><i class="fa fa-circle-o"></i> Most Sales of Month </a></li>
                    <li><a href="<?= base_url("admin_jsessID/panel/sales-report"); ?>"><i class="fa fa-circle-o"></i> Sales Report </a></li>
                    
                    <li><a href="<?= base_url("admin_jsessID/panel/stock"); ?>"><i class="fa fa-circle-o"></i> Stock On Retail Genius </a></li>
                    <li><a href="<?= base_url("admin_jsessID/panel/no_item_viewed"); ?>"><i class="fa fa-circle-o"></i> No of Times Item viewed </a></li>
                </ul>
            </li>


            <li><a href="<?= base_url("admin_jsessID/panel/message"); ?>"><i class="fa fa-circle-o"></i> Messages </a></li>
            <li><a href="<?= base_url("admin_jsessID/panel/reviews"); ?>"><i class="fa fa-circle-o"></i> Reviews </a></li>
           <li><a href="<?= base_url("admin_jsessID/logout"); ?>"><i class="fa fa-circle-o"></i> Logout </a></li>
           


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>