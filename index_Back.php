<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('storage/php/functions.php');

if(isset($_GET['cmd']) == "logout") {
    session_destroy();
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="WARZ, WARZ เถื่อน, วอร์ซี, Infes, Infestation, กันโปร warz, โปร warz, โปรแกรมช่วยเล่น">
    <meta name="keywords" content="WARZ, WARZ เถื่อน, วอร์ซี, Infes, Infestation, กันโปร warz, โปร warz, โปรแกรมช่วยเล่น">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no maximum-scale=1">
    <meta name="author" content="KNz">

    <title><?php echo $_CONFIG['SERVER']['NAME']." | Survival & PvP"; ?></title>
    <link rel="icon" type="image/png" href="assets/images/shooter/icon.png">

    <!-- START: Styles -->
    <link rel="stylesheet" href="storage/colorbox/colorbox.css" />

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Prompt|Athiti:400,700">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Mitr:300&subset=thai'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Lato:400,400italic,700,300,300italic'>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/dist/css/bootstrap.min.css" />

    <!-- Flickity -->
    <link rel="stylesheet" href="assets/vendor/flickity/dist/flickity.min.css" />

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="assets/vendor/magnific-popup/dist/magnific-popup.css" />

    <!-- Revolution Slider -->
    <link rel="stylesheet" href="assets/vendor/slider-revolution/css/settings.css">
    <link rel="stylesheet" href="assets/vendor/slider-revolution/css/layers.css">
    <link rel="stylesheet" href="assets/vendor/slider-revolution/css/navigation.css">

    <!-- Bootstrap Sweetalert -->
    <link rel="stylesheet" href="assets/vendor/bootstrap-sweetalert/dist/sweetalert.css" />

    <!-- Social Likes -->
    <link rel="stylesheet" href="assets/vendor/social-likes/dist/social-likes_flat.css" />

    <!-- FontAwesome -->
    <script defer src="assets/vendor/font-awesome/svg-with-js/js/fontawesome-all.min.js"></script>
    <script defer src="assets/vendor/font-awesome/svg-with-js/js/fa-v4-shims.min.js"></script>

    <!-- Youplay -->
    <link rel="stylesheet" href="assets/css/youplay-shooter.css">
    

    <!-- RTL (uncomment this to enable RTL support) -->
    <!-- <link rel="stylesheet" href="assets/css/youplay-rtl.min.css" /> -->

    <!-- Custom Styles -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/custom-shooter.css">
    <link rel="stylesheet" href="test.css">
    <!-- END: Styles -->

    <!-- jQuery -->
    <script src="assets/vendor/jquery/dist/jquery.min.js"></script>

    <?php include_once dirname(__FILE__) . '/storage/pongpisut/head.php'; ?>
    <style type="text/css">
        ul > li > a {
            font-size: 12px
        }
    </style>

<!-- Custom Style -->
<style type="text/css"> 

.sidebar, .sidebar *, .sidebar:before{
  transition: all 0.2s ease-in-out;
}
.sidebar{
  position:fixed;
  z-index: 99;
  top:35%;
  transform: translate(0%,-50%);
  margin-left:-170px;
  border-radius: 0px 15px 15px 0px;
  background-color:rgba(0,0,0,0.5);
  padding:2px;
  overflow:hidden;
  box-shadow: 0 1px 4px rgba(0,0,0,0.1);
}
.sidebar li{
  opacity:0;
}
.sidebar:before{
  position:absolute;
  right:10px;
  top:50%;
  transform: translate(0%,-50%);
  color:#ffffff;
  font-size:3em;
  text-shadow: -1px -1px 0 rgba(0,0,0,0.2);
}
.sidebar:hover:before{
  opacity:0;
}
.sidebar:hover{
  margin-left:0px;
}
.sidebar:hover li{
  opacity:1;
}
.sidebar a{
  text-decoration:none;
  color:#bbb;
  line-height: 50px;
  text-shadow: -1px -1px 0 rgba(0,0,0,0.2);
  padding: 0 20px;
  display:block;
}
.sidebar a:hover{
  color:#fff;
}
.sidebar li{
  height:50px;
}
.sidebar li:hover{
  border-left: 3px solid rgba(255,0,0,0.8);
  background-color: rgba(0,0,0,0.2);
}
.sidebar li:last-child{
  border-bottom:none;
  border-radius: 0px 0px 5px 0px;
}
.sidebar li:first-child{
  border-radius: 0px 5px 0px 0px;
}
    </style>
<!-- ------------------------------------------------------------ -->
<!-- ------------------------------------------------------------ -->
<!-- ------------------------------------------------------------ -->
<style>
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}
.avatar {
    width: 120px;
	height: 120px;
    border-radius: 10%;
    border: 3px solid #888;
    margin-top: 30px;
}

