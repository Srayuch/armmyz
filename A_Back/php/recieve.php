<?php
include('functions.php');

if(isset($_POST['DATA']) && checkApiIp() ) {
	$APIKEY = $api_passkey;
	$DATA = $_POST['DATA'];
	$RAW = APIDecrypt($APIKEY, $DATA);

	$transaction_id = $RAW['transaction_id'];
	$checkdate = $RAW['checkdate'];
	$userid = $RAW['userid'];
	$amount = $RAW['amount'];
	$status = $RAW['status'];

	if($status == "SUCCESS") {
		
		$CustomerID = GetCustomerID($userid);
		$username = GetUserName($CustomerID);
		
		if($username == $userid){
			
			$dataMulti = GetdataMultiple();
			$dataGC = GetGCAmount(false,$amount);
			
			if($dataGC != FALSE) {
				
				$multi = 1;	
				$multi = $dataMulti[0]['multiple'];
				
				if($multi > 1) {
					$x = $multi + 0.5;
				} else {
					$x = $multi * 1.5;
				}
				
				DonateLogs($CustomerID, $amount);
				gctouser($dataGC[0]['TopupA_amount'] * $x, $userid,'ADDPOINT');
				TruemoneyLogs($transaction_id, $CustomerID, $userid, '','TRUEMONEY WALLET', $amount, $x, ($dataGC[0]['TopupA_amount'] * $x), 'GC', 1);
				
				$row = GetdataPromotion(true,$amount);
				
				for($i=0;$i<count($row);$i++) {
					itemtouser($row[$i]['TopupP_iid'],$row[$i]['TopupP_iamount'],$userid,'ADDITEM');	
				}		
				die('SUCCESS | ระบบทำการแอด [POINTS] : '.($dataGC[0]['TopupA_amount'] * $x).' และ [ITEMS SET] : '.$amount.' ให้แก่ [Username] : '.$userid.' เรียบร้อย');
				
			} else {
				die('NOTFOUND | จำนวนเงินที่เติมเข้ามาไม่ตรงกับราคาที่มีในฐานข้อมูล');
			}
			
		} else {
			die('NOTFOUND | ไม่พบชื่อผู้ใช้นี้ในระบบ');
		}
		
	} else {
		die('FAILED | STATUS NOT SUCCESS');
	}
	
} else {
	die('ERROR | ACCESS_DENIED');
}
?>