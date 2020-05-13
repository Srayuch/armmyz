<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

include('storage/php/functions.php');
if(isset($_GET['logout'])){
	session_destroy();
	header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="WARZ, WARZ เถื่อน, วอร์ซี, Infes, Infestation, กันโปร warz, โปร warz, โปรแกรมช่วยเล่น">
    <meta name="keywords" content="WARZ, WARZ เถื่อน, วอร์ซี, Infes, Infestation, กันโปร warz, โปร warz, โปรแกรมช่วยเล่น">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title><?php echo(isset($_SESSION['username'])?$_SESSION['username']:'Login ').' WarZ | By WebShopping'?></title>
	<link rel="shortcut icon" href="storage/images/icon.ico" />

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="WARZTH.NET">

    <!-- GOOGLE FONTS -->
    <link href='//fonts.googleapis.com/css?family=Raleway:700,400,400italic,500' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Lato:400,400italic,700,300,300italic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Mitr:300&subset=thai' rel='stylesheet' type='text/css'>

    <!-- CORE CSS -->
    <link href="storage/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="storage/css/elegant-icons.css" rel="stylesheet" type="text/css">
    <link href="storage/css/sweetalert2.css" rel="stylesheet" type="text/css">
    <link href="storage/css/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css">
    <!-- THEME CSS -->
    <link href="storage/css/dataTables.bootstrap.min.css" type="text/css" rel="stylesheet" >
    <link href="storage/css/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" >
    <link href="storage/css/font-awesome.min.css" type="text/css" rel="stylesheet" >
	<link href="storage/css/custom.css" type="text/css" rel="stylesheet" >
	<link href="storage/css/main.css" type="text/css" rel="stylesheet" >
	
	<!-- REPORTS CSS -->
	<link href="storage/css/reports.css" type="text/css" rel="stylesheet"   />
	<link rel="stylesheet" type="text/css" href="storage/colorbox/colorbox.css" />
	
<style type="text/css">
		
div.nav-logo {
	width: auto;
	height: 50px;
	margin: 15px 0px 0px 0px;
	float: left;
}
div.mini-info {
	float: left;
	width: auto;
	height: 50px;
	margin: 20px 0px 0px 0px;
}
div.mini-info ul {
	padding: 0px 0px 0px 0px;
	font-size: 11px;
	font-weight: bold;
	color: #FFFFFF;
	text-align: center;
}
img.img-charrentpro {
	border-radius: 10px 10px 10px 10px;
	-moz-border-radius: 10px 10px 10px 10px;
	-webkit-border-radius: 10px 10px 10px 10px;
	display: block;
	max-width: 550px;
	height: 400px;
}
		
	</style>
	
</head>

<body>
<!-- WRAPPER -->
<div id="wrapper">
<?php
	if(isset($_SESSION['username'])){
		$data = GetUserData($_SESSION['customerid']);
	echo ';
		<!-- NAVBAR -->
		<span id="lc" style="font-weight:bold; font-size:11px;">'.lc().'</span>
		<nav class="navbar navbar-default navbar-fixed-top navbar-light-font ignore-paddingtop">
			<div class="container">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
						data-target="#main-nav-collapse">
					<span class="sr-only">Toggle Navigation</span>
					<i class="fa fa-bars"></i>
				</button>
				<div class="mini-info">
					<ul>'.$_SESSION['username'].' ( '.$_SESSION['customerid'].' ) <br> GC : '.$data["GamePoints"].' &nbsp;&nbsp;DL : '.$data["GameDollars"].' &nbsp;&nbsp;WP : '.$data["WebPoints"].'</ul>
				</div>
				<div id="main-nav-collapse" class="collapse navbar-collapse">		
					<ul class="nav navbar-nav main-navbar-nav Mitr">
						'.GetMenu(true).'
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-gears"></i> จัดการบัญชี
								<span class="caret"></span>
							</a>	
							<ul class="dropdown-menu">
								<li><a href="/">เปลี่ยนรหัสผ่าน</a></li>
								<li><a href="?menu=charname_change">เปลี่ยนชื่อตัวละคร</a></li>
							</ul>						
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-credit-card"></i> เติมเงิน / ซื้อไอเทม
								<span class="caret"></span>
							</a>	
							<ul class="dropdown-menu">
								<li><a href="?menu=refill">เติมเงินด้วย True Money</a></li>
								<!-- <li><a href="?menu=refill_wallet">เติมเงินด้วย True Wallet</a></li> -->
								<li><a href="?menu=item">ซื้อไอเทมแรร์</a></li>
								<li><a href="?menu=char_rent">เช่าตัวละคร</a></li>
								<li><a href="?menu=star_rent">เช่าดาวหน้าชื่อ</a></li>
							</ul>						
						</li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-credit-card"></i> แลกไอเทม
								<span class="caret"></span>
							</a>	
							<ul class="dropdown-menu">
								<li><a href="?menu=itemcode">ใช้ไอเทมโค้ด</a></li>
								<li><a href="?menu=get_gc">แลก GC Card</a></li>
								<li><a href="?menu=reward">รับไอเทมรีวอร์ด</a></li>
								<li><a href="?menu=buy_exp">แลกค่าประสบการณ์</a></li>
							</ul>						
						</li>
						<li><a href="?menu=move"><i class="fa fa-map-marker"></i> ย้ายพิกัดแมพแท้</a></li>
					</ul>
					
					<ul class="nav navbar-nav main-navbar-nav Mitr">
						<li class="login js-logins"><a href="?logout=1"><i class="fa fa-sign-out"></i> ออกจากระบบ</a></li>
					</ul>
					
				</div>
				<!-- END MAIN NAVIGATION -->
			</div>
		</nav>
		<!-- END NAVBAR -->
		';
		if(isset($_GET['menu']) && $_GET['menu']=='refill' && isset($_SESSION['username']))
		{
			echo "
				<section class='no-padding-bottom' style='margin-top: 30px;'>
					<div class='container Mitr'>      
						<div class='text-left' style='padding-top: 10px;'>
							<div class='section-header'>
								<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-credit-card'></i> เติมเงินเข้าระบบด้วยบัตรทรูมันนี่ (<u>ไม่สามารถใช้บัตรทรูมูฟ H ได้</u> )</h3>
								<div class='sub-heading'>
									หากมีปัญหาเติมเงินไม่เข้า กรุณาติดต่อทีมงานทันทีที่กลุ่มเฟซ : ".$_CONFIG['SERVER']['FBGROUP_URL']."
								</div>
								<hr>
							</div>
								<div class='col-md-12'>
									<div class='text-left' style='margin-bottom: 20px;'>
										<div class='col-md-6' style='margin-top: 30px;'>
											<img src='storage/images/truemoney.png' class='img-responsive'>
										</div>
										<div class='col-md-6'>
										<div><h3>ยอดเงินที่เติมในระบบ <span style='float: right'>".GetDonate($_SESSION['customerid']).".00 บาท</span></h3></div>
										<hr style='margin: 3px;'>
										<form>
											<div class='form-group'>
												<label for='tmn_password'>รหัสบัตรทรูมันนี่ 14 หลัก</label>
												<input type='text' class='form-control' id='tmn_password' placeholder='' pattern='[0-9]{14}' maxlength='14'><br>
												<select name='ref3' id='ref3' class='form-control'>
													<option value=''>กรุณาเลือกชนิดของ Points ที่ได้รับ</option>
													<option value='GamePoints'>GamePoints [GC]</option>
													<option value='WebPoints'>WebPoints [WP]</option>
												</select>
											</div>
											<button type='button' id='send' class='btn btn-success' onClick='".Topup_System()."'><i class='fa fa-credit-card'></i> เติมเงินเข้าระบบ</button>
											<input name='ref1' type='hidden' id='ref1' value='".$_SESSION['customerid']."' />
											<input name='ref2' type='hidden' id='ref2' value='".$_SESSION['username']."'>									  
										</form>
										</div>       
										<br clear='all'>
										<br>
										<h3><i class='fa fa-check'></i> มูลค่าบัตรเติมเงินที่ได้รับ POINTS</h3>
										<div class='table-responsive' data-example-id='striped-table'>
											<table class='table table-striped table-bordered'> 
												<thead> 
													<tr> 
														<th>บัตรทรูมันนี่</th> 
														<th>อัตราการคูณ</th>
														<th>WP ที่จะได้รับ</th>
														<th>GC ที่จะได้รับ</th>
														<th>ไอเทมที่จะได้รับจากโปรโมชั่น</th>
													</tr> 
												</thead> 
												<tbody> 
														".GenDataTableTruemoney()."                                                                            
												</tbody>
											</table> 
										</div>    
									</div>    
								</div>
								<div class='col-md-12 text-left' style='margin-top: -20px;'>
									<hr>
									<div class='bs-example' data-example-id='striped-table'>
										<table id='table_id' class='table table-striped table-bordered'>
											<thead>
												<tr>
													<th>TXID</th>
													<th>วันที่</th>
													<th>เติมเงินผ่านระบบ</th>
													<th>หมายเลขบัตร</th>
													<th>มูลค่า</th>
													<th>อัตราการ X</th>
													<th>Points ที่ได้รับ</th>
													<th>สถานะการเติมเงิน</th>
												</tr>
											</thead>
											<tbody>
												".GendataTruemoney($_SESSION['customerid'])."
											</tbody>
										</table>
									</div>
								</div>            
							</div>
						</div>    
					</div>
				</section>		
			";		
		}
		else if(isset($_GET['menu']) && $_GET['menu']=='refill_wallet' && isset($_SESSION['username']))
		{
			echo "
				<section class='no-padding-bottom' style='margin-top: 30px;'>
					<div class='container Mitr'>      
						<div class='text-left' style='padding-top: 10px;'>
							<div class='section-header'>
								<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-credit-card'></i> เติมเงินเข้าระบบด้วย *** ทรูมันนี่วอลเล็ท ***</h3>
								<div class='sub-heading'>
									หากมีปัญหาเติมเงินไม่เข้า กรุณาติดต่อทีมงานทันทีที่กลุ่มเฟซ : ".$_CONFIG['SERVER']['FBGROUP_URL']."
								</div>
								<hr>
							</div>
								<div class='col-md-12'>
									<div class='text-left' style='margin-bottom: 20px;'>
										<div class='col-md-6' style='margin-top: 30px;'>
											<img src='storage/images/truewallet.png' class='img-responsive'>
										</div>
										<div class='col-md-6'>
										<div><h3>ยอดเงินที่เติมในระบบ <span style='float: right'>".GetDonate($_SESSION['customerid']).".00 บาท</span></h3></div>
										<hr style='margin: 3px;'>
										<form>
											<div class='form-group'>
												<label for='tmn_password'>เลือกราคา Wallet ที่ต้องการเติม</label>
												<select id='wallet_amout' class='form-control'>
													<option value='50'>ต้องการเติม 50 บาท</option>
													<option value='90'>ต้องการเติม 90 บาท</option>
													<option value='150'>ต้องการเติม 150 บาท</option>
													<option value='300'>ต้องการเติม 300 บาท</option>
													<option value='500'>ต้องการเติม 500 บาท</option>
													<option value='1000'>ต้องการเติม 1000 บาท</option>
												</select>
											</div>
											<button type='button' id='wallet_open' class='btn btn-success' onClick='return false'><i class='fa fa-credit-card'></i> เติมเงินเข้าระบบ</button>
											<input type='hidden' id='userid' value='".$_SESSION['username']."'>	
											<input type='hidden' id='merchant_id' value='".$merchant_id."'>
										</form>
										</div>       
										<br clear='all'>
										<br>
										<h3><i class='fa fa-check'></i> อัตราการเติมเงินที่ได้รับ POINTS</h3>
										<div class='table-responsive' data-example-id='striped-table'>
											<table class='table table-striped table-bordered'> 
												<thead> 
													<tr> 
														<th>วอลเล็ทราคา</th> 
														<th>อัตราการคูณ</th>
														<th>GC ที่จะได้รับ</th>
														<th>ไอเทมที่จะได้รับจากโปรโมชั่น</th>
													</tr> 
												</thead> 
												<tbody> 
														".GenDataTableWallet()."                                                                            
												</tbody>
											</table> 
										</div>    
									</div>    
								</div>
								<div class='col-md-12 text-left' style='margin-top: -20px;'>
									<hr>
									<div class='bs-example' data-example-id='striped-table'>
										<table id='table_id' class='table table-striped table-bordered'>
											<thead>
												<tr>
													<th>TXID</th>
													<th>วันที่</th>
													<th>เติมเงินผ่านระบบ</th>
													<th>หมายเลขบัตร</th>
													<th>มูลค่า</th>
													<th>อัตราการ X</th>
													<th>Points ที่ได้รับ</th>
													<th>สถานะการเติมเงิน</th>
												</tr>
											</thead>
											<tbody>
												".GendataTruemoney($_SESSION['customerid'])."
											</tbody>
										</table>
									</div>
								</div>            
							</div>
						</div>    
					</div>
				</section>		
			";		
		}
		else if(isset($_GET['menu']) && $_GET['menu']=='get_gc' && isset($_SESSION['username']))
		{
			echo "
				<section class='no-padding-bottom' style='margin-top: 30px;'>
					<div class='container Mitr'>      
						<div class='text-left'>
							<div class='section-header'>
								<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-credit-card'></i> บัตรแลก GC ****</h3>
								<div class='sub-heading'>
									หากมีปัญหาในการแลก GC กรุณาติดต่อทีมงานทันทีที่กลุ่มเฟซ : ".$_CONFIG['SERVER']['FBGROUP_URL']."
								</div>
								<hr>
							</div>
								<div class='col-md-12'>
									<div class='text-left' style='margin-bottom: 0px;'>
										<div class='col-md-4' style='margin-top: 0px;'>
											<img src='storage/images/gc_card.png' class='img-responsive'>
										</div>
										<div class='col-md-8'>
										<div><h3>คุณมีบัตรแลก GC ทั้งหมด <span style='float: right'>".GetGccard($_SESSION['customerid'], $gc_cardid)." ใบ</span></h3></div>
										<hr style='margin: 3px;'>
			
										<form>
												<label for='tmn_password'>เลือกจำนวนบัตรที่ต้องการแลก</label>
												<input id='gccard' type='text' class='form-control text-center' placeholder='ระบุจำนวนบัตร'>
												<input type='hidden' id='userid' value='".$_SESSION['username']."'>	
												<br>
											<button class='btn btn-lg btn-success' id='submit-redeem' type='submit' onclick='return false'><i class='fa fa-gift'></i> แลก GC !!</button>
										</form>
										</div>       
										           
							</div>
						</div>    
					</div>
				</section>		
			";		
		}
		else if(isset($_GET['menu']) && $_GET['menu']=='buy_exp' && isset($_SESSION['username']))
		{
			$data = GetUserData($_SESSION['customerid']);
			echo "
				<section class='no-padding-bottom' style='margin-top: 30px;'>
					<div class='container Mitr'>      
						<div class='text-left' style='padding-top: 10px;'>
							<div class='section-header'>
								<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-diamond'></i> แลกแต้มสกิล</h3>
								<div class='sub-heading'>
									แลกแต้มสกิล แล้วเป็นเทพก่อนใคร ได้ที่นี่ <br>
								</div>
								<hr>
								<div class='col-md-6'>
									<h4>ซื้อแต้มสกิล [EXP]</h4>
										<div class='sub-heading'>อัตราการแลกแต้มสกิล 1 WP = ".$exp_wp." EXP <br> </div>
									<hr>
									<form> 
										<div class='form-group'>
											<label for='trueamount'>เลือกตัวละครที่ต้องการแลกแต้มสกิล</label>
											".GetCharNameexp()."
										</div>								
										<div class='form-group'>
											<label for='itemid'>กรอกจำนวน WP ที่ต้องการแลกแต้มสกิล</label>
											<input type='text' class='form-control' id='wpforexp' placeholder='กรอกจำนวน WP'>
										</div>									                                     
										<button type='submit' class='btn btn-success' id='submit-changeexp' onclick='return false'><i class='fa fa-edit'></i> แลกแต้มสกิล</button>
									</form>
									<hr>
								</div>
							</div>						
						</div>    
					</div>
				</section>		
			";		
		}
		else if(isset($_GET['menu']) && $_GET['menu']=='char_rent' && isset($_SESSION['username']))
		{
			$data = GetUserData($_SESSION['customerid']);
			echo "
				<section class='no-padding-bottom' style='margin-top: 30px;'>
					<div class='container Mitr'>      
						<div class='text-left' style='padding-top: 10px;'>
							<div class='section-header'>
								<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-diamond'></i> เช่าตัวละคร</h3>
								<div class='sub-heading'>
									สามารถเช่าตัวละคร เพิ่มความสามารถได้ที่นี่!<br>
								</div>
								<hr>
								<div class='col-md-6'>
									<form> 
										<div class='form-group'>
											<label for='trueamount'>กรุณาเลือกตัวละครที่ต้องการเช่า</label>
											".GetCharforRent()."
										</div>								
										<div class='form-group'>
											<label for='itemid'>กรุณาเลือกวันที่ต้องการเช่า</label>
											".GetCharRentPrice('Char')."
										</div>									                                     
										<button type='submit' class='btn btn-success' id='submit-charrent' onclick='return false'><i class='fa fa-edit'></i> ยืนยันเช่าตัวละคร</button>
									</form>
									<hr>
								</div>
								<div class='col-md-6'>
									<center>
										<img src='storage/images/Pro_Charrent.png' class='img-charrentpro'>
									</center>
								</div>
							</div>						
						</div>    
					</div>
				</section>		
			";		
		}
		else if(isset($_GET['menu']) && $_GET['menu']=='star_rent' && isset($_SESSION['username']))
		{
			$data = GetUserData($_SESSION['customerid']);
			echo "
				<section class='no-padding-bottom' style='margin-top: 30px;'>
					<div class='container Mitr'>      
						<div class='text-left' style='padding-top: 10px;'>
							<div class='section-header'>
								<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-diamond'></i> เช่าดาวหน้าชื่อ</h3>
								<div class='sub-heading'>
									สามารถเช่าดาวหน้าชื่อ เพิ่มความสามารถได้ที่นี่!<br>
								</div>
								<hr>
								<div class='col-md-6'>
									<form> 								
										<div class='form-group'>
											<label for='itemid'>กรุณาเลือกวันที่ต้องการเช่า</label>
											".GetCharRentPrice('Star')."
										</div>									                                     
										<button type='submit' class='btn btn-success' id='submit-starrent' onclick='return false'><i class='fa fa-edit'></i> ยืนยันเช่าดาวหน้าชื่อ</button>
									</form>
									<hr>
								</div>
								<div class='col-md-6'>
									<center>
										<img src='storage/images/Pro_Starrent.png' class='img-charrentpro'>
									</center>
								</div>
							</div>						
						</div>    
					</div>
				</section>		
			";		
		}
		else if(isset($_GET['menu']) && $_GET['menu']=='charname_change' && isset($_SESSION['username']))
		{
			$data = GetUserData($_SESSION['customerid']);
			echo "
				<section class='no-padding-bottom' style='margin-top: 30px;'>
					<div class='container Mitr'>      
						<div class='text-left' style='padding-top: 10px;'>
							<div class='section-header'>
								<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-diamond'></i> เปลี่ยนชื่อตัวละคร</h3>
								<div class='sub-heading'>
									คุณสามารถเปลี่ยนชื่อตัวละครเป็นภาษาไทยและมีอักษรพิเศษ ได้ที่นี่ <br>
								</div>
								<hr>
								".GetCharName()."  
							</div>	
						</div>
					</div>
				</section>		
			";		
		}
		else if(isset($_GET['menu']) && $_GET['menu']=='reward' && isset($_SESSION['username']))
		{
			echo "
				<section class='no-padding-bottom' style='margin-top: 30px;'>
					<div class='container Mitr'>      
						<div class='text-left' style='padding-top: 10px;'>
							<div class='section-header'>
								<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-diamond'></i> ไอเทมรีวอร์ด</h3>
								<div class='sub-heading'>
									รับไอเทมรีวอร์ด...
								</div>
								<hr>
							</div>
							<hr>
							<div class='row'>
								<div class='col-md-12 text-left' style='margin-top: -20px;'>
									<div class='bs-example' data-example-id='striped-table'>
										<table id='table-addreward' class='table table-striped table-bordered'>
											<thead>
												<tr>
													<th>ยอดสะสม</th>
													<th>ชื่อไอเทม</th>
													<th>จำนวนไอเทม</th>
													<th>จัดการ</th>
												</tr>
											</thead>
											<tbody>
												".GenDataTableRewardMe($_SESSION['username'])."
											</tbody>
										</table>
									</div>
								</div> 
							</div>						
						</div>    
					</div>
				</section>		
			";		
		}
		else if(isset($_GET['menu']) && $_GET['menu']=='item' && isset($_SESSION['username']))
		{
			$data = GetUserData($_SESSION['customerid']);
			echo "
				<section class='no-padding-bottom' style='margin-top: 30px;'>
					<div class='container Mitr'>      
						<div class='text-left' style='padding-top: 10px;'>
							<div class='section-header'>
								<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-diamond'></i> ซื้อไอเทมแรร์</h3>
								<div class='sub-heading'>
									RARE ITEM : ไอเทมแรร์เพิ่มความสามารถพิเศษ <br>
								</div>
								<hr>
								".spc_itemsell()."
							</div>						
						</div>    
					</div>
				</section>		
			";		
		}
		else if(isset($_GET['menu']) && $_GET['menu']=='itemcode' && isset($_SESSION['username']))
		{
			echo "
				<section class='no-padding-bottom' style='margin-top: 30px;'>
					<div class='container Mitr'>
						<div class='text-left' style='padding-top: 10px;'>
							<div class='section-header'>
								<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-random'></i> แลกรหัสไอเทม ( ItemCode )</h3>
								<div class='sub-heading'>
									ระบบแลกรหัส ItemCode ใช้สำหรับรับ Item..
								</div>
								<hr>
							</div>
							<div class='row'>
								<div class='col-md-6'>
									<div class='text-center' style='margin-bottom: 90px;'>
										<div id='random'><center><img src='storage/images/box.png' class='img-responsive'></center></div>
										<div id='getItem' style='display: none'>
											<center><img id='itemImg' src='' class='img-responsive'></center>
											คุณได้รับ <span id='itemName' style='font-weight: bold'></span> !!
										</div>
									</div>
								</div>
								<div class='col-md-6'>
									<div class='text-center' style='margin-bottom: 90px; font-family: Kanit'>
										<h3><i class='fa fa-gift'></i> รหัส ItemCode ที่คุณมี !</h3>
										<input id='itemcodekey' type='text' class='form-control input-lg text-center' placeholder='รหัส ItemCode ..'>
										<input id='userencrypt' type='hidden' value='".$_SESSION['encodename']."' class='form-control'>
										<br>
										<button class='btn btn-lg btn-danger' id='submit-senditemcode' type='submit' onclick='return false'><i class='fa fa-gift'></i> รับไอเทม !!</button>
										<br>
										<br>
										** รหัส ItemCode **<br>สามารถใช้งานได้ 1 ครั้งต่อ 1 ID เท่านั้น !!
									</div>        
								</div>
								<div class='col-md-12'>
									<hr>
									<div class='table-responsive' data-example-id='striped-table'>
										<table id='table-itemcode' class='table table-striped table-bordered'> 
										<thead> 
											<tr>
												<th>ItemCode</th> 
												<th>ItemType</th> 
												<th>ItemName</th> 
												<th>จำนวน</th> 
												<th>วันที่ได้รับ</th> 
											</tr> 
										</thead> 
										<tbody> 
											".GenDataTableItemCodeUse($_SESSION['username'])."
										</tbody>
										</table> 
									</div>
								</div>
							</div>   
						</div>
					</div>
				</section>		
			";
		}	
		else if(isset($_GET['menu']) && $_GET['menu']=='move' && isset($_SESSION['username']))
		{
			echo "
				<section class='no-padding-bottom' style='margin-top: 30px;'>
					<div class='container Mitr'>
						<div class='text-left' style='padding-top: 10px;'>
							<div class='section-header'>
								<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-map-marker'></i> ย้ายพิกัดตัวละคร ( Move )</h3>
								<div class='sub-heading'>
									ย้ายพิกัดตัวละครไปยังเมืองต่างๆ ที่ต้องการ..
								</div>
								<hr>
							</div>
							<div class='row'>
								<div class='col-md-12'>
									<div>
										<form action='' method='post' enctype='multipart/form-data'>
											<div class='col-md-6 text-left' style='margin-bottom: 90px;'>
												<h4>เลือกเมืองและตัวละคร</h4>
												<hr>
												<div class='form-group'>
													<label for='exampleInputEmail1'>เลือกตัวละคร</label>
													<select id='schar' name='schar' class='form-control'>
													".GenDataChar($_SESSION['customerid'])."
													</select>
												</div> 
												<div class='form-group'>
													<label for='exampleInputEmail1'>เลือกเมืองที่ต้องการ</label>
													<select id='map' name='map' class='form-control'>
													".GenDataOption()."
													</select>
												</div>                                
											</div>
											<div class='col-md-6'>
												<h4>รายละเอียดเทเลพอต</h4>
												<hr>
												<div style='padding: 7px 0px;'>ตัวละคร :<span style='float: right'><p id='pname'>-</p></span></div>
												<div style='padding: 7px 0px;'>แผนที่ :<span style='float: right'><p id='pmap'>-</p></span></div>
												<div style='padding: 7px 0px;'>ค่าบริการ :<span style='float: right'><p id='pay'>-</p></span></div>
												<div style='padding: 7px 0px;'><button type='submit' id='submit-movenow' onclick='return false' class='btn btn-success'><i class='fa fa-credit-card'></i> ย้ายตัวละคร</button></div>
											</div>
											
										</form>    
									</div>     
									<br clear='all'>
									<hr>
								</div>
							</div>
						</div>
					</div>
				</section>	
			";	
		}
		else if(isset($_GET['menu']) && $_GET['menu']=='refill_conf' && isset($_SESSION['username']) && AuthenCheck($_SESSION['username'],$_SESSION['encodename'],$_SESSION['authen']))
		{
			$data = GetGCAmount();
			echo "
				<section class='no-padding-bottom' style='margin-top: 30px;'>
					<div class='container Mitr'>        
						<div class='text-left' style='padding-top: 10px;'>
							<div class='section-header'>
								<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-credit-card'></i> ตั้งค่าระบบเติมเงิน</h3>
								<hr>
							</div>
							<div class='row'>
								<div>
									<div class='col-md-6'>
										<h4>ตั้งค่า GC ที่ได้รับ</h4>
										<hr>          
										<form> 
										  <div class='form-group'>
											<label for='true50'>บัตรทรูมันนี่ 50 บาท</label>
											<input type='text' class='form-control' id='true50' placeholder='GC ที่ได้รับ.....' value='".$data[0]['TopupA_amount']."'>
										  </div>
										  <div class='form-group'>
											<label for='true90'>บัตรทรูมันนี่ 90 บาท</label>
											<input type='text' class='form-control' id='true90' placeholder='GC ที่ได้รับ.....' value='".$data[1]['TopupA_amount']."'>
										  </div>
										  <div class='form-group'>
											<label for='true150'>บัตรทรูมันนี่ 150 บาท</label>
											<input type='text' class='form-control' id='true150' placeholder='GC ที่ได้รับ.....' value='".$data[2]['TopupA_amount']."'>
										  </div>  
										  <div class='form-group'>
											<label for='true300'>บัตรทรูมันนี่ 300 บาท</label>
											<input type='text' class='form-control' id='true300' placeholder='GC ที่ได้รับ.....' value='".$data[3]['TopupA_amount']."'>
										  </div> 
										  <div class='form-group'>
											<label for='true500'>บัตรทรูมันนี่ 500 บาท</label>
											<input type='text' class='form-control' id='true500' placeholder='GC ที่ได้รับ.....' value='".$data[4]['TopupA_amount']."'>
										  </div> 
										  <div class='form-group'>
											<label for='true1000'>บัตรทรูมันนี่ 1000 บาท</label>
											<input type='text' class='form-control' id='true1000' placeholder='GC ที่ได้รับ.....' value='".$data[5]['TopupA_amount']."'>
										  </div>                                   
										  <button type='submit' class='btn btn-success' id='submit-gcamount' onclick='return false'><i class='fa fa-edit'></i> บันทึกการเปลี่ยนแปลง</button>
										</form>                     
									</div>
									<div class='col-md-6'>
										<h4>ตั้งค่าโปรโมชั่นแถมไอเทม</h4>
										<hr>
										<form> 
										<div class='form-group'>
											<label for='trueamount'>มูลค่าบัตร</label>
											".GetTrueAmount()."
										</div>								
										  <div class='form-group'>
											<label for='itemid'>รหัสไอเทม</label>
											<input type='text' class='form-control' id='itemid' placeholder='รหัสไอเทม.....'>
										  </div>									
										  <div class='form-group'>
											<label for='itemname'>ชื่อไอเทม</label>
											<input type='text' class='form-control' id='itemname' placeholder='ชื่อไอเทม.....'>
										  </div>
										  <div class='form-group'>
											<label for='itemamount'>จำนวนไอเทม</label>
											<input type='text' class='form-control' id='itemamount' placeholder='จำนวนไอเทม.....'>
										  </div>                                     
										  <button type='submit' class='btn btn-success' id='submit-addpromotion' onclick='return false'><i class='fa fa-edit'></i> เพิ่มไอเทมโปรโมชั่น</button>
										</form>
										<hr>
										<div class='bs-example' data-example-id='striped-table'>
											<table id='table-promotion' class='table table-striped table-bordered'>
												<thead>
													<tr>
														<th>มูลค่าบัตร</th>
														<th>รหัสไอเทม</th>
														<th>ชื่อไอเทม</th>
														<th>จำนวน</th>
														<th>จัดการ</th>
													</tr>
												</thead>
												<tbody>
													".GenDataTablePromotion()."
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<br clear='all'>
								<hr>
							</div>
						</div>
					</div>
				</section>	
			";
		}
		else if(isset($_GET['menu']) && $_GET['menu']=='gencode_conf' && isset($_SESSION['username']) && AuthenCheck($_SESSION['username'],$_SESSION['encodename'],$_SESSION['authen']))
		{
			echo "
				<section class='no-padding-bottom' style='margin-top: 30px;'>
					<div class='container Mitr'>        
						<div class='text-left' style='padding-top: 10px;'>
							<div class='section-header'>
								<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-external-link'></i> ส่ง GC และ แอดของ</h3>
								<hr>
							</div>
							<div class='row'>
								<div>
									<div class='col-md-6'>
										<h4>สร้างโคดแลก GC</h4>
										<hr>          
										<form> 
										  <div class='form-group'>
											<label for='gcpoint'>จำนวน GC</label>
											<input type='text' class='form-control' id='gcpoint' placeholder='จำนวน GC.....' value='1'>
										  </div>
										  <div class='form-group'>
											<label for='limit'>จำกัดจำนวนการใช้งาน / ครั้ง</label>
											<input type='text' class='form-control' id='limit' placeholder='จำกัดจำนวนการใช้งาน / ครั้ง......' >
										  </div>                            
										  <button type='submit' class='btn btn-success' id='submit-gencodegc' onclick='return false'><i class='fa fa-location-arrow'></i> สร้างโคดแลก GC เดี๋ยวนี้....</button>
										</form> 			
									</div>
									<div class='col-md-6'>
										<h4>สร้างโคดแลก Item</h4>
										<hr>          
										<form> 
										  <div class='form-group'>
											<label for='itemindex'>รหัสไอเทม</label>
											<input type='text' class='form-control' id='itemindex' placeholder='รหัสไอเท็ม.....' value='101262'>
										  </div>
										  <div class='form-group'>
											<label for='itemname'>ชื่อ Item</label>
											<input type='text' class='form-control' id='itemname' placeholder='ชื่อ Item.....' value=''>
										  </div>
										  <div class='form-group'>
											<label for='quantity'>จำนวน ที่ต้องการส่ง ( ชิ้น )</label>
											<input type='text' class='form-control' id='quantity' placeholder='จำนวน......' >
										  </div>   
										  <div class='form-group'>
											<label for='ilimit'>จำกัดจำนวนการใช้งาน / ครั้ง</label>
											<input type='text' class='form-control' id='ilimit' placeholder='จำกัดจำนวนการใช้งาน / ครั้ง......' >
										  </div>                            
										  <button type='submit' class='btn btn-success' id='submit-gencodeitem' onclick='return false'><i class='fa fa-location-arrow'></i> สร้างโคดแลก Item เดี๋ยวนี้....</button>
										</form>                   
									</div>
								</div>							
								<br clear='all'>
							</div>
							<hr>
							<div class='row'>
								<div class='col-md-12'>
									<div class='row'>
										<div class='col-md-12 text-left' style='margin-top: -20px;'>
											<div class='bs-example' data-example-id='striped-table'>
												<table id='table-gencode' class='table table-striped table-bordered'>
													<thead>
														<tr>
															<th>ItemCode</th>
															<th>ItemID</th>
															<th>ไอเทมที่จะได้รับ</th>
															<th>จำนวน</th>
															<th>จำนวนการใช้งาน / ครั้ง</th>
															<th>จัดการ</th>
														</tr>
													</thead>
													<tbody>
														".GenDataTableItemCode()."
													</tbody>
												</table>
											</div>
										</div> 
									</div>									
								</div>
							</div>							
						</div>
					</div>
				</section>	
			";
		}
		else if(isset($_GET['menu']) && $_GET['menu']=='addpoint_conf' && isset($_SESSION['username']) && AuthenCheck($_SESSION['username'],$_SESSION['encodename'],$_SESSION['authen']))
		{
			echo "
				<section class='no-padding-bottom' style='margin-top: 30px;'>
					<div class='container Mitr'>        
						<div class='text-left' style='padding-top: 10px;'>
							<div class='section-header'>
								<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-external-link'></i> ส่ง GC และ แอดของ</h3>
								<hr>
							</div>
							<div class='row'>
								<div>
									<div class='col-md-6'>
										<h4>ส่ง GC ให้แก่ผู้เล่น</h4>
										<hr>          
										<form> 
										  <div class='form-group'>
											<label for='quantity1'>จำนวน GC ที่ต้องการส่ง</label>
											<input type='text' class='form-control' id='quantity1' placeholder='จำนวน GC.....' value='1'>
										  </div>
										  <div class='form-group'>
											<label for='username1'>ไอดี / อีเมล ที่ต้องดารส่ง ( ปล่อยว่างเพื่อส่งให้กับทุกคน)</label>
											<input type='text' class='form-control' id='username1' placeholder='ไอดี / อีเมล.....' >
										  </div>                                
										  <button type='submit' class='btn btn-success' id='submit-addpoint1' onclick='return false'><i class='fa fa-plus-circle'></i> เพิ่ม GC เฉพาะไอดี / อีเมล ที่กำหนด....</button>
										  <button type='submit' class='btn btn-success' id='submit-addpoint2' onclick='return false'><i class='fa fa-plus-square'></i> เพิ่ม GC ให้ทั้งหมด....</button>
										</form>                   
									</div>
									<div class='col-md-6'>
										<h4>ส่งไอเทมให้แก่ผู้เล่น</h4>
										<hr>          
										<form> 
										  <div class='form-group'>
											<label for='itemindex2'>รหัสไอเทม ที่ต้องการส่ง</label>
											<input type='text' class='form-control' id='itemindex2' placeholder='รหัสไอเท็ม.....' value='101262'>
										  </div>
										  <div class='form-group'>
											<label for='quantity2'>จำนวน ที่ต้องการส่ง ( ชิ้น )</label>
											<input type='text' class='form-control' id='quantity2' placeholder='จำนวนไอเทม.....' value='1'>
										  </div>
										  <div class='form-group'>
											<label for='username2'>ไอดี / อีเมล ที่ต้องดารส่ง ( ปล่อยว่างเพื่อส่งให้กับทุกคน)</label>
											<input type='text' class='form-control' id='username2' placeholder='ไอดี / อีเมล.....' >
										  </div>                              
										  <button type='submit' class='btn btn-success' id='submit-additem1' onclick='return false'><i class='fa fa-plus-circle'></i> ส่งไอเทมเฉพาะไอดี / อีเมล ที่กำหนด....</button>
										  <button type='submit' class='btn btn-success' id='submit-additem2' onclick='return false'><i class='fa fa-plus-square'></i> ส่งไอเทมให้ทั้งหมด....</button>
										</form>                   
									</div>
								</div>
								<br clear='all'>
								<hr>
							</div>
						</div>
					</div>
				</section>	
			";
		}
		else if(isset($_GET['menu']) && $_GET['menu']=='report_conf' && isset($_SESSION['username']) && AuthenCheck($_SESSION['username'],$_SESSION['encodename'],$_SESSION['authen']))
		{
			echo "
				<section class='no-padding-bottom' style='margin-top: 30px;'>
					<div class='container Mitr'>        
						<div class='text-left' style='padding-top: 10px;'>
							<div class='section-header'>
								<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-external-link'></i> ตรวจสอบรีพอร์ต</h3>
								<hr>
							</div>
							<div class='row'>
								<div>
									<div class='col-md-12'>
										<div class='gallery'>
											".GetReports()."
										</div>
									</div>
								</div>
								<br clear='all'>
								<hr>
							</div>
						</div>
					</div>
				</section>	
			";
		}		
		else if(isset($_GET['menu']) && $_GET['menu']=='teleport_conf' && isset($_SESSION['username']) && AuthenCheck($_SESSION['username'],$_SESSION['encodename'],$_SESSION['authen']))
		{
			echo "
				<section class='no-padding-bottom' style='margin-top: 30px;'>
					<div class='container Mitr'>        
						<div class='text-left' style='padding-top: 10px;'>
							<div class='section-header'>
								<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-bolt'></i> เทเลพอต</h3>
								<div class='sub-heading'>
									เพิ่ม / ลบ จุดเทเลพอต...
								</div>
								<hr>
							</div>
							<div class='row'>
								<div>
									<div class='col-md-6'>
										<h4>เพิ่มแผนที่</h4>
										<hr>
										<form> 
										  <div class='form-group'>
											<label for='mapname'>ชื่อแผนที่</label>
											<input type='text' class='form-control' id='mapname' placeholder='ตัวอย่าง Colorado'>
										  </div>
										  <div class='form-group'>
											<label for='mapid'>รหัสแผนที่</label>
											<input type='text' class='form-control' id='mapid' placeholder='ตัวอย่าง 2'>
										  </div>                                
										  <button type='submit' class='btn btn-success' id='submit-addmap' onclick='return false'><i class='fa fa-edit'></i> เพิ่มแผนที่</button>
										</form>
										<hr>
										<h4>ข้อมูลแผนที่</h4>									
										<hr>									
										<div class='bs-example' data-example-id='striped-table'>
											<table id='table-addmap' class='table table-striped table-bordered'>
												<thead>
													<tr>
														<th>ชื่อแผนที่่</th>
														<th>จัดการ</th>
													</tr>
												</thead>
												<tbody>
													".GenDataTableMap()."
												</tbody>
											</table>
										</div>
									</div>								
									<div class='col-md-6'>
										<h4>เพิ่มจุดเทเลพอต</h4>
										<hr>          
										<form> 
										  <div class='form-group'>
											<label for='exampleInputEmail1'>เลือกแผนที่</label>
											<select id='datamap' name='datamap' class='form-control'>
											".GenDataMap()."
											</select>
										  </div>   									
										  <div class='form-group'>
											<label for='placename'>ชื่อสถานที่</label>
											<input type='text' class='form-control' id='placename' placeholder='ชื่อสถานที่'>
										  </div>
										  <div class='form-group'>
											<label for='posX'>พิกัด X</label>
											<input type='text' class='form-control' id='posX' placeholder='พิกัด แกน X'>
										  </div>
										  <div class='form-group'>
											<label for='posY'>พิกัด Y</label>
											<input type='text' class='form-control' id='posY' placeholder='พิกัด แกน Y'>
										  </div>
										  <div class='form-group'>
											<label for='posZ'>พิกัด Z</label>
											<input type='text' class='form-control' id='posZ' placeholder='พิกัด แกน Z'>
										  </div>
										  <div class='form-group'>
											<label for='pay'>ค่าบริการ > GC</label>
											<input type='text' class='form-control' id='pay' placeholder='ค่าบริการ'>
										  </div>                                    
										  <button type='submit' class='btn btn-success' id='submit-addpos' onclick='return false'><i class='fa fa-edit'></i> เพิ่มจุดเทเลพอต</button>
										</form> 
										<hr>
										<h4>ข้อมูลจุดเทเลพอต</h4>
										<hr>
										<div class='bs-example' data-example-id='striped-table'>
											<table id='table-addpos' class='table table-striped table-bordered'>
												<thead>
													<tr>
														<th>แผนที่</th>
														<th>เมือง</th>
														<th>พิกัด</th>
														<th>GC</th>
														<th>จัดการ</th>
													</tr>
												</thead>
												<tbody>
													".GenDataTablePos()."
												</tbody>
											</table>
										</div>									
									</div>							
									<br clear='all'>
									<hr>
							</div>
						</div>
					</div>
				</section>
			";
		}	
		else if(isset($_GET['menu']) && $_GET['menu']=='banned_conf' && isset($_SESSION['username']) && AuthenCheck($_SESSION['username'],$_SESSION['encodename'],$_SESSION['authen']))
		{
			echo "
				<section class='no-padding-bottom' style='margin-top: 30px;'>
					<div class='container Mitr'>        
						<div class='text-left' style='padding-top: 10px;'>
							<div class='section-header'>
								<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-ban'></i> แบน / ปลดแบน</h3>
								<div class='sub-heading'>
									แบน / ปลดแบน...
								</div>
								<hr>
							</div>
							<div class='row'>
								<div>
									<div class='col-md-6'>
										<h4>กรอกชื่อตัวละครเพื่อทำการแบน</h4>
										<hr>
										<form> 
											<div class='input-group'>
											  <input type='text' class='form-control' id='findchar' placeholder='ชื่อตัวละคร'>
											  <span class='input-group-btn'>
												<button class='btn btn-info' type='button' id='submit-findchar' onclick='return false'>ค้นหาตัวละคร</button>
											  </span>
											</div>		
											<br>
										  <div class='form-group'>
											<label for='banned'>ไอดี / อีเมล</label>
											<input type='text' class='form-control' id='banned' placeholder='-' disabled>
										  </div>                              
										  <button type='submit' class='btn btn-success' id='submit-banned' onclick='return false'><i class='fa fa-ban'></i> แบนไอดี / อีเมลนี้</button>
										</form>
									</div>								
									<div class='col-md-6'>
										<h4>รายการผู้ถูกแบน</h4>									
										<hr>									
										<div class='bs-example' data-example-id='striped-table'>
											<table id='table-banned' class='table table-striped table-bordered'>
												<thead>
													<tr>
														<th>CustomerID</th>
														<th>ID / Email</th>
														<th>จัดการ</th>
													</tr>
												</thead>
												<tbody>
													".GenDataTableBanned()."
												</tbody>
											</table>
										</div>																	
									</div>							
									<br clear='all'>
									<hr>
								</div>	
							</div>
						</div>
					</div>
				</section>
			";
		}	
		else if(isset($_GET['menu']) && $_GET['menu']=='reward_conf' && isset($_SESSION['username']) && AuthenCheck($_SESSION['username'],$_SESSION['encodename'],$_SESSION['authen']))
		{
			echo "
				<section class='no-padding-bottom' style='margin-top: 30px;'>
					<div class='container Mitr'>        
						<div class='text-left' style='padding-top: 10px;'>
							<div class='section-header'>
								<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-diamond'></i> สะสมเติมเงิน</h3>
								<div class='sub-heading'>
									เพิ่ม / ลบ สะสมเติมเงิน...
								</div>
								<hr>
							</div>
							<div class='row'>
								<div>
									<div class='col-md-6'>
										<h4>เพิ่มไอเทมสะสมเติมเงิน</h4>
										<hr>
										<form> 
										  <div class='form-group'>
											<label for='amount'>ยอดเติม</label>
											<input type='text' class='form-control' id='amount' placeholder='ยอดเติม....'>
										  </div>
										  <div class='form-group'>
											<label for='itemid'>รหัสไอเทม</label>
											<input type='text' class='form-control' id='itemid' placeholder='รหัสไอเทม...'>
										  </div>  
										  <div class='form-group'>
											<label for='quantity'>จำนวนไอเทม</label>
											<input type='text' class='form-control' id='quantity' placeholder='จำนวนไอเทม...'>
										  </div>  
										  <div class='form-group'>
											<label for='itemname'>ชื่อไอเทม</label>
											<input type='text' class='form-control' id='itemname' placeholder='ชื่อไอเทม...'>
										  </div>                                
										  <button type='submit' class='btn btn-success' id='submit-addreward' onclick='return false'><i class='fa fa-edit'></i> เพิ่มรีวอร์ด</button>
										</form>
									</div>								
									<div class='col-md-6'>
										<h4>รายการไอเทมรีวอร์ด</h4>									
										<hr>									
										<div class='bs-example' data-example-id='striped-table'>
											<table id='table-addreward' class='table table-striped table-bordered'>
												<thead>
													<tr>
														<th>ยอดสะสม</th>
														<th>รหัสไอเทม</th>
														<th>ชื่อไอเทม</th>
														<th>จำนวนไอเทม</th>
														<th>จัดการ</th>
													</tr>
												</thead>
												<tbody>
													".GenDataTableReward()."
												</tbody>
											</table>
										</div>																	
									</div>							
									<br clear='all'>
									<hr>
								</div>	
							</div>
						</div>
					</div>
				</section>
			";
		}
		else if(isset($_GET['menu']) && $_GET['menu']=='spcitem_conf' && isset($_SESSION['username']) && AuthenCheck($_SESSION['username'],$_SESSION['encodename'],$_SESSION['authen']))
		{
			echo "
				<section class='no-padding-bottom' style='margin-top: 30px;'>
					<div class='container Mitr'>        
						<div class='text-left' style='padding-top: 10px;'>
							<div class='section-header'>
								<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-diamond'></i> RARE ITEM</h3>
								<div class='sub-heading'>
									ตั้งค่าไอเทมแรร์
								</div>
								<hr>
							</div>
							<div class='row'>
								<div>
									<div class='col-md-6'>
										<h4>เพิ่มไอเทมแรร์</h4>
										<h>- ให้นำรูปไอเทมไปใส่ไว้ที่ storage/images/storeicon/</h>
										<hr>
										<form> 
										  <div class='form-group'>
											<label for='itemid'>ITEM ID</label>
											<input type='text' class='form-control' id='itemid' placeholder='รหัสไอเทม....'>
										  </div>
										  <div class='form-group'>
											<label for='itemname'>ITEM NAME</label>
											<input type='text' class='form-control' id='itemname' placeholder='ชื่อไอเทม...' readonly>
										  </div>    
										  <div class='form-group'>
											<label for='opt1'>OPTION 1</label>
											<input type='text' class='form-control' id='opt1' placeholder='ออฟชั่นของไอเทม...'>
										  </div>   
										  <div class='form-group'>
											<label for='opt2'>OPTION 2</label>
											<input type='text' class='form-control' id='opt2' placeholder='ออฟชั่นของไอเทม...'>
										  </div>
										  <div class='form-group'>
											<label for='opt3'>OPTION 3</label>
											<input type='text' class='form-control' id='opt3' placeholder='ออฟชั่นของไอเทม...'>
										  </div>
										  <div class='form-group'>
											<label for='price'>PRICE</label>
											<input type='text' class='form-control' id='price' placeholder='ราคาของไอเทม...'>
										  </div>
										  <div class='form-group'>
											<label for='quantity'>QUANTITY</label>
											<input type='text' class='form-control' id='quantity' placeholder='จำนวนไอเทม... [ หากไอเทมเป็นตัวละครให้ใส่ 1 เท่านั้น ]'>
										  </div>
										  <button type='submit' class='btn btn-success' id='submit-spcitem' onclick='return false'><i class='fa fa-edit'></i> เพิ่มไอเทม</button>
										</form>
									</div>								
									<div class='col-md-6'>
										<h4>รายการไอเทมพิเศษ</h4>
										<h>- รายการไอเทมที่ตั้งขายบน Shop แล้ว</h>
										<hr>									
										<div class='bs-example' data-example-id='striped-table'>
											<table id='table-addspcitem' class='table table-striped table-bordered'>
												<thead>
													<tr>
														<th>รหัสไอเทม</th>
														<th>ชื่อไอเทม</th>
														<th>Option1</th>
														<th>Option2</th>
														<th>Option3</th>
														<th>ราคา</th>
														<th>จำนวน</th>
														<th>จัดการ</th>
													</tr>
												</thead>
												<tbody>
													".GenDataTableSpcItem()."
												</tbody>
											</table>
										</div>																	
									</div>							
									<br clear='all'>
									<hr>
								</div>	
							</div>
						</div>
					</div>
				</section>
			";
		}
		else if(isset($_GET['menu']) && $_GET['menu']=='db2sql_conf' && isset($_SESSION['username']) && AuthenCheck($_SESSION['username'],$_SESSION['encodename'],$_SESSION['authen']))
		{
			$data = $_SESSION['dburl'];
			echo "
				<section class='no-padding-bottom' style='margin-top: 30px;'>
					<div class='container Mitr'>        
						<div class='text-left' style='padding-top: 10px;'>
							<div class='section-header'>
								<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-external-link'></i> เพิ่มข้อมูล ITEMDB ไปยัง SQL SERVER</h3>
								<div class='sub-heading'>
									ตัวช่วยให้แอดมินเพิ่ม ITEM ลงร้านค้าได้ง่ายขึ้น...
								</div>
								<hr>
							</div>
							<div class='row'>
								<div>
									<div class='col-md-6'>
										<h4>กรุณานำไฟล์ ItemsDB ไปไว้ที่ storage/itemsdb/itemsDB.xml</h4>
										<hr>
										<form> 
											<button type='submit' class='btn btn-success' id='query-itemdb' onclick='return false'><i class='fa fa-edit'></i> แอดไอเทมลง SQL</button>
										</form>
									</div>								
									<div class='col-md-6'>
										<h4>สถานะการอัพเดต SQL</h4>									
										<hr>									
										<div class='bs-example' data-example-id='striped-table'>
											<IFRAME id='dbstatus' src='' width='560' height='270' frameborder='0' scrolling='auto'></IFRAME>
										</div>																	
									</div>							
									<br clear='all'>
									<hr>
								</div>	
							</div>
						</div>
					</div>
				</section>
			";
		}
		else if(isset($_GET['menu']) && $_GET['menu']=='settings_conf' && isset($_SESSION['username']) && AuthenCheck($_SESSION['username'],$_SESSION['encodename'],$_SESSION['authen']))
		{
			echo "
			<section class='no-padding-bottom' style='margin-top: 30px;'>
				<div class='container Mitr'>        
					<div class='text-left' style='padding-top: 10px;'>
						<div class='section-header'>
							<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-user'></i> ตั่งค่าพื้นฐาน</h3>
							<hr>
						</div>
						<div class='row'>
							<div>
								<div class='col-md-12'>      
									<form>
									  <div class='form-group'>
										<label for='conf_ip'>IP SQL Server</label>
										<input type='text' class='form-control' id='conf_ip' placeholder='IP SQL Server' value='".$_CONFIG['SERVER']['IP']."'>
									  </div>
									  <div class='form-group'>
										<label for='conf_user'>User SQL Server</label>
										<input type='text' class='form-control' id='conf_user' placeholder='User SQL Server' value='".$_CONFIG['SERVER']['USER']."'>
									  </div> 
									  <div class='form-group'>
										<label for='conf_pass'>Pass SQL Server</label>
										<input type='password' class='form-control' id='conf_pass' placeholder='Pass SQL Server' value='".$_CONFIG['SERVER']['PASS']."'>
									  </div> 
									  <div class='form-group'>
										<label for='conf_dbname'>Database Name</label>
										<input type='text' class='form-control' id='conf_dbname' placeholder='Database Name' value='".$_CONFIG['SERVER']['DB']."'>
									  </div>  
									  <div class='form-group'>
										<label for='conf_license'>License Key</label>
										<input type='text' class='form-control' id='conf_license' placeholder='License Key' value='".$_CONFIG['SERVER']['LICENSE']."'>
									  </div> 
									  <div class='form-group'>
										<label for='conf_passkey'>API PASSKEY</label>
										<input type='text' class='form-control' id='conf_passkey' placeholder='API PASSKEY' value='".$_CONFIG['TOPUP']['APIKEY']."'>
									  </div> 
									  <div class='form-group'>
										<label for='conf_tmnid'>TMTOPUP_ID</label>
										<input type='text' class='form-control' id='conf_tmnid' placeholder='TMTOPUP_ID' value='".$_CONFIG['TOPUP']['TMTUID']."'>
									  </div> 
									  <div class='form-group'>
										<label for='conf_adminid'>ADMIN_ID</label>
										<input type='text' class='form-control' id='conf_adminid' placeholder='ADMIN_ID' value='".$_CONFIG['SERVER']['DEV']."'>
									  </div> 
										<div class='form-group'>
											<label for='conf_md5'>เปิดใช้รหัสผ่าน MD5</label>
											".GetChoiceMD5()."
										</div>								  
									  <button type='submit' class='btn btn-success' id='submit-conf' onclick='return false'><i class='fa fa-edit'></i> บันทึก</button>
									</form>                     
								</div>
							</div>
							<br clear='all'>
							<hr>
						</div>
					</div>
				</div>
			</section>
			";		
		}
		else if(isset($_GET['menu']) && $_GET['menu']=='multiple_conf' && isset($_SESSION['username']) && AuthenCheck($_SESSION['username'],$_SESSION['encodename'],$_SESSION['authen']))
		{
			$data = GetdataMultiple();
			$start_date = date("m/d/Y H:i:s a",$data[0]['start_date']);
			$end_date = date("m/d/Y H:i:s a",$data[0]['end_date']);	
			echo "
				<section class='no-padding-bottom' style='margin-top: 30px;'>
					<div class='container Mitr'>        
						<div class='text-left' style='padding-top: 10px;'>
							<div class='section-header'>
								<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-tachometer'></i> ตั้งค่าอัตรการคุณ</h3>
								<hr>
							</div>
							<div class='row'>
								<div>
									<div class='col-md-6'>
										<h4>ตั้งค่า</h4>
										<hr>          
										<form> 							
										<div class='form-group'>
											<label for='multiple'>อัตราการคุณ</label>
											<select class='form-control' id='multiple'>
												".GetChoice()."		
											</select>
										</div>
										<div class='form-group' id='start_datepick'>
											<label for='start_date'>เวลาเริ่มต้นกิจกรรม</label>
											<div class='input-group start_datepick'>
												<input type='text' id='start_date' class='form-control start_datepick' value='".$start_date."' />
												<span class='input-group-addon'>
													<span class='glyphicon glyphicon-calendar'></span>
												</span>
											</div>
										</div>							
										<div class='form-group' id='end_datepick'>
											<label for='end_date'>เวลาหมดกิจกรรม</label>
											<div class='input-group end_datepick'>
												<input type='text' id='end_date' class='form-control end_datepick' value='".$end_date."' />
												<span class='input-group-addon'>
													<span class='glyphicon glyphicon-calendar'></span>
												</span>
											</div>
										</div>                                  
										  <button type='submit' class='btn btn-success' id='submit-startmultiple' onclick='return false'><i class='fa fa-send'></i> แก้ไขกิจกรรม</button>
										</form>                     
									</div>
									<div class='col-md-6'>
										<h4>สถานะ</h4>
										<hr>
											".GetMultiStatus()."
										<hr> 
									</div>
								</div>
								<br clear='all'>
								<hr>
							</div>
						</div>
					</div>
				</section>	
			";
		}	
		else
		{
			$data = GetUserData($_SESSION['customerid']);
			echo "
				<section class='no-padding-bottom' style='margin-top: 30px;'>
					<div class='container Mitr'>        
						<div class='text-left' style='padding-top: 10px;'>
							<div class='section-header'>
								<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-user'></i> ข้อมูลตัวละคร</h3>
								<div class='sub-heading'>
									ข้อมูล Account ของคุณ...
								</div>
								<hr>
							</div>
							<div class='row'>
								<div>
									<div class='col-md-6'>
										<h4>เปลี่ยนรหัสผ่าน</h4>
										<hr>          
										<form> 
										  <div class='form-group'>
											<label for='passold'>รหัสผ่านเดิม</label>
											<input type='password' class='form-control' id='passold' placeholder='รหัสผ่านเดิม'>
										  </div>
										  <div class='form-group'>
											<label for='newpass1'>รหัสผ่านใหม่</label>
											<input type='password' class='form-control' id='newpass1' placeholder='รหัสผ่านใหม่'>
										  </div>
										  <div class='form-group'>
											<label for='newpass2'>ยืนยัน รหัสผ่านใหม่</label>
											<input type='password' class='form-control' id='newpass2' placeholder='ยืนยัน รหัสผ่านใหม่'>
										  </div>                                  
										  <button type='submit' class='btn btn-success' id='submit-changepass' onclick='return false'><i class='fa fa-edit'></i> เปลี่ยนรหัสผ่าน</button>
										  <input id='userencrypt' type='hidden' value='".$_SESSION['encodename']."' class='form-control'>
										</form>                     
									</div>
									<div class='col-md-6'>
										<h4>Account Info ( ".$_SESSION['username']." )</h4>
										<hr>
										<div style='padding: 5px 0px;'>CustomerID <span style='float: right'>".$data['CustomerID']."</span></div>
										<div style='padding: 5px 0px;'>Account Email <span style='float: right'>".$_SESSION['username']."</span></div>
										<div style='padding: 5px 0px;'>Account Status <span style='float: right'>".($data['AccountStatus'] == 100 ? 'ปกติ' : 'แบน')."</span></div>
										<div style='padding: 5px 0px;'>Register <span style='float: right'>".date_format( $data['dateregistered'], 'jS, F Y H:i:s' )."</span></div>
										<div style='padding: 5px 0px;'>[ WP ] Web Point  <span style='float: right'>".$data['WebPoints']."</span></div>
										<div style='padding: 5px 0px;'>[ GC ] Game Point  <span style='float: right'>".$data['GamePoints']."</span></div>
										<div style='padding: 5px 0px;'>[ DL ] Game Dollars  <span style='float: right'>".$data['GameDollars']."</span></div>
										<div style='padding: 5px 0px;'>Time Play <span style='float: right' title='ชั่วโมง:นาที:วินาที' data-toggle='tooltip'>".sec_to_time($data['TimePlayed'])."</span></div>
									</div>
								</div>
								<br clear='all'>
								<hr>
							</div>
						</div>
					</div>
				</section>	
			";
		}
	}else{
		if(db_check() && CheckAuthen())
		{
			echo "
			<!-- NAVBAR -->
			<span id='lc' style='font-weight:bold; font-size:11px;'>".lc()."</span>
			<nav class='navbar navbar-default navbar-fixed-top navbar-light-font ignore-paddingtop'>
				<div class='container'>
					<div class='nav-logo'>
						<img src='storage/images/bravana-light.png' alt='WarzLogo'>
					</div>
					<div class='userinfo'>
						<i class='fa fa-gears'></i><span id='status'> Loadding... </span>
						<i class='fa fa-line-chart'></i><span id='Online'> Loadding... </span>
						<i class='fa fa-list'></i><span id='Accounts'> Loadding... </span>
						<i class='fa fa-users'></i><span id='Character'> Loadding... </span>
						<ul><marquee>".$_CONFIG['SERVER']['NAME']." ยินดีต้อนรับ !! - ".showeventgc()."</marquee></ul>
					</div>
				</div>
				<!-- END MAIN NAVIGATION -->
			</nav>
			<!-- END NAVBAR -->
			<section class='no-padding-bottom' style='margin-top: 30px;'>
				<div class='container Mitr'>        
					<div class='text-left' style='padding-top: 10px;'>
						<div class='section-header'>
							<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-user'></i> เข้าสู่ระบบ</h3>
							<hr>
						</div>
						<div class='row'>
							<div>
								<div class='col-md-6'>      
									<form>
										<div class='form-group'>
											<label for='accountname'>อีเมล หรือ ไอดี</label>
											<input type='text' class='form-control' id='accountname' placeholder='อีเมล หรือ ไอดี'>
										</div>
										<div class='form-group'>
											<label for='password'>รหัสผ่าน</label>
											<input type='password' class='form-control' id='password' placeholder='รหัสผ่าน'>
										</div>  
										<button type='submit' class='btn btn-success' id='submit-login' onclick='return false'><i class='fa fa-sign-in'></i> เข่าสู่ระบบ</button>
										<button type='submit' class='btn btn-info' id='submit-register' onclick='return false'><i class='fa fa-user-plus'></i> สมัครเล่นเกมส์</button>
										<button type='button' class='btn btn-warning' id='dl_btn'><i class='fa fa-download'></i> ดาวน์โหลดเกมส์</button>
											<input type='hidden' id='launcher_name' value=' ".$launcher['name']." '>
											<input type='hidden' id='launcher_version' value=' ".$launcher['version']." '>
											<input type='hidden' id='launcher_link' value=' ".$launcher['link']." '>
											<input type='hidden' id='fullclient_name' value=' ".$fullclient['name']." '>
											<input type='hidden' id='fullclient_version' value=' ".$fullclient['version']." '>
											<input type='hidden' id='fullclient_link' value=' ".$fullclient['link']." '>
										<button type='button' class='btn btn-danger' id='show_ban' onclick='return false'><i class='fa fa-lock'></i> รายชื่อคนโดนแบน</button>
											<input type='hidden' id='ban_list' value=' ".ban_detail()." '>
									</form>
									<div id='top10'>
										<table width='670' cellspacing='0' cellpadding='0'>
											<tr>
												<td width='300' valign='top'>
													<div align='center'>
														<span style='font-family: Kanit; font-weight:bold; font-size:16px;'><i class='fa fa-user'></i> อันดับผู้เล่นที่เก่งที่สุดในแต่ละสาย</span>
														<table width='350'>
															<thead style='font-size:14px;'>
																<tr>
																	<th>#</th>
																	<th>สายโจร</th>
																	<th>สายตำรวจ</th>
																</tr>
															</thead>
															<tbody style='font-size:12px;'>
																".showtop10good()."
															</tbody>
														</table>
													</div>
												</td>
												<td width='20'>&nbsp;</td>
												<td width='300' valign='top'>
													<div align='center'>
														<span style='font-family: Kanit; font-weight:bold; font-size:16px;'><i class='fa fa-user'></i> อันดับผู้เล่นที่รวยที่สุด</span>
														<table width='300'>
															<thead style='font-size:14px;'>
																<tr>
																	<th>#</th>
																	<th>CustomerID</th>
																	<th>ชื่อตัวละคร</th>
																	<th>GamePoint</th>
																</tr>
															</thead>
															<tbody style='font-size:12px;'>
																".showtop10gc()."
															</tbody>
														</table>
													</div>	
												</td>
											</tr>
										</table>
									</div>
								</div>
							</div>
								<div class='col-md-6'>
									<div class='text-center' style='margin-bottom: 90px;'>
										<div id='random'>
											<center>
												<img src='storage/images/LoginZombie.png' class='img-responsive'>
											</center>
										</div>
									</div>						
								</div>
							<br clear='all'>
						</div>
					</div>
				</div>
			</section>
		";
		}
		else
		{
			echo "
			<!-- NAVBAR -->
			<span id='lc' style='font-weight:bold; font-size:11px;'>".lc()."</span>
			<nav class='navbar navbar-default navbar-fixed-top navbar-light-font ignore-paddingtop'>
				<div class='container'>
					<div class='nav-logo'>
						<img src='storage/images/bravana-light.png' alt='WarzLogo'>
					</div>
					<!-- END MAIN NAVIGATION -->
				</div>
			</nav>
			<!-- END NAVBAR -->
			<section class='no-padding-bottom' style='margin-top: 30px;'>
				<div class='container Mitr'>        
					<div class='text-left' style='padding-top: 10px;'>
						<div class='alert alert-danger' role='alert'><h5>".(!CheckAuthen()?'License ไม่ถูกต้อง<br>':'').(!db_check()?'ไม่สามารถเชื่อมต่อฐานข้อมูลได้':'')."</h5></div>
						
						<!-- <div class='section-header'>
							<h3 class='dark-text' style='font-family: Kanit'><i class='fa fa-user'></i> ตั่งค่าพื้นฐาน</h3>
							<hr>
						</div>
						<div class='row'>
							<div>
								<div class='col-md-12'>      
									<form>
									  <div class='form-group'>
										<label for='conf_ip'>IP SQL Server</label>
										<input type='text' class='form-control' id='conf_ip' placeholder='IP SQL Server' value='".$_CONFIG['SERVER']['IP']."'>
									  </div>
									  <div class='form-group'>
										<label for='conf_user'>User SQL Server</label>
										<input type='text' class='form-control' id='conf_user' placeholder='User SQL Server' value='".$_CONFIG['SERVER']['USER']."'>
									  </div> 
									  <div class='form-group'>
										<label for='conf_pass'>Pass SQL Server</label>
										<input type='password' class='form-control' id='conf_pass' placeholder='Pass SQL Server' value='".$_CONFIG['SERVER']['PASS']."'>
									  </div> 
									  <div class='form-group'>
										<label for='conf_dbname'>Database Name</label>
										<input type='text' class='form-control' id='conf_dbname' placeholder='Database Name' value='".$_CONFIG['SERVER']['DB']."'>
									  </div>  
									  <div class='form-group'>
										<label for='conf_license'>License Key</label>
										<input type='text' class='form-control' id='conf_license' placeholder='License Key' value='".$_CONFIG['SERVER']['LICENSE']."'>
									  </div> 
									  <div class='form-group'>
										<label for='conf_passkey'>API PASSKEY</label>
										<input type='text' class='form-control' id='conf_passkey' placeholder='API PASSKEY' value='".$_CONFIG['TOPUP']['APIKEY']."'>
									  </div> 
									  <div class='form-group'>
										<label for='conf_tmnid'>TMTOPUP_ID</label>
										<input type='text' class='form-control' id='conf_tmnid' placeholder='TMTOPUP_ID' value='".$_CONFIG['TOPUP']['TMTUID']."'>
									  </div> 
									  <div class='form-group'>
										<label for='conf_adminid'>ADMIN_ID</label>
										<input type='text' class='form-control' id='conf_adminid' placeholder='ADMIN_ID' value='".$_CONFIG['SERVER']['DEV']."'>
									  </div> 
										<div class='form-group'>
											<label for='conf_md5'>เปิดใช้รหัสผ่าน MD5</label>
											".GetChoiceMD5()."
										</div>								  
									  <button type='submit' class='btn btn-success' id='submit-conf' onclick='return false'><i class='fa fa-edit'></i> บันทึก</button>
									</form>                     
								</div>
							</div>
							<br clear='all'>
							<hr>
						</div>
						-->
					</div>
				</div>
			</section>
		";
		}
	}
?>
</div>
<!-- END WRAPPER -->
    <!-- JAVASCRIPT -->
    <script src="storage/js/jquery-2.1.1.min.js"></script>
    <script src="storage/js/bootstrap.min.js"></script>
    <script src="storage/js/Moment.js"></script>
    <script src="storage/js/transition.js"></script>
    <script src="storage/js/collapse.js"></script>
    <script src="storage/js/process.js"></script>
    <script src="storage/js/bravana.js"></script>
    <script src="storage/js/jquery.dataTables.min.js"></script>
    <script src="storage/js/jquery-ui.js"></script>
    <script src="storage/js/bootstrap-datetimepicker.min.js"></script>
    <script src="storage/js/dataTables.bootstrap.min.js"></script>
    <script src="storage/js/sweetalert2.min.js"></script>
	
	<!-- REPORTS SCRIPT -->
	<script type="text/javascript" src="storage/colorbox/jquery.colorbox-min.js"></script>
<?php
	if(isset($_GET['menu']) && $_GET['menu']=='refill')
		echo '<script src=\'https://www.tmtopup.com/topup/3rdTopup.php?uid='.$_CONFIG['TOPUP']['TMTUID'].'\'></script>';
	/*
	if(AuthenCheck($_SESSION['username'],$_SESSION['encodename'])){	
		if($ver!=preg_replace('/\s+/', '', call_version())){
			echo '
				<script>
					sweetAlert( "แจ้งเตือน", "มีเวอร์ชั่นใหม่ออกมาแล้วกรุณาโหลดใหม่ได้ที่<a href=\'http://purchase.let-play.com\' target=\'_blank\'> คลิ๊ก </a><br><br>มีอะไรใหม่ในเวอร์ชั่นนี้<a href=\'http://purchase.let-play.com/version.php?v=data\' target=\'_blank\'> คลิ๊ก </a>", "info" )	
				</script>
			';			
		}	
	}
	*/
?>
<!-- SCM Music Player http://scmplayer.net -->
<script type="text/javascript" src="http://scmplayer.net/script.js" 
data-config="{	'skin':'skins/black/skin.css',
				'volume':<?php echo $volume; ?>,
				'autoplay':<?php echo $autoplay; ?>,
				'shuffle':<?php echo $shuffle; ?>,
				'repeat':<?php echo $repeat; ?>,
				'placement':'bottom',
				'showplaylist':false,
				'playlist':[
					{	'title':'<?php echo $title[1]; ?>',
						'url':'<?php echo $url[1]; ?>'
					},
					{
						'title':'<?php echo $title[2]; ?>',
						'url':'<?php echo $url[2]; ?>'
					},
					{
						'title':'<?php echo $title[3]; ?>',
						'url':'<?php echo $url[3]; ?>'
					},
					{
						'title':'<?php echo $title[4]; ?>',
						'url':'<?php echo $url[4]; ?>'
					},
					{
						'title':'<?php echo $title[5]; ?>',
						'url':'<?php echo $url[5]; ?>'
					},
					{
						'title':'<?php echo $title[6]; ?>',
						'url':'<?php echo $url[6]; ?>'
					},
					{
						'title':'<?php echo $title[7]; ?>',
						'url':'<?php echo $url[7]; ?>'
					},
					{
						'title':'<?php echo $title[8]; ?>',
						'url':'<?php echo $url[8]; ?>'
					},
					{
						'title':'<?php echo $title[9]; ?>',
						'url':'<?php echo $url[9]; ?>'
					},
					{
						'title':'<?php echo $title[10]; ?>',
						'url':'<?php echo $url[10]; ?>'
					}
				]}" >
</script>
<!-- SCM Music Player script end -->	
</body>
</html>	