/* The Modal (background) */
.modal {
	display:none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.9);
}

/* Modal Content Box */
.modal-content {
    background-color: rgba(0,0,0,0.6);
    margin: 10% auto 15% auto;
    border: 2px solid #888;
    border-radius: 10px 10px 10px 10px;
    text-align: center;
    width: 40%;
    height: auto;
}

.modal-content ul > li {
    margin-top: 20px;
    margin-bottom: 20px;
    margin-left: -10%;
    list-style-type: none;
    font-family: 'Mitr';
    font-size: 14px;
}

.modal-content ul > li > button {
    font-size: 16px;
}
.fb-input { 
	padding:6px; 
	font-size:13px; 
	border-radius:6px; 
	border: 1px solid #888;
	color:#ffffff; 
	background-color:rgba(0,0,0,0.7); 
	border-color:#bfbbbf; 
	text-shadow:0px 0px 0px rgba(42,42,42,.75);  
    text-align: center; 
    width: 40%;
} 
.label-text{
    padding:6px; 
	font-size:13px; 
	border-radius:6px; 
	text-shadow:0px 0px 0px rgba(42,42,42,.75);  
    text-align: left; 
    width: 40%;
}
.fb-input:focus { 
	outline:none; 
}

.fb-input .cbt-input {
    width: 70%;
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 10px;
    top: 0;
    color: #fff;
    font-size: 35px;
    font-weight: bold;
}
.close:hover,.close:focus {
    color: red;
    cursor: pointer;
}

/* Add Zoom Animation */
.animate {
    animation: zoom 0.6s
}
@keyframes zoom {
    from {transform: scale(0)} 
    to {transform: scale(1)}
}
</style>
</head>


<body style="font-family:'Mitr'">
<ul class="sidebar">
    <li>
        <a href="#">
            <span style="margin-right:35px;margin-left:-13px;font-size:14px;font-family:'Mitr';font-weight:bold;"><i class="fa fa-cogs" aria-hidden="true"></i>  สถานะเซิร์ฟเวอร์ :</span>
            <span style="float: right;margin-right:-10px;font-family:'Mitr';font-weight:bold;" id="status"> Loadding..</span>
        </a>
    </li>
    <li>
        <a href="#">
            <span style="margin-right:35px;margin-left:-13px;font-size:14px;font-family:'Mitr';font-weight:bold;"><i class="fa fa-line-chart" aria-hidden="true"></i>  คนออนไลน์ :</span>
            <span style="float: right;margin-right:-10px;font-family:'Mitr';font-weight:bold;" id="Online">Loadding..</span>
        </a>
    </li>
    <li>
        <a href="#">
            <span style="margin-right:35px;margin-left:-13px;font-size:14px;font-family:'Mitr';font-weight:bold;"><i class="fa fa-address-card" aria-hidden="true"></i>  ไอดีทั้งหมด :</span>
            <span style="float: right;margin-right:-10px;font-family:'Mitr';font-weight:bold;" id="Accounts">Loadding..</span>
        </a>
    </li>
    <li>
        <a href="#">
            <span style="margin-right:35px;margin-left:-13px;font-size:14px;font-family:'Mitr';font-weight:bold;"><i class="fa fa-users" aria-hidden="true"></i>  ตัวละครทั้งหมด :</span>
            <span style="float: right;margin-right:-10px;font-family:'Mitr';font-weight:bold;" id="Character">Loadding..</span>
        </a>
    </li>
