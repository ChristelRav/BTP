<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Spica Admin</title>
  <!-- base:css -->
  <link rel="stylesheet" href="<?php echo base_url("assets/vendors/mdi/css/materialdesignicons.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/vendors/css/vendor.bundle.base.css"); ?>">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo base_url("assets/images/favicon.png"); ?>" />
</head>

<body>
  <div class="container-scroller d-flex">
    <div class="container-fluid page-body-wrapper full-page-wrapper d-flex">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="<?php echo base_url("assets/images/logo.svg"); ?>" alt="logo">
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3"   action="<?php echo site_url('CT_Client/login')?>"  method="POST"  >
                <div class="form-group">
                  <input type="text" name="contact" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="phone number" value="0340590098">
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">SIGN IN</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Log in Admin? <a href="<?php echo site_url('CT_Admin/')?>" class="text-primary">Connect</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="<?php echo base_url("assets/vendors/js/vendor.bundle.base.js"); ?>"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="<?php echo base_url("assets/js/off-canvas.js"); ?>"></script>
  <script src="<?php echo base_url("assets/js/hoverable-collapse.js"); ?>"></script>
  <script src="<?php echo base_url("assets/js/template.js"); ?>"></script>
  <!-- endinject -->
</body>

</html>
