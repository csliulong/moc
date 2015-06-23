<?php
/**
 * 连接数据库
 * @return resource
 */
function connect(){
	$link=mysql_connect(DB_HOST,DB_USER,DB_PWD) or die("数据库连接失败ERROR:".mysql_errno().":".mysql_error());
	mysql_set_charset(DB_CHARSET);
	mysql_select_db(DB_DBNAME) or die("指定数据库打开失败");
	return $link;
}

/**
 * 完成记录的插入操作
 * @param sting $table
 * @param array $array
 * @return number
 */
function insert($table,$array){
	$keys=join(",", array_keys($array));
	$vals="'".join("','",array_values($array))."'";
	$sql="insert {$table}($keys) values({$vals})";
	echo $sql;
	echo '<hr/>';
	mysql_query($sql);
	return mysql_insert_id();	
}


/**
 * 记录的更新操作
 * @param string $table
 * @param array $array
 * @param string $where
 * @return number|boolean
 */
function update($table,$array,$where=NULL){
	foreach ($array as $key=>$val){
		if ($str==NULL){
			$sep="";
		}else {
			$sep=",";
		}
		$str.=$sep.$key."='".$val."'";
	}
	
		$sql="update {$table} set {$str} ".($where==NULL?NULL:" where ".$where);
		$result=mysql_query($sql);
		echo $sql;
		if ($result){
			return mysql_affected_rows();
		}else {
			return FALSE;
		}
	
}


/**
 * 删除记录
 * @param string $table
 * @param string $where
 * @return number
 */
function delete($table,$where){
	$where=$where==NULL?NULL:" where ".$where;
	$sql="delete from {$table} {$where}";
//	echo $sql;
	mysql_query($sql);
	return mysql_affected_rows();
}


/**
 * 得到指定一条记录
 * @param string $sql
 * @param string $result_type
 * @return multitype:
 */
function fetchOne($sql,$result_type=MYSQL_ASSOC){
	$result=mysql_query($sql);
	$row=@mysql_fetch_array($result,$result_type);
	return $row;
}




/**
 * 得到所有记录
 * @param string $sql
 * @param string $result_type
 * @return multitype:
 */
function fetchAll($sql,$result_type=MYSQL_ASSOC){
	$result=mysql_query($sql);
	while (@$row=mysql_fetch_array($result,$result_type)){
		$rows[]=$row;
	}
	return $rows;
}


function getResultNum($sql){
	$result=mysql_query($sql);
	return mysql_num_rows($result);
}


function getInsertId(){
	return mysql_insert_id();
}

























?>