</ul>
<!-- Preloader -->
<div class="page-preloader preloader-wrapp">
    <img src="assets/images/shooter/logo.png" alt="">
    <div class="preloader"></div>
</div>
<!-- /Preloader -->

<?PHP
if (isset($_GET['do'])) {
    if ($_GET['do'] == "logout_fb") {
        include_once dirname(__FILE__) . '/logout_fb.php';
    }
}
?>


 <!-- Navbar -->
<nav class="navbar-youplay navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="off-canvas" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">
                <img src="assets/images/shooter/logo-nav.png" alt="">
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                 <li>
                    <a href="#">
                        เกี่ยวกับไอเทม
                        <span class="label">Items Detail</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        รายชื่อที่ถูกแบน
                        <span class="label">List For Banned</span>
                    </a>
                </li>
                <li>
                     <a href="#">
                        ดูรูปรีพอร์ต
                        <span class="label">Reports Picture</span>
                    </a>
                </li>
                <li>
                     <a href="?cmd=ranking">
                        การจัดอันดับ
                        <span class="label">Rankings</span>
                    </a>
                </li>                                
                <li>
                     <a href="#Download">
                        ดาวน์โหลด
                        <span class="label">Download Game</span>
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <?php
                if(isset($_SESSION['username'])){
                    $data = GetUserData($_SESSION['customerid']);
                    if($data["AccountStatus"] == 100) {
                        $type = "ใช้งานได้ปกติ";                        
                    } else {
                        $type = "ระงับการใช้งาน";
                    }

                    if($data["IsDeveloper"] == 125 || 126) {
                        $isDev = "Developer";
                    } else {
                        $isDev = "Member";
                    }
            ?>
                <li class="dropdown dropdown-hover">
                    <a href="user-activity.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <?php echo $_SESSION['username']; ?>
                        <span class="badge bg-default"></span>
                        <span class="caret"></span>
                        <span class="label"><?php echo $isDev." | ".$type; ?></span>
                    </a>
                    <div class="dropdown-menu">
                        <ul role="menu">               
                            <li>
                                <a href="?cmd=manager">
                                    จัดการไอดี   
                                </a>
                            </li>
                            <li>
                                <a href="?cmd=changepass">
                                    เปลี่ยนรหัสผ่าน
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="?cmd=logout">
                                    ออกจากระบบ
                                </a>
                            </li>
                        </ul>            
                    </div>
                </li>
                <li class="dropdown dropdown-hover">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="fa fa-money"></i>
                            Point
                            <span class="label">Your Points</span>
                    </a>
                    <div class="dropdown-menu">
                        <div style="font-size: 5px;float:left;margin-left:22px;">
                            <label style="font-size: 3px; color: #efca10;">Game Points :</label>
                            <a><?php echo $data["GamePoints"]; ?></a><br>

                            <label style="font-size: 3px; color: #318ec4;">Dollars :</label>                            
                            <a><?php echo $data["GameDollars"]; ?></a><br>

                            <label style="font-size: 3px; color: #a4f4b6;">Web Points :</label>
                            <a><?php echo $data["WebPoints"]; ?></a><br><br>
                        </div>
                        <center>
                            <a href="#" class="btn btn-default btn-sm" style="margin-top: 0px;padding: 10px 40px;">เติมเงิน</a>
                        </center>
                    </div>
                </li>
            <?php } else { ?>
                <li class="dropdown dropdown-hover dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">
                        Register | Login <i class="fa fa-user"></i>
                        <span class="caret"></span>
                        <span class="label">สมัครสมาชิก | เข้าสู่ระบบ</span>
                    </a>
                    <div class="dropdown-menu">
                        <form class="navbar-login-form">
                            <p>E-Mail</p>
                            <div class="youplay-input">
                                <input type="text" id="accountname" placeholder="กรอกอีเมล">
                            </div>

                            <p>Password</p>
                            <div class="youplay-input">
                                <input type="password" id="password" placeholder="กรอกรหัสผ่าน">
                            </div>

                            <div class="youplay-checkbox mb-15 ml-5">
                                <input type="checkbox" name="rememberme" value="forever" id="nav-rememberme">
                                <label for="nav-rememberme" style="font-size: 12px;">จดจำการเข้าสู่ระบบ</label>
                                <a class="no-fade" style="float: right; font-size: 12px;" href="#">ลืมรหัสผ่าน?</a>
                            </div>
                            <center>
                                <button style="padding: 15px 100px;font-size: 25px;" class="btn btn-sm ml-0 mr-0" id="submit-login" onclick="return false">
                                    เข้าสู่ระบบ
                                </button>
                            </center>
                            <br>
                            <div align="center">
                                <fb:login-button 
                                    scope="public_profile,email"
                                    onlogin="checkLoginState();">
                                </fb:login-button>
                            </div>
                        </form>
                    </div>
                </li>
            <?php }; ?> 
            </ul>
        </div>
    </div>
