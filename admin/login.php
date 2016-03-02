<?php
/**  
 * 解密成功了就点广告支持下吧，收入全部用来支付解密服务器
 * 该文件由 www.qiling.org 解密，批量解密可联系qq2859470
 * 如解密失败可联系qq2859470 如解密文件无法使用，可联系我修复
 * 同时我们提供目前无法破解的加密服务...新增php53/php54等解密 
 */

// header("location:index.php?m=home&c=login&a=login");
//dirname( __FILE__ )为/admin
require_once( dirname( __FILE__ )."/../require/function.inc.php" );
// echo dirname(__FILE__)."/../require/function.inc.php";
require_once( LULINREQ."/class/userlogin.class.php" );

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

// echo $dopost;exit();
//判断$dopost是否为login,用户刚开始登陆，肯定为空
if ( $dopost == "login" )
{
    //这里是从login.html里面传过来数据的
    //strtolower把字符串改为小写,为空
    $svali = strtolower( getckvdvalue( ) );
//     echo $svali;exit();

//     ( $admindir );

    //创建一个user对象
    $cuserLogin = new userLogin( );
    
    //如果$userid不为空或者$pwd不为空，则执行下面的命令
    if ( !empty( $userid ) || !empty( $pwd ) )
    {
        
        $res = $cuserLogin->checkUser( $userid, $pwd );
        if ( $res == 1 )
        {
            $cuserLogin->keepUser( );
            if ( !empty( $gotopage ) )
            {
                trace( "成功登录，正在转向管理管理主页！", $gotopage, 300 );
                exit( );
            }
            trace( "成功登录，正在转向管理管理主页！", "index.php", 300 );
            exit( );
        }
        if ( $res == -1 )
        {
            trace( "你的用户名不存在!", -1, 0, 1000 );
            exit( );
        }
        trace( "你的密码错误!", -1, 0, 1000 );
        exit( );
    }
    trace( "用户和密码没填写完整!", -1, 0, 1000 );
    exit( );
}
//所以顺利到这一步
// require( "template/login.html" );
echo "./../";
?>
