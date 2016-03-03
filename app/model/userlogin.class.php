<?php
//zend52   
//Decode by www.dephp.cn  QQ 2859470
?>
<?php

class userLogin
{

    public $userName = "";
    public $userPwd = "";
    public $userID = "";
    public $adminDir = "";
    public $userType = "";
    public $userChannel = "";
    public $userPurview = "";
    public $keepUserIDTag = "lulin_admin_id";
    public $keepUserTypeTag = "lulin_admin_type";
    public $keepUserChannelTag = "lulin_admin_channel";
    public $keepUserNameTag = "lulin_admin_name";
    public $keepUserPurviewTag = "lulin_admin_purview";
    public $keepAdminStyleTag = "lulin_admin_style";
    public $adminStyle = "lulincms";

    //构造函数
    public function __construct( $admindir = "" )
    {
        //全局定义$admin_path
        global $admin_path;
        /* echo $admin_path;
        exit(); */
        //判断是否存在$keepUserIDTag session
        if ( isset( $_SESSION[$this->keepUserIDTag] ) )
        {
            //存在则执行如下命令
            $this->userID = $_SESSION[$this->keepUserIDTag];
            $this->userType = $_SESSION[$this->keepUserTypeTag];
            $this->userChannel = $_SESSION[$this->keepUserChannelTag];
            $this->userName = $_SESSION[$this->keepUserNameTag];
            $this->userPurview = $_SESSION[$this->keepUserPurviewTag];
            $this->adminStyle = $_SESSION[$this->keepAdminStyleTag];
        }
        //判断$admindir是否为空
        if ( $admindir != "" )
        {
            
            $this->adminDir = $admindir;
        }
        else
        {
            $this->adminDir = $admin_path;
        }
    }
    
    
    //这个函数是旧式构造函数
    public function userLogin( $admindir = "" )
    {
        $this->__construct( $admindir );
    }

    public function checkUser( $username, $userpwd )
    {
        global $dsql;
        $this->userName = preg_replace( "/[^0-9a-zA-Z_@!\\.-]/", "", $username );
        $this->userPwd = preg_replace( "/[^0-9a-zA-Z_@!\\.-]/", "", $userpwd );
        $pwd = substr( md5( $this->userPwd ), 5, 20 );
        $dsql->SetQuery( "SELECT admin.*,atype.purviews FROM `#@__admin` admin LEFT JOIN `#@__admintype` atype ON atype.rank=admin.usertype WHERE admin.userid LIKE '".$this->userName."' LIMIT 0,1" );
        $dsql->Execute( );
        $row = $dsql->GetObject( );
        if ( !isset( $row->pwd ) )
        {
            return -1;
        }
        if ( $pwd != $row->pwd )
        {
            return -2;
        }
        $loginip = getip( );
        $this->userID = $row->id;
        $this->userType = $row->usertype;
        $this->userChannel = $row->typeid;
        $this->userName = $row->uname;
        $this->userPurview = $row->purviews;
        $inquery = "UPDATE `#@__admin` SET loginip='".$loginip."',logintime='".time( )."' WHERE id='".$row->id."'";
        $dsql->ExecuteNoneQuery( $inquery );
        $sql = "UPDATE #@__member SET logintime=".time( ).( ", loginip='".$loginip."' WHERE mid=" ).$row->id;
        $dsql->ExecuteNoneQuery( $sql );
        return 1;
    }

    //玛呀，究竟在哪里调用了这些函数呀
    public function keepUser( )
    {
        if ( $this->userID != "" && $this->userType != "" )
        {
            global $admincachefile;
            global $adminstyle;
            if ( empty( $adminstyle ) )
            {
                $adminstyle = "lulincms";
            }
            $_SESSION[$this->keepUserIDTag] = $this->userID;
            $_SESSION[$this->keepUserTypeTag] = $this->userType;
            $_SESSION[$this->keepUserChannelTag] = $this->userChannel;
            $_SESSION[$this->keepUserNameTag] = $this->userName;
            $_SESSION[$this->keepUserPurviewTag] = $this->userPurview;
            $_SESSION[$this->keepAdminStyleTag] = $adminstyle;
            $this->ReWriteAdminChannel( );
            return 1;
        }
        return -1;
    }

    public function ReWriteAdminChannel( )
    {
        $cacheFile = LULINDATA."/cache/admincat_".$this->userID.".inc";
        $typeid = trim( $this->userChannel );
        if ( empty( $typeid ) || 10 <= $this->getUserType( ) )
        {
            $firstConfig = "\$cfg_admin_channel = 'all';\r\n\$admin_catalogs = array();\r\n";
        }
        else
        {
            $firstConfig = "\$cfg_admin_channel = 'array';\r\n";
        }
        $fp = fopen( $cacheFile, "w" );
        fwrite( $fp, "<?php\r\n" );
        fwrite( $fp, $firstConfig );
        if ( !empty( $typeid ) )
        {
            $typeids = explode( ",", $typeid );
            $typeid = "";
            foreach ( $typeids as $tid )
            {
                $typeid .= $typeid == "" ? getsonidsul( $tid ) : ",".getsonidsul( $tid );
            }
            $typeids = explode( ",", $typeid );
            $typeidsnew = array_unique( $typeids );
            $typeid = join( ",", $typeidsnew );
            fwrite( $fp, "\$admin_catalogs = array(".$typeid.");\r\n" );
        }
        fwrite( $fp, "" );
        fclose( $fp );
    }

