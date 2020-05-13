<?php
  include("../config/connect.php");
  include("../config/select.php");
   @session_start();
   $uid = $_POST['email'];
   $cpt = $_POST['cpt'];
   if($uid != '' && $cpt != '') {
     if($cpt == $_SESSION['CAPTCHA']) {
       $conn = connectDb();
       $params = array();
       $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
       $sql = sqlsrv_query($conn, "SELECT * FROM Accounts WHERE email='$uid'", $params, $options);
       $stmt= sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC);
       $chk_uid = sqlsrv_num_rows($sql);
       if($chk_uid > 0) {
         $customer = $stmt['CustomerID'];
         $chk = sqlsrv_fetch_array(sqlsrv_query($conn, "SELECT * FROM UsersData WHERE CustomerID='$customer'"), SQLSRV_FETCH_ASSOC);
         if($chk['GetitemYoutube'] == 0) {
           $sql = sqlsrv_query($conn,"EXEC LG_FollowSteamer'".$customer."'");
           if($sql) {
             echo "success|รับไอเทมสำเร็จแล้ว, ไปนัวกันได้เลย!";
           } else {
             echo "error|Error: ไม่สามารถทำรายการลงฐานข้อมูลได้";
           }
         } else {
            echo "error|คุณได้รับไอเทมไปแล้ว, ไม่สามารถรับได้อีก";
         }
       } else {
         echo "error|ไม่พบชื่อผู้ใช้ของท่านในระบบ";
       }
     } else {
       echo "error|Captcha ไม่ถูกต้อง, กรุณาลองใหม่อีกครั้ง!";
     }
   } else {
     echo "error|กรุณากรอกข้อมูลให้ครบทุกช่อง";
   }
?>
