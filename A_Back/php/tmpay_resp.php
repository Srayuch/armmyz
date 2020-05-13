<?php
include('functions.php');
global $_CONFIG;
if ( $conn === false) { 
	echo "Error in connection.\n"; die( print_r( sqlsrv_errors(), true));
}

if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
	$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
} else {
	$ip = $_SERVER["REMOTE_ADDR"];
}

if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
	$_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
}

if($_SERVER['REMOTE_ADDR'] == $_CONFIG['tmpay']['access_ip'])
{
	$transaction_id = $_GET['transaction_id'];
	$password = $_GET['password'];
	$real_amount = $_GET['real_amount'];
	$status = $_GET['status'];
	
	$amount = floor($real_amount);
	
	$dataMulti = GetdataMultiple();
	$multi = $dataMulti[0]['multiple'];
	$dataGC = GetGCAmount(false,$amount);
	$gp_point = $dataGC[0]['TopupA_amount'] * $multi;
		
	$conn = db_connect();
	$sql = "UPDATE wzTopup_TBL SET txid = '".$transaction_id."' , amount = '".$amount."', status = '".$status."' WHERE password = '".$password."'";
	$stmt = exec_query( $conn, $sql);
	
	$sql1 = "SELECT * FROM wzTopup_TBL WHERE password = '".$password."'";
	$stmt1 = exec_query($conn, $sql1);
	$row = sqlsrv_fetch_array( $stmt1, SQLSRV_FETCH_ASSOC);
	
	if($row['unit'] == 'WP') {
		$x_multi = 1;
		$points = $amount;
	} else if($row['unit'] == 'GC') {
		$x_multi = $multi;
		$points = $gp_point;
	}
	$sql2 = "UPDATE wzTopup_TBL SET multiple = '".$x_multi."', gp_point = '".$points."' WHERE password = '".$password."' ";
	$stmt2 = exec_query($conn, $sql2);
	
	if($status == 1) {
		DonateLogs($row['CustomerID'], $amount);
		$arr = GetdataPromotion(true,$amount);
		
		if($row['unit'] == 'GC') {
			for($i=0;$i<count($arr);$i++) {	
				itemtouser($arr[$i]['TopupP_iid'],$arr[$i]['TopupP_iamount'],$row['email'],'ADDITEM');
			}
			
			$sql = "{call BD_TOPUP(?, ?)}";
			$params = array( array($_SESSION['customerid'], SQLSRV_PARAM_IN), array($amount, SQLSRV_PARAM_IN) );
			exec_proc( $conn, $sql, $params);
		}
		
		if($row['unit'] == 'WP') {
			wptouser($amount,$row['email'],'ADDPOINT');
			die('SUCCEED|ทำการแอด [WP] ให้กับ '.$row['email'].'  จำนวน  '.$amount.' WP เรียบร้อยแล้ว');
		} else if($row['unit'] == 'GC'){
			gctouser($gp_point,$row['email'],'ADDPOINT');
			die('SUCCEED|ทำการแอด [GC] ให้กับ '.$row['email'].'  จำนวน  '.$gp_point.' GC เรียบร้อยแล้ว');
		}
		
	}	
} else {
    die('ERROR|ACCESS_DENIED|' . $_SERVER['REMOTE_ADDR']);
}

?>