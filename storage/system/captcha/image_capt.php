<?php
  @session_start();
  require_once("rand_func.php");
  header("Content-Type: image/png");
  $im = @imagecreate(58, 18)
      or die("Cannot Initialize new GD image stream");
  $rt = randText();
  $_SESSION['CAPTCHA'] = $rt;
  $background_color = imagecolorallocate($im, 0, 0, 0);
  $text_color = imagecolorallocate($im, 255, 255, 255);
  $line1_color = imagecolorallocate($im, rand(0,255), rand(0,255), rand(0,255));
  $line2_color = imagecolorallocate($im, rand(0,255), rand(0,255), rand(0,255));
  imagestring($im, 5, 2, 2, $rt , $text_color);
  imageline($im,rand(0,40),rand(0,18),rand(0,40),rand(0,18),$line2_color);
  imageline($im,rand(0,40),rand(0,18),rand(0,40),rand(0,18),$line1_color);
  imagepng($im);
  imagedestroy($im);
?>
