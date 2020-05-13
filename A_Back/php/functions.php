<?php  
 $ver = '1.0.3';
 error_reporting(0);
 @session_start();
 header('Content-Type: text/html; charset=utf-8');
 date_default_timezone_set("Asia/Bangkok");
 include('config.php');
 include('lang.php');
 
 //ON - OFF CHECK LICENSE SYSTEM
 $CHK_LICENSE = FALSE;

 if(db_check() && $CHK_LICENSE && Decrypt_Base64($_CONFIG['SERVER']['LICENSE']) != gethostbyname(gethostname()) || Decrypt_Base64($_CONFIG['SERVER']['LICENSE']) == '127.0.0.1' || Decrypt_Base64($_CONFIG['SERVER']['LICENSE']) == 'localhost') {

	 session_destroy();
 } else {

	 @session_start();
 }
 
 function CheckAuthen() {

	global $CHK_LICENSE;
	global $_CONFIG;
	if($CHK_LICENSE && Decrypt_Base64($_CONFIG['SERVER']['LICENSE']) != gethostbyname(gethostname()) || Decrypt_Base64($_CONFIG['SERVER']['LICENSE']) == '127.0.0.1' || Decrypt_Base64($_CONFIG['SERVER']['LICENSE']) == 'localhost') {

		return false;
	} else {

		return true;
	} 
}
	
 function db_connect() {
	global $_CONFIG;
	db_check();
	$db_connectionInfo = array( "UID" => $_CONFIG['SERVER']['USER'], "PWD" => $_CONFIG['SERVER']['PASS'], "Database" => $_CONFIG['SERVER']['DB'], "CharacterSet" => "UTF-8" );
	$conn = sqlsrv_connect($_CONFIG['SERVER']['IP'], $db_connectionInfo);
	if(!$conn) {

		die( print_r( sqlsrv_errors(), true));
		exit();
	}
	return $conn;
}
	
 function db_check() {
	global $_CONFIG;
	$db_connectionInfo = array( "UID" => $_CONFIG['SERVER']['USER'], "PWD" => $_CONFIG['SERVER']['PASS'], "Database" => $_CONFIG['SERVER']['DB'], "CharacterSet" => "UTF-8" );
	$conn = sqlsrv_connect($_CONFIG['SERVER']['IP'], $db_connectionInfo);
	if($conn) {

		return true;
	}
	session_destroy();
	return false;
}
	
 function exec_query($conn, $tsql) {

	$stmt = sqlsrv_query($conn, $tsql);
	if(!$stmt) {

		echo "exec failed.\n";
		die( print_r( sqlsrv_errors(), true));
	}
	return $stmt;
}

 function exec_query_store($conn, $tsql, $arr) {

	$stmt = sqlsrv_query($conn, $tsql, $arr);
	if(!$stmt) {

		echo "exec failed.\n";
		die( print_r( sqlsrv_errors(), true));
	}
	return $stmt;
}

 function exec_proc($conn, $tsql, $params) {

	$stmt = sqlsrv_query($conn, $tsql, $params);
	if(!$stmt) {

		echo "exec failed.\n";
		die( print_r( sqlsrv_errors(), true));
	}
	return $stmt;
}

 function exec_num($conn, $tsql) {

	$params = array();
	$options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
	$stmt = sqlsrv_query($conn, $tsql, $params, $options);
	if(!$stmt) {

		echo "exec failed.\n";
		die( print_r( sqlsrv_errors(), true));
	}
	return sqlsrv_num_rows( $stmt );
}

 function Encrypt_Base64($text,$salt='***WebShopping***') {

	return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $salt, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
	}
	
 function Decrypt_Base64($text,$salt='***WebShopping***') {

	return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $salt, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
	}

 function clean($sql, $formUse = true) {

    $sql = preg_replace("/(from|select|insert|delete|where|drop table|show tables|,|'|#|\*|--|\\\\)/i", "", $sql);
    $sql = trim($sql);
    $sql = strip_tags($sql);
    if (!$formUse || !get_magic_quotes_gpc()) {

        $sql = addslashes($sql);
    }
    return $sql;
}
	
 function misc_parsestring($text, $allowchr) {

    if (empty($allowchr)) {

        $allowchr = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    }
    if (empty($text)) {

        return FALSE;
    }

    $size = strlen($text);
    for ($i = 0; $i < $size; $i++) {

        $tmpchr = substr($text, $i, 1);
        if (strpos($allowchr, $tmpchr) === FALSE) {

            return FALSE;
        }
    }
    return TRUE;
}
 
 function alert($string) {

	echo "<script type='text/javascript'> alert('$string'); </script>";
 }
 
 function md5_warz($password) {
	global $_CONFIG;
	if($_CONFIG['SERVER']['MD5']) {
		return md5($_CONFIG['SERVER']['MD5KEY'].$password);
	} else {
		return $password;
	}
 }
 
 function check_filter_a($text) {
	return preg_replace("/[^a-z0-9]/", "", $text) == $text ? true : false;
 }
 
 function check_login() {
	if(!isset($_SESSION['customerid']) || !isset($_SESSION['username']) || !isset($_SESSION['encodename'])){
		session_destroy();
		header( "location: index.php" );
	}
 }
 
 function sec_to_time($seconds) {
	global $lang;
	$day = floor($seconds / (3600*24));
	$hours = floor($seconds / 3600) % 24;
	$minutes = floor(($seconds / 60) % 60);
	$seconds = $seconds % 60;
	return sprintf(" %02d ".$lang['day']." %02d ".$lang['hour']." %02d ".$lang['min']." %02d ".$lang['sec']."", $day, $hours, $minutes, $seconds);
 }
 
 function GetUserData($customerid){
	$conn = db_connect();
	$str = "SELECT CustomerID,dateregistered,AccountStatus,WebPoints,GamePoints,GameDollars,TimePlayed,IsDeveloper FROM UsersData WHERE CustomerID = '".$customerid."'";
	$array = sqlsrv_fetch_array(exec_query( $conn, $str), SQLSRV_FETCH_ASSOC);
	return array('CustomerID'=>$array['CustomerID'],'dateregistered'=>$array['dateregistered'],'AccountStatus'=>$array['AccountStatus'],'WebPoints'=>$array['WebPoints'],'GamePoints'=>$array['GamePoints'],'GameDollars'=>$array['GameDollars'],'TimePlayed'=>$array['TimePlayed'],'IsDeveloper'=>$array['IsDeveloper']);
 }
 function GetCustomerID($username){
	$conn = db_connect();
	$str = "SELECT [CustomerID] FROM [Accounts] WHERE [email] = '".$username."'";
	$array = sqlsrv_fetch_array(exec_query( $conn, $str), SQLSRV_FETCH_ASSOC);
	return $array['CustomerID'];
 }
 
 function GetUserName($customerid){
	$conn = db_connect();
	$str = "SELECT [email] FROM [WarZ].[dbo].[Accounts] where [CustomerID] = '".$customerid."'";
	$array = sqlsrv_fetch_array(exec_query( $conn, $str), SQLSRV_FETCH_ASSOC);
	return $array['email'];
 }
	
 function register($account,$password){
	$conn = db_connect();
	$sql = "{call WZ_ACCOUNT_CREATE(?, ?, ?, ?, ?, ?, ?, ?)}";
	$params = array( array(''.$_SERVER['REMOTE_ADDR'].'', SQLSRV_PARAM_IN), array($account, SQLSRV_PARAM_IN), array($password, SQLSRV_PARAM_IN), array('ARMY-TH', SQLSRV_PARAM_IN), array('', SQLSRV_PARAM_IN), array('', SQLSRV_PARAM_IN), array('', SQLSRV_PARAM_IN), array('', SQLSRV_PARAM_IN) );
	if(exec_proc( $conn, $sql, $params) ) {
		return "REGISTER:TRUE";
	} else {
		return "REGISTER:FASLE";
	}
 }
 
 function spcitemtouser($username,$itemid,$param){
	$conn = db_connect();
	if($username!=''){
		$str = "SELECT CustomerID FROM Accounts WHERE email = '".$username."'";
		$array = sqlsrv_fetch_array(exec_query( $conn, $str), SQLSRV_FETCH_ASSOC);

		$str2 = "SELECT WebPoints FROM UsersData WHERE CustomerID = '".$array['CustomerID']."'";
		$array2 = sqlsrv_fetch_array(exec_query( $conn, $str2), SQLSRV_FETCH_ASSOC);
		
		$str3 = "SELECT * FROM wzItemSell_TBL WHERE ItemID = '".$itemid."'";
		$array3 = sqlsrv_fetch_array(exec_query( $conn, $str3), SQLSRV_FETCH_ASSOC);
		
		if (exec_num( $conn,$str ) == 1 && exec_num( $conn,$str2 ) == 1 && exec_num( $conn,$str3 ) == 1 ) {
			if($array2['WebPoints'] < $array3['Price']) {
				return $param.":NOWP";
			} else {
				exec_query( $conn, "UPDATE UsersData SET WebPoints -= '".$array3['Price']."' WHERE CustomerID = '".$array['CustomerID']."'");
				$sql = "{call FN_AddItemToUser(?, ?, ?)}";
				$params = array( array($array['CustomerID'], SQLSRV_PARAM_IN), array($itemid, SQLSRV_PARAM_IN), array(1, SQLSRV_PARAM_IN) );
				for($i=0; $i<$array3['Qty']; $i++){
					exec_proc( $conn, $sql, $params);
				}
				return $param.":TRUE";
			}
		} else {
			return $param.":FALSE";
		}
	}
 }
 
 function wptouser($quantity,$username,$param){
	$conn = db_connect();
	if($username!=''){
		$str = "SELECT CustomerID FROM Accounts WHERE email = '".$username."'";
		$array = sqlsrv_fetch_array(exec_query( $conn, $str), SQLSRV_FETCH_ASSOC);
		if (exec_num( $conn,$str ) == 1) {
			exec_query( $conn, "UPDATE UsersData SET WebPoints += '".$quantity."' WHERE CustomerID = '".$array['CustomerID']."'");
			return $param.":TRUE";
		} else {
			return $param.":FALSE";
		}
	}
 }
	
 function gctouser($quantity,$username,$param){
	$conn = db_connect();
	if($username!=''){
		$str = "SELECT CustomerID FROM Accounts WHERE email = '".$username."'";
		$array = sqlsrv_fetch_array(exec_query( $conn, $str), SQLSRV_FETCH_ASSOC);
		if (exec_num( $conn,$str ) == 1) {
			exec_query( $conn, "UPDATE UsersData SET GamePoints += '".$quantity."' WHERE CustomerID = '".$array['CustomerID']."'");
			$data = GetdataItemCodeUse($username);
			$str = '';
			$str .= '<tr><td>'.$data[0]['ItemCodeText'].'</td>';
			$str .= '<td>'.($data[0]['ItemCodeType']==0?"GC":"ITEM").'</td>';
			$str .= '<td>'.$data[0]['ItemCodeItemName'].'</td>';
			$str .= '<td>'.$data[0]['ItemCodeQuantity'].' '.($data[0]['ItemCodeType']==0?"GC":"ชิ้น").'</td>';
			$str .= '<td>'.$data[0]['ItemCodeUseTime'].'</td></tr>';
			return $param." : TRUE#".$str." | ";
		} else {
			return $param." : FALSE | ";
		}
	} else {
		exec_query( $conn, "UPDATE UsersData SET GamePoints += '".$quantity."'");
		return $param.":TRUE";
	}
 }
 
 function itemtouser($itemindex,$quantity,$username,$param){
	$conn = db_connect();
	if($username!=''){
		$str = "SELECT CustomerID FROM Accounts WHERE email = '".$username."'";
		$array = sqlsrv_fetch_array(exec_query( $conn, $str), SQLSRV_FETCH_ASSOC);
		if (exec_num( $conn,$str ) == 1) {
			$sql = "{call FN_AddItemToUser(?, ?, ?)}";
			$params = array( array($array['CustomerID'], SQLSRV_PARAM_IN), array($itemindex, SQLSRV_PARAM_IN), array(2000, SQLSRV_PARAM_IN) );
			for($i=0; $i<$quantity; $i++){
				exec_proc( $conn, $sql, $params);
			}
			return $param.":TRUE";
		} else {
			return $param.":FALSE";
		}
	} else {
		$str = "SELECT CustomerID FROM Accounts order by CustomerID asc";
		$stmt = sqlsrv_query( $conn, $str );
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
			$sql = "{call FN_AddItemToUser(?, ?, ?)}";
			$params = array( array($row['CustomerID'], SQLSRV_PARAM_IN), array($itemindex, SQLSRV_PARAM_IN), array(2000, SQLSRV_PARAM_IN) );
			for($i=0; $i<$quantity; $i++){
				exec_proc( $conn, $sql, $params);
			}
		} return $param.":TRUE";
	}
 }
 
 function GenChar($no = 16, $str = "", $chr = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'){
	$length = strlen($chr);
	while($no --) {
		$str .= $chr{mt_rand(0, $length- 1)};
	}
	return $str;
 }
 
 function GenCCMath(){
	$r1 = rand(50,100);
	$r2 = rand(1,50);
	$re = Encrypt_Base64((rand(0,1)==0?$r1+$r2:$r1-$r2));
	$re = Encrypt_Base64($r1+$r2);
	return $re;
 }
 
 function GenItemCodeGC($gcpoint, $limit, $type){
	$conn = db_connect();
	$itemcode = substr(chunk_split(GenChar(16), 4, '-'),0,-1);
	global $lang;
	if (CheckItemCode($itemcode)) {
		exec_query( $conn, "INSERT INTO [wzItemCode_TBL]([ItemCodeItemID],[ItemCodeItemName],[ItemCodeText],[ItemCodeQuantity],[ItemCodeLimit],[ItemCodeRemain],[ItemCodeType])VALUES('$itemindex','GC Point.','$itemcode','$gcpoint','$limit','$limit','$type')");
		$data = GetdataItemCode();
		$str = '<tr id="del'.$data[0]['ItemCodeIdx'].'">';
		$str .= '<td>'.$data[0]['ItemCodeText'].'</td>';
		$str .= '<td>'.($data[0]['ItemCodeItemID']==0?"-":$data[0]['ItemCodeItemID']).'</td>';
		$str .= '<td>'.$data[0]['ItemCodeItemName'].'</td>';
		$str .= '<td>'.$data[0]['ItemCodeQuantity'].' '.($data[0]['ItemCodeType']==0?"GC":"ชิ้น").'</td>';
		$str .= '<td>'.$data[0]['ItemCodeRemain'].' / '.$data[0]['ItemCodeLimit'].'</td>';
		$str .= '<td><button onClick="deldata('.$data[0]['ItemCodeIdx'].',\''.Encrypt_Base64($data[0]['ItemCodeIdx']).'\')" class="btn btn-danger btn-xs" data-title="Delete"><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
		return "GENCODEGC:TRUE#".$str;
	} else {
		GenItemCodeGC($gcpoint, $limit, $type);
	}
 } 
 
 function GenItemCodeItem($itemindex, $itemname, $quantity, $limit, $type){
	$conn = db_connect();
	$itemcode = substr(chunk_split(GenChar(16), 4, '-'),0,-1);
	global $lang;
	if (CheckItemCode($itemcode)) {
		exec_query( $conn, "INSERT INTO [wzItemCode_TBL]([ItemCodeItemID],[ItemCodeItemName],[ItemCodeText],[ItemCodeQuantity],[ItemCodeLimit],[ItemCodeRemain],[ItemCodeType])VALUES('$itemindex','$itemname','$itemcode','$quantity','$limit','$limit','$type')");
		$data = GetdataItemCode();
		$str = '<tr id="del'.$data[0]['ItemCodeIdx'].'">';
		$str .= '<td>'.$data[0]['ItemCodeText'].'</td>';
		$str .= '<td>'.($data[0]['ItemCodeItemID']==0?"-":$data[0]['ItemCodeItemID']).'</td>';
		$str .= '<td>'.$data[0]['ItemCodeItemName'].'</td>';
		$str .= '<td>'.$data[0]['ItemCodeQuantity'].' '.($data[0]['ItemCodeType']==0?"GC":"ชิ้น").'</td>';
		$str .= '<td>'.$data[0]['ItemCodeRemain'].' / '.$data[0]['ItemCodeLimit'].'</td>';
		$str .= '<td><button onClick="deldata('.$data[0]['ItemCodeIdx'].',\''.Encrypt_Base64($data[0]['ItemCodeIdx']).'\')" class="btn btn-danger btn-xs" data-title="Delete"><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
		return "GENCODEITEM:TRUE#".$str;
	} else {
		GenItemCodeItem($itemindex, $itemname, $quantity, $limit, $type);
	}
 }
 
 function CheckItemCode($itemcode){
		$conn = db_connect();
		$str = "SELECT ItemCodeIdx FROM wzItemCode_TBL WHERE ItemCodeText = '".$itemcode."'";
		if (exec_num( $conn,$str ) == 0) {
			return true;
		}
		return false;
	}
 function CheckTrueCard($truecard){
	$conn = db_connect();
	$str = "SELECT card_id FROM wzTopup_TBL WHERE cardserial = '".$truecard."'";
	if (exec_num( $conn,$str ) == 0) {
		return true;
	}
	return false;
 }
 
 function GetdataItemCode(){
	$conn = db_connect();
	$str = "SELECT * FROM wzItemCode_TBL where ItemCodeDel = 0 order by ItemCodeIdx desc";
	$stmt = sqlsrv_query( $conn, $str );
	$post = array();
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
		$post[] = $row;
	}
	return $post;
 }
 
 function GetdataPromotion($last = true, $amount = ''){
	$conn = db_connect();
	if (is_numeric($amount)) {
		$str = "SELECT * FROM wzTopupP_TBL where TopupP_idel = 0 and TopupP_tamount = '".$amount."' order by TopupP_id asc";
	} else if($last) {
		$str = "SELECT * FROM wzTopupP_TBL where TopupP_idel = 0 order by TopupP_id desc";
	} else {
		$str = "SELECT * FROM wzTopupP_TBL where TopupP_idel = 0 order by TopupP_tamount asc, TopupP_id asc";
	}
	$stmt = sqlsrv_query( $conn, $str );
	$post = array();
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
		$post[] = $row;
	}
	return $post;
 }
 
 function GetdataPos($index=''){
	$conn = db_connect();
	$str = "SELECT * FROM wzItemPos_TBL where PosDel = 0";
	if($index!='') {
		$str .= " and PosID = $index";
	} else {
		$str .= " order by PosID desc";
	}
	$stmt = sqlsrv_query( $conn, $str );
	$post = array();
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
		$post[] = $row;
	}
	return $post;
 }
 
 function GetdataMap($index=''){
	$conn = db_connect();
	$str = "SELECT * FROM wzItemMap_TBL where ItemMapDel = 0";
	if($index!='') {
		$str .= " and ItemMapIdx = $index";
	} else {
		$str .= " order by ItemMapIdx desc";
	}
	$stmt = sqlsrv_query( $conn, $str );
	$post = array();
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
		$post[] = $row;
	}
	return $post;
 }
 
 function GetdataReward($news=false,$index=''){
	$conn = db_connect();
	$str = "SELECT * FROM wzItemFreeList_TBL where FreeListDel = 0";
	if($index!='') {
		$str .= " and FreeListIdx = $index";
	}else if($news) {
		$str .= " order by FreeListIdx desc";
	} else {
		$str .= " order by FreeListAmount asc, FreeListIdx asc";
	}
	$stmt = sqlsrv_query( $conn, $str );
	$post = array();
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
		$post[] = $row;
	}
	return $post;
 }
 
 function Getdataspcitem($news=false,$index=''){
	$conn = db_connect();
	$str = "SELECT * FROM wzItemSell_TBL where ItemDel = 0";
	if($index!='') {
		$str .= " and ItemNo = $index";
	}else if($news) {
		$str .= " order by ItemNo desc";
	}
	$stmt = sqlsrv_query( $conn, $str );
	$post = array();
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
		$post[] = $row;
	}
	return $post;
 }
 
 function GenDataOption(){
	$data = GetdataPos();
	$str = '<option value="'.Encrypt_Base64(0).'#-" selected>กรุณาเลือกแผนที่ที่ต้องการ..</option>';
	foreach ($data as $row) {
		$mdata = GetdataMap($row['PosMap']);
		if(count($mdata[0]['ItemMapName'])>0) {
			$str .= '<option value="'.Encrypt_Base64($row['PosID']).'#'.$row['PosGC'].' GC#[Map] '.$mdata[0]['ItemMapName'].' > '.$row['PosName'].'">[Map] '.$mdata[0]['ItemMapName'].' > '.$row['PosName'].'</option>';
		}
		return $str;
	}
 }
 
 function GetdataChar($CustomerID){
	$conn = db_connect();
	$str = "SELECT CharID,CustomerID,Gamertag FROM UsersChars where CustomerID = '".$CustomerID."' order by CharID desc";
	$stmt = sqlsrv_query( $conn, $str );
	$post = array();
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
		$post[] = $row;
	}
	return $post;
 }
 
 function GenDataChar($CustomerID){
	$data = GetdataChar($CustomerID);
	$str = '<option value="'.Encrypt_Base64(0).'#-" selected>กรุณาเลือกแผนที่ที่ต้องการ..</option>';
	foreach ($data as $row) {
		$str .= '<option value="'.Encrypt_Base64($row['CharID']).'#'.$row['Gamertag'].'">'.$row['Gamertag'].'</option>';
	}
	return $str;
 }
 
 function GenDataMap(){
	$data = GetdataMap();
	$str = '<option value="'.Encrypt_Base64(0).'" selected>กรุณาเลือกแผนที่ที่ต้องการ..</option>';
	foreach ($data as $row) {
		$data = GetdataMap($row['PosMap']);
		$str .= '<option id="delmapoption'.$data[0]['ItemMapIdx'].'" value="'.Encrypt_Base64($row['ItemMapIdx']).'">'.$row['ItemMapName'].'</option>';
	}
	return $str;
 }
 
 function GenDataTablePromotion(){
	$data = GetdataPromotion(false);
	global $_CONFIG;
	$str = '';
	foreach ($data as $row) {
		$str .= '<tr id="delpromotion'.$row['TopupP_id'].'">';
		$str .= '<td>'.$_CONFIG['TMN'][$row['TopupP_tamount']]['TRUEMONEY'].' บาท</td>';
		$str .= '<td>'.$row['TopupP_iid'].'</td>';
		$str .= '<td>'.$row['TopupP_iname'].'</td>';
		$str .= '<td>'.$row['TopupP_iamount'].'</td>';
		$str .= '<td><button onClick="delpromotion('.$row['TopupP_id'].',\''.Encrypt_Base64($row['TopupP_id']).'\')" class="btn btn-danger btn-xs" data-title="Delete"><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
	}
	return $str;
 }
 
 function GenDataTableItemCode(){
	$data = GetdataItemCode();
	$str = '';
	foreach ($data as $row) {
		$str .= '<tr id="del'.$row['ItemCodeIdx'].'">';
		$str .= '<td>'.$row['ItemCodeText'].'</td>';
		$str .= '<td>'.($row['ItemCodeItemID']==0?"-":$row['ItemCodeItemID']).'</td>';
		$str .= '<td>'.$row['ItemCodeItemName'].'</td>';
		$str .= '<td>'.$row['ItemCodeQuantity'].' '.($row['ItemCodeType']==0?"GC":"ชิ้น").'</td>';
		$str .= '<td>'.$row['ItemCodeRemain'].' / '.$row['ItemCodeLimit'].'</td>';
		$str .= '<td><button onClick="deldata('.$row['ItemCodeIdx'].',\''.Encrypt_Base64($row['ItemCodeIdx']).'\')" class="btn btn-danger btn-xs" data-title="Delete"><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
	}
	return $str;
 }
 
 function GenDataTableTruemoney(){
	$data = GetGCAmount();
	global $_CONFIG;
	$str = '';
	for($i=0; $i<count($data); $i++) {
		$itemlist = '';
		$row = GetdataPromotion(false,$data[$i]['TopupA_card']);
		for($j=0; $j<count($row); $j++) {
			$itemlist .= $row[$j]['TopupP_iname'].' = '.$row[$j]['TopupP_iamount'].' ชิ้น';
			if($j+1 != count($row)) {
				$itemlist .= ' | ';
			}
		}
		if(count($row)==0) {
			$itemlist = 'ขณะนี้ยังไม่มีไอเทมโปรโมชั่น';
		}
		$str .= '<tr><td width="90" class="text-center">'.$_CONFIG['TMN'][$data[$i]['TopupA_card']]['TRUEMONEY'].' บาท</td>';
		$str .= '<td width="95" class="text-center" id="Refill_multiple">กำลังโหลดข้อมูล.....</td>';
		$str .= '<td width="95" class="text-center">'.$_CONFIG['TMN'][$data[$i]['TopupA_card']]['TRUEMONEY'].'</td>';
		$str .= '<td width="95" class="text-center" id="Refill_amountID'.$i.'">กำลังโหลดข้อมูล.....</td>';
		$str .= '<td>'.$itemlist.'</td></tr>';
	}
	$str .= '<tr><td colspan="7" class="text-center"><h4>สถานะกิจกรรมเติมเงิน</h4></td></tr>';
	$str .= '<tr><td colspan="7" class="text-center" id="RefillStatusMultiple">กำลังโหลดข้อมูล.....</td></tr>';
	return $str;
 }
 
 function GenDataTableWallet(){
	$data = GetGCAmount();
	global $_CONFIG;
	$str = '';
	for($i=0; $i<count($data); $i++) {
		$itemlist = '';
		$row = GetdataPromotion(false,$data[$i]['TopupA_card']);
		for($j=0; $j<count($row); $j++) {
			$itemlist .= $row[$j]['TopupP_iname'].' = '.$row[$j]['TopupP_iamount'].' ชิ้น';
			if($j+1 != count($row)) {
				$itemlist .= ' | ';
			}
		}
		if(count($row)==0) {
			$itemlist = 'ขณะนี้ยังไม่มีไอเทมโปรโมชั่น';
		}
		$str .= '<tr><td width="95" class="text-center">'.$_CONFIG['TMN'][$data[$i]['TopupA_card']]['TRUEMONEY'].' บาท</td>';
		$str .= '<td width="95" class="text-center" id="RefillTw_multiple">กำลังโหลดข้อมูล.....</td>';
		$str .= '<td width="95" class="text-center" id="RefillTw_amountID'.$i.'">กำลังโหลดข้อมูล.....</td>';
		$str .= '<td>'.$itemlist.'</td></tr>';
	}
	$str .= '<tr><td colspan="7" class="text-center"><h4>สถานะกิจกรรมเติมเงิน</h4></td></tr>';
	$str .= '<tr><td colspan="7" class="text-center" id="RefillStatusMultiple">กำลังโหลดข้อมูล.....</td></tr>';
	return $str;
 }
 
 function GetdataTruemoney($customerid){
	$conn = db_connect();
	$str = "SELECT * FROM wzTopup_TBL where CustomerID = '".$customerid."' order by card_id desc";
	$stmt = exec_query($conn, $str);
	$post = array();
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
		$post[] = $row;
	}
	return $post;
 }
 
 function GendataTruemoney($customerid){
	$data = GetdataTruemoney($customerid);
	global $lang;
	$str = '';
	foreach ($data as $row) {
		$status = $row['status'];
		if($status == 0) {
			$status = '<font style="color:blue;">'.$lang['menu_waitprocess'].'</font>';
		}else if($status == 1) {
			$status = '<font style="color:green;">'.$lang['menu_refillpass'].'</font>';
		} else if($status == 3) {
			$status = '<font style="color:red;">'.$lang['menu_carduse'].'</font>';
		} else if($status == 4) {
			$status = '<font style="color:red;">'.$lang['menu_cardwrong'].'</font>';
		} else {
			$status = '<font style="color:red;">'.$lang['menu_notruemoneycard'].'</font>';
		}
		$str .= '<tr><td>'.$lang['menu_sharp'].$row['txid'].'</td>';
		$str .= '<td>'.$row['success_time'].'</td>';
		$str .= '<td>'.$row['cardserial'].'</td>';
		$str .= '<td>'.$row['password'].'</td>';
		$str .= '<td>'.$row['amount'].' '.$lang['menu_truemoneyBath'].'</td>';
		$str .= '<td>'.$lang['menu_truemoneyX'].' '.$row['multiple'].' '.$lang['menu_truemoneyduplex'].'</td>';
		$str .= '<td>'.$row['gp_point'].' '.$row['unit'].'</td>';
		$str .= '<td>'.$status.'</td></tr>';
		return $str;
	}
 }
 
 function MoveNow($schar, $map){
	$conn = db_connect();
	$data = GetdataPos($map);
	$gdata = GetUserData($_SESSION['customerid']);
	if($gdata['GamePoints'] >= $data[0]['PosGC']) {
		$str = "UPDATE UsersChars SET GameMapId = '".$data[0]['PosMap']."' ,GamePos = '".$data[0]['PosVal']."' WHERE CharID = '".$schar."'";
		if (exec_query( $conn, $str)) {
			$ex = explode("#", gctouser(-($data[0]['PosGC']),$_SESSION['username'],'ADDPOINT'));
			if($ex[0] == 'ADDPOINT:TRUE' && ($gdata['GamePoints']-$data[0]['PosGC']) >= 0) {
				return "MOVENOW:TRUE";
			} else {
				return "MOVENOW:FALSE";
			}
		}else {
			return "MOVENOW:FALSE";
		}
	} else {
		return "MOVENOW:NOTENOUGH";
	}
 }
 
 function GetdataMultiple(){
	$conn = db_connect();
	$str = "SELECT * FROM wzTopupConf_TBL";
	$stmt = sqlsrv_query( $conn, $str );
	$post = array();
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
		$post[] = $row;
	}
	return $post;
 }
 
 function GetGCAmount($all=true,$amount=0){
	$conn = db_connect();
	$str = "SELECT * FROM wzTopupA_TBL";
	if(!$all) {
		$str .= " where TopupA_card = '".$amount."'";
	}
	$stmt = sqlsrv_query( $conn, $str );
	$post = array();
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
		$post[] = $row;
	}
	return $post;
 }
 
 function GetDonate($customerid){
	$conn = db_connect();
	$str = "SELECT * FROM wzDonate_TBL where d_customerid = '".$customerid."'";
	if (exec_num( $conn,$str ) == 1) {
		$stmt = sqlsrv_query( $conn, $str );
		$post = array();
		$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
		return $row['d_amount'];
	} else {
		return 0;
	}
 }
 
 function TruemoneyLogs($txid, $customerid, $email, $card, $password, $amount, $multiple, $value, $unit, $status, $ip){
	$conn = db_connect();
	exec_query( $conn, "INSERT INTO [wzTopup_TBL]([txid],[CustomerID],[email],[cardserial],[password],[amount],[success_time],[multiple],[gp_point],[unit],[status],[uip])VALUES('".$txid."','".$customerid."','".$email."','".$card."','".$password."','".$amount."','".date("Y-m-d H:i:s", time())."','".$multiple."','".$value."','".$unit."','".$status."','".$ip."')");
 }
 
 function DonateLogs($customerid, $amount){
	$conn = db_connect();
	$str = "SELECT * FROM [wzDonate_TBL] where d_customerid = '".$customerid."'";
	if (exec_num( $conn,$str ) == 1) {
		exec_query( $conn, "UPDATE [wzDonate_TBL] SET d_amount += '".$amount."' WHERE d_customerid = '".$customerid."'");
	} else {
		exec_query( $conn, "INSERT INTO [wzDonate_TBL]([d_customerid],[d_amount])VALUES('".$customerid."','".$amount."')");
	}
 }
 
 function UpdateGcAmount($GCString){
	$conn = db_connect();
	$ex = explode("#", $GCString);
	for($i=0; $i<count($ex); $i++) {
		exec_query( $conn, "UPDATE [wzTopupA_TBL] SET TopupA_amount = '".$ex[$i]."' WHERE TopupA_id = '".$i."'");
	}
	return "GCAMOUNT:TRUE";
 }
 
 function FreeItemLogs($order, $email){
	$conn = db_connect();
	exec_query( $conn, "INSERT INTO [wzItemFreeUse_TBL]([ItemFreeOrder],[ItemFreeEmail])VALUES('".$order."','".$email."')");
 }
 
 function AddPromotion($trueamount, $itemid, $itemname, $itemamount){
	$conn = db_connect();
	global $_CONFIG;
	$str = "INSERT INTO [wzTopupP_TBL] ([TopupP_tamount],[TopupP_iid],[TopupP_iname],[TopupP_iamount])VALUES('".$trueamount."','".$itemid."','".$itemname."','".$itemamount."')";
	if (exec_query( $conn, $str)) {
		$data = GetdataPromotion();
		$str = '<tr id="delpromotion'.$data[0]['TopupP_id'].'">';
		$str .= '<td>'.$_CONFIG['TMN'][$data[0]['TopupP_tamount']]['TRUEMONEY'].' บาท</td>';
		$str .= '<td>'.$data[0]['TopupP_iid'].'</td>';
		$str .= '<td>'.$data[0]['TopupP_iname'].'</td>';
		$str .= '<td>'.$data[0]['TopupP_iamount'].'</td>';
		$str .= '<td><button onClick="delpromotion('.$data[0]['TopupP_id'].',\''.Encrypt_Base64($data[0]['TopupP_id']).'\')" class="btn btn-danger btn-xs" data-title="Delete"><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
		return "ADDPROMOTION:TRUE#".$str;
	} else {
		return "ADDPROMOTION:FALSE";
	}
 }
 
 function TruemoneyConf(){
	$conn = db_connect();
	$str = "SELECT * FROM wzTopupConf_TBL";
	if (exec_num( $conn,$str ) == 0) {
		exec_query( $conn, "INSERT INTO wzTopupConf_TBL ([start_date] ,[end_date] ,[multiple]) VALUES ('".date("Y-m-d H:i:s", time())."','".date("Y-m-d H:i:s", time())."',1)");
	}
 }
 
 function DeleteItemCode($index){
	$conn = db_connect();
	$str = "SELECT ItemCodeIdx FROM wzItemCode_TBL WHERE ItemCodeIdx = '".$index."'";
	if (exec_num( $conn,$str ) == 1) {
		exec_query( $conn, "UPDATE wzItemCode_TBL SET ItemCodeDel = 1 WHERE ItemCodeIdx = '".$index."'");
		return "DELETEID:TRUE";
	}
	return "DELETEID:FALSE";
 }
 
 function DeleteReward($index){
	$conn = db_connect();
	$str = "SELECT FreeListIdx FROM wzItemFreeList_TBL WHERE FreeListIdx = '".$index."'";
	if (exec_num( $conn,$str ) == 1) {
		exec_query( $conn, "UPDATE wzItemFreeList_TBL SET FreeListDel = 1 WHERE FreeListIdx = '".$index."'");
		return "DELETEREWARD:TRUE";
	}
	return "DELETEREWARD:FALSE";
 }
 
 function DeleteSpcItem($index){
	$conn = db_connect();
	$str = "SELECT ItemNo FROM wzItemSell_TBL WHERE ItemNo = '".$index."'";
	if (exec_num( $conn,$str ) == 1) {
		exec_query( $conn, "UPDATE wzItemSell_TBL SET ItemDel = 1 WHERE ItemNo = '".$index."'");
		return "DELETESPCITEM:TRUE";
	}
	return "DELETESPCITEM:FALSE";
 }
 
 function DeleteBanned($index){
	$conn = db_connect();
	$str = "SELECT CustomerID FROM UsersData WHERE CustomerID = '".$index."' and [AccountStatus] = 200";
	if (exec_num( $conn,$str ) == 1) {
		exec_query( $conn, "UPDATE [UsersData] SET [AccountStatus] = 100 WHERE [CustomerID] = '".$index."'");
		exec_query( $conn, "UPDATE [Accounts] SET [AccountStatus] = 100 WHERE [CustomerID] = '".$index."'");
		return "DELETEBANNED:TRUE";
	}
	return "DELETEBANNED:FALSE";
 }
 
 function GetReward($index){
	$conn = db_connect();
	$data = GetdataReward(false,$index);
	$str = "SELECT * FROM wzItemFreeUse_TBL WHERE ItemFreeEmail = '".$_SESSION['username']."' and ItemFreeOrder = '".$index."'";
	if (exec_num( $conn,$str ) == 0) {
		$GPPoint = GetDonate($_SESSION['customerid']);
		if($GPPoint>=$data[0]['FreeListAmount']){
			FreeItemLogs($index, $_SESSION['username']);
			exec_query($conn, "UPDATE [wzDonate_TBL] SET d_amount -= '".$data[0]['FreeListAmount']."' WHERE d_customerid = '".$_SESSION['customerid']."' ");
			return itemtouser($data[0]['FreeListItemID'],$data[0]['FreeListQt'],$_SESSION['username'],'GETREWARD');
		} else {
			return "GETREWARD:FALSE";
		}
	} else {
		return "GETREWARD:USED";
	}
 }
 
 function DelImage($decode,$id){
	$rep = str_replace('storage/reports','../reports',$decode);
	if (file_exists($rep)) {
		if(unlink($rep)) {
			return "DELIMAGE:TRUE#".$id;
		} else {
			return "DELIMAGE:FALSE";
		}
	} else {
		return $rep."DELIMAGE:FALSE";
	}
 }

 function DeletePromotion($index){
	$conn = db_connect();
	$str = "SELECT TopupP_id FROM wzTopupP_TBL WHERE TopupP_id = '".$index."'";
	if (exec_num( $conn,$str ) == 1) {
		exec_query( $conn, "UPDATE wzTopupP_TBL SET TopupP_idel = 1 WHERE TopupP_id = '".$index."'");
		return "DELETEPROMOTION:TRUE";
	}
	return "DELETEPROMOTION:FALSE";
 }
 
 function delmap($index){
	$conn = db_connect();
	$str = "SELECT ItemMapIdx FROM wzItemMap_TBL WHERE ItemMapIdx = '".$index."'";
	if (exec_num( $conn,$str ) == 1) {
		exec_query( $conn, "UPDATE wzItemMap_TBL SET ItemMapDel = 1 WHERE ItemMapIdx = '".$index."'");
		return "DELETEADD:TRUE";
	}
	return "DELETEADD:FALSE";
 }
 
 function delpos($index){
	$conn = db_connect();
	$str = "SELECT PosID FROM wzItemPos_TBL WHERE PosID = '".$index."'";
	if (exec_num( $conn,$str ) == 1) {
		exec_query( $conn, "UPDATE wzItemPos_TBL SET PosDel = 1 WHERE PosID = '".$index."'");
		return "DELETEPOS:TRUE";
	}
	return "DELETEPOS:FALSE";
 }
 
 function AddMap($mapname, $mapid){
	$conn = db_connect();
	$str = "INSERT INTO [wzItemMap_TBL] ([ItemMapId],[ItemMapName])VALUES('".$mapid."','".$mapname."')";
	if (exec_query( $conn, $str)) {
		$data = GetdataMap();
		$str = '<tr id="delmap'.$data[0]['ItemMapIdx'].'">';
		$str .= '<td>'.$data[0]['ItemMapName'].'</td>';
		$str .= '<td><button onClick="delmap('.$data[0]['ItemMapIdx'].',\''.Encrypt_Base64($data[0]['ItemMapIdx']).'\')" class="btn btn-danger btn-xs" data-title="Delete"><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
		$opt = '<option id="delmapoption'.$data[0]['ItemMapIdx'].'" value="'.Encrypt_Base64($data[0]['ItemMapIdx']).'">'.$data[0]['ItemMapName'].'</option>';
		return "ADDMAP:TRUE#".$str."#".$opt;
	} else {
		return "ADDMAP:FALSE";
	}
 }
 
 function GenDataTableMap(){
	$data = GetdataMap();
	$str = '';
	foreach ($data as $row) {
		$str .= '<tr id="delmap'.$row['ItemMapIdx'].'">';
		$str .= '<td>'.$row['ItemMapName'].'</td>';
		$str .= '<td><button onClick="delmap('.$row['ItemMapIdx'].',\''.Encrypt_Base64($row['ItemMapIdx']).'\')" class="btn btn-danger btn-xs" data-title="Delete"><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
	}
	return $str;
 }
 function AddPos($placename, $datamap, $posX, $posY, $posZ, $pay){
	$conn = db_connect();
	$str = "INSERT INTO [wzItemPos_TBL] ([PosName],[PosMap],[PosVal],[PosGC])VALUES('".$placename."','".$datamap."','".$posX." ".$posY." ".$posZ." 180','".$pay."')";
	if (exec_query( $conn, $str)) {
		$data = GetdataPos();
		$mdata = GetdataMap($datamap);
		$str = '<tr id="delpos'.$data[0]['PosID'].'" '.($mdata[0]['ItemMapName']==''?'class="danger"':'').'>';
		$str .= '<td>'.($mdata[0]['ItemMapName']==''?'รอแก้ Line465':$mdata[0]['ItemMapName']).'</td>';
		$str .= '<td>'.$data[0]['PosName'].'</td>';
		$str .= '<td>'.$data[0]['PosVal'].'</td>';
		$str .= '<td>'.$data[0]['PosGC'].' GC</td>';
		$str .= '<td><button onClick="delpos('.$data[0]['PosID'].',\''.Encrypt_Base64($data[0]['PosID']).'\')" class="btn btn-danger btn-xs" data-title="Delete"><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
		return "ADDPOS:TRUE#".$str;
	} else {
		return "ADDPOS:FALSE";
	}
 }
	
 function GenDataTablePos(){
	$data = GetdataPos();
	$str = '';
	foreach ($data as $row) {
		$mdata = GetdataMap($row['PosMap']);
		$str .= '<tr id="delpos'.$row['PosID'].'"  '.($mdata[0]['ItemMapName']==''?'class="danger"':'').'>';
		$str .= '<td>'.($mdata[0]['ItemMapName']==''?'รอแก้ Line485':$mdata[0]['ItemMapName']).'</td>';
		$str .= '<td>'.$row['PosName'].'</td>';
		$str .= '<td>'.$row['PosVal'].'</td>';
		$str .= '<td>'.$row['PosGC'].' GC</td>';
		$str .= '<td><button onClick="delpos('.$row['PosID'].',\''.Encrypt_Base64($row['PosID']).'\')" class="btn btn-danger btn-xs" data-title="Delete"><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
	}
	return $str;
 }
 
 function AddSpcitem($itemid, $itemname, $opt1, $opt2, $opt3, $price, $quantity){
	$conn = db_connect();
	$str = "INSERT INTO [wzItemSell_TBL] ([ItemID],[ItemName],[Option1],[Option2],[Option3],[Price],[Qty])VALUES('".$itemid."','".$itemname."','".$opt1."','".$opt2."','".$opt3."','".$price."','".$quantity."')";
	if (exec_query( $conn, $str)) {
		$data = Getdataspcitem(true);
		$str = '<tr id="delspcitem'.$data[0]['ItemNo'].'">';
		$str .= '<td>'.$data[0]['ItemID'].'</td>';
		$str .= '<td>'.$data[0]['ItemName'].'</td>';
		$str .= '<td>'.$data[0]['Option1'].'</td>';
		$str .= '<td>'.$data[0]['Option2'].'</td>';
		$str .= '<td>'.$data[0]['Option3'].'</td>';
		$str .= '<td>'.$data[0]['Price'].' GC</td>';
		$str .= '<td>'.$data[0]['Qty'].' ชิ้น</td>';
		$str .= '<td><button onClick="delspcitem('.$data[0]['ItemNo'].',\''.Encrypt_Base64($data[0]['ItemNo']).'\')" class="btn btn-danger btn-xs" data-title="Delete"><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
		return "ADDSPCITEM:TRUE#".$str;
	} else {
		return "ADDSPCITEM:FALSE";
	}
 }
 
  function GenDataTableSpcItem(){
	$conn = db_connect();
	$data = Getdataspcitem();
	$str = '';
	foreach ($data as $row) {
		$str .= '<tr id="delspcitem'.$row['ItemNo'].'">';
		$str .= '<td>'.$row['ItemID'].'</td>';
		$str .= '<td>'.$row['ItemName'].'</td>';
		$str .= '<td>'.$row['Option1'].'</td>';
		$str .= '<td>'.$row['Option2'].'</td>';
		$str .= '<td>'.$row['Option3'].'</td>';
		$str .= '<td>'.$row['Price'].'</td>';
		$str .= '<td>'.$row['Qty'].'</td>';
		$str .= '<td><button onClick="delspcitem('.$row['ItemNo'].',\''.Encrypt_Base64($row['ItemNo']).'\')" class="btn btn-danger btn-xs" data-title="Delete"><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
	}
	return $str;
 }
 
 function AddReward($amount, $itemid, $quantity, $itemname){
	$conn = db_connect();
	$str = "INSERT INTO [wzItemFreeList_TBL] ([FreeListAmount],[FreeListItemID],[FreeListQt],[FreeListName])VALUES('".$amount."','".$itemid."','".$quantity."','".$itemname."')";
	if (exec_query( $conn, $str)) {
		$data = GetdataReward(true);
		$str = '<tr id="delreward'.$data[0]['FreeListIdx'].'">';
		$str .= '<td>'.$data[0]['FreeListAmount'].' บาท</td>';
		$str .= '<td>'.$data[0]['FreeListItemID'].'</td>';
		$str .= '<td>'.$data[0]['FreeListName'].'</td>';
		$str .= '<td>'.$data[0]['FreeListQt'].' ชิ้น</td>';
		$str .= '<td><button onClick="delreward('.$data[0]['FreeListIdx'].',\''.Encrypt_Base64($data[0]['FreeListIdx']).'\')" class="btn btn-danger btn-xs" data-title="Delete"><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
		return "ADDREWARD:TRUE#".$str;
	} else {
		return "ADDREWARD:FALSE";
	}
 }

 function GenDataTableReward(){
	$conn = db_connect();
	$data = GetdataReward();
	$str = '';
	foreach ($data as $row) {
		$str .= '<tr id="delreward'.$row['FreeListIdx'].'">';
		$str .= '<td>'.$row['FreeListAmount'].' บาท</td>';
		$str .= '<td>'.$row['FreeListItemID'].'</td>';
		$str .= '<td>'.$row['FreeListName'].'</td>';
		$str .= '<td>'.$row['FreeListQt'].' ชิ้น</td>';
		$str .= '<td><button onClick="delreward('.$row['FreeListIdx'].',\''.Encrypt_Base64($row['FreeListIdx']).'\')" class="btn btn-danger btn-xs" data-title="Delete"><span class="glyphicon glyphicon-trash"></span></button></td></tr>';
	}
	return $str;
 }
 
 function GenDataTableRewardMe($username){
	$conn = db_connect();
	$data = GetdataRewardMe($username);
	$str = '';
	$GPPoint = GetDonate($_SESSION['customerid']);
	foreach ($data as $row) {
		$data = GetdataReward(false,$row['FreeListIdx']);
		$Qry = "SELECT * FROM [wzItemFreeUse_TBL] where ItemFreeOrder='".$row['FreeListIdx']."' and ItemFreeEmail='".$username."'";
		$str .= '<tr>';
		$str .= '<td>'.$row['FreeListAmount'].' บาท</td>';
		$str .= '<td>'.$row['FreeListName'].'</td>';
		$str .= '<td>'.$row['FreeListQt'].' ชิ้น</td>';
		if(exec_num( $conn,$Qry)) {
			$str .= '<td><button class="btn btn-danger btn-xs" data-title="Delete" disabled><span class="glyphicon glyphicon-gift"> รับไอเทมรีวอร์ดสำเร็จ...!!</span></button></td></tr>';
		} else if($GPPoint<$data[0]['FreeListAmount']) {
			$str .= '<td><button class="btn btn-success btn-xs" data-title="Reward" disabled><span class="glyphicon glyphicon-gift"> ยอดเงินสะสมไม่พอ...!!</span></button></td></tr>';
		} else {
			$str .= '<td><button onClick="getreward('.$row['FreeListIdx'].',\''.Encrypt_Base64($row['FreeListIdx']).'\')" class="btn btn-success btn-xs" data-title="Reward" id="btnreward'.$row['FreeListIdx'].'"><span class="glyphicon glyphicon-gift" id="spanreward'.$row['FreeListIdx'].'"> รับไอเทมรีวอร์ด...!!</span></button></td></tr>';
		}
	} return $str;
 }
 
 function GetdataRewardMe($username){
	$conn = db_connect();
	$str = "SELECT * FROM wzItemFreeList_TBL where [FreeListDel]=0 order by FreeListAmount asc, FreeListIdx asc";
	$stmt = sqlsrv_query( $conn, $str );
	$post = array();
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
		$post[] = $row;
	}
	return $post;
 }
 
 function GetdataBanned($index=''){
	$conn = db_connect();
	$str = "SELECT [CustomerID],[AccountStatus] FROM [UsersData] where [AccountStatus] = '200'";
	if($index!='') {
		$str .= " and CustomerID = $index";
	} else {
		$str .= " order by CustomerID asc";
	}
	$stmt = sqlsrv_query( $conn, $str );
	$post = array();
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
		$post[] = $row;
	}
	return $post;
 }
 
 function GenDataTableBanned(){
	$conn = db_connect();
	$data = GetdataBanned();
	$str = '';
	foreach ($data as $row) {
		$str .= '<tr id="delbanned'.$row['CustomerID'].'">';
		$str .= '<td>'.$row['CustomerID'].'</td>';
		$str .= '<td>'.GetUserName($row['CustomerID']).'</td>';
		$str .= '<td><button onClick="delbanned('.$row['CustomerID'].',\''.Encrypt_Base64($row['CustomerID']).'\')" class="btn btn-danger btn-xs" data-title="Unbaned"><span class="fa fa-history"> ปลดแบน</span></button></td></tr>';
	} return $str;
 }
 
 function UseItemCode($username, $itemcodekey){
	$conn = db_connect();
	$str = "SELECT * FROM wzItemCode_TBL WHERE ItemCodeText = '".$itemcodekey."'";
	if (exec_num( $conn,$str ) == 1) {
		$array = sqlsrv_fetch_array(exec_query( $conn, $str), SQLSRV_FETCH_ASSOC);
		if(!AlreadyUseCode($username,$array['ItemCodeIdx'])) {
			if($array['ItemCodeType'] == 0) {
				if(UpdateRemainCode($array['ItemCodeIdx'])) {
					if(InsertDataUseCode($username,$array['ItemCodeIdx'])){
						return gctouser($array['ItemCodeQuantity'],$username,'SENDITEMCODE');
					} else {
						return "SENDITEMCODE:FALSE";
					}
				}
				return "SENDITEMCODE:NOTREMAIN";
			} else {
				if(UpdateRemainCode($array['ItemCodeIdx'])) {
					if(InsertDataUseCode($username,$array['ItemCodeIdx'])){
						return itemtouser($array['ItemCodeItemID'],$array['ItemCodeQuantity'],$username,'SENDITEMCODE');
					} else {
						return "SENDITEMCODE:FALSE";
					}
				}
				return "SENDITEMCODE:NOTREMAIN";
			}
		} else {
			return "SENDITEMCODE:USERISUSE";
		}
	} else {
		return "SENDITEMCODE:NOTCODE";
	}
	return "SENDITEMCODE:FALSE";
 }
 
 function SetupConf($conf_ip, $conf_user, $conf_pass, $conf_dbname, $conf_license, $conf_passkey, $conf_tmnid, $conf_adminid, $conf_md5){
	$arr = array( 'conf_ip' => $conf_ip , 'conf_user' => $conf_user , 'conf_pass' => $conf_pass , 'conf_dbname' => $conf_dbname , 'conf_true' => array(50, 90, 150, 300, 500, 1000) , 'conf_license' => $conf_license , 'conf_passkey' => $conf_passkey , 'conf_tmnid' => $conf_tmnid , 'conf_adminid' => $conf_adminid , 'conf_md5' => Decrypt_Base64($conf_md5) );
	writeFile(json_encode($arr));
	return "CONF:TRUE";
 }
 
 function InsertDataUseCode($ItemCodeUseUname,$ItemCodeUseidx){
	$conn = db_connect();
	$flag = false;
	$str = "INSERT INTO wzItemCodeUse_TBL ([ItemCodeUseidx],[ItemCodeUseUname],[ItemCodeUseTime]) VALUES ('".$ItemCodeUseidx."','".$ItemCodeUseUname."','".date("Y-m-d H:i:s", time())."')";
	if (exec_query( $conn, $str)) {
		$flag = true;
	}
	return $flag;
 }
 
 function AlreadyUseCode($ItemCodeUseUname,$ItemCodeUseidx){
	$conn = db_connect();
	$flag = false;
	$str = "SELECT ItemCodeUseid FROM wzItemCodeUse_TBL WHERE ItemCodeUseidx = $ItemCodeUseidx and ItemCodeUseUname = '".$ItemCodeUseUname."'";
	if (exec_num( $conn,$str ) == 1) {
		$flag = true;
	}
	return $flag;
 }
	
 function UpdateRemainCode($ItemCodeIdx){
	$conn = db_connect();
	$flag = false;
	$str = "SELECT ItemCodeIdx FROM wzItemCode_TBL WHERE ItemCodeIdx = $ItemCodeIdx and ItemCodeRemain > 0";
	if (exec_num( $conn,$str ) == 1) {
		$str = "UPDATE wzItemCode_TBL SET ItemCodeRemain -= 1 WHERE ItemCodeIdx = $ItemCodeIdx";
		if (exec_query( $conn, $str)) {
			$flag = true;
		}
	}
	return $flag;
 }
 
 function GetdataItemCodeUse($username){
	$conn = db_connect();
	$str = "SELECT * FROM wzItemCodeUse_TBL as cu, wzItemCode_TBL as c where c.ItemCodeIdx = cu.ItemCodeUseidx and cu.ItemCodeUseUname = '".$username."' order by ItemCodeUseid desc";
	$stmt = sqlsrv_query( $conn, $str );
	$post = array();
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
		$post[] = $row;
	}
	return $post;
 }
 
 function GenDataTableItemCodeUse($username){
	$data = GetdataItemCodeUse($username);
	$str = '';
	foreach ($data as $row) {
		$str .= '<td>'.$row['ItemCodeText'].'</td>';
		$str .= '<td>'.($row['ItemCodeType']==0?"GC":"ITEM").'</td>';
		$str .= '<td>'.$row['ItemCodeItemName'].'</td>';
		$str .= '<td>'.$row['ItemCodeQuantity'].' '.($row['ItemCodeType']==0?"GC":"รอแก้ Line 585").'</td>';
		$str .= '<td>'.$row['ItemCodeUseTime'].'</td></tr>';
	}
	return $str;
 }
 
 function UpdateEvent($start=0, $end=0, $multiple){
	$conn = db_connect();
	if($start == 0 && $end == 0) {
		$str = "UPDATE [wzTopupConf_TBL] SET multiple = 1";
	} else {
		$str = "UPDATE [wzTopupConf_TBL] SET start_date = '".$start."', end_date = '".$end."', multiple = '".$multiple."'";
	} 
	if (exec_query( $conn, $str)) {
		$str = 'เปิด #* '.$multiple.'#'.date("m/d/Y H:i:s A",$start).'#'.date("m/d/Y H:i:s A",$end);
		return "STARTMULTIPLE:TRUE#".$str;
	}
	return "STARTMULTIPLE:FALSE";
 }
 
 function AddBanned($banned){
	$conn = db_connect();
	$str = "SELECT [email] FROM [Accounts] where [email] = '".$banned."'";
	$array = sqlsrv_fetch_array(exec_query( $conn, $str), SQLSRV_FETCH_ASSOC);
	$customerid = GetCustomerID($banned);
	if (exec_num( $conn,$str ) == 1){
		$str = "SELECT [CustomerID] FROM [UsersData] where [CustomerID] = '".$customerid."' and [AccountStatus] = 100";
		if (exec_num( $conn,$str ) == 1){
			$str = "UPDATE [UsersData] SET [AccountStatus] = 200 WHERE [CustomerID] = '".$customerid."'";
			if (exec_query( $conn, $str)) {
				$data = GetdataBanned($customerid);
				$str = '<tr id="delbanned'.$data[0]['CustomerID'].'">';
				$str .= '<td>'.$data[0]['CustomerID'].'</td>';
				$str .= '<td>'.GetUserName($data[0]['CustomerID']).'</td>';
				$str .= '<td><button onClick="delbanned('.$data[0]['CustomerID'].',\''.Encrypt_Base64($data[0]['CustomerID']).'\')" class="btn btn-danger btn-xs" data-title="Unbaned"><span class="fa fa-history"> ปลดแบน</span></button></td></tr>';
				return "BANNED:TRUE#".$str;
			} else {
				return "BANNED:FALSE";
			}
		} else {
			return "BANNED:ALREADYBAN";
		}
	} else {
		return "BANNED:NOUSER";
	}
 }
	
 function FindChar($charname){
	$conn = db_connect();
	$str = "SELECT ac.[email] FROM [UsersChars] as uc ,[Accounts] as ac where uc.[CustomerID]=ac.[CustomerID] and uc.[Gamertag] = '".$charname."'";
	$stmt = sqlsrv_query( $conn, $str );
	$post = array();
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
		$post[] = $row;
	}
	return $post;
 }
 
 function HwidBanned($hardwareid, $cid, $unban=false) {
	$conn = db_connect();
	if($unban == false){
		$str = "SELECT [AccountStatus] FROM [Accounts] where [CustomerID] = '".$cid."' ";
		$str2 = "SELECT [AccountStatus] FROM [UsersData] where [CustomerID] = '".$cid."' ";
		$array = sqlsrv_fetch_array(exec_query( $conn, $str), SQLSRV_FETCH_ASSOC);
		$array2 = sqlsrv_fetch_array(exec_query( $conn, $str2), SQLSRV_FETCH_ASSOC);
		if ($array['AccountStatus'] != 202 && $array2['AccountStatus'] != 202){
			$str = "UPDATE [Accounts] SET [AccountStatus] = 202 WHERE [CustomerID] = '".$cid."' ";
			$str2 = "UPDATE [UsersData] SET [AccountStatus] = 202 WHERE [CustomerID] = '".$cid."' ";
			$str3 = "INSERT INTO [HWID_Ban] VALUES (".$hardwareid.", 9999)";
			if (exec_query( $conn, $str) && exec_query( $conn, $str2) && exec_query( $conn, $str3)) {
				return "HWIDBAN:TRUE";
			} else {
				return "HWIDBAN:FALSE";
			}
		} else {
			return "HWIDBAN:ALREADY";
		}
	} else {
		$str = "SELECT [AccountStatus] FROM [Accounts] where [CustomerID] = '".$cid."' ";
		$str2 = "SELECT [AccountStatus] FROM [UsersData] where [CustomerID] = '".$cid."' ";
		$str3 = "SELECT [HardwareID] FROM [HWID_Ban] where [HardwareID] = '".$hardwareid."' ";
		$array = sqlsrv_fetch_array(exec_query( $conn, $str), SQLSRV_FETCH_ASSOC);
		$array2 = sqlsrv_fetch_array(exec_query( $conn, $str2), SQLSRV_FETCH_ASSOC);
		if ($array['AccountStatus'] != 100 && $array2['AccountStatus'] != 100 && exec_num( $conn,$str3 ) == 1){
			$str = "UPDATE [Accounts] SET [AccountStatus] = 100 WHERE [CustomerID] = '".$cid."' ";
			$str2 = "UPDATE [UsersData] SET [AccountStatus] = 100 WHERE [CustomerID] = '".$cid."' ";
			$str3 = "DELETE FROM [HWID_Ban] WHERE [HardwareID] = '".$hardwareid."' ";
			if (exec_query( $conn, $str) && exec_query( $conn, $str2) && exec_query( $conn, $str3)) {
				return "HWIDUNBAN:TRUE";
			} else {
				return "HWIDUNBAN:FALSE";
			}
		} else {
			return "HWIDBAN:ALREADY";
		}
	}
 }
 
 function UnBanned($cid){
	$conn = db_connect();
	$str = "SELECT [AccountStatus] FROM [UsersData] where [CustomerID] = '".$cid."' ";
	$arr = sqlsrv_fetch_array(exec_query( $conn, $str));
	if($arr['AccountStatus'] != 100) {
		$str = "UPDATE [UsersData] SET [AccountStatus] = 100 WHERE [CustomerID] = '".$cid."' ";
		$str2 = "UPDATE [Accounts] SET [AccountStatus] = 100 WHERE [CustomerID] = '".$cid."' ";
		if (exec_query( $conn, $str) && exec_query( $conn, $str2)) {
			return "UNBAN:TRUE";
		} else {
			return "UNBAN:FALSE";
		}
	} else {
		return "UNBAN:ALREADY";
	}
 }
	
 function AuthenCheck($username,$endcode,$developer,$bool=true){
	global $_CONFIG;
	if( $_CONFIG['SERVER']['DEV'] == $username && $_CONFIG['SERVER']['DEV'] == Decrypt_Base64($endcode) && $developer == 126 ){
		return true;
	}
	if(!$bool) {
		session_destroy();
		header( "location: index.php" );
	}
	return false;
 }
 
 function writeFile($string){
	$fh = fopen("settings.json", 'w');
	fwrite($fh, $string);
	fclose($fh);
 }
 
 function GetMultiStatus(){
	$str = '';
	$str .= '<div style="padding: 5px 0px;">อัตราการคูณปัจจุบัน<span style="float: right" id="multi_num">กำลังดึงข้อมูล.....</span></div>';
	$str .= '<hr>';
	$str .= '<div style="padding: 5px 0px;">สถานะกิจกรรม<span style="float: right" id="multi_status">กำลังดึงข้อมูล.....</span></div>';
	$str .= '<div style="padding: 5px 0px;">อัตรการคูณที่กำลังรอ<span style="float: right" id="multi_wait">กำลังดึงข้อมูล.....</span></div>';
	$str .= '<div style="padding: 5px 0px;">วัน / เวลาเริ่มกิจกรรม<span style="float: right" id="multi_start">กำลังดึงข้อมูล.....</span></div>';
	$str .= '<div style="padding: 5px 0px;">วัน / เวลาหมดกิจกรรม<span style="float: right" id="multi_end">กำลังดึงข้อมูล.....</span></div>';
	return $str;
 }
 
 function GetChoice(){
	$str = '';
	$data = GetdataMultiple();
	$str .= '<option value="'.Encrypt_Base64(1).'" '.($data[0]['multiple']=='1'?"selected":"").'>1</option>';
	$str .= '<option value="'.Encrypt_Base64(2).'" '.($data[0]['multiple']=='2'?"selected":"").'>2</option>';
	$str .= '<option value="'.Encrypt_Base64(3).'" '.($data[0]['multiple']=='3'?"selected":"").'>3</option>';
	$str .= '<option value="'.Encrypt_Base64(4).'" '.($data[0]['multiple']=='4'?"selected":"").'>4</option>';
	$str .= '<option value="'.Encrypt_Base64(5).'" '.($data[0]['multiple']=='5'?"selected":"").'>5</option>';
	return $str;
 }
 
