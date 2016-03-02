<?php
function panomenu($id,$n){
    global $cfg_cmspath;
    $panolist = array();
    array_push($panolist,array("name"=>"全景参数","url"=>"vrpano_edit.php"));
    array_push($panolist,array("name"=>"全景场景","url"=>"vrpano_scene.php"));
    array_push($panolist,array("name"=>"地图管理","url"=>"vrpano_map.php"));
    array_push($panolist,array("name"=>"控制版面","url"=>"vrpano_control.php"));
    array_push($panolist,array("name"=>"UI界面","url"=>"vrpano_ui.php"));
    array_push($panolist,array("name"=>"图集","url"=>"vrpano_photo.php"));
    array_push($panolist,array("name"=>"360物体","url"=>"vrpano_cube.php"));
    $v = 1;
    $html = "";
    foreach ($panolist as $arr) {
        if($n==$v){
            $html .=  "<input type=\"button\" class=\"btn2\" value=\"{$arr['name']}\" />";
        }else{
            $html .=  "<input type=\"button\" class=\"btn1\" onclick=\"window.location.href='{$arr['url']}?id=$id'\" value=\"{$arr['name']}\" />";
        }        
        $v++;
    }
    $html .= "<input type=\"button\" class=\"btn1\" value=\"总体预览\" onclick=\"penoshow($id);\"/>\r\n";
    $html .= "<script language=\"javascript\" type=\"text/javascript\">\r\n";
    $html .= "function penoshow(n){\r\n";
    $html .= "window.open(\"{$cfg_cmspath}/vrpano/vrpano\"+n, \"vrpano\"+n);\r\n";
    $html .= "}\r\n";
    $html .= "</script>\r\n";
    return $html;
}
?>
