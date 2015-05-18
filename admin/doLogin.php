<?php
require_once '../include.php';
$username=$_POST['username'];
$username=addslashes($username);
$password=md5($_POST['password']);

$verify=strtolower($_POST['verify']);
$verify1=strtolower($_SESSION['verify']);
$autoFlag=$_POST['autoFlag'];
//echo $verify;
//echo '<hr/>';
//echo $verify1;
if ($verify==$verify1){
	$sql="select * from imooc_admin where username='{$username}' and password='{$password}'";
	$row=checkAdmin($sql);
	if ($row){
		if ($autoFlag){
			setcookie("adminId",$row['id'],time()+7*24*3600);
			setcookie("adminName",$row['username'],time()+7*24*3600);
		}
		$_SESSION['adminId']=$row['id'];
		$_SESSION['adminName']=$row['username'];
		alertMes("登陆成功", "index.php");
	}else {
		alertMes("登陆失败，重新登陆！", "login.php");
	}
}else {
	alertMes("验证码错误", "login.php");
}