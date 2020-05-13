<?php

session_start();
include_once dirname(__FILE__) . '/config.php';
include_once dirname(__FILE__) . '/db.php';
CheckUserUpdate();
checkSQLServerConnect();

function checkSQLServerConnect() {
    global $conn;
    if (!$conn) {
        die(print_r(sqlsrv_errors(), true));
    }
}

function array_random_assoc($arr, $num = 1) {
    $keys = array_keys($arr);
    shuffle($keys);

    $r = array();
    for ($i = 0; $i < $num; $i++) {
        $r[$keys[$i]] = $arr[$keys[$i]];
    }
    return $r;
}

function randdy($var1, $var2) {
    $r = rand($var1, $var2);
    return $r;
}

function RandomGrade_20() {
    $min = 1;
    $max = 20;
    $r = rand($min, $max);
    if ($r >= 10) {
        $r = rand(5, $max);
    }
    if ($r >= 15) {
        $r = rand($min, $max);
    }
    return $r;
}

function returnVar($var) {
    return $var;
}

function checkDayofTime() {
    return date("D", strtotime(date("Y-M-d H:i:s", time())));
}


function getPlayerOnline() {
    global $conn;
    $find_online = query($conn, "SELECT uc.LastUpdateDate, uc.Gamertag, uc.CustomerID, ud.CustomerID, ud.IsDeveloper, ud.AccountType From UsersChars as uc JOIN UsersData as ud ON uc.CustomerID = ud.CustomerID      
WHERE DATEDIFF(MINUTE, uc.LastUpdateDate, GETDATE()) <= 1");
    $count_p = sqlsrv_num_rows($find_online);
    if ($find_online) {
        return $count_p;
    } else {
        return null;
    }
}

function rdr($url) {
    echo '<meta http-equiv="refresh" content="0;URL=' . $url . '">';
    echo '<script>location.replace("' . $url . '")</script>';
}

function is_str($txt) {
    if (!preg_match("/^[a-zA-Z0-9_]+$/", $txt)) {
        return false;
    } else {
        return true;
    }
}

function is_str_th($txt) {
    if (!preg_match('/\p{Thai}/u', $txt)) { //preg_match("/^[a-zA-Z0-9 \s]+$/", $name));
        return false;
    } else {
        return true;
    }
}

function clean($value) {
    $value = htmlspecialchars(strip_tags($value));
    if (get_magic_quotes_gpc()) {
        $value = stripslashes($value);
    }
    $value = str_replace("'", "''", $value);
    $value = str_replace(";", "", $value);
    $value = str_replace("=", "", $value);
    $value = str_replace(",", "", $value);
    $value = str_replace(" ", "", $value);
    return $value;
}

function GetTime() {
    return date("Y-m-d H:i:s", time());
}
