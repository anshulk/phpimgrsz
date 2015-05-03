<?php  
function resizeImage($imagePath, $width, $height, $filterType, $blur, $bestFit, $cropZoom) {
    $imagick = new \Imagick(realpath($imagePath));

    $imagick->resizeImage($width, $height, $filterType, $blur, $bestFit);

    $cropWidth = $imagick->getImageWidth();
    $cropHeight = $imagick->getImageHeight();

    if ($cropZoom) {
        $newWidth = $cropWidth / 2;
        $newHeight = $cropHeight / 2;

        $imagick->cropimage(
            $newWidth,
            $newHeight,
            ($cropWidth - $newWidth) / 2,
            ($cropHeight - $newHeight) / 2
        );

        $imagick->scaleimage(
            $imagick->getImageWidth() * 4,
            $imagick->getImageHeight() * 4
        );
    }


    header("Content-Type: image/jpg");
    echo $imagick->getImageBlob();
}

if($_REQUEST['sample'] !== "")
$filePath = $_REQUEST['sample'];
else
$filePath = $_REQUEST['img'];
    
$height = $_REQUEST['height'];
$width = $_REQUEST['width'];
$ratio = $_REQUEST['ratio'];
$blur = $_REQUEST['blur'];
$cropZoom = $_REQUEST['crop'];

echo resizeImage($filePath, $width, $height, IMAGICK::INTERPOLATE_AVERAGE, $blur, $ratio, 0);

?>