function GetMenu($bool){
	$str = '';
	if(AuthenCheck($_SESSION['username'],$_SESSION['encodename'],$_SESSION['authen'],$bool)){
		$str .= '<li class="dropdown">';
		$str .= '<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-wrench"></i>  จัดการระบบ';
		$str .= '<span class="caret"></span>';
		$str .= '</a>';
		$str .= '<ul class="dropdown-menu">';
		$str .= '<li><a href="?menu=refill_conf">ตั้งค่าระบบเติมเงิน</a></li>';
		$str .= '<li><a href="?menu=multiple_conf">ตั้งค่าอัตราการคูณ</a></li>';
		$str .= '<li><a href="?menu=reward_conf">ตั้งค่าเติมเงินสะสม</a></li>';
		$str .= '<li><a href="?menu=gencode_conf">ตั้งค่าไอเทมโค๊ด</a></li>';
		$str .= '<li><a href="?menu=spcitem_conf">ตั้งค่าไอเทมแรร์</a></li>';
		$str .= '<li><a href="?menu=teleport_conf">ตั้งค่าเทเลพอต</a></li>';
		$str .= '<li><a href="?menu=banned_conf">ตั้งค่า แบน/ปลดแบนไอดี</a></li>';
		$str .= '<li><a href="?menu=addpoint_conf">เพิ่ม GC/ส่งไอเทม แก่ผู้เล่น</a></li>';
		$str .= '<li><a href="?menu=report_conf">ตรวจรีพอร์ต</li>';
		$str .= '<li><a href="?menu=db2sql_conf">อัพเดต ItemDB ไปยัง SQL</li>';
		$str .= '<li><a href="">Comming Soon</a></li>';
		$str .= '</ul>';
		$str .= '</li>';
	}
	return $str;
 }
 
 function GetTrueAmount(){
	$str = '';
	$str .= "<select class='form-control' id='trueamount'>";
	$str .= "<option value='".Encrypt_Base64('')."'>เลือกข้อมูลของบัตร</option>";
	$str .= "<option value='".Encrypt_Base64(50)."'>50 บาท</option>";
	$str .= "<option value='".Encrypt_Base64(90)."'>90 บาท</option>";
	$str .= "<option value='".Encrypt_Base64(150)."'>150 บาท</option>";
	$str .= "<option value='".Encrypt_Base64(300)."'>300 บาท</option>";
	$str .= "<option value='".Encrypt_Base64(500)."'>500 บาท</option>";
	$str .= "<option value='".Encrypt_Base64(1000)."'>1000 บาท</option>";
	$str .= "</select>";
	return $str;
 }
 
 function GetChoiceMD5(){
	global $_CONFIG;
	$str = '';
	$str .= "<select class='form-control' id='conf_md5'>";
	$str .= "	<option value='".Encrypt_Base64(1)."' ".($_CONFIG['SERVER']['MD5']=='1'?'selected':'').">เปิด</option>";
	$str .= "	<option value='".Encrypt_Base64(0)."' ".($_CONFIG['SERVER']['MD5']=='0'?'selected':'').">ปิด</option>";
	$str .= "</select>";
	return $str;
 }
 
 function call_version() {
	if(function_exists('curl_init')) {
		$curl = curl_init('http://purchase.let-play.com/version.php');
		@curl_setopt($curl, CURLOPT_TIMEOUT, 10);
		@curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		@curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1;WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.81 Safari/537.36");
		$response = preg_replace('/\s+/', '', @curl_exec($curl));
		curl_close($curl);
		return $response;
	}
 }
 
 function showeventgc(){
	$conn = db_connect();
	$str = "SELECT multiple FROM wzTopupConf_TBL";
	$stmt = sqlsrv_query( $conn, $str );
	if ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
		$eventgc = 'วันนี้เติมเงิน x'.$row['multiple'].' ทุกราคาบัตร';
	} else {
		$eventgc = '<span style="color:#F00;">!Error : ไม่สามารถดึงข้อมูลกิจกรรมเติมเงินได้</span>';
	}
	return $eventgc;
 }
 
 function showtop10gc(){
	$conn = db_connect();
	$rank = 1;
	$query = "SELECT TOP 10 * FROM UsersData WHERE IsDeveloper = 0 ORDER BY GamePoints DESC";
	$result = sqlsrv_query( $conn, $query);
		while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
			$show .= '<tr>';
			$show .= '<td width="25">';
			$show .= $rank++;
			$show .= '</td>';
			$show .= '<td>';
			$show .= $row['CustomerID'];
			$show .= '</td>';
			$show .= '<td>';     
                                           
			$sql_customer= "SELECT Gamertag FROM UsersChars WHERE CustomerID='".$row["CustomerID"]."'";
			$sql_customer = sqlsrv_query( $conn, $sql_customer);
								
			if( sqlsrv_fetch( $sql_customer ) === false) {
				die( print_r( sqlsrv_errors(), true));
			}
								
			$customer = sqlsrv_get_field( $sql_customer, 0);
			$show .= $customer;
			$show .= '</td>';
			$show .= '<td>';
			$show .= $row['GamePoints'];
			$show .= '</td>';
			$show .= '</tr>';
		}
		return $show;
	;
 }
 function top10_bandit() {
	$conn = db_connect();
	$rank = 1;

	$query = "SELECT TOP 10 Reputation, Gamertag FROM UsersChars WHERE Reputation < 0 ORDER BY Reputation ASC";
	$result = sqlsrv_query( $conn, $query);

	while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {	
		$show .= '
		<a class="youplay-single-match" href="#">
        	<div class="pull-left">
        	    <div class="angled-img">
        	        <div class="img">
        	            <img src="https://cdn-html.nkdev.info/youplay/assets/images/dark/clan-navi.jpg" alt="พงศ์พิสุทธิ์ หมั่นเหมาะ">
        	        </div>
        	    </div>
        	    <h5 class="text-center">พงศ์พิสุทธิ์ หมั่นเหมาะ</h5>
        	</div>
        		<div class="pull-left ml-30">
        		    <h3 class="youplay-match-title">'. $row["Gamertag"] .'</h3>
        		    <div class="date">ค่าชื่อเสียงของผู้เล่น : '. $row['Reputation'] .'</div>
        		</div>
        	<div class="label youplay-match-count">'. $rank++ .'</div>
        	<div class="clearfix"></div>
    	</a>
		';
	}
	return $show;
 }

 function top10_police() {
	$conn = db_connect();
	$rank = 1;

	$query2 = "SELECT TOP 10 Reputation, Gamertag FROM UsersChars WHERE Reputation > 0 ORDER BY Reputation DESC";
	$result2 = sqlsrv_query( $conn, $query2);
	while( $row = sqlsrv_fetch_array( $result2, SQLSRV_FETCH_ASSOC)) {	
		$show .= '
		<a class="youplay-single-match" href="#">
        	<div class="pull-left">
        	    <div class="angled-img">
        	        <div class="img">
        	            <img src="https://cdn-html.nkdev.info/youplay/assets/images/dark/clan-navi.jpg" alt="พงศ์พิสุทธิ์ หมั่นเหมาะ">
        	        </div>
        	    </div>
        	    <h5 class="text-center">พงศ์พิสุทธิ์ หมั่นเหมาะ</h5>
        	</div>
        		<div class="pull-left ml-30">
        		    <h3 class="youplay-match-title">'. $row["Gamertag"] .'</h3>
        		    <div class="date">ค่าชื่อเสียงของผู้เล่น : '. $row['Reputation'] .'</div>
        		</div>
        	<div class="label youplay-match-count">'. $rank++ .'</div>
        	<div class="clearfix"></div>
    	</a>
		';
	}
	return $show;
 }
