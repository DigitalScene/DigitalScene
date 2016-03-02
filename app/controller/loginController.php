<?php
class LoginController{
    public function login_pass($dopost,$userid,$pwd,$catpcha,$authnum){
        if ( $dopost == "login" )
        {
            //这里是从login.html里面传过来数据的
            //strtolower把字符串改为小写,为空
            $svali = strtolower( getckvdvalue( ) );
            //     echo $svali;exit();
        
            //     ( $admindir );
        
            //创建一个user对象
            $cuserLogin = new userLogin( );


            //如果$catpcha不为空，则执行下面的命令
            if(!empty( $catpcha )){
               
                if ($catpcha==$authnum){
                    
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
                            trace( "成功登录，正在转向管理管理主页！", "index123.php", 300 );
                            exit( );
                        }
                        if ( $res == -1 )
                        {
                            trace( "你的用户名不存在!", -1, 2000 );
                            exit( );
                        }
                        trace( "你的密码错误!", -1,  2000 );
                        exit( );
                    }
                    trace( "用户和密码没填写完整!", -1, 2000 );
                    exit( );
                }
                trace( "验证码不正确 !", -1, 2000 );
                exit( );
            }
            trace( "验证码为空!", -1, 2000 );
            exit( );
            
            
        }
    }
}

?>