</nav>
<!-- /Navbar -->

<div class="content-wrap">
        
            <!--
    Banner

    Additional classes:
        .small
        .xsmall
        .big
        .full
-->
<section class="youplay-banner banner-top big">
    
        <div class="image">
            <img src="assets/images/shooter/banner-bg.jpg" alt="">
        </div>
    

    <div class="info">
        <div>
            <div class="container">
 
                <div class="text-center">
                    <h2>K-NightZ</h2>
                        
                    <a class="btn btn-md video-popup" href="https://www.youtube.com/watch?v=-Fjx8U4pq1E"><i class="fa fa-play-circle"></i>&nbsp; ชมตัวอย่าง</a>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- /Banner -->

        

        
    <!-- Links with Images -->
    <div class="container mt-60">

        <!--
            Carousel

            Additional classes:
                .youplay-carousel-size-1
                .youplay-carousel-size-2
                .youplay-carousel-size-3
                .youplay-carousel-size-4
                .youplay-carousel-size-5
                .youplay-carousel-size-6

            Additional attributes:
                data-autoplay
                data-loop
                data-dots
                data-arrows
                data-stage-padding
                data-item-padding
        -->
        <div class="youplay-carousel" data-stage-padding="0" data-item-padding="15" data-autoplay="8000" data-loop="false">
            <a class="angled-img" href="index.php#preorder">
                <div class="img">
                    <img src="assets/images/shooter/game-cos-1-500x375.jpg" alt="">
                </div>
                <div class="bottom-info">
                    <h4>Preorder Today</h4>
                    <div>We will send you Early Edition of Call of Shooter.</div>
                </div>
            </a>
            <a class="angled-img" href="blog.html">
                <div class="img">
                    <img src="assets/images/shooter/game-cos-6-500x375.jpg" alt="">
                </div>
                <div class="bottom-info">
                    <h4>Our News</h4>
                    <div>Get news from the source, and you don't miss anything important.</div>
                </div>
            </a>
            <a class="angled-img" href="forums.html">
                <div class="img">
                    <img src="assets/images/shooter/game-cos-3-500x375.jpg" alt="">
                </div>
                <div class="bottom-info">
                    <h4>Join Community</h4>
                    <div>Be the part of huge gaming community.</div>
                </div>
            </a>
            <a class="angled-img" href="https://twitter.com/nkdevv" target="_blank">
                <div class="img">
                    <img src="assets/images/shooter/game-cos-4-500x375.jpg" alt="">
                </div>
                <div class="bottom-info">
                    <h4>Follow on Twitter</h4>
                    <div>We love and use this social network for smart people.</div>
                </div>
            </a>
        </div>
    </div>
    <!-- /Links with Images -->


    <!-- Realistic Battles -->
    <section class="youplay-banner big mt-40">
        <div class="image" data-speed="0.4">
            <img class="jarallax-img" src="assets/images/shooter/game-cos-2-1920x1200.jpg" alt="">
        </div>

        <div class="info">
            <div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <h2 class="fs-40">Realistic Battles</h2>
                            <p class="lead">Eleifend sem ipsum conubia euismod potenti ante ad sem sed, dictumst hymenaeos torquent quis. Class leo. Odio orci velit nulla habitasse conubia tempor eleifend dui suscipit mauris eget mollis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /Realistic Battles -->


    <!-- The True Emotions -->
    <section class="container mt-120">
        <div class="row">
            <div class="col-xs-12">
                <img src="assets/images/BG2.jpg" alt="">
                <h2 class="fs-40">The True Emotions</h2>
                <p class="lead">Vivamus maecenas, praesent. Sociosqu laoreet risus purus. Sed mus vivamus. Pede metus rutrum dui Aliquet ac auctor nulla montes Donec fermentum penatibus feugiat elementum interdum Consequat ipsum turpis proin taciti cursus senectus urna ultrices orci dui id vitae massa hendrerit consectetuer lectus augue inceptos viverra erat. Vitae nostra fames neque.</p>
            </div>
        </div>
    </section>
    <!-- /The True Emotions -->


    <!-- Preorder -->
    <section class="youplay-banner big mt-120" id="Download">
        <div class="image" data-speed="0.4">
            <img class="jarallax-img" src="assets/images/BG1.jpg" alt="">
        </div>

        <div class="info container align-center">
            <div>
                <div class="glitch" data-text="K-NightZ">K-NightZ</div> 
                <!--<h1 class="fs-60">K-NightZ</h1>-->
                <h5 class="fs-15">ร่วมมาทดสอบเซิพเวอร์ด้วยกันได้ในวันที่ 17 ตุลาคม 2561 เวลา 8:00 น. เป็นต้นไป</h5>
                <a class="btn btn-lg" href="<?php echo $launcher['link']; ?>"><i class="fa fa-download"></i>&nbsp; โหลดตัวเต็ม
                    <br><label class="label" style="font-size: 9px;"><?php echo $launcher['name']; ?></label>
                </a>
                <a class="btn btn-lg" href="<?php echo $fullclient['link']; ?>"><i class="fa fa-download"></i>&nbsp; โหลดตัวทับ
                    <br><label class="label" style="font-size: 9px;"><?php echo $fullclient['name']; ?></label>
                </a>
            </div>
            <!-- INFO -->
            <div class="requirements-block" style="background-color: rgba(0, 0, 0, 0.4);width:35%;left: 0;right: 0;float:center;margin-top:12px;margin-left: auto;margin-right: auto;padding:3px 12px 12px 12px;">
                <h3>ความต้องการของระบบ</h3>
                <div class="panel-group youplay-accordion" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="collapsed">
                                    Minimum <span class="icon-plus"></span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body" style="">
                                <div>
                                    <strong>OS:</strong> Windows 7 SP1 64bit, Windows 8.1 64bit
                                </div>
                                <div>
                                    <strong>Processor:</strong> AMD® A8 3870 3,6 Ghz or Intel® Core ™ i3 2100 3.1Ghz
                                </div>
                                <div>
                                    <strong>Memory:</strong> 4 GB RAM
                                </div>
                                <div>
                                    <strong>Graphics:</strong> NVIDIA® GeForce GTX 465 / ATI Radeon TM HD 6870
                                </div>
                                <div>
                                    <strong>DirectX:</strong> Version 11
                                </div>
                                <div>
                                    <strong>Network:</strong> Broadband Internet connection
                                </div>
                                <div>
                                    <strong>Hard Drive:</strong> 23 GB available space
                                </div>
                                <div>
                                    <strong>Sound Card:</strong> DirectX 11 sound device
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Recommended <span class="icon-plus"></span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body">
                                <div>
                                    <strong>OS:</strong> Windows 7 SP1 64bit, Windows 8.1 64bit
                                </div>
                                <div>
                                    <strong>Processor:</strong> AMD® FX 8150 3.6 GHz or Intel® Core™ i7 2600 3.4 GHz
                                </div>
                                <div>
                                    <strong>Memory:</strong> 8 GB RAM
                                </div>
                                <div>
                                    <strong>Graphics:</strong> NVIDIA® GeForce® GTX 750, ATI Radeon™ HD 7850
                                </div>
                                <div>
                                    <strong>DirectX:</strong> Version 11
                                </div>
                                <div>
                                    <strong>Network:</strong> Broadband Internet connection
                                </div>
                                <div>
                                    <strong>Hard Drive:</strong> 23 GB available space
                                </div>
                                <div>
                                    <strong>Sound Card:</strong> DirectX 11 sound device
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- INFO -->
        </div>
        
    </section>
    <!-- /Preorder -->

        