    public function exitUser( )
    {
        clearmyaddon( );
        $_SESSION = array( );
    }

    public function getUserChannel( )
    {
        if ( $this->userChannel != "" )
        {
            return $this->userChannel;
        }
        return "";
    }

    public function getUserType( )
    {
        if ( $this->userType != "" )
        {
            return $this->userType;
        }
        return -1;
    }

    public function getUserRank( )
    {
        return $this->getUserType( );
    }

    public function getUserID( )
    {
        if ( $this->userID != "" )
        {
            return $this->userID;
        }
        return -1;
    }

    public function getUserName( )
    {
        if ( $this->userName != "" )
        {
            return $this->userName;
        }
        return -1;
    }

    public function getPurview( )
    {
        return $this->userPurview;
    }

}

//----------------------------------------------------分界线

function TestPurview( $n )
{
    $rs = FALSE;
    $purview = $GLOBALS['cuserLogin']->getPurview( );
    if ( preg_match( "/admin_AllowAll/i", $purview ) )
    {
        return TRUE;
    }
    if ( $n == "" )
    {
        return TRUE;
    }
    if ( !isset( $GLOBALS['groupRanks'] ) )
    {
        $GLOBALS['GLOBALS']['groupRanks'] = explode( " ", $purview );
    }
    $ns = explode( ",", $n );
    foreach ( $ns as $n )
    {
        if ( $n == "" || !in_array( $n, $GLOBALS['groupRanks'] ) )
        {
            continue;
        }
        $rs = TRUE;
        break;
    }
    return $rs;
}

function CheckPurview( $n )
{
    if ( !testpurview( $n ) )
    {
        trace( "对不起，你没有权限执行此操作！<br/><br/><a href='javascript:history.go(-1);'>点击此返回上一页&gt;&gt;</a>", "javascript:;" );
        exit( );
    }
}

function TestAdmin( )
{
    $purview = $GLOBALS['cuserLogin']->getPurview( );
    if ( preg_match( "/admin_AllowAll/i", $purview ) )
    {
        return TRUE;
    }
    return FALSE;
}

function CheckCatalog( $cid, $msg )
{
    global $cfg_admin_channel;
    global $admin_catalogs;
    if ( $cfg_admin_channel == "all" || testadmin( ) )
    {
        return TRUE;
    }
    if ( !in_array( $cid, $admin_catalogs ) )
    {
        trace( " ".$msg." <br/><br/><a href='javascript:history.go(-1);'>点击此返回上一页&gt;&gt;</a>", "javascript:;" );
        exit( );
    }
    return TRUE;
}

function AddMyAddon( $fid, $filename )
{
    $cacheFile = LULINDATA."/cache/addon-".session_id( ).".inc";
    if ( !file_exists( $cacheFile ) )
    {
        $fp = fopen( $cacheFile, "w" );
        fwrite( $fp, "<?php\r\n" );
        fwrite( $fp, "\$myaddons = array();\r\n" );
        fwrite( $fp, "\$maNum = 0;\r\n" );
        fclose( $fp );
    }
    include( $cacheFile );
    $fp = fopen( $cacheFile, "a" );
    $arrPos = $maNum;
    ++$maNum;
    fwrite( $fp, "\$myaddons[\$maNum] = array('".$fid."', '{$filename}');\r\n" );
    fwrite( $fp, "\$maNum = ".$maNum.";\r\n" );
    fclose( $fp );
}

function ClearMyAddon( $aid = 0, $title = "" )
{
    global $dsql;
    $cacheFile = LULINDATA."/cache/addon-".session_id( ).".inc";
    $_SESSION['bigfile_info'] = array( );
    $_SESSION['file_info'] = array( );
    if ( !file_exists( $cacheFile ) )
    {
        return;
    }
}

function GetSonIdsUL( $id, $channel = 0, $addthis = TRUE )
{
    global $cfg_Cs;
    $GLOBALS['GLOBALS']['idArray'] = array( );
    if ( !is_array( $cfg_Cs ) )
    {
        require_once( DEDEDATA."/cache/inc_catalog_base.inc" );
    }
    getsonidslogicul( $id, $cfg_Cs, $channel, $addthis );
    $rquery = join( ",", $GLOBALS['idArray'] );
    return $rquery;
}

function GetSonIdsLogicUL( $id, $sArr, $channel = 0, $addthis = FALSE )
{
    if ( $id != 0 && $addthis )
    {
        $GLOBALS['GLOBALS']['idArray'][$id] = $id;
    }
    foreach ( $sArr as $k => $v )
    {
        if ( !( $v[0] == $id ) && !( $channel == 0 ) || !( $v[1] == $channel ) )
        {
            getsonidslogicul( $k, $sArr, $channel, TRUE );
        }
    }
}

if ( !defined( "LULINREQ" ) )
{
    exit( "Request Error!" );
}
session_start( );
$LulinUserCatalogs = array( );
?>
