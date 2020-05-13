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
  		$_SESSION['username'] = $array['email'];
		echo "LOGIN:TRUE|";
		header('Location: ../../');
  		exit();
  	} else {
		echo "LOGIN:FALSE|";
		header('Location: ../../');
  		exit();
  	}
   }
?>