<!-- Footer -->
<footer class="youplay-footer">
    <div class="wrapper">
            <!-- Widgets -->
            <div class="widgets">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="side-block">
                                <div class="block-content">
                                    <img src="assets/images/shooter/logo.png" alt="">
                                    <br><br>
                                    <p>
                                        Pretium placerat senectus cubilia purus. In curae; sem morbi odio, platea magna. Fames integer accumsan. Pellentesque proin fermentum et consequat.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- Side Popular News -->
                            <div class="side-block">
                                <h4 class="block-title">Popular News</h4>
                                <div class="block-content p-0">
                                    <!-- Single News Block -->
                                    <div class="row youplay-side-news">
                                        <div class="col-xs-3 col-md-4">
                                            <a href="#" class="angled-img">
                                                <div class="img">
                                                    <img src="assets/images/shooter/game-cos-1-500x375.jpg" alt="">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xs-9 col-md-8">
                                            <h4 class="ellipsis"><a href="#" title="Bloodborne - First Try!">Ready for Preorder - Call of Shooter</a></h4>
                                            <span class="date"><i class="fa fa-calendar"></i> May 14, 2017</span>
                                        </div>
                                    </div>
                                    <!-- /Single News Block -->

                                    <!-- Single News Block -->
                                    <div class="row youplay-side-news">
                                        <div class="col-xs-3 col-md-4">
                                            <a href="#" class="angled-img">
                                                <div class="img">
                                                    <img src="assets/images/shooter/game-cos-2-500x375.jpg" alt="">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xs-9 col-md-8">
                                            <h4 class="ellipsis"><a href="#" title="Whats New in Middle-earth">Closed Beta Started Today - Call of Shooter</a></h4>
                                            <span class="date"><i class="fa fa-calendar"></i> April 24, 2017</span>
                                        </div>
                                    </div>
                                    <!-- /Single News Block -->

                                    <!-- Single News Block -->
                                    <div class="row youplay-side-news">
                                        <div class="col-xs-3 col-md-4">
                                            <a href="#" class="angled-img">
                                                <div class="img">
                                                    <img src="assets/images/shooter/game-cos-3-500x375.jpg" alt="">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xs-9 col-md-8">
                                            <h4 class="ellipsis"><a href="#" title="Let's Grind Diablo III">We are in Facebook Now!</a></h4>
                                            <span class="date"><i class="fa fa-calendar"></i> April 5, 2017</span>
                                        </div>
                                    </div>
                                    <!-- /Single News Block -->
                                </div>
                            </div>
                            <!-- /Side Popular News -->
                        </div>
                        <div class="col-md-3">
                            <!-- Our Twitter -->
                            <div class="side-block">
                                <h4 class="block-title">Our Twitter</h4>
                                <div class="block-content">
                                    <div class="youplay-twitter" data-twitter-user-name="nkdevv" data-twitter-count="2" data-twitter-hide-replies="false"></div>
                                </div>
                            </div>
                            <!-- /Our Twitter -->
                        </div>
                        <div class="col-md-3">
                            <!-- Instagram -->
                            <div class="side-block">
                                <h4 class="block-title">Instagram</h4>
                                <div class="youplay-instagram row small-gap" data-instagram-user-id="2133360819"
                                ></div>
                            </div>
                            <!-- /Instagram -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Widgets -->

            <!-- Copyright -->
            <div class="copyright">
                <div class="container">
                    <p>2018 &copy; <strong>K-NightZ</strong>. All rights reserved</p>
                </div>
            </div>
            <!-- /Copyright -->
    </div>
