<?php

/*
 *  RETAILGENIUS.COM - Team Innovation 
 *  ---------------------------------
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}



//redirect('/../../login');

?>



</head>

<body class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href=""><b>ROYAL</b>PHONES</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Please sign in to explore</p>
        
        <?php echo $this->session->flashdata('error');?>
        
        
        <?= form_open() ?>
        
          <div class="form-group has-feedback">
              <input type="text" class="form-control" name="user" placeholder="Email Or User Name"/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
              <input type="password" class="form-control" name="password" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
              <div class="checkbox icheck">
                <label>
                    <input name="rem" type="checkbox"> Remember Me
                </label>
              </div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
                <button type="submit" name="createSess" value="do" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

        

        <a href="#">I forgot my password</a><br>
        <!--<a href="register.html" class="text-center">Register a new membership</a>-->

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
