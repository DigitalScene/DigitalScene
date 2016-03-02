<?php
/**  
 * 解密成功了就点广告支持下吧，收入全部用来支付解密服务器
 * 该文件由 www.qiling.org 解密，批量解密可联系qq2859470
 * 如解密失败可联系qq2859470 如解密文件无法使用，可联系我修复
 * 同时我们提供目前无法破解的加密服务...新增php53/php54等解密 
 */
//str_replace("被替换者","替换者","要替换部分字符的字符串")，LULINADMIN为admin
define( "LULINADMIN", str_replace( "\\", "/", dirname( __FILE__ ) ) );
//引用功能类文件
require_once( LULINADMIN."/../require/function.inc.php" );
//引用用户登录文件
require_once( LULINREQ."/class/userlogin.class.php" );

header( "Cache-Control:private" );

$dsql->safeCheck = FALSE;
$dsql->SetLongLink( );

set_time_limit( 0 );

$Nowurl = $NowOnlyurl = "";
//$isUrlOpen是什么
$isUrlOpen = @ini_get( "allow_url_fopen" );

//function.func.php文件中的一个函数,得到/admin/index.php
$Nowurl = getcururl( );
/* echo $Nowurl;
exit(); */
//php中 explode("分割符","要被分割的字符串"),得到一个数组
$Nowurls = explode( "?", $Nowurl );
/* echo $Nowurls;
exit(); */
//得到/admin/index.php
$NowOnlyurl = $Nowurls[0];
/*  echo $NowOnlyurl;
 exit();  */

//来自function.func.php中$cfg_cmspath = '';
$cmspath = $cfg_cmspath;
/* echo $cmspath;
exit(); */

//这个什么时候得到一个已经赋值的user啦
$cuserLogin = new userLogin( );
//这些user的属性数据好像跟数据库没有关系耶
/* echo "UserID--".$cuserLogin->getUserID()," UserType->".$cuserLogin->getUserType()," Purview--".$cuserLogin->getPurview()," UserChannel--".$cuserLogin->getUserChannel()," UserName--".$cuserLogin->getUserName()," UserRank--".$cuserLogin->getUserRank();
exit(); */

//如果当前user的userID为-1,则跳转到location:login.php?gotopage=admin/index.php,就是始终是登录界面
// if ( $cuserLogin->getUserID( ) == -1 )
// {
//     header( "location:login.php?gotopage=".urlencode( $Nowurl ) );
//     exit( );
// }
//如果之前用户没有登录过，则session不会保存，所以当前user的userID为-1,则跳转到location:login.php?gotopage=admin/index.php,就是始终是登录界面
//如果之前用户已经登录过，则session会保存user的信息，所以当前user的userID不为-1
if ( $cuserLogin->getUserID( ) == -1 )
{
//     header( "location:login.php?gotopage=". $Nowurl."/hahaha你大爷" );
    header("location:../app/controller/loginProcess.php");
    exit( );
}
?>