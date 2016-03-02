<?php
require_once(dirname(__FILE__) . "/../../config.php");
$mydb = new MySql();
$scenesql = "SELECT * FROM `#@__pano_scene` WHERE `id` = $id";
$scenerow = $mydb->getOne($scenesql);

$xml = "";
$xml .= '<?xml version="1.0" encoding="UTF-8"?>' . "\r\n";
$xml .= '<krpano version="1.16">' . "\r\n";
$xml .= "<plugin name=\"editor\" url=\"plugins/editor.swf\" keep=\"true\"/>\r\n";

$xml .= '<events onloadcomplete="" />' . "\r\n";
$xml .= '<view fov="80" />' . "\r\n";
if ($scenerow['type'] == 1) {
    $xml .= '<image type="SPHERE">' . "\r\n";
    $xml .= '<sphere url="'.$cmspath.'/vrpano/vrpano'.$scenerow['pid'].'/images/scene' . $scenerow['rank'] . '/pano.jpg" />' . "\r\n";
    $xml .= '</image>' . "\r\n";
} else {
    $xml .= '<image type="CUBE">' . "\r\n";
    $xml .= '<left url="'.$cmspath.'/vrpano/vrpano'.$scenerow['pid'].'/images/scene' . $scenerow['rank'] . '/pano_left.jpg" />' . "\r\n";
    $xml .= '<front url="'.$cmspath.'/vrpano/vrpano'.$scenerow['pid'].'/images/scene' . $scenerow['rank'] . '/pano_front.jpg" />' . "\r\n";
    $xml .= '<right url="'.$cmspath.'/vrpano/vrpano'.$scenerow['pid'].'/images/scene' . $scenerow['rank'] . '/pano_right.jpg" />' . "\r\n";
    $xml .= '<back url="'.$cmspath.'/vrpano/vrpano'.$scenerow['pid'].'/images/scene' . $scenerow['rank'] . '/pano_back.jpg" />' . "\r\n";
    $xml .= '<up url="'.$cmspath.'/vrpano/vrpano'.$scenerow['pid'].'/images/scene' . $scenerow['rank'] . '/pano_up.jpg" />' . "\r\n";
    $xml .= '<down url="'.$cmspath.'/vrpano/vrpano'.$scenerow['pid'].'/images/scene' . $scenerow['rank'] . '/pano_down.jpg" />' . "\r\n";
    $xml .= '</image>' . "\r\n";
}
$xml .= '<events onloadcomplete="js(add_hotspot(););"/>'."\r\n";

$xml .= "<plugin name=\"endbtn\" url=\"button.png\" keep=\"true\" align=\"rightbottom\" x=\"18\" y=\"18\" alpha=\"0.8\" onover=\"tween(alpha,1);\" onout=\"tween(alpha,0.8);\" onclick=\"js(getback();)\"/>\r\n";
$xml .= '</krpano>' . "\r\n";
echo $xml;
?>
