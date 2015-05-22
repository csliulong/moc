<?php
require_once '../include.php';
$pageSize=2;
$page=$_REQUEST['page']?(int)$_REQUEST['page']:1;
$rows=getAdminByPage($page,$pageSize);
//var_dump($rows);

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<LINK rel="Bookmark" href="/favicon.ico" >
<LINK rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<script type="text/javascript" src="lib/PIE_IE678.js"></script>
<![endif]-->
<link href="css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="lib/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!--[if IE 7]>
<link href="lib/font-awesome/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" />
<![endif]-->
<link href="lib/iconfont/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>管理员列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i> 首页 <span class="c-gray en">&gt;</span> 管理员管理 <span class="c-gray en">&gt;</span> 管理员列表 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>
<div class="pd-20">
  <div class="text-c">
    <form class="Huiform" method="post" action="doAdminAction.php?act=addAdmin" target="_self">
      <input type="text" placeholder="帐号" autocomplete="off" value="" name="username" class="input-text" style=" width:150px">
      <input type="password" placeholder="密码" autocomplete="off" value="" name="password" class="input-text" style="width:150px;">
      <input type="text" placeholder="管理员邮箱" autocomplete="off" value="" name="email" class="input-text" style="width:150px;">
      <span class="select-box" style="width:150px;">
      <select class="select" name="admin_role" size="1">
        <option value="0">超级管理员</option>
        <option value="1">总编</option>
        <option value="2">栏目主辑</option>
        <option value="3">栏目编辑</option>
      </select>
      </span>
      <button type="submit" class="btn btn-success" id="" name=""><i class="icon-plus"></i> 添加</button>
    </form>
  </div>
  <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="icon-trash"></i> 批量删除</a></span> <span class="r">共有数据：<strong>54</strong> 条</span> </div>
  <table class="table table-border table-bordered table-bg">
    <thead>
      <tr>
        <th scope="col" colspan="7">员工列表</th>
      </tr>
      <tr class="text-c">
        <th width="25"><input type="checkbox" name="" value=""></th>
        <th width="40">ID</th>
        <th width="150">登录名</th>
        <th>角色</th>
        <th width="130">加入时间</th>
        <th width="100">是否已启用</th>
        <th width="70">操作</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($rows as $row):?>
      <tr class="text-c"> 
        <td><input type="checkbox" value="1" name=""></td>
        <td><?php echo $row['id'];?></td>
        <td><?php echo $row['username'];?></td>
        <td><?php echo $row['admin_role'];?></td>
        <td><?php echo time();?></td>
        <td class="admin-status"><span class="label label-success radius">已启用</span></td>
        <td class="f-14 admin-manage"><a style="text-decoration:none" onClick="admin_stop(this,'10001')" href="javascript:;" title="停用"><i class="icon-hand-down"></i></a> <a title="编辑" href="javascript:;" onclick="admin_edit('4','400','310','角色编辑','admin-edit.html')" class="ml-5" style="text-decoration:none"><i class="icon-edit"></i></a> <a title="删除" href="javascript:;" onclick="admin_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a></td>
      </tr>
      <?php endforeach;?>
      <?php if($totalRows>$pageSize):?>
        <tr>
          <td colspan="4"><?php echo showPage($page,$totalPage);?></td>
        </tr>
      <?php endif;?>
    </tbody>
  </table>
</div>
<script type="text/javascript" src="lib/jquery.min.js"></script> 
<script type="text/javascript" src="lib/Validform_v5.3.2.js"></script> 
<script type="text/javascript" src="lib/layer1.8/layer.min.js"></script> 
<script type="text/javascript" src="lib/laypage/laypage.js"></script> 
<script type="text/javascript" src="js/H-ui.js"></script> 
<script type="text/javascript" src="js/H-ui.admin.js"></script> 
<script type="text/javascript" src="js/H-ui.admin.doc.js"></script> 
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?080836300300be57b7f34f4b3e97d911";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F080836300300be57b7f34f4b3e97d911' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>