// Fram rank
 function top10_fram() {
	$conn = db_connect();
	$rank = 1;

	$query = "SELECT TOP 10 XP, Gamertag FROM UsersChars ORDER BY XP DESC";
	$result = sqlsrv_query( $conn, $query);

	while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {	
		$show .= '
		<a class="youplay-single-match" href="#">
        	<div class="pull-left">
        	    <div class="angled-img">
        	        <div class="img">
        	            <img src="https://cdn-html.nkdev.info/youplay/assets/images/dark/clan-navi.jpg" alt="พงศ์พิสุทธิ์ หมั่นเหมาะ">
        	        </div>
        	    </div>
        	    <h5 class="text-center">พงศ์พิสุทธิ์ หมั่นเหมาะ</h5>
        	</div>
        		<div class="pull-left ml-30">
        		    <h3 class="youplay-match-title">'. $row["Gamertag"] .'</h3>
        		    <div class="date">ค่าประสบการณ์ของผู้เล่น '. $row['XP'] .'</div>
        		</div>
        	<div class="label youplay-match-count">'. $rank++ .'</div>
        	<div class="clearfix"></div>
    	</a>
		';
	}
	return $show;
 }
 
 //GET SERVER STATUS
 function getserverstatus($param){
	 global $_CONFIG;
	if($param == 'server') {
		$xml = simplexml_load_file($_CONFIG['SERVER']['STATUS_URL']);
		foreach($xml->ServerInfo as $data) {
			$status = $data['status'];
		}
		if($status == 'Online' || $status == 'ONLINE'){
			$status = 'ONLINE';
		} else {
			$status = 'OFFLINE';
		}
		return $status;
	} else if($param == 'online') {
		$tsql = "SELECT uc.LastUpdateDate, uc.Gamertag, uc.CustomerID, ud.CustomerID, ud.IsDeveloper, ud.AccountType From UsersChars as uc JOIN UsersData as ud ON uc.CustomerID = ud.CustomerID      
		WHERE DATEDIFF(MINUTE, uc.LastUpdateDate, GETDATE()) <= 1";
		$conn = db_connect();
		$online = exec_num($conn, $tsql);
		$row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
		return $online;
	} else if($param == 'accounts') {
		$tsql = "SELECT CustomerID FROM Accounts";
		$conn = db_connect();
		$accounts = exec_num($conn, $tsql);
		return $accounts;
	} else if($param == 'character') {
		$tsql = "SELECT CharID FROM UsersChars";
		$conn = db_connect();
		$character = exec_num($conn, $tsql);
		return $character;
	}
 }
 
 function spc_itemsell() {
	$tsql = "SELECT * FROM wzItemSell_TBL";
	$conn = db_connect();
	$stmt = exec_query($conn, $tsql);
	$count = exec_num($conn, $tsql);
	for( $i=1;$i<=$count;$i++ ) {
		$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
		$imgitem = get_dbxml($row["ItemID"]);
		if($row["ItemDel"] == 0) {
			$item .= "<div class='box'>";
			$item .= "<div class='img-resize'>";
			$item .= "<img src='".$imgitem['img_url']."'>";
			$item .= "</div>";
			$item .= "<form>";
			$item .= "<input type='hidden' id='usernameplayer".$i."' value='".$_SESSION['username']."'>";
			$item .= "<input type='hidden' id='buyitemid".$i."' value='".$row["ItemID"]."'>";
			$item .= "<br><span class='spc-name'>".$row["ItemName"]."</span> <br>";
			$item .= "<span>จำนวน ".$row["Qty"]." ชิ้น</span> <br><br>";
			$item .= "<span>คุณสมบัติพิเศษ : </span> <br>";
			if(($row["Option1"] && $row["Option2"] && $row["Option3"]) != "") {
				$item .= "<span class='spc-detail'>".$row["Option1"]." , ".$row["Option2"]." , ".$row["Option3"]."</span> <br><br>";
			} else {
				$item .= "<span class='spc-detail'>-</span> <br><br>";
			}
			$item .= "<button type='submit' id='submit-buyitem' class='btn btn-success' value='".$i."' onclick='return false'><i class='fa fa-credit-card'></i> ซื้อ ".$row["Price"]." WP</button><br>";
			$item .= "</form>";
			$item .= "</div>";
		}
	}
	return $item;
 }
 
 function get_dbxml($id) {
	global $_CONFIG;
	
	if(file_get_contents($_CONFIG['FUNCTIONS']['ITEMDB_URL']) == FALSE) {
		$xml =  file_get_contents(str_replace('storage','..',$_CONFIG['FUNCTIONS']['ITEMDB_URL']));
	} else {
		$xml = file_get_contents($_CONFIG['FUNCTIONS']['ITEMDB_URL']);
	}
	
	$xml = simplexml_load_string($xml);
	$json = json_encode($xml);
	$arr = json_decode($json,TRUE);

	//X-- อาวุธ 
	foreach ($arr["WeaponsArmory"]["Weapon"] as $row){
		$itemID =  $row["@attributes"]["itemID"];
		$name =  $row["Store"]["@attributes"]["name"];
		$img = $row["Store"]["@attributes"]["icon"];
		$d = str_replace('$Data/Weapons/StoreIcons',$_CONFIG['FUNCTIONS']['PNG_URL'],$img);
		$url = str_replace('.dds','.png',$d);
	
		if($itemID == $id) {
			return array('itemID'=>$itemID,'name'=>$name,'img_url'=>$url);
		}
	}
	
	//X ชุดเกราะ
	foreach ($arr["GearArmory"]["Gear"] as $row){
		$itemID =  $row["@attributes"]["itemID"];
		$name =  $row["Store"]["@attributes"]["name"];
		$img = $row["Store"]["@attributes"]["icon"];
		$d = str_replace('$Data/Weapons/StoreIcons',$_CONFIG['FUNCTIONS']['PNG_URL'],$img);
		$url = str_replace('.dds','.png',$d);
		
		if($itemID == $id) {
			return array('itemID'=>$itemID,'name'=>$name,'img_url'=>$url);
		}
	}
	
	//X กระเป๋า
	foreach ($arr["BackpackArmory"]["Backpack"] as $row){
		$itemID =  $row["@attributes"]["itemID"];
		$name =  $row["Store"]["@attributes"]["name"];
		$img = $row["Store"]["@attributes"]["icon"];
		$d = str_replace('$Data/Weapons/StoreIcons',$_CONFIG['FUNCTIONS']['PNG_URL'],$img);
		$url = str_replace('.dds','.png',$d);
		
		if($itemID == $id) {
			return array('itemID'=>$itemID,'name'=>$name,'img_url'=>$url);
		}
	}
	
	//X อาหาร
	foreach ($arr["FoodArmory"]["Item"] as $row){
		$itemID =  $row["@attributes"]["itemID"];
		$name =  $row["Store"]["@attributes"]["name"];
		$img = $row["Store"]["@attributes"]["icon"];
		$d = str_replace('$Data/Weapons/StoreIcons',$_CONFIG['FUNCTIONS']['PNG_URL'],$img);
		$url = str_replace('.dds','.png',$d);
		
		if($itemID == $id) {
			return array('itemID'=>$itemID,'name'=>$name,'img_url'=>$url);
		}
	}
	
	//X ใบคราฟ
	foreach ($arr["CraftComponentsArmory"]["Item"] as $row){
		$itemID =  $row["@attributes"]["itemID"];
		$name =  $row["Store"]["@attributes"]["name"];
		$img = $row["Store"]["@attributes"]["icon"];
		$d = str_replace('$Data/Weapons/StoreIcons',$_CONFIG['FUNCTIONS']['PNG_URL'],$img);
		$url = str_replace('.dds','.png',$d);
		
		if($itemID == $id) {
			return array('itemID'=>$itemID,'name'=>$name,'img_url'=>$url);
		}
	}
	
	//X ตัวละคร
	foreach ($arr["HeroArmory"]["Hero"] as $row){
		$itemID =  $row["@attributes"]["itemID"];
		$name =  $row["Store"]["@attributes"]["name"];
		$img = $row["Store"]["@attributes"]["icon"];
		$d = str_replace('$Data/Weapons/StoreIcons',$_CONFIG['FUNCTIONS']['PNG_URL'],$img);
		$url = str_replace('.dds','.png',$d);
		
		if($itemID == $id) {
			return array('itemID'=>$itemID,'name'=>$name,'img_url'=>$url);
		}
	}
	
	//X กระสุน & ของแต่งปืน
	foreach ($arr["AttachmentArmory"]["Attachment"] as $row){
		$itemID =  $row["@attributes"]["itemID"];
		$name =  $row["Store"]["@attributes"]["name"];
		$img = $row["Store"]["@attributes"]["icon"];
		$d = str_replace('$Data/Weapons/StoreIcons',$_CONFIG['FUNCTIONS']['PNG_URL'],$img);
		$url = str_replace('.dds','.png',$d);
		
		if($itemID == $id) {
			return array('itemID'=>$itemID,'name'=>$name,'img_url'=>$url);
		}
	}
 }
 
 function queryitemdb() {
	 
	global $_CONFIG;
	 
	$svName = $_CONFIG['SERVER']['IP'];
	$conn_info = array(
      "Database" => $_CONFIG['SERVER']['DB'],
      "UID" => $_CONFIG['SERVER']['USER'],
      "PWD" => $_CONFIG['SERVER']['PASS'],
      "CharacterSet" => "UTF-8",
      );
	  
	$conn = sqlsrv_connect($svName, $conn_info);
	$data = simplexml_load_file($_CONFIG['FUNCTIONS']['ITEMDB_URL']);
	if($data == TRUE) {
		return TRUE;
	} else {
		$data = simplexml_load_file(str_replace('storage','..',$_CONFIG['FUNCTIONS']['ITEMDB_URL']));
	}
	if ($data == FALSE) {
		return "ADDITEMDB:XMLFALSE";   
	}
	
	foreach( $data->WeaponsArmory->Weapon as $tmp_data ){
   $sql = "SELECT * FROM [dbo].[Items_Weapons] WHERE [ItemID] = '".$tmp_data['itemID']."'";
   $stmt = sqlsrv_query($conn, $sql , array(), array("Scrollable"=>"buffered"));

   echo "ItemID: ".$tmp_data['itemID']."|-|Name: ".$tmp_data->Store['name']." ";
   if(sqlsrv_num_rows($stmt) == 0){
      $sql_cmd = "INSERT INTO [dbo].[Items_Weapons] VALUES (
         ".$tmp_data['itemID']."
         ,N'".($tmp_data['FNAME']?$tmp_data['FNAME']:substr($tmp_data->Model['file'],26,strlen($tmp_data->Model['file'])-30))."'
         ,".$tmp_data['category']."
         ,N'".$tmp_data->Store['name']."'
         ,N'".str_replace("'","''",$tmp_data->Store['desc'])."'
         ,N'".trim($tmp_data->Model['muzzlerOffset.x']." "
      		.$tmp_data->Model['muzzlerOffset.y']." "
      		.$tmp_data->Model['muzzlerOffset.z'])."'
         ,N'".$tmp_data->MuzzleModel['file']."'
         ,N'".$tmp_data->Animation['type']."'
         ,N'".$tmp_data->PrimaryFire['bullet']."'
         ,N'".$tmp_data->Sound['shoot']."'
         ,N'".$tmp_data->Sound['reload']."'
         ,".(double)$tmp_data->PrimaryFire['damage']."
         ,".($tmp_data->PrimaryFire['immediate'] == 'true'?1:0)."
         ,".(double)$tmp_data->PrimaryFire['mass']."
         ,".(int)$tmp_data->PrimaryFire['speed']."
         ,".(double)$tmp_data->PrimaryFire['decay']."
         ,".(double)$tmp_data->PrimaryFire['area']."
         ,".(double)$tmp_data->PrimaryFire['delay']."
         ,".(double)$tmp_data->PrimaryFire['timeout']."
         ,".(int)$tmp_data->PrimaryFire['numShells']."
         ,".(int)$tmp_data->PrimaryFire['clipSize']."
         ,".(double)$tmp_data->PrimaryFire['reloadTime']."
         ,".(double)$tmp_data->PrimaryFire['activeReloadTick']."
         ,".(double)$tmp_data->PrimaryFire['rateOfFire']."
         ,".(double)$tmp_data->PrimaryFire['spread']."
         ,".(double)$tmp_data->PrimaryFire['recoil']."
         ,".(double)$tmp_data->PrimaryFire['numgrenades']."
         ,N'".$tmp_data->PrimaryFire['grenadename']."'
         ,N'".$tmp_data->PrimaryFire['firemode']."'
         ,30
         ,N'".$tmp_data->PrimaryFire['ScopeType']."'
         ,".(double)$tmp_data->PrimaryFire['ScopeZoom']."
         ,0 ,0 ,0 ,0 ,0
         ,".(double)$tmp_data->Store['LevelRequired']."
         ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0
         ,".(double)$tmp_data['upgrade']."
         ,".(double)$tmp_data->FPS['IsFPS']."
         ,".(double)$tmp_data->FPS['i0']."
         ,".(double)$tmp_data->FPS['i1']."
         ,".(double)$tmp_data->FPS['i2']."
         ,".(double)$tmp_data->FPS['i3']."
         ,".(double)$tmp_data->FPS['i4']."
         ,".(double)$tmp_data->FPS['i5']."
         ,".(double)$tmp_data->FPS['i6']."
         ,".(double)$tmp_data->FPS['i7']."
         ,".(double)$tmp_data->FPS['i8']."
         ,".(double)$tmp_data->FPS['d0']."
         ,".(double)$tmp_data->FPS['d1']."
         ,".(double)$tmp_data->FPS['d2']."
         ,".(double)$tmp_data->FPS['d3']."
         ,".(double)$tmp_data->FPS['d4']."
         ,".(double)$tmp_data->FPS['d5']."
         ,".(double)$tmp_data->FPS['d6']."
         ,".(double)$tmp_data->FPS['d7']."
         ,".(double)$tmp_data->FPS['d8']."
         ,N'".($tmp_data->Model['AnimPrefix']?$tmp_data->Model['AnimPrefix']:$tmp_data['FNAME'])."'
         ,".(int)$tmp_data['Weight']."
         ,".(int)$tmp_data->Dur['u']."
         ,".(int)$tmp_data->Dur['r1']."
         ,".(int)$tmp_data->Dur['r2']."
         ,".(int)$tmp_data->Dur['r3']."
         ,".(int)$tmp_data->Res['r1']."
         ,".(int)$tmp_data->Res['r2']."
         ,".(int)$tmp_data->Res['r3'].")";
      echo "|-|Status: New!<br>"; 
   }else{
      $sql_cmd = "UPDATE [dbo].[Items_Weapons]
      SET [FNAME] = N'".($tmp_data['FNAME']?$tmp_data['FNAME']:substr($tmp_data->Model['file'],26,strlen($tmp_data->Model['file'])-30))."'
         ,[Category] = ".$tmp_data['category']."
         ,[Name] = N'".$tmp_data->Store['name']."'
         ,[Description] = N'".str_replace("'","''",$tmp_data->Store['desc'])."'
         ,[MuzzleOffset] = N'".trim($tmp_data->Model['muzzlerOffset.x']." ".$tmp_data->Model['muzzlerOffset.y']." ".$tmp_data->Model['muzzlerOffset.z'])."'
         ,[MuzzleParticle] = N'".$tmp_data->MuzzleModel['file']."'
         ,[Animation] = N'".$tmp_data->Animation['type']."'
         ,[BulletID] = N'".$tmp_data->PrimaryFire['bullet']."'
         ,[Sound_Shot] = N'".$tmp_data->Sound['shoot']."'
         ,[Sound_Reload] = N'".$tmp_data->Sound['reload']."'
         ,[Damage] = ".(double)$tmp_data->PrimaryFire['damage']."
         ,[isImmediate] = ".($tmp_data->PrimaryFire['immediate'] == 'true'?1:0)."
         ,[Mass] = ".(double)$tmp_data->PrimaryFire['mass']."
         ,[Speed] = ".(int)$tmp_data->PrimaryFire['speed']."
         ,[DamageDecay] = ".(double)$tmp_data->PrimaryFire['decay']."
         ,[Area] = ".(double)$tmp_data->PrimaryFire['area']."
         ,[Delay] = ".(double)$tmp_data->PrimaryFire['delay']."
         ,[Timeout] = ".(double)$tmp_data->PrimaryFire['timeout']."
         ,[NumClips] = ".(int)$tmp_data->PrimaryFire['numShells']."
         ,[Clipsize] = ".(int)$tmp_data->PrimaryFire['clipSize']."
         ,[ReloadTime] = ".(double)$tmp_data->PrimaryFire['reloadTime']."
         ,[ActiveReloadTick] = ".(double)$tmp_data->PrimaryFire['activeReloadTick']."
         ,[RateOfFire] = ".(double)$tmp_data->PrimaryFire['rateOfFire']."
         ,[Spread] = ".(double)$tmp_data->PrimaryFire['spread']."
         ,[Recoil] = ".(double)$tmp_data->PrimaryFire['recoil']."
         ,[NumGrenades] = ".(double)$tmp_data->PrimaryFire['numgrenades']."
         ,[GrenadeName] = N'".$tmp_data->PrimaryFire['grenadename']."'
         ,[Firemode] = N'".$tmp_data->PrimaryFire['firemode']."'
         ,[ScopeType] = N'".$tmp_data->PrimaryFire['ScopeType']."'
         ,[ScopeZoom] = ".(double)$tmp_data->PrimaryFire['ScopeZoom']."
         ,[LevelRequired] = ".(double)$tmp_data->Store['LevelRequired']."
         ,[IsUpgradeable] = ".(double)$tmp_data['upgrade']."
         ,[IsFPS] = ".(double)$tmp_data->FPS['IsFPS']."
         ,[FPSSpec0] = ".(double)$tmp_data->FPS['i0']."
         ,[FPSSpec1] = ".(double)$tmp_data->FPS['i1']."
         ,[FPSSpec2] = ".(double)$tmp_data->FPS['i2']."
         ,[FPSSpec3] = ".(double)$tmp_data->FPS['i3']."
         ,[FPSSpec4] = ".(double)$tmp_data->FPS['i4']."
         ,[FPSSpec5] = ".(double)$tmp_data->FPS['i5']."
         ,[FPSSpec6] = ".(double)$tmp_data->FPS['i6']."
         ,[FPSSpec7] = ".(double)$tmp_data->FPS['i7']."
         ,[FPSSpec8] = ".(double)$tmp_data->FPS['i8']."
         ,[FPSAttach0] = ".(double)$tmp_data->FPS['d0']."
         ,[FPSAttach1] = ".(double)$tmp_data->FPS['d1']."
         ,[FPSAttach2] = ".(double)$tmp_data->FPS['d2']."
         ,[FPSAttach3] = ".(double)$tmp_data->FPS['d3']."
         ,[FPSAttach4] = ".(double)$tmp_data->FPS['d4']."
         ,[FPSAttach5] = ".(double)$tmp_data->FPS['d5']."
         ,[FPSAttach6] = ".(double)$tmp_data->FPS['d6']."
         ,[FPSAttach7] = ".(double)$tmp_data->FPS['d7']."
         ,[FPSAttach8] = ".(double)$tmp_data->FPS['d8']."
         ,[AnimPrefix] = N'".($tmp_data->Model['AnimPrefix']?$tmp_data->Model['AnimPrefix']:$tmp_data['FNAME'])."'
         ,[Weight] = ".(int)$tmp_data['Weight']."
         ,[DurabilityUse] = ".(double)$tmp_data->Dur['u']."
         ,[RepairAmount] = ".(double)$tmp_data->Dur['r1']."
         ,[PremRepairAmount] = ".(double)$tmp_data->Dur['r2']."
         ,[RepairPriceGD] = ".(double)$tmp_data->Dur['r3']."
         ,[ResWood] = ".(int)$tmp_data->Res['r1']."
         ,[ResStone] = ".(int)$tmp_data->Res['r2']."
         ,[ResMetal] = ".(int)$tmp_data->Res['r3']."
   WHERE [ItemID] = '".$tmp_data['itemID']."'";
   echo "|-|Status: Update<br>"; 
   }
   $stmt = sqlsrv_query($conn, $sql_cmd); 
  }

