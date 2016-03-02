<?php
require_once(dirname(__FILE__) . "/../config.php");
$menuArray = array();
$menuList = '
    <menu:top id="1" name="全景制作"  icon="images/index/toolicon1.png">
        <menu:item name="全景项目管理" link="vrpano_main.php" target="main" rank="" />
        <menu:item name="快捷添加项目" link="vrpano_add.php" target="main" rank="" />
        <menu:item name="热点样式管理" link="vrpano_spot_style.php" target="main" rank="" />
    </menu:top>
    <menu:top id="2" name="插件工具"  icon="images/index/toolicon3.png">
        <menu:item name="在线文件管理" link="file_manage_main.php" target="main" rank="" />
    </menu:top>
';

if ($cuserLogin->getUserType() >= 10) {    
    $menuList .= '
    <menu:top id="3" name="系统参数"  icon="images/index/toolicon2.png">
        <menu:item name="系统基本参数" link="sys_info.php" target="main" rank="" />
        <menu:item name="管理员账户管理" link="sys_admin_user.php" target="main" rank="" />
        <menu:item name="数据库一键备份" link="sys_data.php" target="main" rank="" />
        <menu:item name="数据库一键还原" link="sys_data_revert.php" target="main" rank="" />
    </menu:top>
    ';
}

?>