<?php
function reg(){
	$arr=$_POST;
	$arr['password']=md5($_POST['password']);
	$arr['regTime']=time();

	$uploadFile=uploadFile();

	if ($uploadFile&&is_array($uploadFile)) {
		$arr['face']=$uploadFile[0]['name'];
	}else{
		return "注册失败";
	}

	if (insert("imooc_user",$arr)) {
		$mes="注册成功！<br/>3秒钟后跳转到登陆页面！<meta http-equiv='refresh' content='3;url=login.php'/>";
	}else{
		$filename="uploads/".$uploadFile[0]['name'];
		if (file_exists($filename)) {
			unlink($filename);
		}
		$mes="注册失败！<br/><a href='reg.php'>重新注册</a>|<a href='index.php'>查看首页</a>";
	}
	return $mes;
}



function login(){
	$username=$_POST['username'];
	$username=mysql_escape_string($username);
	$password=md5($_POST['password']);

	$verify=strtolower($_POST['verify']);
	$verify1=strtolower($_SESSION['verify']);
	// echo $verify;
	// echo '<hr/>';
	// echo $verify1;
	// exit();

	$autoFlag=$_POST['autoFlag'];
	// var_dump($_POST);
	// // echo '<hr/>';
	// exit();
	if ($verify==$verify1) {
		$sql="select * from imooc_user where username='{$username}' and password='{$password}'";
		$row=fetchOne($sql);
		if ($row) {
			if ($autoFlag) {

				setcookie("userId",$row['id'],time()+7*24*3600);
				setcookie("userName",$row['username'],time()+7*24*3600);
			}

			$_SESSION['loginFlag']=$row['id'];
			$_SESSION['username']=$row['username'];

			$mes="登陆成功！<br/>3秒钟后跳转到首页<meta http-equiv='refresh' content='3;url=index.php'/>";
		}else{
			$mes="登陆失败！<a href='login.php'>重新登陆</a>";
		}
	}else{
		$mes="验证码错误！<a href='login.php'>重新登陆</a>";
	}
	return $mes;
}


function userOut(){
	$_SESSION=array();

	if (isset($_COOKIE[session_name()])) {
		setcookie(session_name(),"",time()-1);
	}

	session_destroy();
	header("location:index.php");
}

function addUser(){
	$arr=$_POST;
	unset($arr['demo1']);
	// var_dump($arr);
	// echo '<hr/>';
	// exit();
//	$arr['password']=md5($_POST['password']);
	$arr['regTime']=time();

	$path="../face";
	$uploadFile=uploadFile($path);
	if ($uploadFile&&is_array($uploadFile)) {
		$arr['face']=$uploadFile[0]['name'];
	}else{
		return "添加失败！<a href='addUser.php'>重新添加</a>";
	}

	$res=insert("imooc_user",$arr);
	if($res){
		$mes="添加成功！<br/><a href='addUser.php'>继续添加</a>|<a href='listUser.php'>查看用户列表</a>";
	}else{
		$filename="../face/".$uploadFile[0]['name'];
		if (file_exists($filename)) {
			unlink($filename);
		}
		$mes="添加失败！<br/><a href='addUser.php'>重新添加</a>";
	}
	return $mes;
}

function changePwd($id){
	$arr=$_POST;
	unset($arr['password2']);
	$arr['password']=md5($_POST['password']);
	$res=update("imooc_user",$arr,"id={$id}");
	if ($res) {
		$mes="添加成功！<br/>3秒钟后跳转到首页<meta http-equiv='refresh' content='11;url=index.php'/>";
	}else{
		$mes="登陆失败！<br/>3秒钟后跳转到首页<meta http-equiv='refresh' content='13;url=user-list.php'/>";
	}
	return $mes;
}

function editUser($id){
	$arr=$_POST;
	unset($arr['password2']);
	unset($arr['uploadfile-2']);


	$arr['password']=md5($_POST['password']);
	$face=$_POST['face'];
	echo $face;
	$path="../admin/face";

	// if (!file_exists($path)) {
	// 	mkdir($path,0777,true);
	// }

	if (file_exists("../admin/face/".$face)) {
//		echo "../admin/face/".$face;
		unlink("../admin/face/".$face);
	}

	$uploadFile=uploadFile($path);

	var_dump($uploadFile);
	if ($uploadFile&&is_array($uploadFile)) {
		$arr['face']=$uploadFile[0]['name'];
		echo $arr['face'];
	}else{
		return "添加失败！<a href='addUser.php'>重新添加</a>";
	}

	$res=update("imooc_user",$arr,"id={$id}");
	if ($res) {
		$mes="编辑成功！<br/><a href='listUser.php'>查看用户列表</a>";
	}else{
		$mes="编辑失败！<br/><a href='listUser.php'>请重新修改</a>";
	}
	return $mes;
}

function delUser($id){
	$sql="select face from imooc_user where id=".$id;
	$row=fetchOne($sql);
//	echo $row;
	$face=$row['face'];
//	echo $face;
//	exit();
	if (file_exists("../face/".$face)) {
		unlink("../face/".$face);
	}

	if (delete("imooc_user","id={$id}")) {
		$mes="删除成功!<br/><a href='listUser.php>查看用户列表</a>";
	}else{
		$mes="删除失败!<br/><a href='listUser.php'>请重新删除</a>";
	}
	return $mes;
}
?>