foreach( $data->FoodArmory->Item as $tmp_data ){
   $sql = "SELECT * FROM [dbo].[Items_Weapons] WHERE [ItemID] = '".$tmp_data['itemID']."'";
   $stmt = sqlsrv_query($conn, $sql , array(), array("Scrollable"=>"buffered"));

   echo "ItemID: ".$tmp_data['itemID']."|-|Name: ".$tmp_data->Store['name'];
   if(sqlsrv_num_rows($stmt) == 0){
      $sql_cmd = "INSERT INTO [dbo].[Items_Weapons] VALUES (
         ".$tmp_data['itemID']."
         ,N'".substr($tmp_data->Model['file'],26,strlen($tmp_data->Model['file'])-30)."'
         ,".$tmp_data['category']."
         ,N'".$tmp_data->Store['name']."'
         ,N'".str_replace("'","''",$tmp_data->Store['desc'])."'
         ,N'' ,N'' ,N'' ,N'' ,N'' ,N'' ,0 ,0 ,0 ,0 ,0
         ,".(double)$tmp_data->Property['stamina']."
         ,0 ,0 ,0
         ,".(int)$tmp_data->Property['shopSS']."
         ,".(double)$tmp_data->Property['health']."
         ,0 
         ,".(double)$tmp_data->Property['toxicity']."
         ,".(double)$tmp_data->Property['water']."
         ,".(double)$tmp_data->Property['food']."
         ,0 ,N'' ,N'' ,30 ,N'' ,0 ,0 ,0 ,0 ,0 ,0
         ,".(double)$tmp_data->Store['LevelRequired']."
         ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,N''
         ,".(int)$tmp_data['Weight']."
         ,0 ,0 ,0 ,0 ,0 ,0 ,0)";
      echo "|-|Status: New!<br>"; 
   }else{
      $sql_cmd = "UPDATE [dbo].[Items_Weapons]
       SET [FNAME] = N'".substr($tmp_data->Model['file'],26,strlen($tmp_data->Model['file'])-30)."'
         ,[Category] = ".$tmp_data['category']."
         ,[Name] = N'".$tmp_data->Store['name']."'
         ,[Description] = N'".str_replace("'","''",$tmp_data->Store['desc'])."'
         ,[Area] = ".(double)$tmp_data->Property['stamina']."
         ,[Clipsize] = ".(int)$tmp_data->Property['shopSS']."
         ,[ReloadTime] = ".(double)$tmp_data->Property['health']."
         ,[RateOfFire] = ".(double)$tmp_data->Property['toxicity']."
         ,[Spread] = ".(double)$tmp_data->Property['water']."
         ,[Recoil] = ".(double)$tmp_data->Property['food']."
         ,[LevelRequired] = ".(double)$tmp_data->Store['LevelRequired']."       
         ,[Weight] = ".(int)$tmp_data['Weight']."
      WHERE [ItemID] = ".$tmp_data['itemID'];
   echo "|-|Status: Update<br>"; 
   }
   $stmt = sqlsrv_query($conn, $sql_cmd);
}

