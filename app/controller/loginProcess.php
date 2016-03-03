<?php
require_once( "../../require/function.inc.php" );
require_once( "../model/userlogin.class.php" );


    $userid=$_GET['userid'];
    $pwd=$_GET['pwd'];

    //创建一个user对象
    $cuserLogin = new userLogin( );

        $res = $cuserLogin->checkUser( $userid, $pwd );
        if ( $res == 1 )
        {
            //成功登录
            $cuserLogin->keepUser( );
//            if ( !empty( $gotopage ) )
//            {
//                trace( "成功登录，正在转向管理管理主页！", $gotopage, 300 );
//                exit( );
//            }

            trace( "成功登录，正在转向管理主页！", "../../admin/index.php", 300 );
            exit( );
        }
        if ( $res == -1 )
        {
            trace( "你的用户名不存在!", -1, 1000 );
            exit( );
        }
        trace( "你的密码错误!", -1,  1000 );
        exit( );

?>


