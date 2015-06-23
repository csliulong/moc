<?php
require_once '../include.php';
$id=$_REQUEST['id'];
$sql="select id,username,password,email,sex from imooc_user where id='{$id}'";
$row=fetchOne($sql);
// var_dump($row);
// exit;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<script type="text/javascript" src="lib/PIE_IE678.js"></script>
<![endif]-->
<link href="css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
<link href="lib/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css" />
<!--[if IE 7]>
<link href="lib/font-awesome/font-awesome-ie7.min.css" rel="stylesheet" type="text/css" />
<![endif]-->
<link href="lib/iconfont/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>添加用户</title>
</head>
<body>
<div class="pd-20">
  <form action="doAdminAction.php?act=editUser&id=<?php echo $id; ?>" method="post" class="form form-horizontal" id="form-user-add" enctype="multipart/form-data">
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>用户名：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="<?php echo $row['username']; ?>" id="user-name" name="username" datatype="*2-16" nullmsg="用户名不能为空">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>性别：</label>
      <div class="formControls col-5 skin-minimal">
        <div class="radio-box">
          <input type="radio" id="sex-1" value="1" name="sex" <?php echo $row['sex']=="男"?"checked='checked'":null; ?> datatype="*" nullmsg="请选择性别！">
          <label for="sex-1">男</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="sex-2" value="2" name="sex" <?php echo $row['sex']=="女"?"checked='checked'":null; ?>>
          <label for="sex-2">女</label>
        </div>
        <div class="radio-box">
          <input type="radio" id="sex-3" value="3" name="sex" <?php echo $row['sex']=="保密"?"checked='checked'":null; ?>>
          <label for="sex-3">保密</label>
        </div>
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>新密码：</label>
      <div class="formControls col-4">
        <input type="password" class="input-text" autocomplete="off" placeholder="密码" name="password" id="password" plugin="passwordStrength" datatype="*6-18" nullmsg="请输入密码！" >
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="Validform_checktip Validform_right" style="display: none;"></div>
    <div class="passwordStrength" style="">
      <b class="form-label col-3">密码强度：</b> <span class="bgStrength">弱</span><span>中</span><span class="last">强</span>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>确认密码：</label>
      <div class="formControls col-4">
        <input type="password" class="input-text" autocomplete="off" placeholder="密码" name="password2" id="password2" recheck="password" datatype="*6-18" nullmsg="请再输入一次密码！" errormsg="您两次输入的密码不一致！" >
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3"><span class="c-red">*</span>邮箱：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" placeholder="<?php echo $row['email']; ?>" name="email" id="email" datatype="e" nullmsg="请输入邮箱！">
      </div>
      <div class="col-4"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-3">附件：</label>
      <div class="formControls col-5"> <span class="btn-upload form-group">
        <input class="input-text upload-url" type="text" name="uploadfile-2" id="uploadfile-2" readonly  datatype="*" nullmsg="请添加附件！" style="width:200px">
        <a href="javascript:void();" class="btn btn-primary radius upload-btn"><i class="iconfont">&#xf0020;</i> 浏览文件</a>
        <input type="file" multiple name="face" class="input-file">
        </span> </div>
      <div class="col-4"> </div>
    </div>

    <div class="row cl">
      <div class="col-9 col-offset-3">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
      </div>
    </div>
  </form>
</div>
</div>
<script type="text/javascript" src="lib/jquery.min.js"></script> 
<script type="text/javascript" src="lib/icheck/jquery.icheck.min.js"></script> 
<script type="text/javascript" src="lib/Validform_v5.3.2.js"></script> 
<script type="text/javascript" src="js/H-ui.js"></script> 
<script type="text/javascript" src="js/H-ui.admin.js"></script> 
<script type="text/javascript" src="lib/passwordStrength-min.js"></script>
<script>
$(function(){
  //$(".registerform").Validform();  //就这一行代码！;    
  $("#form-user-password").Validform({
    tiptype:2,
    usePlugin:{
      passwordstrength:{
        minLen:6,//设置密码长度最小值，默认为0;
        maxLen:18,//设置密码长度最大值，默认为30;
        trigger:function(obj,error){
          //该表单元素的keyup和blur事件会触发该函数的执行;
          //obj:当前表单元素jquery对象;
          //error:所设密码是否符合验证要求，验证不能通过error为true，验证通过则为false;
          
          //console.log(error);
          if(error){
            obj.parent().next().find(".Validform_checktip").show();
            obj.parent().next().find(".passwordStrength").hide();
          }else{
            obj.parent().next().find(".Validform_checktip").hide();
            obj.parent().next().find(".passwordStrength").show(); 
          }
        }
      }
    }
  });
})

</script> 
<script type="text/javascript">
$(function(){
	$("#form-user-add").Validform({
		tiptype:2,
	});
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
});
</script> 
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