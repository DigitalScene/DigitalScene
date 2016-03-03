<!DOCTYPE html>
<html>
<head>

    <title>数字场景登录</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    <link href="./../common/style/login.css" rel="stylesheet" media="screen" type="text/css" />
    <script src="./../common/js/jquery.js" language="javascript" type="text/javascript"></script>
    <script type="text/javascript">
        function changeAuthCode() {
            var num = new Date().getTime();
            var rand = Math.round(Math.random() * 10000);
            num = num + rand;
            $('#ver_code').css('visibility', 'visible');
            if ($("#vdimgck")[0]) {
                $("#vdimgck")[0].src = "./../../require/vdimgck.php?tag=" + num;
            }
            return false;
        }
        $(document).ready(function(){
            $("#userid").focus();
            $("input").focus(function(){
                $(this).addClass("cheaked");
            });
            $("input").blur(function(){
                $(this).removeClass("cheaked");
            });
        });
    </script>
</head>
<body>
<div class="main">

    <div class="mid">
        <form name="form1" method="post" action="../controller/checkLoginCatpchaProcess.php">
            <!--dopost 在login.html 里面被赋值  -->
            <input type="hidden" name="dopost" value="login" />

            <input name='adminstyle' type='hidden' value='newdedecms' />
            <div class="mid_mian">
                <div class="logn">
                    <div class="title">数字场景制作平台登录</div>
                    <div class="box">
                        <table>
                            <tr>
                                <td style="text-align: right" width="60">用户名</td>
                                <td style="padding-left: 10px;"><input type="text" id="userid" name="userid" class="inputbox" /></td>
                            </tr>
                            <tr>
                                <td style="text-align: right" width="60">密&nbsp;&nbsp;&nbsp;码</td>
                                <td style="padding-left: 10px;"><input type="password" class="inputbox" name="pwd" /></td>
                            </tr>
                            <tr>
                                <td style="text-align: right" width="70">验证码</td>
                                <td style="padding-left: 10px;">
                                    <input type="text" class="inputbox123"  name="catpcha" />
                                    <img class="imgbox123" title="点击刷新" src="./../utils/captcha.php"  onclick="this.src='./../utils/captcha.php?aa='+Math.random();"/></td>
                            </tr>
                            <tr>
                                <td colspan="2" style="text-align: center;"><input class="btn1" value="" type="submit" /><input value="" onclick="form1.reset();" class="btn2" type="button" /></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
<script type="text/javascript">
    var allheight = $(window).height();
    var mtp = (allheight - 537) / 2 - 30;
    if (mtp > 0) {
        $(".main").css("margin-top", mtp + "px");
    }
    $(window).resize(function() {
        var allheight = $(window).height();
        var mtp = (allheight - 537) / 2 - 30;
        if (mtp > 0) {
            $(".main").css("margin-top", mtp + "px");
        }
    });
</script>
</body>
</html>
