<?php
header("content-type:text/html;charset=utf-8");
require_once "../utils/ToMessage.class.php";
session_start();
//验证码图上的数字
$myCheckCode= $_SESSION['myCheckCode'];
//echo $myCheckCode;
//用户输入的验证码
$catpcha=$_POST['catpcha'];
$userid=$_POST['userid'];
$pwd=$_POST['pwd'];

$tomessage=new tomessage();
if(!empty($userid)){
    if(!empty($pwd)){
        if(!empty($catpcha)){
            if($catpcha==$myCheckCode){
                unset($_SESSION['myCheckCode']);
                header("location:./loginProcess.php?userid=$userid&pwd=$pwd");
            }else{
                $tomessage->trace("验证码不正确,正确为$myCheckCode",-1,1000);
            }
        }else{
            $tomessage->trace("验证码不能为空",-1,1000);
        }
    }else{
        $tomessage->trace("密码不能为空",-1,1000);
    }

}else{
    $tomessage->trace("用户名不能为空",-1,1000);
}

?>