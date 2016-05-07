<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
?>

<div class="container" >
    <!-- row 1: navigation -->
    <div class="row" >
        <nav class="navbar navbar-default  navbar-fixed-top" role="navigation" style="background-color: black;" >
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="<?= base_url("royal/panel/add-product"); ?>">Add Product</a></li>
                    <li ><a href="<?= base_url('royal/panel/my_products'); ?>">All Products</a></li>
                    <li><a href="#">Invoice</a></li>                  
                    <li> <a href="">Hi, <?= $this->session->userdata('userName'); ?></a>
                       
                    </li>

                    <li><a href="<?= base_url("royal/logout"); ?>"><i class="fa fa-circle-o"></i> Logout </a></li>

                </ul>
            </div>  
        </nav>
    </div>
    <br> <br>  
    <!-- row 2: header -->
<!--    <header class="row" style="margin-top: 20px;">
        <div class="col-lg-6 col-sm-5">
            <a href=""><img src="/Royal-Mobiles/dist/mobiles/img/banner.jpg" alt="Royal Phones."  class="img-responsive img-circle" ></a>         
        </div>
    </header>-->
</div>