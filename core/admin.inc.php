<?php
function checkAdmin($sql){
	return fetchOne($sql);
}

function checkLogined(){
//	alertMes("请先登陆", "login.php");

	if ($_SESSION['adminId']==""&&$_COOKIE['adminId']==""){
		alertMes("请先登陆", "login.php");
	}
}


function addAdmin(){
	$arr=$_POST;
	$arr['password']=md5($_POST['password']);
	var_dump($arr);
	if (insert("imooc_admin",$arr)) {
		$mes="添加成功！<br/><a href='admin-list.html'>继续添加</a>|<a href='admin-list.html'>查看管理员列表</a>";
//		alertMes("kkkkk");
	}else{
		$mes="添加失败！<br/><a href='admin-list.html'>重新添加</a>";
//		alertMes("kskkkk");
	}
	return $mes;
}

function getAdminByPage($page,$pageSize=2){
	$sql="select * from imooc_admin";
	global $totalRows;
	$totalRows=getResultNum($sql);
	global $totalPage;
	$totalPage=ceil($totalRows/$pageSize);
	if ($page<1||$page==null||!is_numeric($page)) {
		$page=1;
	}
	if($page>=$totalPage)$page=$totalPage;
	$offset=($page-1)*$pageSize;
	$sql="select id,username,email,admin_role from imooc_admin limit {$offset},{$pageSize}";
	$rows=fetchAll($sql);
	return $rows;
}