<?php
 $ver = '1.0.3';
 error_reporting(0);
 @session_start();
 header('Content-Type: text/html; charset=utf-8');
 date_default_timezone_set("Asia/Bangkok");
 include('../config.php');
 include('../lang.php');
if (!isset($config)) {
    exit;
}

global $_CONFIG;
db_check();
$db_connectionInfo = array( "UID" => $_CONFIG['SERVER']['USER'], "PWD" => $_CONFIG['SERVER']['PASS'], "Database" => $_CONFIG['SERVER']['DB'], "CharacterSet" => "UTF-8" );
$conn = sqlsrv_connect($_CONFIG['SERVER']['IP'], $db_connectionInfo);
return $conn;

if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

function query($conn, $tsql, $q = array()) {
    $stmt = sqlsrv_query($conn, $tsql, $q, array("Scrollable" => SQLSRV_CURSOR_KEYSET));
    if (!$stmt) {
        echo "exec failed.\n";
        die(print_r(sqlsrv_errors(), true));
    }
    return $stmt;
}
