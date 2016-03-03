<?php
/**
 * 解密成功了就点广告支持下吧，收入全部用来支付解密服务器
* 该文件由 www.qiling.org 解密，批量解密可联系qq2859470
* 如解密失败可联系qq2859470 如解密文件无法使用，可联系我修复
* 同时我们提供目前无法破解的加密服务...新增php53/php54等解密
*/

if ( !file_exists( dirname( __FILE__ )."/data/config.php" ) )
{
    header( "Location:install/index.php" );
    exit( );
}


//跳转到admin/index.php
//header( "Location:admin/index.php" );
header( "Location:./app/web/login.php" );
//header( "Location:./app/web/login.php" );
echo "\r\n";
?>