foreach( $data->VehicleArmory->Item as $tmp_data ){
   $sql = "SELECT * FROM [dbo].[Items_Weapons] WHERE [ItemID] = '".$tmp_data['itemID']."'";
   $stmt = sqlsrv_query($conn, $sql , array(), array("Scrollable"=>"buffered"));

   echo "ItemID: ".$tmp_data['itemID']."|-|Name: ".$tmp_data->Store['name'];
   if(sqlsrv_num_rows($stmt) == 0){
      $sql_cmd = "INSERT INTO [dbo].[Items_Weapons] VALUES (
         ".$tmp_data['itemID']."
         ,N'".$tmp_data->Property['fname']."'
         ,".$tmp_data['category']."
         ,N'".$tmp_data->Store['name']."'
         ,N'".str_replace("'","''",$tmp_data->Store['desc'])."'
         ,N'' ,N'' ,N'' ,N'' ,N'' ,N'' ,0 ,0 ,0 ,0 ,0
         ,".(double)$tmp_data->Property['fuel']."
         ,0 ,0 ,0 ,0
         ,".(double)$tmp_data->Property['durability']."
         ,".(double)$tmp_data->Property['armor']."
         ,0
         ,".(double)$tmp_data->Property['torque']."
         ,".(double)$tmp_data->Property['omega']."
         ,0 ,N'' ,N'' ,30 ,N'' ,0 ,0 ,0 ,0 ,0 ,0 ,0
         ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,N''
         ,".(int)$tmp_data['Weight']."
         ,0 ,0 ,0 ,0 ,0 ,0 ,0)";
      echo "|-|Status: New!<br>"; 
   }else{
      $sql_cmd = "UPDATE [dbo].[Items_Weapons]
      SET [FNAME] = N'".$tmp_data->Property['fname']."'
         ,[Category] = ".$tmp_data['category']."
        ,[Name] = N'".$tmp_data->Store['name']."'
        ,[Description] = N'".str_replace("'","''",$tmp_data->Store['desc'])."'
        ,[Area] = ".(double)$tmp_data->Property['fuel']."
        ,[ReloadTime] = ".(double)$tmp_data->Property['durability']."
        ,[ActiveReloadTick] = ".(double)$tmp_data->Property['armor']."
        ,[Spread] = ".(double)$tmp_data->Property['torque']."
        ,[Recoil] = ".(double)$tmp_data->Property['omega']."
      WHERE [ItemID] = ".$tmp_data['itemID'];
      echo "|-|Status: Update<br>"; 
   }
   $stmt = sqlsrv_query($conn, $sql_cmd);
}