</footer>
<!-- /Footer -->
    
<!-- START: Scripts -->
<script src="storage/js/process1.js"></script>

<!-- Object Fit Polyfill -->
<script src="assets/vendor/object-fit-images/dist/ofi.min.js"></script>

<!-- jQuery -->
<script src="storage/js/jquery-2.1.1.min.js"></script>
<script src="assets/vendor/jquery/dist/jquery.min.js"></script>

<!-- Hexagon Progress -->
<script src="assets/vendor/HexagonProgress/jquery.hexagonprogress.min.js"></script>

<!-- Bootstrap -->
<script src="assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Jarallax -->
<script src="assets/vendor/jarallax/dist/jarallax.min.js"></script>

<!-- Flickity -->
<script src="assets/vendor/flickity/dist/flickity.pkgd.min.js"></script>

<!-- jQuery Countdown -->
<script src="assets/vendor/jquery-countdown/dist/jquery.countdown.min.js"></script>

<!-- Moment.js -->
<script src="assets/vendor/moment/min/moment.min.js"></script>
<script src="assets/vendor/moment-timezone/builds/moment-timezone-with-data.min.js"></script>

<!-- Magnific Popup -->
<script src="assets/vendor/magnific-popup/dist/jquery.magnific-popup.min.js"></script>

