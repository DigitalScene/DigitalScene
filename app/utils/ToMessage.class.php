<?php
class tomessage{

    function trace( $msg, $gourl, $limittime = 0 )
    {
        if ( $gourl == "-1" )
        {
            if ( $limittime == 0 )
            {
                $litime = 200;
            }
            $gourl = "javascript:history.go(-1);";
        }
        $htmlhead = "<html>\r\n<head>\r\n<title>提示信息</title>\r\n";
        $htmlhead .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\r\n<meta http-equiv=\"X-UA-Compatible\" content=\"IE=100\"/>\r\n";
        $htmlhead .= "<base target='_self'/>\r\n<style type=\"text/css\">\r\n";
        $htmlhead .= "body{background:#fff;margin:0px;}\r\n";
        $htmlhead .= "#showbox{background:url(../../require/images/showbox.gif) no-repeat; width:377px; height:232px; overflow:hidden; margin:0 auto; margin-top:40px;}\r\n";
        $htmlhead .= "#title{height:30px; overflow:hidden; margin-top:7px;  text-align: center; font: bold 14px/30px '微软雅黑'; color:#333;}";
        $htmlhead .= "#main{width: 360px; height: 188px; overflow: hidden; margin-left: 9px; font: 12px/20px 微软雅黑; color: #be0000;}";
        $htmlhead .= ".text{font: 12px/20px 微软雅黑; color: #be0000;}";
        $htmlhead .= "</style>\r\n</head>\r\n";
        $htmlhead .= "<body>\r\n<center>\r\n";
        $htmlhead .= "<div id=\"showbox\">";
        $htmlhead .= "<div id=\"title\">提示信息</div>\r\n<div id=\"main\">\r\n";
        $htmlhead .= "<table width=\"90%\" height=\"188px\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\r\n";
        $htmlhead .= "<tr>\r\n<td class=\"text\" align=\"center\" height=\"188px\">";
        $htmlhead .= "{$msg}</br></br><a href=\"{$gourl}\">点击这里快速跳转</a>";
        $htmlhead .= "</td></tr>\r\n";
        $htmlhead .= "</table>\r\n</div>\r\n</div>\r\n";
        $htmlhead .= "</center>\r\n<script>\r\n";
        $htmlfoot = "</script>\r\n</body>\r\n</html>\r\n";
        $litime = $limittime == 0 ? 200 : $limittime;
        $func = "";
        $func .= "var pgo=0;\n      function JumpUrl(){\n        if(pgo==0){ location='".$gourl."'; pgo=1; }\n      }\r\n";
        $rmsg = $func;
        if ( $gourl != "javascript:;" && $gourl != "" )
        {
            $rmsg .= "setTimeout('JumpUrl()',".$litime.");";
        }
        else
        {
            $rmsg .= "";
        }
        $msg = $htmlhead.$rmsg.$htmlfoot;
        echo $msg;
    }
}

?>