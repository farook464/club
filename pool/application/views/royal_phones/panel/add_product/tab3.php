<?php
/*
 *  RETAILGENIUS.COM - Team Innovation 
 *  ---------------------------------
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
?>

<div class="tab-pane  form-horizontal" id="tab_3">



<div class="form-group">
        <label  class="col-sm-2 control-label">Supplier Name <span style="color:red">*</span> </label>
        <div class="col-sm-10">
            <input type="text" name="supplier_name" id="supplier_name" class="form-control"  placeholder="Supplier Name">      
        </div>
    </div>

<div class="form-group">
        <label  class="col-sm-2 control-label">Supplier Phone <span style="color:red">*</span> </label>
        <div class="col-sm-10">
            <input type="tel" name="supplier_phone" id="supplier_phone" class="form-control"  placeholder="Supplier Phone">      
        </div>
    </div>

<div class="form-group">
        <label  class="col-sm-2 control-label">Supplier Address <span style="color:red">*</span> </label>
        <div class="col-sm-10">
            <input type="text" name="supplier_address" id="supplier_address" class="form-control"  placeholder="Supplier Address">      
        </div>
    </div>

  <div class="form-group" style="margin: 10px"> 
      <span id="do_save_supplier" class="btn btn-primary col-sm-12"> Save Supplier </span> 
</div>



</div>