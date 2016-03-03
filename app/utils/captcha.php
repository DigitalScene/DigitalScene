<?php
session_start();
//$sid=session_id();
require './ValidateCode.class.php';//先把类包含进来，实际路径根据实际情况进行修改
$_vc=new ValidateCode();//实例化一个对象
//生成图片
$_vc->doimg();
$_SESSION['myCheckCode']=$_vc->getCode();//将验证码保存到SESSION中
?>