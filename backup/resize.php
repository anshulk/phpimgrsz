<?php  

$filePath = $_REQUEST['img'];
$height = $_REQUEST['height'];
$width = $_REQUEST['width'];
$ratio = $_REQUEST['ratio'];

$imagick = new \Imagick(realpath($filePath));
$imagick->resizeImage($width, $height, IMAGICK::INTERPOLATE_AVERAGE, 1, $ratio);
header("Content-Type: image/jpg");
echo $imagick->getImageBlob();

?>