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