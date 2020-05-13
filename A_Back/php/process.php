<?php 
 include('functions.php');
 
 if(isset($_POST['cmd']) && $_POST['cmd'] == 'login' ) {
	$conn = db_connect();
	$username = clean($_POST['accountname']);
	$password = clean($_POST['password']);

	if($password == "") {
		$str = "SELECT * FROM Accounts WHERE email = '".$username."'";
	} else {
		$str = "SELECT * FROM Accounts WHERE email = '".$username."' and MD5Password = '".md5_warz($password)."'";
	}

	$array = sqlsrv_fetch_array(exec_query( $conn, $str), SQLSRV_FETCH_ASSOC);
	if (exec_num( $conn,$str ) == 1) {
		$_SESSION['authen'] = $array['IsDeveloper'];
		$_SESSION['customerid'] = $array['CustomerID'];
		$_SESSION['encodecid'] = Encrypt_Base64($array['CustomerID']);
		$_SESSION['username'] = $array['email'];
		$_SESSION['encodename'] = Encrypt_Base64($array['email']);
		$_SESSION['encodekey'] = md5($array['CustomerID'].$array['email']);
		echo "LOGIN:TRUE#FBNEWREGIS:FALSE";
		exit();
	} else {
		echo "LOGIN:FALSE#FBNEWREGIS:TRUE";
		exit();
	}
 }
 
 if(isset($_POST['cmd']) && $_POST['cmd'] == 'register' ) {
	$conn = db_connect();
	$FB_ID = clean($_POST['fbid']);
	$FB_Email = clean($_POST['fbemail']);
	$FB_Name = clean($_POST['fbname']);
	$FB_Link = clean($_POST['fblink']);
	$FB_Pic = clean($_POST['fbpic']);
	$Pass = clean($_POST['pass']);
	$CBT_Email = clean($_POST['cbtemail']);

	echo "REGISTER:TRUE";

	$str = "SELECT * FROM Accounts WHERE email = '".$FB_Email."'";
	$array = sqlsrv_fetch_array(exec_query( $conn, $str), SQLSRV_FETCH_ASSOC);

	if(misc_parsestring(strtoupper($pass),'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstwxyz1234567890') == FALSE) {
		echo "REGISTER:CHARVALID";
		exit();
	} else {
		if (exec_num( $conn,$str ) == 0) {
			echo register($account, $pass);
			exit();
		} else {
			echo "REGISTER:ALREADYUSE";
			exit();
		}
	}
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'changepass' ) {
	$conn = db_connect();
	$userencrypt = clean($_POST['userencrypt']);
	$passold = clean($_POST['passold']);
	$newpass1 = clean($_POST['newpass1']);
	$newpass2 = clean($_POST['newpass2']);
		if($passold == "" || $newpass1 == "" || $newpass2 == ""){
			echo "CHANGEPASS:FNULL";
			exit();
		} else if($newpass1 != $newpass2){
			echo "CHANGEPASS:NMATCH";
			exit();
		} else if(misc_parsestring(strtoupper($passold),'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstwxyz1234567890') == FALSE){
			echo "CHANGEPASS:CHARVALID";
			exit();
		} else if(misc_parsestring(strtoupper($newpass1),'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstwxyz1234567890') == FALSE){
			echo "CHANGEPASS:CHARVALID";
			exit();
		} else if(misc_parsestring(strtoupper($newpass2),'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstwxyz1234567890') == FALSE){
			echo "CHANGEPASS:CHARVALID";
			exit();
		} else if($_POST['passold'] != $passold || $_POST['newpass1'] != $newpass1 || $_POST['newpass2'] != $newpass2){
			echo "CHANGEPASS:CHARVALID";
			exit();
		} else if((strlen($newpass1) > 16 || strlen($newpass1) < 6) && (strlen($newpass2) > 16 || strlen($newpass2) < 6)){
			echo "CHANGEPASS:CHARLENGTH";
			exit();
		} else {
			$str = "SELECT * FROM Accounts WHERE email = '".Decrypt_Base64($userencrypt)."' and MD5Password = '".md5_warz($passold)."'";
			if (exec_num( $conn,$str ) == 1) {
				exec_query( $conn, "UPDATE Accounts SET MD5Password = '".md5_warz($newpass1)."' WHERE email = '".Decrypt_Base64($userencrypt)."' and MD5Password = '".md5_warz($passold)."'");
				echo "CHANGEPASS:TRUE";
				exit();
			} else {
				echo "CHANGEPASS:FALSE";
				exit();
			}
		}
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'addpromotion' ) {
	$trueamount = Decrypt_Base64(clean($_POST['trueamount']));
	$itemid = clean($_POST['itemid']);
	$itemname = clean($_POST['itemname']);
	$itemamount = clean($_POST['itemamount']);
	if($itemid == "" || $itemname == "" || $itemamount == "" || $trueamount == ""){
		echo "ADDPROMOTION:FNULL";
		exit();
	} else if(!is_numeric($trueamount)){
		echo "ADDPROMOTION:TRUEAMOUNTVALID";
		exit();
	} else if(!is_numeric($itemid)){
		echo "ADDPROMOTION:NUMVALID";
		exit();
	} else if(!is_numeric($itemamount)){
		echo "ADDPROMOTION:NUMVALID";
		exit();
	} else if($_POST['itemid'] != $itemid || $_POST['itemname'] != $itemname || $_POST['itemamount'] != $itemamount){
		echo "ADDPROMOTION:CHARVALID";
		exit();
	} else {
		echo AddPromotion($trueamount, $itemid, $itemname, $itemamount);
		exit();
	}
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'gcamount' ) {
	$true50 = clean($_POST['true50']);
	$true90 = clean($_POST['true90']);
	$true150 = clean($_POST['true150']);
	$true300 = clean($_POST['true300']);
	$true500 = clean($_POST['true500']);
	$true1000 = clean($_POST['true1000']);
	if($true50 == "" || $true90 == "" || $true150 == "" || $true300 == "" || $true500 == "" || $true1000 == ""){
		echo "GCAMOUNT:FNULL";
		exit();
	} else if(!is_numeric($true50) || !is_numeric($true90) || !is_numeric($true150) || !is_numeric($true300) || !is_numeric($true500) || !is_numeric($true1000)){
		echo "GCAMOUNT:GCMOUNTVALID";
		exit();
	} else if($_POST['true50'] != $true50 || $_POST['true90'] != $true90 || $_POST['true150'] != $true150 || $_POST['true300'] != $true300 || $_POST['true500'] != $true500 || $_POST['true1000'] != $true1000){
		echo "GCAMOUNT:CHARVALID";
		exit();
	} else {
		$GCString = $true50.'#'.$true90.'#'.$true150.'#'.$true300.'#'.$true500.'#'.$true1000;
		echo UpdateGcAmount($GCString);
		exit();
	}
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'addpoint1' ) {
	$username = clean($_POST['username']);
	$quantity = clean($_POST['quantity']);
	if($username == "" || $quantity == ""){
		echo "ADDPOINT:FNULL";
		exit();
	} else if(!is_numeric($quantity)){
		echo "ADDPOINT:NUMVALID";
		exit();
	} else if($quantity<=0){
		echo "ADDPOINT:ISLOW";
		exit();
	} else if($_POST['username'] != $username || $_POST['quantity'] != $quantity){
		echo "ADDPOINT:CHARVALID";
		exit();
	} else {
		echo gctouser($quantity,$username,'ADDPOINT');
		exit();
	}
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'addpoint2' ) {
	$username = clean($_POST['username']);
	$quantity = clean($_POST['quantity']);
	if($quantity == ""){
		echo "ADDPOINT:FNULL";
		exit();
	} else if($username != ""){
		echo "ADDPOINT:NOTNULL";
		exit();
	} else if($quantity<=0){
		echo "ADDPOINT:ISLOW";
		exit();
	} else if(!is_numeric($quantity)){
		echo "ADDPOINT:NUMVALID";
		exit();
	} else if(!is_numeric($quantity)){
		echo "ADDPOINT:CHARVALID";
		exit();
	} else {
		echo gctouser($quantity,'','ADDPOINT');
		exit();
	}
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'additem1' ) {
	$username = clean($_POST['username']);
	$itemindex = clean($_POST['itemindex']);
	$quantity = clean($_POST['quantity']);
	if($itemindex == "" || $itemindex == "" || $quantity == ""){
		echo "ADDITEM:FNULL";
		exit();
	} else if(!is_numeric($itemindex)){
		echo "ADDITEM:INDEXVALID";
		exit();
	} else if($quantity<=0){
		echo "ADDITEM:ISLOW";
		exit();
	} else if(!is_numeric($quantity)){
		echo "ADDITEM:NUMVALID";
		exit();
	} else if($_POST['username'] != $username || $_POST['itemindex'] != $itemindex || $_POST['quantity'] != $quantity) {
		echo "ADDITEM:CHARVALID";
		exit();
	} else {
		echo itemtouser($itemindex,$quantity,$username,'ADDITEM');
		exit();
	}
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'additem2' ) {
	$username = clean($_POST['username']);
	$itemindex = clean($_POST['itemindex']);
	$quantity = clean($_POST['quantity']);
	if($itemindex == "" || $quantity == "") {
		echo "ADDITEM:FNULL";
		exit();
	} else if($username != "") {
		echo "ADDITEM:NOTNULL";
		exit();
	} else if($quantity<=0) {
		echo "ADDITEM:ISLOW";
		exit();
	} else if(!is_numeric($itemindex)) {
		echo "ADDITEM:INDEXVALID";
		exit();
	} else if(!is_numeric($quantity)) {
		echo "ADDITEM:NUMVALID";
		exit();
	} else if($_POST['itemindex'] != $itemindex || $_POST['quantity'] != $quantity) {
		echo "ADDITEM:CHARVALID";
		exit();
	} else {
		echo itemtouser($itemindex,$quantity,'','ADDITEM');
		exit();
	}
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'buyspcitem' ) {
	$username 	= clean($_POST['username']);
	$itemid 	= clean($_POST['itemid']);
	if($username == "" || $itemid == ""){
		echo "BUYSPCITEM:FNULL";
		exit();
	} else {
		echo spcitemtouser($username,$itemid,'BUYSPCITEM');
		exit();
	}
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'charrent' ) {
	$hero 	= clean($_POST['hero']);
	$day 	= clean($_POST['day']);
	echo charrent($hero,$day);
	exit();
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'starrent' ) {
	$day 	= clean($_POST['day']);
	echo starrent($day);
	exit();
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'movenow' ) {
	$schar = explode("#", $_POST['schar']);
	$map = explode("#", $_POST['map']);
	$schar = Decrypt_Base64(clean($schar[0]));
	$map = Decrypt_Base64(clean($map[0]));
	if($schar == "" || $schar == "") {
		echo "MOVENOW:FNULL";
		exit();
	} else if($schar == 0 && $map == 0 ) {
		echo "MOVENOW:ANULL";
		exit();
	} else if($schar == 0 ) {
		echo "MOVENOW:CNULL";
		exit();
	} else if($map == 0 ) {
		echo "MOVENOW:MNULL";
		exit();
	} else {
		echo MoveNow($schar, $map);
		exit();
	}
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'gencodegc' ) {
	$gcpoint = clean($_POST['gcpoint']);
	$limit = clean($_POST['limit']);
	if($gcpoint == "" || $limit == "") {
		echo "GENCODEGC:FNULL";
		exit();
	} else if(!is_numeric($gcpoint)) {
		echo "GENCODEGC:NUMVALID";
		exit();
	} else if(!is_numeric($limit)) {
		echo "GENCODEGC:LIMITVALID";
		exit();
	} else if($_POST['gcpoint'] != $gcpoint) {
		echo "GENCODEGC:CHARVALID";
		exit();
	} else {
		echo GenItemCodeGC($gcpoint, $limit, 0);
		exit();
	}
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'gencodeitem' ) {
	$itemindex = clean($_POST['itemindex']);
	$itemname = clean($_POST['itemname']);
	$quantity = clean($_POST['quantity']);
	$limit = clean($_POST['limit']);
	if($itemindex == "" || $itemname == "" || $quantity == "" || $limit == "") {
		echo "GENCODEITEM:FNULL";
		exit();
	} else if(!is_numeric($itemindex)) {
		echo "GENCODEITEM:INDEXVALID";
		exit();
	} else if(!is_numeric($limit)) {
		echo "GENCODEITEM:LIMITVALID";
		exit();
	} else if(!is_numeric($quantity)) {
		echo "GENCODEITEM:NUMVALID";
		exit();
	} else if($_POST['itemindex'] != $itemindex || $_POST['quantity'] != $quantity || $_POST['limit'] != $limit) {
		echo "GENCODEITEM:CHARVALID";
		exit();
	} else {
		echo GenItemCodeItem($itemindex, $itemname, $quantity, $limit, 1);
		exit();
	}
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'senditemcode' ) {
	$itemcodekey = clean($_POST['itemcodekey']);
	$userencrypt = clean($_POST['userencrypt']);
	if($itemcodekey == "" || $userencrypt == "") {
		echo "SENDITEMCODE:FNULL";
		exit();
	} else if(misc_parsestring(strtoupper($itemcodekey),'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890-') == FALSE) {
		echo "SENDITEMCODE:CHARVALID";
		exit();
	} else if(strtoupper($_POST['itemcodekey']) != strtoupper($itemcodekey) || $_POST['userencrypt'] != $userencrypt) {
		echo "SENDITEMCODE:CHARVALID";
		exit();
	} else {
		echo UseItemCode(Decrypt_Base64($userencrypt), $itemcodekey);
		exit();
	}
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'redeemgc' ) {
	$username = $_POST['userid'];
	$gccard = $_POST['gccard'];
	if($gccard == ""){
		echo "REDEEM:FALSE";
		exit();
	} else {
		$conn = db_connect();
		$str = "SELECT * FROM Accounts WHERE email = '".$username."'";
		$array = sqlsrv_fetch_array(exec_query( $conn, $str), SQLSRV_FETCH_ASSOC);
		$str4 = "SELECT * FROM UsersInventory WHERE CustomerID = '".$array['CustomerID']."' AND ItemID = '".$gc_cardid."' ";
		$array1 = sqlsrv_fetch_array(exec_query( $conn, $str4), SQLSRV_FETCH_ASSOC);
		if($array1['Quantity'] < $gccard){
			echo "REDEEM:FALSE";
			exit();
		} else if (exec_num( $conn,$str ) == 1) {
			$point = $gccard_x * $gccard;
			$str1 = "UPDATE UsersData SET GamePoints += '".$point."' WHERE CustomerID = '".$array['CustomerID']."'";
			exec_query($conn,$str1);
			$str2 = "UPDATE UsersInventory SET Quantity -= '".$gccard."' WHERE CustomerID = '".$array['CustomerID']."' AND ItemID = '".$gc_cardid."'";
			exec_query($conn,$str2);
			$array1 = sqlsrv_fetch_array(exec_query( $conn, $str4), SQLSRV_FETCH_ASSOC);
			if($array1['Quantity'] == 0) {
				$str5 = "DELETE FROM UsersInventory WHERE CustomerID = '".$array['CustomerID']."' AND ItemID = '".$gc_cardid."'";
				exec_query($conn,$str5);
			}
			echo "REDEEM:TRUE";
			exit();
		} else {
			echo "REDEEM:FALSE";
			exit();
		}
		
	}
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'addmap' ) {
	$mapname = clean($_POST['mapname']);
	$mapid = clean($_POST['mapid']);
	if($mapname == "" || $mapid == "") {
		echo "ADDMAP:FNULL";
		exit();
	} else if($_POST['mapname'] != $mapname || $_POST['mapid'] != $mapid) {
		echo "ADDMAP:CHARVALID";
		exit();
	} else if(!is_numeric($mapid)) {
		echo "ADDMAP:PAYVALID";
		exit();
	} else {
		echo AddMap($mapname, $mapid);
		exit();
	}
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'addpos' ) {
	$placename = clean($_POST['placename']);
	$datamap = Decrypt_Base64(clean($_POST['datamap']));
	$posX = clean($_POST['posX']);
	$posY = clean($_POST['posY']);
	$posZ = clean($_POST['posZ']);
	$pay = clean($_POST['pay']);
	if($placename == "" || $datamap == "" || $posX == "" || $posY == "" || $posZ == "" || $pay == "") {
		echo "ADDPOS:FNULL";
		exit();
	} else if($_POST['placename'] != $placename || $_POST['posX'] != $posX || $_POST['posY'] != $posY || $_POST['posZ'] != $posZ || $_POST['pay'] != $pay) {
		echo "ADDPOS:CHARVALID";
		exit();
	} else if(!is_numeric($pay)) {
		echo "ADDPOS:PAYVALID";
		exit();
	} else if(!is_numeric($datamap)) {
		echo "ADDPOS:MAPVALID";
		exit();
	} else if(misc_parsestring($posX,'0123456789.') == FALSE) {
		echo "ADDPOS:POSVALID";
		exit();
	} else if(misc_parsestring($posY,'0123456789.') == FALSE) {
		echo "ADDPOS:POSVALID";
		exit();
	} else if(misc_parsestring($posZ,'0123456789.') == FALSE) {
		echo "ADDPOS:POSVALID";
		exit();
	} else {
		echo AddPos($placename, $datamap, $posX, $posY, $posZ, $pay);
		exit();
	}
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'addreward' ) {
	$amount = clean($_POST['amount']);
	$itemid = clean($_POST['itemid']);
	$quantity = clean($_POST['quantity']);
	$itemname = clean($_POST['itemname']);
	if($amount == "" || $itemid == "" || $quantity == "" || $itemname == "") {
		echo "ADDREWARD:FNULL";
		exit();
	} else if($_POST['amount'] != $amount || $_POST['itemid'] != $itemid || $_POST['quantity'] != $quantity || $_POST['itemname'] != $itemname) {
		echo "ADDREWARD:CHARVALID";
		exit();
	} else if(!is_numeric($amount)) {
		echo "ADDREWARD:AMOUNTVALID";
		exit();
	} else if(!is_numeric($itemid)) {
		echo "ADDREWARD:ITEMIDVALID";
		exit();
	} else if(!is_numeric($quantity)) {
		echo "ADDREWARD:QTVALID";
		exit();
	} else {
		echo AddReward($amount, $itemid, $quantity, $itemname);
		exit();
	}
  } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'changename' ) {
	$charid = $_POST['charid'];
	$newname = $_POST['newname'];
	if($charid == "" || $newname == "") {
		echo "CHANGE:FNULL";
		exit();
	} else if($_POST['charid'] != $charid || $_POST['newname'] != $newname) {
		echo "CHANGE:CHARVALID";
		exit();
	} else if(misc_parsestring($newname,$text) == FALSE) {
		echo "CHANGE:CHARVALID";
		exit();
	} else {
		echo ChangeName($charid, $newname);
		exit();
	}
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'changeexp' ) {
	$charname = $_POST['charname'];
	$wpamount = $_POST['wpamount'];
	if($charname == "" || $wpamount == "") {
		echo "EXP:FNULL";
		exit();
	} else if($_POST['charname'] != $charname || $_POST['wpamount'] != $wpamount) {
		echo "EXP:CHARVALID";
		exit();
	} else if(!is_numeric($wpamount)) {
		echo "EXP:CHARVALID";
		exit();
	} else {
		echo ChangeExp($charname, $wpamount);
		exit();
	}
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'tmpay' ) {
	$tmc_pass = clean($_POST['tmc_pass']);
	$unit = clean($_POST['point']);
	$uid = clean($_POST['uid']);
	$email = clean($_POST['email']);
	echo refill_sendcard($tmc_pass, $unit, $uid, $email);
	exit();
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'wallet' ) {
	$tmc_pass = clean($_POST['tmc_pass']);
	$unit = clean($_POST['point']);
	$uid = clean($_POST['uid']);
	$email = clean($_POST['email']);
	echo true2wallet($tmc_pass, $unit, $uid, $email);
	exit();
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'tmpaycheck' ) {
	$tmc_pass = clean($_POST['tmc_pass']);
	$uid = clean($_POST['uid']);
	echo tmpay_check($tmc_pass, $uid);
	exit();
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'addspcitem' ) {
	$itemid = clean($_POST['itemid']);
	$itemname = clean($_POST['itemname']);
	$opt1 = clean($_POST['opt1']);
	$opt2 = clean($_POST['opt2']);
	$opt3 = clean($_POST['opt3']);
	$price = clean($_POST['price']);
	$quantity = clean($_POST['quantity']);
	if($itemid == "" || $itemname == "" || $price == "" || $quantity == "") {
		echo "ADDSPCITEM:FNULL";
		exit();
	} else if($_POST['itemid'] != $itemid || $_POST['itemname'] != $itemname || $_POST['price'] != $price || $_POST['quantity'] != $quantity) {
		echo "ADDSPCITEM:CHARVALID";
		exit();
	} else if(!is_numeric($itemid)) {
		echo "ADDSPCITEM:ITEMIDVALID";
		exit();
	} else if(!is_numeric($price)) {
		echo "ADDSPCITEM:PRICEVALID";
		exit();
	} else if(!is_numeric($quantity)) {
		echo "ADDSPCITEM:QTVALID";
		exit();
	} else {
		echo AddSpcitem($itemid, $itemname, $opt1, $opt2, $opt3, $price, $quantity);
		exit();
	}
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'banned' ) {
	$banned = clean($_POST['banned']);
	if($banned == ""){
		echo "BANNED:FNULL";
		exit();
	}else if($_POST['banned'] != $banned) {
		echo "BANNED:CHARVALID";
		exit();
	} else {
		echo AddBanned($banned);
		exit();
	}
  } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'hwidban' ) {
	$hardwareid = clean($_POST['hardwareid']);
	$cid = clean($_POST['cid']);
	if($cid == "" && $hardwareid = "" || $cid == "" || $hardwareid = ""){
		echo "HWIDBAN:FNULL";
		exit();
	}else if($_POST['hardwareid'] != $hardwareid && $_POST['cid'] != $cid) {
		echo "HWIDBAN:CHARVALID";
		exit();
	} else {
		echo HwidBanned($hardwareid, $cid);
		exit();
	}
  } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'hwidunban' ) {
	$hardwareid = clean($_POST['hardwareid']);
	$cid = clean($_POST['cid']);
	if($cid == "" && $hardwareid = "" || $cid == "" || $hardwareid = ""){
		echo "HWIDUNBAN:FNULL";
		exit();
	}else if($_POST['hardwareid'] != $hardwareid && $_POST['cid'] != $cid) {
		echo "HWIDUNBAN:CHARVALID";
		exit();
	} else {
		echo HwidBanned($hardwareid, $cid, true);
		exit();
	}
  } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'unban' ) {
	$cid = clean($_POST['cid']);
	if($cid == ""){
		echo "UNBAN:FNULL";
		exit();
	}else if($_POST['cid'] != $cid) {
		echo "UNBAN:CHARVALID";
		exit();
	} else {
		echo UnBanned($cid);
		exit();
	}
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'findchar' ) {
	$charname = clean($_POST['findchar']);
	if($charname == ""){
		echo "FINDCHAR:FNULL";
		exit();
	} else if($_POST['banned'] != $banned) {
		echo "FINDCHAR:CHARVALID";
		exit();
	} else {
		$data = FindChar($charname);
		if(count($data)>0) {
			echo 'FINDCHAR:TRUE#'.$data[0]['email'];
			exit();
		} else {
			echo 'FINDCHAR:FAILED';
			exit();
		}
	}
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'delimages' ) {
	$patch = $_POST['patch'];
	if($patch == ""){
		echo "DELIMG:FNULL";
		exit();
	} else {
		echo removeDir($patch);
		exit();
	}
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'queryitemdb' ) {
	echo queryitemdb();
	exit();
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'conf' ) {
	$conf_ip = clean($_POST['conf_ip']);
	$conf_user = clean($_POST['conf_user']);
	$conf_pass = clean($_POST['conf_pass']);
	$conf_dbname = clean($_POST['conf_dbname']);
	$conf_license = clean($_POST['conf_license']);
	$conf_passkey = clean($_POST['conf_passkey']);
	$conf_tmnid = clean($_POST['conf_tmnid']);
	$conf_adminid = clean($_POST['conf_adminid']);
	$conf_md5 = clean($_POST['conf_md5']);
	if($conf_ip == "" || $conf_user == "" || $conf_pass == "" || $conf_dbname == "" || $conf_license == "" || $conf_passkey == "" || $conf_tmnid == "" || $conf_adminid == "" || $conf_md5 == "") {
		echo "CONF:FNULL";
		exit();
	} else if($_POST['conf_ip'] != $conf_ip || $_POST['conf_user'] != $conf_user || $_POST['conf_pass'] != $conf_pass || $_POST['conf_dbname'] != $conf_dbname || $_POST['conf_passkey'] != $conf_passkey || $_POST['conf_tmnid'] != $conf_tmnid || $_POST['conf_adminid'] != $conf_adminid) {
		echo "CONF:CHARVALID";
		exit();
	} else {
		echo SetupConf($conf_ip, $conf_user, $conf_pass, $conf_dbname, $conf_license, $conf_passkey, $conf_tmnid, $conf_adminid, $conf_md5);
		exit();
	}
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'startmultiple' ) {
	$start_date = strtotime(clean($_POST['start_date']));
	$end_date = strtotime(clean($_POST['end_date']));
	$multiple = clean(Decrypt_Base64($_POST['multiple']));
	if($start_date == "" || $end_date == "" || $multiple == "") {
		echo "STARTMULTIPLE:FNULL";
		exit();
	} else if(!is_numeric($start_date)) {
		echo "STARTMULTIPLE:INDEXVALID";
		exit();
	} else if(!is_numeric($end_date)) {
		echo "STARTMULTIPLE:INDEXVALID";
		exit();
	} else if(misc_parsestring($multiple,'12345') == FALSE) {
		echo "STARTMULTIPLE:INDEXVALID";
		exit();
	} else if($start_date > $end_date) {
		echo "STARTMULTIPLE:TIMEVALID";
		exit();
	} else {
		echo UpdateEvent($start_date, $end_date, $multiple);
		exit();
	}
 } else if((isset($_POST['cmd']) && $_POST['cmd'] == 'getStatusMultiple') || (isset($_GET['cmd']) && $_GET['cmd'] == 'getStatusMultiple') && (isset($_GET['data']))) {
	global $_CONFIG;
	$dataGC = GetGCAmount();
	$data = GetdataMultiple();
	$multi = $data[0]['multiple'];
	$start = $data[0]['start_date'];
	$end = $data[0]['end_date'];
	$cur = strtotime(date("Y-m-d H:i:s", time()));
	$str = '';
	if($_GET['data']==1) {
		if( $multi > 1 ) {
			if($start > $cur) {
				echo 'หมดกิจกรรม * '.$multi.' ในอีก '.sec_to_time($start - $cur).'#* 1#* '.$multi.'#'.date("Y-m-d H:i:s", $start).'#'.date("Y-m-d H:i:s", $end);
			} else if($end > $cur) {
				echo 'หมดกิจกรรม * '.$multi.' ในอีก '.sec_to_time($end - $cur).'#* '.$multi.'#-#'.date("Y-m-d H:i:s", $start).'#'.date("Y-m-d H:i:s", $end);
			} else if($cur > $end) {
				UpdateEvent($start, $end, 1);
			} else {
				echo 'หมดกิจกรรม'.'#* '.$multi.'#-'.'#-'.'#-';
			}
		} else {
			echo 'หมดกิจกรรม'.'#* '.$multi.'#-'.'#-'.'#-';
		}
	} else if($_GET['data']==2) {
		if( $multi > 1 ) {
			if($start > $cur) {
				$str .= 1;
				for($i=0; $i<count($dataGC); $i++) {
					$str .= '#'.$dataGC[$i]['TopupA_amount'];
				}
			} else if($end > $cur) {
				$str .= $multi;
				for($i=0; $i<count($dataGC); $i++) {
					$str .= '#'.$dataGC[$i]['TopupA_amount'] * $multi;
				}
			} else if($cur > $end) {
				UpdateEvent($start, $end, 1);
			} else {
				$str .= $multi;
				for($i=0; $i<count($dataGC); $i++) {
					$str .= '#'.$dataGC[$i]['TopupA_amount'];
				}
			}
		} else {
			$str .= $multi;
			for($i=0; $i<count($dataGC); $i++) {
				$str .= '#'.$dataGC[$i]['TopupA_amount'];
			}
		}
		echo $str;
	} else {
		if( $multi > 1 ) {
			if($start > $cur) {
				$str .= 1.5;
				for($i=0; $i<count($dataGC); $i++) {
					$str .= '#'.$dataGC[$i]['TopupA_amount'] * $str;
				}
			} else if($end > $cur) {
				$str .= $multi + 0.5;
				for($i=0; $i<count($dataGC); $i++) {
					$str .= '#'.$dataGC[$i]['TopupA_amount'] * $str;
				}
			} else if($cur > $end) {
				UpdateEvent($start, $end, 1);
			} else {
				$str .= $multi + 0.5;
				for($i=0; $i<count($dataGC); $i++) {
					$str .= '#'.$dataGC[$i]['TopupA_amount'] * $str;
				}
			}
		} else {
			$str .= $multi * 1.5;
			for($i=0; $i<count($dataGC); $i++) {
				$str .= '#'.$dataGC[$i]['TopupA_amount'] * $str;
			}
		}
		echo $str;
	}
 } else if((isset($_POST['cmd']) && $_POST['cmd'] == 'serverinfo') || (isset($_GET['cmd']) && $_GET['cmd'] == 'getserverinfo') ) {
	$str .= '#'.getserverstatus("server").'#'.getserverstatus("online").'#'.getserverstatus("accounts").'#'.getserverstatus("character");
	echo $str;
	exit();
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'fblogin') {
	$id = $_POST['fbmail'];
	
	exit();
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'getitemname') {
	$id = $_POST['id'];
	$str = get_dbxml($id);
	echo $str['name'];
	exit();
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'deleteid' ) {
	$decode = Decrypt_Base64(clean($_POST['encode']));
	echo DeleteItemCode($decode);
	exit();
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'deletereward' ) {
	$decode = Decrypt_Base64(clean($_POST['encode']));
	echo DeleteReward($decode);
	exit();
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'deletespcitem' ) {
	$decode = Decrypt_Base64(clean($_POST['encode']));
	echo DeleteSpcItem($decode);
	exit();
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'deletebanned' ) {
	$decode = Decrypt_Base64(clean($_POST['encode']));
	echo DeleteBanned($decode);
	exit();
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'getreward' ) {
	$decode = Decrypt_Base64(clean($_POST['encode']));
	echo GetReward($decode);
	exit();
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'delimage' ) {
	$decode = Decrypt_Base64(clean($_POST['imgname']));
	echo DelImage($decode,$_POST['id']);
	exit();
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'deletepromotion' ) {
	$decode = Decrypt_Base64(clean($_POST['encode']));
	echo DeletePromotion($decode);
	exit();
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'delpos' ) {
	$decode = Decrypt_Base64(clean($_POST['encode']));
	echo delpos($decode);
	exit();
 } else if(isset($_POST['cmd']) && $_POST['cmd'] == 'delmap' ) {
	$decode = Decrypt_Base64(clean($_POST['encode']));
	echo delmap($decode);
	exit();
 } 
 ?>