foreach( $data->CraftComponentsArmory->Item as $tmp_data ){
   $sql = "SELECT * FROM [dbo].[Items_Generic] WHERE [ItemID] = '".$tmp_data['itemID']."'";
   $stmt = sqlsrv_query($conn, $sql , array(), array("Scrollable"=>"buffered"));

   echo "ItemID: ".$tmp_data['itemID']."|-|Name: ".$tmp_data->Store['name'];
   if(sqlsrv_num_rows($stmt) == 0){
      $sql_cmd = "INSERT INTO [dbo].[Items_Generic] VALUES (
         ".$tmp_data['itemID']."
         ,N'".substr($tmp_data->Model['file'],26,strlen($tmp_data->Model['file'])-30)."'
         ,".$tmp_data['category']."
         ,N'".$tmp_data->Store['name']."'
         ,N'".str_replace("'","''",$tmp_data->Store['desc'])."'
         ,0 ,0 ,0 ,0 ,0
         ,".(double)$tmp_data->Store['LevelRequired']."
         ,0 ,0 ,0 ,0 
         ,".(int)$tmp_data['Weight']."
         ,0 ,0 ,0)";
      echo "|-|Status: New!<br>"; 
   }else{
      $sql_cmd = "UPDATE [dbo].[Items_Generic]
       SET [FNAME] = N'".substr($tmp_data->Model['file'],26,strlen($tmp_data->Model['file'])-30)."'
         ,[Category] = ".$tmp_data['category']."
         ,[Name] = N'".$tmp_data->Store['name']."'
         ,[Description] = N'".str_replace("'","''",$tmp_data->Store['desc'])."'
         ,[LevelRequired] = ".(double)$tmp_data->Store['LevelRequired']."
         ,[Weight] = ".(int)$tmp_data['Weight']."
      WHERE [ItemID] = ".$tmp_data['itemID'];
      echo "|-|Status: Update<br>"; 
   }
   $stmt = sqlsrv_query($conn, $sql_cmd);
}

foreach( $data->CraftRecipeArmory->Item as $tmp_data ){
   $sql = "SELECT * FROM [dbo].[Items_Generic] WHERE [ItemID] = '".$tmp_data['itemID']."'";
   $stmt = sqlsrv_query($conn, $sql , array(), array("Scrollable"=>"buffered"));

   echo "ItemID: ".$tmp_data['itemID']."|-|Name: ".$tmp_data->Store['name'];
   if(sqlsrv_num_rows($stmt) == 0){
      $sql_cmd = "INSERT INTO [dbo].[Items_Generic] VALUES (
         ".$tmp_data['itemID']."
         ,N'".substr($tmp_data->Model['file'],26,strlen($tmp_data->Model['file'])-30)."'
         ,".$tmp_data['category']."
         ,N'".$tmp_data->Store['name']."'
         ,N'".str_replace("'","''",$tmp_data->Store['desc'])."'
         ,0 ,0 ,0 ,0 ,0
         ,".(double)$tmp_data->Store['LevelRequired']."
         ,0 ,0 ,0 ,0
         ,".(int)$tmp_data['Weight']."
         ,0 ,0 ,0)";
      echo "|-|Status: New!<br>"; 
   }else{
      $sql_cmd = "UPDATE [dbo].[Items_Generic]
         SET [FNAME] = N'".substr($tmp_data->Model['file'],26,strlen($tmp_data->Model['file'])-30)."'
            ,[Category] = ".$tmp_data['category']."
            ,[Name] = N'".$tmp_data->Store['name']."'
            ,[Description] = N'".str_replace("'","''",$tmp_data->Store['desc'])."'
            ,[LevelRequired] = ".(double)$tmp_data->Store['LevelRequired']."
            ,[Weight] = ".(int)$tmp_data['Weight']."
         WHERE [ItemID] = ".$tmp_data['itemID'];
      echo "|-|Status: Update<br>"; 
   }
   $stmt = sqlsrv_query($conn, $sql_cmd);
}

foreach( $data->GearArmory->Gear as $tmp_data ){
   $sql = "SELECT * FROM [dbo].[Items_Gear] WHERE [ItemID] = '".$tmp_data['itemID']."'";
   $stmt = sqlsrv_query($conn, $sql , array(), array("Scrollable"=>"buffered"));

   echo "ItemID: ".$tmp_data['itemID']."|-|Name: ".$tmp_data->Store['name'];
   if(sqlsrv_num_rows($stmt) == 0){
      $sql_cmd = "INSERT INTO [dbo].[Items_Gear] VALUES (
         ".$tmp_data['itemID']."
         ,N'".substr($tmp_data->Model['file'],29,strlen($tmp_data->Model['file'])-33)."'
         ,N'".str_replace("'","''",$tmp_data->Store['name'])."'
         ,N'".str_replace("'","''",$tmp_data->Store['desc'])."'
         ,".$tmp_data['category']."
         ,".(int)$tmp_data['Weight']."
         ,".(int)$tmp_data->Armor['damagePerc']."
         ,".(int)$tmp_data->Armor['damageMax']."
         ,".(int)$tmp_data->Armor['bulkiness']."
         ,".(int)$tmp_data->Armor['inaccuracy']."
         ,".(int)$tmp_data->Armor['stealth']."
         ,0 ,0 ,0 ,0 ,0
         ,".(int)$tmp_data->Armor['ProtectionLevel']."
         ,".(double)$tmp_data->Store['LevelRequired']."
         ,0 ,0 ,0 ,0
         ,".(int)$tmp_data->Dur['u']."
         ,".(int)$tmp_data->Dur['r1']."
         ,".(int)$tmp_data->Dur['r2']."
         ,".(int)$tmp_data->Dur['r3']."
         ,0 ,0 ,0)";
      echo "|-|Status: New!<br>"; 
   }else{
      $sql_cmd = "UPDATE [dbo].[Items_Gear]
         SET [FNAME] = N'".substr($tmp_data->Model['file'],29,strlen($tmp_data->Model['file'])-33)."'
            ,[Name] = N'".str_replace("'","''",$tmp_data->Store['name'])."'
            ,[Description] = N'".str_replace("'","''",$tmp_data->Store['desc'])."'
            ,[Category] = ".$tmp_data['category']."
            ,[Weight] = ".(int)$tmp_data['Weight']."
            ,[DamagePerc] = ".(int)$tmp_data->Armor['damagePerc']."
            ,[DamageMax] = ".(int)$tmp_data->Armor['damageMax']."
            ,[Bulkiness] = ".(int)$tmp_data->Armor['bulkiness']."
            ,[Inaccuracy] = ".(int)$tmp_data->Armor['inaccuracy']."
            ,[Stealth] = ".(int)$tmp_data->Armor['stealth']."
            ,[ProtectionLevel] = ".(int)$tmp_data->Armor['ProtectionLevel']."
            ,[LevelRequired] = ".(double)$tmp_data->Store['LevelRequired']."
            ,[DurabilityUse] = ".(int)$tmp_data->Dur['u']."
            ,[RepairAmount] = ".(int)$tmp_data->Dur['r1']."
            ,[PremRepairAmount] = ".(int)$tmp_data->Dur['r2']."
            ,[RepairPriceGD] = ".(int)$tmp_data->Dur['r3']."
         WHERE [ItemID] = ".$tmp_data['itemID'];
      echo "|-|Status: Update<br>"; 
   }
   $stmt = sqlsrv_query($conn, $sql_cmd);
}

foreach( $data->HeroArmory->Hero as $tmp_data ){
   $sql = "SELECT * FROM [dbo].[Items_Gear] WHERE [ItemID] = '".$tmp_data['itemID']."'";
   $stmt = sqlsrv_query($conn, $sql , array(), array("Scrollable"=>"buffered"));

   echo "ItemID: ".$tmp_data['itemID']."|-|Name: ".$tmp_data->Store['name'];
   if(sqlsrv_num_rows($stmt) == 0){
      $sql_cmd = "INSERT INTO [dbo].[Items_Gear] VALUES (
         ".$tmp_data['itemID']."
         ,N'".substr($tmp_data->Model['file'],29,strlen($tmp_data->Model['file'])-29)."'
         ,N'".str_replace("'","''",$tmp_data->Store['name'])."'
         ,N'".str_replace("'","''",$tmp_data->Store['desc'])."'
         ,".$tmp_data['category']."
         ,".(int)$tmp_data['Weight']."
         ,".(int)$tmp_data->HeroDesc['damagePerc']."
         ,".(int)$tmp_data->HeroDesc['damageMax']."
         ,".(int)$tmp_data->HeroDesc['maxHeads']."
         ,".(int)$tmp_data->HeroDesc['maxBodys']."
         ,".(int)$tmp_data->HeroDesc['maxLegs']."
         ,0 ,0 ,0 ,0 ,0
         ,".(int)$tmp_data->HeroDesc['ProtectionLevel']."
         ,".(double)$tmp_data->Store['LevelRequired']."
         ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0)";
      echo "|-|Status: New!<br>"; 
   }else{
	     $sql_cmd = "UPDATE [dbo].[Items_Gear]
         SET [FNAME] = N'".substr($tmp_data->Model['file'],29,strlen($tmp_data->Model['file'])-33)."'
            ,[Name] = N'".str_replace("'","''",$tmp_data->Store['name'])."'
            ,[Description] = N'".str_replace("'","''",$tmp_data->Store['desc'])."'
            ,[Category] = ".$tmp_data['category']."
            ,[Weight] = ".(int)$tmp_data['Weight']."
            ,[DamagePerc] = ".(int)$tmp_data->HeroDesc['damagePerc']."
            ,[DamageMax] = ".(int)$tmp_data->HeroDesc['damageMax']."
            ,[Bulkiness] = ".(int)$tmp_data->HeroDesc['maxHeads']."
            ,[Inaccuracy] = ".(int)$tmp_data->HeroDesc['maxBodys']."
            ,[Stealth] = ".(int)$tmp_data->HeroDesc['maxLegs']."
            ,[ProtectionLevel] = ".(int)$tmp_data->HeroDesc['ProtectionLevel']."
            ,[LevelRequired] = ".(double)$tmp_data->Store['LevelRequired']."
            ,[DurabilityUse] = ".(int)$tmp_data->Dur['u']."
            ,[RepairAmount] = ".(int)$tmp_data->Dur['r1']."
            ,[PremRepairAmount] = ".(int)$tmp_data->Dur['r2']."
            ,[RepairPriceGD] = ".(int)$tmp_data->Dur['r3']."
         WHERE [ItemID] = ".$tmp_data['itemID'];
      echo "|-|Status: Update<br>"; 
   }
   $stmt = sqlsrv_query($conn, $sql_cmd);
}

foreach( $data->BackpackArmory->Backpack as $tmp_data ){
   $sql = "SELECT * FROM [dbo].[Items_Gear] WHERE [ItemID] = '".$tmp_data['itemID']."'";
   $stmt = sqlsrv_query($conn, $sql , array(), array("Scrollable"=>"buffered"));

   echo "ItemID: ".$tmp_data['itemID']."|-|Name: ".$tmp_data->Store['name'];
   if(sqlsrv_num_rows($stmt) == 0){
      $sql_cmd = "INSERT INTO [dbo].[Items_Gear] VALUES (
         ".$tmp_data['itemID']."
         ,N'".substr($tmp_data->Model['file'],29,strlen($tmp_data->Model['file'])-33)."'
         ,N'".str_replace("'","''",$tmp_data->Store['name'])."'
         ,N'".str_replace("'","''",$tmp_data->Store['desc'])."'
         ,".$tmp_data['category']."
         ,".(int)$tmp_data['Weight']."
         ,0 ,0
         ,".(int)$tmp_data->Desc['maxSlots']."
         ,".(int)$tmp_data->Desc['maxWeight']."
         ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0)";
      echo "|-|Status: New!<br>"; 
   }else{
      $sql_cmd = "UPDATE [dbo].[Items_Gear]
         SET [FNAME] = N'".substr($tmp_data->Model['file'],29,strlen($tmp_data->Model['file'])-33)."'
            ,[Name] = N'".str_replace("'","''",$tmp_data->Store['name'])."'
            ,[Description] = N'".str_replace("'","''",$tmp_data->Store['desc'])."'
            ,[Category] = ".$tmp_data['category']."
            ,[Weight] = ".(int)$tmp_data['Weight']."
            ,[Bulkiness] = ".(int)$tmp_data->Desc['maxSlots']."
            ,[Inaccuracy] = ".(int)$tmp_data->Desc['maxWeight']."
         WHERE [ItemID] = ".$tmp_data['itemID'];
      echo "|-|Status: Update<br>"; 
   }
   $stmt = sqlsrv_query($conn, $sql_cmd);
}

foreach( $data->ItemsDB->Item as $tmp_data ){
   $sql = "SELECT * FROM [dbo].[Items_Generic] WHERE [ItemID] = '".$tmp_data['itemID']."'";
   $stmt = sqlsrv_query($conn, $sql , array(), array("Scrollable"=>"buffered"));

   echo "ItemID: ".$tmp_data['itemID']."|-|Name: ".$tmp_data->Store['name'];
   if(sqlsrv_num_rows($stmt) == 0){
      $sql_cmd = "INSERT INTO [dbo].[Items_Generic] VALUES (
         ".$tmp_data['itemID']."
         ,N'".substr($tmp_data->Store['icon'],25,strlen($tmp_data->Store['icon'])-29)."'
         ,".$tmp_data['category']."
         ,N'".$tmp_data->Store['name']."'
         ,N'".str_replace("'","''",$tmp_data->Store['desc'])."'
         ,0 ,0 ,0 ,0 ,0
         ,".(double)$tmp_data->Store['LevelRequired']."
         ,0 ,0 ,0 ,0 
         ,".(int)$tmp_data['Weight']."
         ,0 ,0 ,0)";
      echo "|-|Status: New!<br>"; 
   }else{
      $sql_cmd = "UPDATE [dbo].[Items_Generic]
         SET [FNAME] = N'".substr($tmp_data->Store['icon'],25,strlen($tmp_data->Store['icon'])-29)."'
            ,[Category] = ".$tmp_data['category']."
            ,[Name] = N'".$tmp_data->Store['name']."'
            ,[Description] = N'".str_replace("'","''",$tmp_data->Store['desc'])."'
            ,[LevelRequired] = ".(double)$tmp_data->Store['LevelRequired']."
            ,[Weight] = ".(int)$tmp_data['Weight']."
         WHERE [ItemID] = ".$tmp_data['itemID'];
      echo "|-|Status: Update<br>"; 
   }
   $stmt = sqlsrv_query($conn, $sql_cmd);
}

