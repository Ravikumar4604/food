<?php

$uname = $_POST['uname'];
$up1   = $_POST['up1'];


if(!empty($uname)|| !empty($up1))
{
	$host = "localhost";
	$dbusername = "root";
	$dbpassword="";
	$dbname="loginpage";


$conn=new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
	die('Connect Error('.mysqli_connect_errno() .') '
		. mysqli_connect_error());
}
else{
	$SELECT="SELECT uname from login where uname=? Limit 1";
	$INSERT="INSERT into login(uname , up1)
	values(?,?)";


	$stmt = $conn->prepare($SELECT);
	$stmt->bind_param("s",$uname);
	$stmt->execute();
	$stmt->bind_result($uname);
	$stmt->store_result();
	$rnum=$stmt->num_rows;

	if($rnum==0){
		$stmt->close();
		$stmt = $conn->prepare($INSERT);
	    $stmt->bind_param("ss", $uname , $up1);
	    $stmt->execute();
	echo"NEW RECORD INSERTED";
}
else{
	echo "SOMONE ALREADY REGISTERED USING THIS EMAIL ID";
}
$stmt->close();
$conn->close();
}
	die();
}
?>