<?php
include('functions.php');

if ( $conn === false) { 
	echo "Error in connection.\n"; die( print_r( sqlsrv_errors(), true));
}

if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
	$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
} else {
	$ip = $_SERVER["REMOTE_ADDR"];
}

require_once('AES.php');

if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
	$_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
}

if($_SERVER['REMOTE_ADDR'] == '203.146.127.115' && isset($_GET['request']))
{
    $aes = new Crypt_AES();
    $aes->setKey($_CONFIG['TOPUP']['APIKEY']);
    $_GET['request'] = base64_decode(strtr($_GET['request'], '-_,', '+/='));
    $_GET['request'] = $aes->decrypt($_GET['request']);
    if($_GET['request'] != false)
    {
        parse_str($_GET['request'],$request);
		$ref1 = trim(base64_decode($request['Ref1']));
		$ref2 = trim(base64_decode($request['Ref2']));
		$ref3 = trim(base64_decode($request['Ref3']));
		$true_txid = $request['TXID'];
		$true_card = $request['cashcard_password'];
		$true_amount = $request['cardcard_amount'];
		$dataMulti = GetdataMultiple();
		$dataGC = GetGCAmount(false,$true_amount);
		$multi = 1;
		$multi = $dataMulti[0]['multiple'];
		DonateLogs($ref1, $true_amount);
		
		if($ref3 == 'WebPoints') {
				
			wptouser($dataGC[0]['TopupA_card'],$ref2,'ADDPOINT');
			TruemoneyLogs($true_txid, $ref1, $ref2, 'TRUEMONEY CARD', $true_card, $true_amount, 1, ($dataGC[0]['TopupA_card']), 'WP', 1);
			
		} else if($ref3 == 'GamePoints') {
				
			gctouser($dataGC[0]['TopupA_amount'] * $multi,$ref2,'ADDPOINT');
			TruemoneyLogs($true_txid, $ref1, $ref2, 'TRUEMONEY CARD', $true_card, $true_amount, $multi, ($dataGC[0]['TopupA_amount'] * $multi), 'GC', 1);
			
		}
		$row = GetdataPromotion(true,$true_amount);
		for($i=0;$i<count($row);$i++) {
				
			itemtouser($row[$i]['TopupP_iid'],$row[$i]['TopupP_iamount'],$ref2,'ADDITEM');
			
		}		
		echo 'SUCCEED';
		
    } else {
        echo 'ERROR|INVALID_PASSKEY';
    }
	
} else {
    echo 'ERROR|ACCESS_DENIED';
}

?>