foreach( $data->AttachmentArmory->Attachment as $tmp_data ){
   $sql = "SELECT * FROM [dbo].[Items_Attachments] WHERE [ItemID] = '".$tmp_data['itemID']."'";
   $stmt = sqlsrv_query($conn, $sql , array(), array("Scrollable"=>"buffered"));

   echo "ItemID: ".$tmp_data['itemID']."|-|Name: ".$tmp_data->Store['name'];
   if(sqlsrv_num_rows($stmt) == 0){
      $sql_cmd = "INSERT INTO [dbo].[Items_Attachments] VALUES (
         ".$tmp_data['itemID']."
         ,N'".substr($tmp_data->Model['file'],26,strlen($tmp_data->Model['file'])-30)."'
         ,".(int)$tmp_data['type']."
         ,N'".$tmp_data->Store['name']."'
         ,N'".str_replace("'","''",$tmp_data->Store['desc'])."'
         ,N'".$tmp_data->Model['MuzzleParticle']."'
         ,N'".$tmp_data->Model['FireSound']."'
         ,".(double)$tmp_data->Upgrade['damage']."
         ,".(double)$tmp_data->Upgrade['range']."
         ,".(double)$tmp_data->Upgrade['firerate']."
         ,".(double)$tmp_data->Upgrade['recoil']."
         ,".(double)$tmp_data->Upgrade['spread']."
         ,".(double)$tmp_data->Upgrade['clipsize']."
         ,".(double)$tmp_data->Upgrade['ScopeMag']."
         ,N'".$tmp_data->Upgrade['ScopeType']."'
         ,N'".$tmp_data->Model['ScopeAnim']."'
         ,".(int)$tmp_data['SpecID']."
         ,".($tmp_data['category']?$tmp_data['category']:19)."
         ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 
         ,".(double)$tmp_data->Store['LevelRequired']."
         ,".(int)$tmp_data['Weight']."
         ,".(int)$tmp_data->Dur['u']."
         ,".(int)$tmp_data->Dur['r1']."
         ,".(int)$tmp_data->Dur['r2']."
         ,".(int)$tmp_data->Dur['r3']."
         ,0 ,0 ,0)";
      echo "|-|Status: New!<br>"; 
   }else{
      $sql_cmd = "UPDATE [dbo].[Items_Attachments]
         SET [FNAME] = N'".substr($tmp_data->Model['file'],26,strlen($tmp_data->Model['file'])-30)."'
            ,[Type] = ".(int)$tmp_data['type']."
            ,[Name] = N'".$tmp_data->Store['name']."'
            ,[Description] = N'".str_replace("'","''",$tmp_data->Store['desc'])."'
            ,[MuzzleParticle] = N'".$tmp_data->Model['MuzzleParticle']."'
            ,[FireSound] = N'".$tmp_data->Model['FireSound']."'
            ,[Damage] = ".(double)$tmp_data->Upgrade['damage']."
            ,[Range] = ".(double)$tmp_data->Upgrade['range']."
            ,[Firerate] = ".(double)$tmp_data->Upgrade['firerate']."
            ,[Recoil] = ".(double)$tmp_data->Upgrade['recoil']."
            ,[Spread] = ".(double)$tmp_data->Upgrade['spread']."
            ,[Clipsize] = ".(double)$tmp_data->Upgrade['clipsize']."
            ,[ScopeMag] = ".(double)$tmp_data->Upgrade['ScopeMag']."
            ,[ScopeType] = N'".$tmp_data->Upgrade['ScopeType']."'
            ,[AnimPrefix] = N'".$tmp_data->Model['ScopeAnim']."'
            ,[SpecID] = ".(int)$tmp_data['SpecID']."
            ,[Category] = ".($tmp_data['category']?$tmp_data['category']:19)."
            ,[LevelRequired] = ".(double)$tmp_data->Store['LevelRequired']."
            ,[Weight] = ".(int)$tmp_data['Weight']."
            ,[DurabilityUse] = ".(int)$tmp_data->Dur['u']."
            ,[RepairAmount] = ".(int)$tmp_data->Dur['r1']."
            ,[PremRepairAmount] = ".(int)$tmp_data->Dur['r2']."
            ,[RepairPriceGD] = ".(int)$tmp_data->Dur['r3']."
         WHERE [ItemID] = ".$tmp_data['itemID'];
      echo "|-|Status: Update<br>"; 
   }
   $stmt = sqlsrv_query($conn, $sql_cmd);
}

 foreach( $data->LootBoxDB->LootBox as $tmp_data ){
   $sql = "SELECT * FROM [dbo].[Items_Generic] WHERE [ItemID] = '".$tmp_data['itemID']."'";
   $stmt = sqlsrv_query($conn, $sql , array(), array("Scrollable"=>"buffered"));

   echo "ItemID: ".$tmp_data['itemID']."|-|Name: ".$tmp_data->Store['name'];
   if(sqlsrv_num_rows($stmt) == 0){
      $sql_cmd = "INSERT INTO [dbo].[Items_Generic] VALUES (
         ".$tmp_data['itemID']."
         ,N'".substr($tmp_data->Model['file'],26,strlen($tmp_data->Model['file'])-30)."'
         ,".$tmp_data['category']."
         ,N'".$tmp_data->Store['name']."'
         ,N'".str_replace("'","''",$tmp_data->Store['desc'])."'
         ,0 ,0 ,0 ,0 ,0
         ,".(double)$tmp_data->Store['LevelRequired']."
         ,0 ,0 ,0 ,0 
         ,".(int)$tmp_data['Weight']."
         ,0 ,0 ,0)";
      echo "|-|Status: New!<br>"; 
   }else{
      $sql_cmd = "UPDATE [dbo].[Items_Generic]
         SET [FNAME] = N'".substr($tmp_data->Model['file'],26,strlen($tmp_data->Model['file'])-30)."'
            ,[Category] = ".$tmp_data['category']."
            ,[Name] = N'".$tmp_data->Store['name']."'
            ,[Description] = N'".str_replace("'","''",$tmp_data->Store['desc'])."'
            ,[LevelRequired] = ".(double)$tmp_data->Store['LevelRequired']."
            ,[Weight] = ".(int)$tmp_data['Weight']."
         WHERE [ItemID] = ".$tmp_data['itemID'];
      echo "|-|Status: Update<br>"; 
   }
   $stmt = sqlsrv_query($conn, $sql_cmd);
 }

 foreach( $data->LootBoxDB->LootBox as $tmp_data ){
   $sql = "SELECT * FROM [dbo].[Items_LootSrvModifiers] WHERE [LootID] = '".$tmp_data['itemID']."'";
   $stmt = sqlsrv_query($conn, $sql , array(), array("Scrollable"=>"buffered"));

   echo "ItemID: ".$tmp_data['itemID']."|-|Name: ".$tmp_data->Store['name'];
   if(sqlsrv_num_rows($stmt) == 0){
      $sql_cmd = "INSERT INTO [dbo].[Items_LootSrvModifiers] VALUES (
         ".$tmp_data['itemID']."
         ,100 ,100 ,200)";
	  echo "|-|Status: New!<br>";
   }else{
      $sql_cmd = "UPDATE [dbo].[Items_LootSrvModifiers]
         SET [SrvNormal] = 100
            ,[SrvTrial] = 100
            ,[SrvPremium] = 200
         WHERE [LootID] = ".$tmp_data['itemID'];
      echo "|-|Status: Update<br>"; 
   }
   $stmt = sqlsrv_query($conn, $sql_cmd);
 }

}

function ban_detail() {
	$conn = db_connect();
	$rank = 1;
	$str = "SELECT uc.Gamertag, ud.AccountStatus, uc.CustomerID, ud.CustomerID
			FROM UsersChars as uc JOIN UsersData as ud ON uc.CustomerID = ud.CustomerID
			WHERE ud.AccountStatus = 200 OR ud.AccountStatus = 202 ORDER BY ud.CustomerID ASC";
	$stmt = sqlsrv_query( $conn, $str );
	if(exec_num($conn, $str) > 0) {
		while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
			if($row['AccountStatus'] == 200) {
				$status = 'ACID';
			} else {
				$status = 'HWID';
			}
			$ban_detail .= '<tr>';
			$ban_detail .= '<td width="20">'.$rank++.'</td>';
			$ban_detail .= '<td width="200">'.$row['Gamertag'].'</td>';
			$ban_detail .= '<td>'.$status.'</td>';
			$ban_detail .= '</tr>';
		}
	} else {
		$ban_detail .= '<tr>';
		$ban_detail .= '<td colspan="3">...ผู้เล่นเซิร์ฟนี้น่ารักมากๆ ตอนนี้ยังไม่มีใครโดนแบนกันสักคน...</td>';
		$ban_detail .= '</tr>';
	}
	return $ban_detail;
}
 
 //SHOW CREDIT
 function lc() {
	 $lc = 'EDITED @2017 BY WEBSHOPPING';
	 return $lc;
 }
 
