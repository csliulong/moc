<?php
/*
define("ROOT", dirname(__FILE__));
//echo ROOT;
set_include_path(".".PATH_SEPARATOR.ROOT."/lib".PATH_SEPARATOR.ROOT."/core".PATH_SEPARATOR.ROOT."/configs".PATH_SEPARATOR.get_include_path());
echo get_include_path();
*/

//include '../include.php';
//$result=mysql_connect("localhost","root","aaaaaa");
//$sql="select * from imooc_admin";
//$array=mysql_query($sql);
//echo $array;
//$row=mysql_fetch_array($array);
//var_dump($row);

require_once '../include.php';
//$sql="select * from imooc_admin";
//$array=mysql_query($sql);

//
//while ($row=mysql_fetch_row($array)){
//	echo '<hr/>';
//	var_dump($row);
//	foreach ($row as $data){
//		echo $data;
//	}
//}


//
//while ($row=mysql_fetch_assoc($array)){
//	echo '<hr/>';
//	var_dump($row);
//	foreach ($row as $data){
//		echo $data;
//	}
//}


//while ($row=mysql_fetch_array($array)){
//	echo '<hr/>';
//	var_dump($row);
//	foreach ($row as $data){
//		echo $data;
//	}
//}


//while ($row=mysql_fetch_field($array)){
//	echo '<hr/>';
//	var_dump($row);
//	foreach ($row as $data){
//		echo $data;
//	}
//}

//while ($row=mysql_fetch_assoc($array)){
//	echo '<hr/>';
//	var_dump($row);
//	foreach ($row as $data){
//		echo '<br/>';
//		echo $data;
//	}
//}
/*
var_dump($array);
echo '<hr/>';
$row=mysql_fetch_assoc($array);
//print_r($row);

var_dump($row);
echo '<hr/>';

$row['username']=iconv('gbk', 'utf-8', '我是你大大爷！');

//$row['id']='10';
unset($row['id']);
unset($row['username']);
var_dump($row);

echo '<hr/>';
$result=update("imooc_admin", $row, 'id>7');
echo $result;
echo '<hr/>';
$result=delete("imooc_admin", 'id=10');
echo $result;
*/

//$array=mysql_query($sql);
//$result=mysql_fetch_assoc($sql)
/*
$sql='select * from imooc_admin';
$result=fetchAll($sql);
/*
var_dump($result);


//var_dump($result);
//echo $result;
//require_once '../include.php';
//var_dump($link);
/*
$sql="select * from imooc_admin";
$array=mysql_query($sql);
var_dump($array);
$keys=join(",", array_keys($array));
$vals="'".join("','", array_values($array))."'";
var_dump($keys);
echo "</h>";

$sql2="insert {$talbe}($keys) values({$vals})";
*/

/*
$sql="select * from imooc_admin where username='king'";
$result=checkAdmin($sql);

var_dump($result);
echo "<hr/>";

*/



//$result=buildRandomString(3,14);
//verifyImage();
verifyImage(3,5,5,5);

echo $result;











