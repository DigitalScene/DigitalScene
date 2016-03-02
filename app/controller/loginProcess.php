<?php

// header("location:index.php?m=home&c=login&a=login");
//dirname( __FILE__ )为/admin
require_once( "./../../require/function.inc.php" );
// echo dirname(__FILE__)."/../require/function.inc.php";
require_once( LULINREQ."/class/userlogin.class.php" );
require_once( "./loginController.php" );
//$dopost这个有什么用
if ( empty( $dopost ) )
{
    $dopost = "";
}

//$admindirs为Array集合,里面是路径
$admindirs = explode( "/", str_replace( "\\", "/", dirname( __FILE__ ) ) );
// echo dirname( __FILE__ ) ;exit();
//获取$admindirs数组最后一个
$admindir = $admindirs[count( $admindirs ) - 1];
// echo $admindir;exit();
//$authnum=$_SESSION['authnum_session'];
//echo $authnum;exit();
// echo $dopost;exit();
//判断$dopost是否为login,用户刚开始登陆，肯定为空
$loginController=new LoginController();
$loginController->login_pass($dopost,$userid,$pwd,$catpcha,$authnum);
//所以顺利到这一步
require( "./../web/login.html" );
?>