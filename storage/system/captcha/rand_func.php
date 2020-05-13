<?php
  function randText($len=6) {
    $textSpace = "abcdefhjmnprtuwxyzABCDEFGHJKMNPRTVXYZ0123456789";
    $textLen = strlen($textSpace)-1;
    $str = "";
    for($i=0;$i<$len;$i++) {
     $str .= $textSpace[rand(0,$textLen)];
    }
    return $str;
  }
?>