<!-- Revolution Slider -->
<script src="assets/vendor/slider-revolution/js/jquery.themepunch.tools.min.js"></script>
<script src="assets/vendor/slider-revolution/js/jquery.themepunch.revolution.min.js"></script>

<!-- ImagesLoaded -->
<script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>

<!-- Isotope -->
<script src="assets/vendor/isotope-layout/dist/isotope.pkgd.min.js"></script>

<!-- Bootstrap Validator -->
<script src="assets/vendor/bootstrap-validator/dist/validator.min.js"></script>

<!-- Bootstrap Sweetalert -->
<script src="assets/vendor/bootstrap-sweetalert/dist/sweetalert.min.js"></script>

<!-- Social Likes -->
<script src="assets/vendor/social-likes/dist/social-likes.min.js"></script>

<!-- Youplay -->
<script src="assets/js/youplay.min.js"></script>
<script src="assets/js/youplay-init.js"></script>

<!-- POPUP FB-REGISTER -->
<div id="modal-wrapper" class="modal">
    <div class="modal-content animate"> 
        <form>
            <span onclick="document.getElementById('modal-wrapper').style.display='none'" class="close" title="Close PopUp">&times;</span>
            <img src="storage/images/avatar.png" id="fb_img" alt="Avatar" class="avatar">
            <ul>
                <li>
                    <input class="fb-input" style="margin-left:2%;" type="text"  id="fb_name" readonly>
                    <input class="fb-input" style="margin-right:2%;" type="text"  id="fb_email" readonly>
                </li>
                <li>
                    <input class="fb-input" style="margin-left:2%;" type="password" placeholder="กรอกรหัสผ่าน" id="pass">
                    <input class="fb-input" style="margin-right:2%;" type="password" placeholder="กรอกรหัสผ่าน อีกครั้ง" id="re-pass">
                </li>
                <li>
                    <input class="fb-input" style="width:82%;" type="text" placeholder="อีเมลที่ใช้เล่นเกมส์ในช่วง Close Beta (สามารถเว้นว่างได้)" id="cbt_email">
                </li>
                <li>
                    <button class="btn btn-sm ml-0 mr-0" style="width:82%;" type="submit" id="fb-submit" onclick="return false">ยืนยันการสมัครไอดีเกมส์</button>
                </li>
            </ul>  
        </form>
    </div>
</div>

