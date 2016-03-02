<?php

//LULINREQ为require
define('LULINREQ', str_replace("\\", '/', dirname(__FILE__)));
define('LULINROOT', str_replace("\\", '/', substr(LULINREQ, 0, -8)));
define('LULINDATA', LULINROOT . '/data');
define('LULINTEMPLATE', LULINROOT . '/templets');

if (version_compare(PHP_VERSION, '5.3.0', '<')) {
    set_magic_quotes_runtime(0);
}

error_reporting(E_ALL ^ E_NOTICE);

$cfg_cmspath = '';
//检查和注册外部提交的变量
require_once(LULINREQ."/tool/requie.tool.php");

//Session保存路径
$sessSavePath = LULINDATA."/sessions/";
if(is_writeable($sessSavePath) && is_readable($sessSavePath))
{
    session_save_path($sessSavePath);
}
//站点根目录
$cfg_basedir = preg_replace('#' . $cfg_cmspath . '\/require#i', '', LULINREQ);
//系统配置参数
require_once(LULINDATA."/setting.php");

//模板的存放目录
$cfg_templets_dir = $cfg_cmspath.'/templets';
$cfg_templets_skin = empty($cfg_model)? $cfg_templets_dir."/default" : $cfg_templets_dir."/$cfg_model";

//数据库配置文件
require_once(LULINDATA.'/config.php');

//全局常用函数
require_once(LULINREQ.'/function.func.php');

//引入数据库类
require_once(LULINREQ.'/class/mysql.class.php');


$lulinNowurl = GetCurUrl();
//cookie处理函数
require_once(LULINREQ."/tool/cookie.tool.php");
//时间处理函数
require_once(LULINREQ."/tool/time.tool.php");

?>