//------------------------------------------------ BEGIN | REPORTS SYSTEM -------------------------------------------------//
 
 function removeDir($path) {
    $path = rtrim($path, '/') . '/';
    $items = glob($path . '*');
    foreach($items as $item) {
        is_dir($item) ? removeDir($item) : unlink($item);
    }
    if(rmdir($path)) {
		return 'DELIMG:TRUE';
	} else {
		return 'DELIMG:CHMOD777';
	}
}
 
 // create thumbnails from images
 function make_thumb($folder,$src,$dest,$thumb_width) {
	$source_image = imagecreatefromjpeg($folder.'/'.$src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	$thumb_height = floor($height*($thumb_width/$width));
	$virtual_image = imagecreatetruecolor($thumb_width,$thumb_height);
	imagecopyresampled($virtual_image,$source_image,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
    imagejpeg($virtual_image,$dest,100);
 }
 
 // display pagination
 function print_pagination($numPages,$urlVars,$currentPage) {
	if ($numPages > 1) {
        $str .= 'Page '. $currentPage .' of '. $numPages;
		$str .='&nbsp;&nbsp;&nbsp;';
		if ($currentPage > 1) {
			$prevPage = $currentPage - 1;
			$str .= '<a href="?'. $urlVars .'p='. $prevPage.'">&laquo;&laquo;</a> ';
		}
		for( $e=0; $e < $numPages; $e++ ) {
			$p = $e + 1;
			if ($p == $currentPage) {
			$class = 'current-paginate';
			} else {
				$class = 'paginate';
			}
			$str .= '<a class="'. $class .'" href="?'. $urlVars .'p='. $p .'">'. $p .'</a>';
		}
		if ($currentPage != $numPages) {
			$nextPage = $currentPage + 1;
			$str .= ' <a href="?'. $urlVars .'p='. $nextPage.'">&raquo;&raquo;</a>';
		}
	}
	return $str;
 }
 
 function GetReports() {
	global $_CONFIG;
	$mainFolder    = 'storage/reports';
	$albumsPerPage = $_CONFIG['REPORT']['ALBUMSPERPAGE'];
	$itemsPerPage  = $_CONFIG['REPORT']['ITEMPERPAGE'];
	$thumb_width   = $_CONFIG['REPORT']['THUMB_WIDTH'];
	$extensions    = array(".jpg",".png",".gif",".JPG",".PNG",".GIF");
	
	if (!isset($_GET['album'])) {
		$folders = scandir($mainFolder, 0);
		$ignore  = array('.', '..');
		$albums = array();
		$captions = array();
		$random_pics = array();

		foreach($folders as $album) {
			$src_folder = $mainFolder.'/'.$album;
			$src_files  = scandir($src_folder);
			$files = array();
	
			foreach($src_files as $file) {
				$ext = strrchr($file, '.');
				if(in_array($ext, $extensions) && !in_array($album, $ignore)) {
					array_push( $files, $file );
					if (!is_dir($src_folder)) {
						mkdir($src_folder);
						chmod($src_folder, 0777);
					}
					$thumb = $src_folder.'/'.$file;
					if (!file_exists($thumb)) {
						make_thumb($src_folder,$file,$thumb,$thumb_width);
					}
				}
			}
			if(!in_array($album, $ignore)) {
				array_push( $albums, $album );
				$caption = substr($album,0,20);
				array_push( $captions, $caption );
				$rand_dirs = glob($mainFolder.'/'.$album.'/*.*'.jpg, GLOB_NOSORT);
				$rand_pic  = $rand_dirs[array_rand($rand_dirs)];
				array_push( $random_pics, $rand_pic );
			}
		}
		if( count($albums) == 0 ) {
			$str .= '<center>** ขณะนี้ยังไม่มีรูปภาพรีพอร์ต ** <br> กรุณาตั้งค่าบันทึกภาพรีพอร์ตไปที่ C:\inetpub\wwwroot\storage\<center>';
		} else {
			$numPages = ceil( count($albums) / $albumsPerPage );
		
			if(isset($_GET['p'])) {
				$currentPage = $_GET['p'];
				if($currentPage > $numPages) {
					$currentPage = $numPages;
				}
			} else {
				$currentPage=1;
			}
		
			$start = ( $currentPage * $albumsPerPage ) - $albumsPerPage;
			$str .= '	<div class="titlebar">
							<div class="float-left">
								<span class="title">Reports Gallery</span>
							</div>
							<div class="float-right">'.count($albums).' อลบั้ม</div>
						</div>';
			$str .= '	<div class="clear"></div>';

			for( $i=$start; $i<$start + $albumsPerPage; $i++ ) {
				if( isset($albums[$i]) ) {
					if ($captions[$i] == 999)
						$captions[$i] = 'Automatic Screens';
						$str .= '	<div class="thumb-album shadow">
										<div class="thumb-wrapper">
											<a href="?menu=report_conf&album='. urlencode($albums[$i]) .'">
												<img src="'. $random_pics[$i] .'" width="'.$thumb_width.'" alt="" />
											</a>
										</div>
										<div class="p5"></div>
										<a href="?menu=report_conf&album='. urlencode($albums[$i]) .'">
											<center><span class="caption">'. $captions[$i] .'</span></center>
										</a>
									</div>';
				}

			}
			
			$str .= '	<br><div align="left" class="statusbar float-left">
								<img src="storage/images/LoginZombie.png" width="200" height="auto">
						';
			
			$str .= '<div class="clear"></div>';
			$str .= '<div align="center" class="paginate-wrapper">';
		
			$urlVars = "";
			print_pagination($numPages,$urlVars,$currentPage);
		
			$str .= '</div>';
		}
	} else {
		$src_folder = $mainFolder.'/'.$_GET['album'];
		$src_files  = scandir($src_folder);

		$files = array();
		foreach($src_files as $file) {
			$ext = strrchr($file, '.');
			if(in_array($ext, $extensions)) {
				array_push( $files, $file );
				if (!is_dir($src_folder)) {
					mkdir($src_folder);
					chmod($src_folder, 0777);
					//chown($src_folder.'/thumbs', 'apache');
				}
				$thumb = $src_folder.'/'.$file;
				if (!file_exists($thumb)) {
					make_thumb($src_folder,$file,$thumb,$thumb_width);
				}
			}
		}
		if ( count($files) == 0 ) {
			$str .= '<div align="left" class="statusbar float-left">
						<form>
							<input type="hidden" id="patch" value="../reports/'.$_GET['album'].'">
							<button type="submit" id="del_reports" class="btn btn-warning" onclick="return false"><i class="fa fa-trash"></i> ลบรีพอร์ต</button>
							<a href="?menu=report_conf"><button class="btn btn-info"><i class="fa fa-sign-in"></i> กลับ</button></a>
						</form>
					</div>
					';
			$str .= 'ไอดีนี้ยังไม่มีการรีพอร์ตภาพมาครับ!';
		} else {
			$numPages = ceil( count($files) / $itemsPerPage );
		
			if(isset($_GET['p'])) {
				$currentPage = $_GET['p'];
				if($currentPage > $numPages) {
					$currentPage = $numPages;
				}
			} else {
				$currentPage=1;
			}
		
			$start = ( $currentPage * $itemsPerPage ) - $itemsPerPage;
			$thefile = $src_folder.'/reports.txt' or "reports.txt";
			$myfile = fopen($thefile, "r");

			if ($_GET['album'] == 999) {
				$str .= '	<div class="titlebar">
								<div class="float-left"><span class="title">Automatic Reports</span></div>
								<div class="float-right">'.count($files).' images</div>
							</div>';
				$str .= '	<div class="clear"></div>';
			} else {
				$str .= '	<div class="titlebar">
								<div class="float-left"><span class="title">REPORTS : '. $_GET['album'] .'</span></div>
								<div class="float-right">'.count($files).' images</div>
							</div>';
				$str .= '	<div class="clear"></div>';
			}
		
			for( $i=$start; $i<$start + $itemsPerPage; $i++ ) {
				if( isset($files[$i]) && is_file( $src_folder .'/'. $files[$i] ) ) {
					$str .= '	<div class="thumb shadow">
									<div class="thumb-wrapper">
										<a href="'. $src_folder .'/'. $files[$i] .'" class="albumpix" rel="albumpix">
											<img src="'. $src_folder .'/'. $files[$i] .'" width="'.$thumb_width.'" alt="" />
										</a>
									</div>
								</div>';
				} else {
					if( isset($files[$i]) ) {
						$str .= $files[$i];
					}
				}
			}

			if ($_GET['album'] != 999) {
				$str .= '<div align="center" class="clear">';
			} else {
				$str .= '<div class="clear">';
			}

			if ($_GET['album'] != 999) {
				$conn = db_connect();

				$tsql = "SELECT CustomerID, email, AccountStatus FROM Accounts where CustomerID =  ".$_GET['album']." ";
				$array = sqlsrv_fetch_array(exec_query( $conn, $tsql), SQLSRV_FETCH_ASSOC);
				
				$tsql1 = "SELECT AccountStatus FROM UsersData where CustomerID =  ".$_GET['album']." ";
				$acc = sqlsrv_fetch_array(exec_query( $conn, $tsql1), SQLSRV_FETCH_ASSOC);

				$tsql2 = "SELECT Gamertag FROM UsersChars where CustomerID = ".$_GET['album']." ";
				$User = sqlsrv_fetch_array(exec_query( $conn, $tsql2), SQLSRV_FETCH_ASSOC);
		 
				$tsql3 = "SELECT HardwareID FROM HWID_Log where CustomerID = ".$_GET['album']." Order By id DESC";
				$HWID = sqlsrv_fetch_array(exec_query( $conn, $tsql3), SQLSRV_FETCH_ASSOC);
			
				if($array['AccountStatus'] == 200 || $acc['AccountStatus'] == 200){
					$acc_status = '<span style="color:red; font-weight: bold">BAN ID</span>';
				} else if($array['AccountStatus'] == 202 || $acc['AccountStatus'] == 202) {
					$acc_status = '<span style="color:red; font-weight: bold">BAN HWID</span>';
				}else {
					$acc_status = '<span style="color:green; font-weight: bold">NORMAL</span>';
				}
			}
			if ($_GET['album'] != 999) { 
				$str .= '<br><div align="left" class="statusbar float-left">
							<form>
								<input type="hidden" id="patch" value="../reports/'.$_GET['album'].'">
								<button type="submit" id="del_reports" class="btn btn-warning" onclick="return false"><i class="fa fa-trash"></i> ลบรีพอร์ต</button>
								<a href="?menu=report_conf"><button class="btn btn-info"><i class="fa fa-sign-in"></i> กลับ</button></a>
							</form>
							<span class="info_detail">CustomerID: </span> '.$array['CustomerID'].' <br>
							<span class="info_detail">E-mail: </span> '.$array['email'].' <br>
							<span class="info_detail">ชื่อตัวละคร : </span> '.$User['Gamertag'].' <br>
							<span class="info_detail">HardwareID : </span> '.$HWID['HardwareID'].' <br>
							<span class="info_detail">Account Status : </span>
							<span id="acc_status">'.$acc_status.'</span> <br><br>
						';
				$str .= '<form>
							<label style="color:#555;">จัดการ Accounts :</label><br>
							<input type="hidden" id="banned" value="'.$array['email'].'">
							<input type="hidden" id="cid" value="'.$array['CustomerID'].'">
							<button type="submit" class="btn btn-danger" id="submit-banned" onclick="return false"><i class="fa fa-ban"></i> แบน</button>
							<button type="submit" class="btn btn-success" id="submit-unban" onClick="return false"><i class="fa fa-check-square"></i> ปลดแบน</button>
							<br>
							<label style="color:#555;">จัดการ HardwareID :</label><br>
							<input type="hidden" id="hardwareid" value="'.$HWID['HardwareID'].'">
							<button type="submit" class="btn btn-danger" id="submit-hwidban" onclick="return false"><i class="fa fa-ban"></i> แบน</button>
							<button type="submit" class="btn btn-success" id="submit-hwidunban" onclick="return false"><i class="fa fa-check-square"></i> ปลดแบน</button>
						</form>
						';
			} else {
				$str .= '<br><div align="left" class="statusbar float-left">
							<form>
								<input type="hidden" id="patch" value="../reports/'.$_GET['album'].'">
								<button type="submit" id="del_reports" class="btn btn-warning" onclick="return false"><i class="fa fa-trash"></i> ลบรีพอร์ต</button>
								<a href="?menu=report_conf"><button class="btn btn-info"><i class="fa fa-sign-in"></i> กลับ</button></a>
							</form>
						';
			}
			
			$str .= '</div></div>';
			$str .= '<div align="center" class="paginate-wrapper">';
			
			if ($_GET['album'] != 999) {
				if (file_exists($thefile)) {
					$str .= '<div align="center"><p><span style="font-size:14px;"><strong>&nbsp; --- Report Logs ---</strong></span></p></div>';
					while(!feof($myfile)) {
						$str .= '<div align="center">'. fgets($myfile) .'</div>';
					}
				}
			}

			$urlVars = "album=".urlencode($_GET['album'])."&amp;";
			print_pagination($numPages,$urlVars,$currentPage);

			$str .= '</div>';
		}
		fclose($myfile);
	}
	return $str;
}

 //------------------------------------------------ END | REPORTS SYSTEM -------------------------------------------------//
 
 /*************************************************************************************************************************/
 
 //------------------------------------------------ BEGIN | TWPAY SYSTEM -------------------------------------------------//
 
 function checkApiIp() { 
	$ipAddress = (!array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) ? $_SERVER['REMOTE_ADDR'] : array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
	if($ipAddress == '119.59.103.14') {
		return true;
	}
	return false;
 }
 
 function APIDecrypt($key, $crypted) {
	$data = json_decode(base64_decode($crypted));
	$iv = base64_decode($data->iv);
	$decrypted = \openssl_decrypt($data->value, 'AES-256-CBC', md5($key), 0, $iv);
	return unserialize($decrypted);
 }
 
 //------------------------------------------------ END | TWPAY SYSTEM -------------------------------------------------//
 
 function GetCharName(){
	global $_CONFIG;
	$conn = db_connect();
	$sql = 'SELECT CharID, HeroItemID, Gamertag FROM UsersChars WHERE CustomerID = '.$_SESSION['customerid'].' ';
	$stmt = exec_query( $conn, $sql);
	$count = exec_num($conn, $sql);
	if($count >= 1) {
		for( $i=1;$i<=$count;$i++ ) {
			$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
			$img = get_dbxml($row['HeroItemID']);
			
			$str .= "<div class='box'>";
			$str .= "<div class='img-resize'>";
			$str .= "<img src='".$img['img_url']."'>";
			$str .= "</div>";
			$str .= "<span class='spc-name'>".$row['Gamertag']."</span>";
			$str .= "<hr>";
			$str .= "<form>";
			$str .= "<input type='hidden' id='charid".$i."' value='".$row['CharID']."'>";
			$str .= "<button type='submit' id='submit-newname' class='btn btn-success' value='".$i."' onclick='return false'><i class='fa fa-edit'></i> เปลี่ยนชื่อ ".$_CONFIG['FUNCTIONS']['change_name']." WP</button>";
			$str .= "</form>";
			$str .= "</div>";
		}
		return $str;
	} else {
		$str = "<h3 class='dark-text' style='font-family: Kanit'>*ไม่มีข้อมูล! คุณยังไม่ได้สร้างตัวละคร</h3>";
		return $str;
	}
 }
 
 function GetCharNameexp(){
	$conn = db_connect();
	$sql = 'SELECT CharID, Gamertag FROM UsersChars WHERE CustomerID = '.$_SESSION['customerid'].' ';
	$stmt = exec_query( $conn, $sql);
	$str = '';
	$str .= "<select class='form-control' id='charnameexp'>";
	while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$str .= "<option value='".$row['CharID']."'>".$row['Gamertag']."</option>";
	}
	$str .= "</select>";
	return $str;
 }
 
 function GetRentPrice($all=true,$type){
	$conn = db_connect();
	$str = "SELECT * FROM wzRentPrice_TBL";
	if(!$all) {
		$str .= " where RentP_type = '".$type."'";
	}
	$stmt = sqlsrv_query( $conn, $str );
	$post = array();
	while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ){
		$post[] = $row;
	}
	return $post;
 }
 
 function charrent($hero,$day){
	global $_SESSION;
	$conn = db_connect();
	if($_SESSION['customerid'] != ''){
		$sql = "SELECT WebPoints FROM UsersData WHERE CustomerID = '".$_SESSION['customerid']."'";
		$arr = sqlsrv_fetch_array(exec_query( $conn, $sql), SQLSRV_FETCH_ASSOC);
		$sql2 = 'SELECT HeroID FROM wzRentChar_TBL WHERE HeroID = '.$hero.' AND ItemDel = 0';
		$arr2 = sqlsrv_fetch_array(exec_query( $conn, $sql2), SQLSRV_FETCH_ASSOC);
		$rentday = GetRentPrice(false,'Char');
		if($arr['WebPoints'] < $rentday[$day]['RentP_price']){
			return 'CHARRENT:NOWP';
		} else {
			$sql = "{call FN_CharRent(?, ?, ?)}";
			$params = array( array($_SESSION['customerid'], SQLSRV_PARAM_IN), array($arr2['HeroID'], SQLSRV_PARAM_IN), array($rentday[$day]['RentP_day'], SQLSRV_PARAM_IN) );
			if(exec_proc( $conn, $sql, $params) ) {
				exec_query( $conn, 'UPDATE UsersData SET WebPoints -= '.$rentday[$day]['RentP_price'].' WHERE CustomerID = '.$_SESSION['customerid'].'');
				return 'CHARRENT:TRUE';
			} else {
				return 'CHARRENT:FALSE#'.die( print_r( sqlsrv_errors(), true));
			}
		}
	}
 }
 
 function starrent($day) {
	global $_SESSION;
	$conn = db_connect();
	if($_SESSION['customerid'] != ''){
		$sql = "SELECT WebPoints FROM UsersData WHERE CustomerID = '".$_SESSION['customerid']."'";
		$arr = sqlsrv_fetch_array(exec_query( $conn, $sql), SQLSRV_FETCH_ASSOC);
		$rentday = GetRentPrice(false,'Star');
		if($arr['WebPoints'] < $rentday[$day]['RentP_price']){
			return 'STARRENT:NOWP';
		} else {
			$sql = "{call FN_RentStar(?, ?)}";
			$params = array( array($_SESSION['customerid'], SQLSRV_PARAM_IN), array($rentday[$day]['RentP_day'], SQLSRV_PARAM_IN) );
			if(exec_proc( $conn, $sql, $params) ) {
				exec_query( $conn, 'UPDATE UsersData SET WebPoints -= '.$rentday[$day]['RentP_price'].' WHERE CustomerID = '.$_SESSION['customerid'].'');
				return 'STARRENT:TRUE';
			} else {
				return 'STARRENT:FALSE#'.die( print_r( sqlsrv_errors(), true));
			}
		}
	}
 }
 
 function GetCharforRent(){
	$conn = db_connect();
	$sql = 'SELECT HeroID FROM wzRentChar_TBL WHERE ItemDel = 0';
	$stmt = exec_query( $conn, $sql);
	$str = '';
	$str .= "<select class='form-control' id='Rent_HeroID'>";
	$str .= "<option value=''>เลือกตัวละครที่ต้องการเช่า ที่นี่!</option>";
	while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
		$herotag = get_dbxml($row['HeroID']);
		$str .= "<option value='".$row['HeroID']."'>".$herotag['name']."</option>";
	}
	$str .= "</select>";
	return $str;
 }
 
 function GetCharRentPrice($type){
	$conn = db_connect();
	$sql = "SELECT * FROM wzRentPrice_TBL WHERE RentP_type = '".$type."'";
	$stmt = exec_query( $conn, $sql);
	$count = exec_num($conn, $sql);
	$str = '';
	$str .= "<select class='form-control' id='Rent_Day'>";
	$str .= "<option value=''>เลือกจำนวนวันที่ต้องการเช่า ที่นี่!</option>";
	for( $i=1;$i<=$count;$i++ ) {
		$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
		$str .= "<option value='".($i-1)."'>".$row['RentP_day']." วัน --> ราคา ".$row['RentP_price']." WP</option>";
	}
	$str .= "</select>";
	return $str;
 }
 
 function ChangeName($charid, $new){
	global $_CONFIG;
	$conn = db_connect();
	$db = "SELECT uc.CharID, uc.Gamertag, ud.WebPoints From UsersChars as uc JOIN UsersData as ud ON uc.CustomerID = ud.CustomerID WHERE uc.CustomerID = ".$_SESSION['customerid']." AND uc.CharID = ".$charid." ";
	$array = sqlsrv_fetch_array(exec_query( $conn, $db), SQLSRV_FETCH_ASSOC);
	if($array['WebPoints'] < $_CONFIG['FUNCTIONS']['change_name']) {
		echo "CHANGE:NOWP";
	} else {
		$sql = "UPDATE UsersChars SET Gamertag = '".$new."' WHERE CustomerID = ".$_SESSION['customerid']." AND CharID = '".$charid."' ";
		$sql2 = 'UPDATE UsersData SET WebPoints -= '.$_CONFIG['FUNCTIONS']['change_name'].' WHERE CustomerID = '.$_SESSION['customerid'].' ';
		$stmt2 = exec_query( $conn, $sql) && exec_query( $conn, $sql2);
		echo "CHANGE:TRUE";
	}
 }
 
 function ChangeExp($charname, $wpamount){
	global $exp_wp;
	$conn = db_connect();
	$db = "SELECT uc.CharID, uc.Gamertag, ud.WebPoints From UsersChars as uc JOIN UsersData as ud ON uc.CustomerID = ud.CustomerID WHERE uc.CustomerID = ".$_SESSION['customerid']." AND CharID = ".$charname." ";
	$array = sqlsrv_fetch_array(exec_query( $conn, $db), SQLSRV_FETCH_ASSOC);
	if($array['WebPoints'] < $wpamount) {
		echo "EXP:NOWP";
	} else if($charname != $array['CharID']) {
		echo "EXP:NULLCHAR";
	} else {
		$exp = ($wpamount * $exp_wp);
		$sql = "UPDATE UsersChars SET XP += ".$exp." WHERE CustomerID = ".$_SESSION['customerid']." AND CharID = '".$charname."' ";
		$sql2 = 'UPDATE UsersData SET WebPoints -= '.$wpamount.' WHERE CustomerID = '.$_SESSION['customerid'].' ';
		$stmt2 = exec_query( $conn, $sql) && exec_query( $conn, $sql2);
		echo "EXP:TRUE#".$exp." ";
	}
 }
 
 function GetGccard($customerid, $gc_cardid){
	$conn = db_connect();
	$str = "SELECT * FROM UsersInventory where CustomerID = '".$customerid."' AND ItemID = '".$gc_cardid."' ";
	if (exec_num( $conn,$str ) >= 1) {
		$stmt = sqlsrv_query( $conn, $str );
		$post = array();
		$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
		return $row['Quantity'];
	} else {
		return 0;
	}
 }
 
 function tmpay_check($tmc_pass, $uid) {
	$conn = db_connect();
	$sql = 'SELECT * FROM wzTopup_TBL WHERE password = '.$tmc_pass.' AND CustomerID = '.$uid.' ';
	$stmt = exec_query( $conn, $sql);
	$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
	if($row['status'] == 1) {
		echo 'TMPAY:CHECKTRUE';
	} else if($row['status'] == 3) {
		echo 'TMPAY:USED';
	} else if($row['status'] == 4) {
		echo 'TMPAY:INVALID';
	} else if($row['status'] == 5) {
		echo 'TMPAY:NOTTRUEMONEY';
	} else {
		echo 'TMPAY:NOTSUCCESS';
	}
 }
 
 function true2wallet($tmc_pass, $unit, $uid, $email) {
	 
	global $_CONFIG;
	
	$conn = db_connect();
	$sql = "SELECT CustomerID FROM wzTopup_TBL WHERE DATEDIFF(HOUR, success_time, GETDATE()) < ".$_CONFIG['WALLET']['BANHOUR']." AND CustomerID = ".$uid." AND status != 1";
	$ban = exec_num($conn,$sql);
	if($ban >= $_CONFIG['WALLET']['NUMBAN']) {
		echo 'WALLET:REFILLBAN#1';
	} else {
		if(function_exists('curl_init')) {
			$curl = curl_init('http://103.233.195.184/topup_server.php?trueid='.$_CONFIG['WALLET']['USER'].'&truepass='.$_CONFIG['WALLET']['PASS'].'&truemoney='.$tmc_pass.'');
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($curl, CURLOPT_TIMEOUT, 15);
			curl_setopt($curl, CURLOPT_HEADER, FALSE);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
			$curl_content = curl_exec($curl);
			curl_close($curl);
		} else {
			$curl_content = file_get_contents('http://103.233.195.184/topup_server.php?trueid='.$_CONFIG['WALLET']['USER'].'&truepass='.$_CONFIG['WALLET']['PASS'].'&truemoney='.$tmc_pass.'');
		}

		if($curl_content != FALSE) {
			$data = json_decode($curl_content);
				if($data->status == 'success') {
					$dataMulti = GetdataMultiple();
					$dataGC = GetGCAmount(false,$data->amount);
					$multi = 1;
					$multi = $dataMulti[0]['multiple'];
					DonateLogs($uid, $data->amount);
					
					if($unit == 'WebPoints') {
						
						$unit = 'WP';
						wptouser($dataGC[0]['TopupA_card'],$email,'ADDPOINT');
						TruemoneyLogs($data->transactionId, $uid, $email, 'TRUEMONEY CARD', $data->truemoney, $data->amount, 1, ($dataGC[0]['TopupA_card']), 'WP', 1, $_SERVER['REMOTE_ADDR']);
						
						echo 'WALLET:TRUE#'.$data->amount.'#'.$dataGC[0]['TopupA_card'].'#'.$unit;
						
					} else if($unit == 'GamePoints') {
						
						$unit = 'GC';
						gctouser($dataGC[0]['TopupA_amount'] * $multi,$ref2,'ADDPOINT');
						TruemoneyLogs($data->transactionId, $uid, $email, 'TRUEMONEY CARD', $data->truemoney, $data->amount, $multi, ($dataGC[0]['TopupA_amount'] * $multi), 'GC', 1, $_SERVER['REMOTE_ADDR']);
					
						echo 'WALLET:TRUE#'.$data->amount.'#'.$dataGC[0]['TopupA_amount'].'#'.$unit;
					
					}
					
					//if($unit != 'WebPoints') {
						$row = GetdataPromotion(true,$data->amount);
						for($i=0;$i<count($row);$i++) {
							itemtouser($row[$i]['TopupP_iid'],$row[$i]['TopupP_iamount'],$email,'ADDITEM');
						}
					//}
					
					
				} else if($data->status == 'error') {
					if($data->code == '-1002') {
						TruemoneyLogs(0, $uid, $email, 'TRUEMONEY CARD', $data->truemoney, 0, $multi, ($dataGC[0]['TopupA_amount'] * $multi), '', 4, $_SERVER['REMOTE_ADDR']);
						echo 'WALLET:NOTSUCCESS#รหัสบัตรไม่ถูกต้อง';
					} else {
						TruemoneyLogs(0, $uid, $email, 'TRUEMONEY CARD', $data->truemoney, 0, $multi, ($dataGC[0]['TopupA_amount'] * $multi), '', 3, $_SERVER['REMOTE_ADDR']);
						echo 'WALLET:NOTSUCCESS#รหัสบัตรถูกใช้งานแล้ว';
					}
				}
		} else {
			echo 'WALLET:SERVERBUSY#'.$curl_content;
		}
	}
 }
 
 function Topup_System() {
	 
	global $_CONFIG;
	 
	if($_CONFIG['TOPUP_SYS'] == 'TMTOPUP') {
		$topup_func = 'submit_tmnc()';
	} else if($_CONFIG['TOPUP_SYS'] == 'WALLET') {
		$topup_func = 'submit_wallet()';
	} else if($_CONFIG['TOPUP_SYS'] == 'TMPAY') {
		$topup_func = 'submit_tmpay()';
	}
	return $topup_func;
 }
 
 function refill_sendcard($tmc_pass, $unit, $uid, $email) {
	global $_CONFIG;

	if($unit == 'GamePoints') {
		$unit = 'GC';
	} else if($unit == 'WebPoints') {
		$unit = 'WP';
	}
	$stmt = TruemoneyLogs(0, $uid, $email, 'TRUEMONEY CARD', $tmc_pass, 0, 0, 0, ''.$unit.'', 0, $_SERVER['REMOTE_ADDR']);
	
	if(function_exists('curl_init'))
	{
		$curl = curl_init('http://www.tmpay.net/TPG/backend.php?merchant_id=' .$_CONFIG['tmpay']['merchant_id'] . '&password=' . $tmc_pass . '&resp_url=' . $_CONFIG['tmpay']['resp_url']);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_TIMEOUT, 5);
		curl_setopt($curl, CURLOPT_HEADER, FALSE);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
		$curl_content = curl_exec($curl);
		curl_close($curl);
	}
	else
	{
		$curl_content =  file_get_contents('http://www.tmpay.net/TPG/backend.php?merchant_id=' .$_CONFIG['tmpay']['merchant_id'] . '&password=' . $tmc_pass . '&resp_url=' . $_CONFIG['tmpay']['resp_url']);
	}
	if(strpos($curl_content,'SUCCEED') !== FALSE) 
	{
		echo 'TMPAY:TRUE#'.$curl_content;
	} else {
		echo 'TMPAY:NOTSUCCESS#'.$curl_content;
	}
	//else return $curl_content;
}

//----------------------------------------------------- [ New Script ] -------------------------------------------//
function GetTime() {
    return date("Y-m-d H:i:s", time());
}
 
 ?>