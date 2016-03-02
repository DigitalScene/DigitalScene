<?php
/**  
 * 解密成功了就点广告支持下吧，收入全部用来支付解密服务器
 * 该文件由 www.qiling.org 解密，批量解密可联系qq2859470
 * 如解密失败可联系qq2859470 如解密文件无法使用，可联系我修复
 * 同时我们提供目前无法破解的加密服务...新增php53/php54等解密 
 */
//引用admin/config.php   dirname(__FILE__)表示index.php的前一所属文件夹,
//作用是判断userid==-1，是则跳转到admin/index.php 判断用户之前是否已经登录过，没有则到登录界面，有则直接到/template/index.htm
require_once( dirname( __FILE__ )."/config.php" );
//这个有什么用呀，加密，看不了
require_once( LULINREQ."/class/mytag.class.php" );
//获得左边菜单功能的访问路径
require_once( LULINADMIN."/inc/menu.php" );
//左边菜单功能编写
require_once( LULINADMIN."/inc/menu_function.php" );
//跳转到index.html
require( LULINADMIN."/template/index.htm" );
exit( );
?>
