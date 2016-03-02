<?php
require_once(dirname(__FILE__) . "/../../config.php");
$datas = explode("|", $data);
$id = $datas[0];
$styleid = $datas[1];
$mydb = new MySql();
$scenesql = "SELECT * FROM `#@__pano_scene` WHERE `id` = $id";
$scenerow = $mydb->getOne($scenesql);

echo $spotsql = "SELECT * FROM `#@__pano_spotstyle` WHERE `id` = $styleid";
$spotrow = $mydb->getOne($spotsql);

$xml = "";
$xml .= '<?xml version="1.0" encoding="UTF-8"?>' . "\r\n";
$xml .= '<krpano version="1.0.8" onstart="action(start);" >' . "\r\n";

$xml .= '<action name="start">' . "\r\n";
$xml .= 'loadscene(scene1, null, MERGE);' . "\r\n";
$xml .= '</action>' . "\r\n";

$xml .= '<events onloadcomplete="" />' . "\r\n";

$xml .= '<scene name="scene1">' . "\r\n";
$xml .= '<view fov="80" fisheye="0" fovmin="60" fovmax="120" />' . "\r\n";
$xml .= '<preview url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/preview.jpg" />' . "\r\n";
if ($scenerow['type'] == 1) {
    $xml .= '<image type="SPHERE">' . "\r\n";
    $xml .= '<sphere url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/pano.jpg" />' . "\r\n";
    $xml .= '</image>' . "\r\n";
} else {
    $xml .= '<image type="CUBE">' . "\r\n";
    $xml .= '<left url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/pano_left.jpg" />' . "\r\n";
    $xml .= '<front url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/pano_front.jpg" />' . "\r\n";
    $xml .= '<right url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/pano_right.jpg" />' . "\r\n";
    $xml .= '<back url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/pano_back.jpg" />' . "\r\n";
    $xml .= '<up url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/pano_up.jpg" />' . "\r\n";
    $xml .= '<down url="%SWFPATH%/images/scene' . $scenerow['rank'] . '/pano_down.jpg" />' . "\r\n";
    $xml .= '</image>' . "\r\n";
}

$xml .= '</scene>' . "\r\n";

$xml .= '<plugin name="introimage" alpha="1" url="'.$cmspath.$spotrow['url'].'" onover="tween(alpha,0.8);" onout="tween(alpha,1);" onclick="getback();"  keep="true" align="center"/>' . "\r\n";

$xml .= '<action name="getback">' . "\r\n";
$xml .= 'js(back(get(VIEW.hlookat),get(VIEW.vlookat)));' . "\r\n";
$xml .= '</action>' . "\r\n";
$xml .= '</krpano>' . "\r\n";
echo $xml;
?>
