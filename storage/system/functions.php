<?php
	@session_start();
	header('Content-Type: text/html; charset=utf-8');
	date_default_timezone_set('Asia/Bangkok');

	include('config.php');
	include('lang.php');

	function check_login() {
		if(!isset($_SESSION['customerid']) || !isset($_SESSION['username'])){
			session_destroy();
			header( "location: index.php" );
		}
	 }

	function db_connect() {
		global $_CONFIG;
		$db_connectionInfo = array( "UID" => $_CONFIG['SERVER']['USER'], "PWD" => $_CONFIG['SERVER']['PASS'], "Database" => $_CONFIG['SERVER']['DB'], "CharacterSet" => "UTF-8" );
		$conn = sqlsrv_connect($_CONFIG['SERVER']['IP'].",".$_CONFIG['SERVER']['PORT'], $db_connectionInfo);
		if(!$conn) {
			die( print_r( sqlsrv_errors(), true));
			exit();
		}
		return $conn;
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

	function md5_warz($password) {
		global $_CONFIG;
		if($_CONFIG['SERVER']['MD5'] == 1) {
			return md5($_CONFIG['SERVER']['MD5KEY'].$password);
		} else if($_CONFIG['SERVER']['MD5'] == 2) {
			return md5($_CONFIG['SERVER']['MD5KEY'].$password.$_CONFIG['SERVER']['MD5KEY2']);
		} else {
			return $password;
		}
	}

	function exec_query($conn, $tsql) {
		$stmt = sqlsrv_query($conn, $tsql);
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
?>