<script>

    var bFbStatus = false;
    var fbID = "";
    var fbName = "";
    var fbEmail = "";
    var img_link  = ""; 
    var fb_link =  "";   

    window.fbAsyncInit = function() {
        FB.init({
            appId      : '586964165054161',
            cookie     : true,
            xfbml      : true,
            version    : 'v3.1'
        });
        FB.AppEvents.logPageView();   
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));


    function statusChangeCallback(response) {
		if(bFbStatus == false) {
			fbID = response.authResponse.userID;
			if (response.status == 'connected') {
				getCurrentUserInfo(response)
			} else {
				FB.login(function(response) {
				    if (response.authResponse){
					    getCurrentUserInfo(response)
				    } else {
					    console.log('Auth cancelled.')
				    }
				}, { scope: 'email' });
			}
		}
		bFbStatus = true;
    }

    function getCurrentUserInfo() {
        FB.api('/me?fields=name,email', function(userInfo) {
            img_link = "http://graph.facebook.com/" + fbID + "/picture?type=large";
            fb_link =  "https://www.facebook.com/app_scoped_user_id/" + fbID + "/";
            var x = document.getElementById("fb_img");
	        fbName = userInfo.name;
            fbEmail = userInfo.email;

            $.ajax({
                type: "POST",
                url: "storage/php/process.php",
                data: { accountname : fbEmail, cmd : 'login'},
                success: function(res){
                    var arr = res.split('#');
                    if (re(arr[1])=='FBNEWREGIS:TRUE') {
                        x.setAttribute("src", img_link);
                        $( "input#fb_name" ).val(fbName);
                        $( "input#fb_email" ).val(fbEmail);
                        document.getElementById("modal-wrapper").style.display="block";
                    } else if (re(arr[1])=='FBNEWREGIS:FALSE') {
                        sweet("ยินดีต้อนรับคุณ [ " + fbName + " ] เข้าสู่ระบบ",true);
                        setTimeout(function(){
                            location.reload();
                        }, 2000);
                    } else {
                        sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้",false);
                    }	
                }
            }); 
        });
    }

    $("#fb-submit").click(function () {
        var pass = $("#pass").val();
        var repass = $("#re-pass").val();
        var cbtemail = $("#cbt_email").val(); 

        if(pass == "" || repass == "") {
		    sweet("กรุณากรอกข้อมูลให้ครบถ้วน",false);
		    return false;
	    } else if(pass != repass) {
		    sweet("กรุณากรอกรหัสผ่านทั้ง 2 ช่องให้ตรงกัน",false);
		    return false;
	    } else if(pass.length < 6) {
            sweet("ความยาวรหัสผ่านควรมีอย่างน้อย 6 ตัวอักษร",false);
		    return false;
        }

        $.ajax({
			type: "POST",
			url: "storage/php/process.php",
            data: { fbemail : fbEmail, fbid : fbID, fbname : fbname, fblink : fb_link, fbpic : img_link, pass : pass, cbtemail : cbtemail, cmd : 'register'},
			success: function(res){
				if(re(res)=='REGISTER:TRUE')
				{
					sweet("สมัครเสร็จสมบูรณ์ ขอให้เล่นเกมส์อย่างสนุกนะคะ",true);
				}
				else if(re(res)=='REGISTER:ALREADYUSE')
				{
					sweet("มีชื่อผู้ใช้นี้อยู่ในระบบแล้ว กรุณาใช้ชื่ออื่น",false);
				}
				else if (re(res)=='REGISTER:CHARVALID')
				{
					sweet("ไม่อนุญาตให้ใส่สัญลักษณ์พิเศษ",false);	
                }	
                else if (re(res)=='REGISTER:FALSE')
				{
					sweet("เกิดปัญหาไม่สามารถส่งข้อมูลไปยังดาต้าเบสได้, กรุณาแจ้งแอดมิน",false);	
				}			
				else
				{
					sweet("พบข้อผิดพลาดระบบไม่สามารถทำงานได้...",false);
				}
			}
		}); 
    })

    function checkLoginState() {
        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });
    }

    //------------------- [ POPUP fb-regis ] -----------------------//
    var modal = document.getElementById('modal-wrapper');
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
    //------------------- [ POPUP fb-regis ] -----------------------//
    
</script>


    
</body>
</html>