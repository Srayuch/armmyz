<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  include('storage/system/sql_inject.php');
  include('storage/system/functions.php');

  if(isset($_GET['cmd']) && trim($_GET['cmd']) == "logout") {
    session_destroy();
    header('Location: ./');
  }

?>

 <!-- xxxxxxxx -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="WARZ, WARZ เถื่อน, วอร์ซี, Infes, Infestation, กันโปร warz, โปร warz, โปรแกรมช่วยเล่น">
    <meta name="keywords" content="WARZ, WARZ เถื่อน, วอร์ซี, Infes, Infestation, กันโปร warz, โปร warz, โปรแกรมช่วยเล่น">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no maximum-scale=1">
    <meta name="author" content="Legend-Studio">

    <title><?php echo (isset($_GET['cmd']))?$lang['page'][trim($_GET['cmd'])]:$lang['page']['wellcome']; echo ' - '.$lang['page']['title']; ?></title>
    <link rel="icon" type="image/png" href="assets/images/logo/logo-nav.png">

    <!-- START: Styles -->

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Prompt|Athiti:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mitr:300&subset=thai">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,400italic,700,300,300italic">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/vendor/fontawesome-free/css/all.min.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/dist/css/bootstrap.min.css" />
    <!-- Youplay -->
    <link rel="stylesheet" href="assets/css/youplay-shooter.css">
    <!-- Bootstrap Sweetalert -->
    <link rel="stylesheet" href="assets/vendor/sweetalert2/sweetalert2.min.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" type="text/css" href="assets/vendor/magnific-popup/dist/magnific-popup.css" />


    <!-- Custom -->
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- END: Styles -->
    <style>

    </style>

  </head>
  <body>

    <!-- Preloader -->
    <div class="page-preloader preloader-wrapp">
      <img src="assets/images/logo/logo.png" alt="">
      <div class="preloader"></div>
    </div>
    <!-- /Preloader -->

    <!-- include nevbar -->
    <?php require_once dirname(__FILE__) . '/storage/pages/menu.php'; ?>

      <!-- include Page Body -->
      <?php
        if(isset($_GET['cmd'])) {
          if(file_exists("storage/pages/".trim($_GET['cmd']).".php")){
            require_once dirname(__FILE__) . "/storage/pages/".trim($_GET['cmd']).".php";
    			}else{
    				require_once dirname(__FILE__) . "/storage/pages/home.php";
    			}
    		} else {
    			require_once dirname(__FILE__) . "/storage/pages/home.php";
    		}
      ?>

    <!-- include footer -->
    <?php require_once dirname(__FILE__) . '/storage/pages/footer.php'; ?>

    <!-- START: Script -->

    <!-- jQuery -->
    <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Youplay -->
    <script src="assets/js/youplay.min.js"></script>
    <script src="assets/js/youplay-init.js"></script>
    <!-- SweetAlert2 -->
    <script src="assets/vendor/sweetalert2/sweetalert2.min.js"></script>
    <!-- Magnific Popup -->
    <script src="assets/vendor/magnific-popup/dist/jquery.magnific-popup.min.js"></script>

    <!-- END: Script -->

    <?php include('storage/system/js_func.php'); ?>
  </body>
</html>
