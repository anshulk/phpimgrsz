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

$filePath = isset($_REQUEST['sample']) ? $_REQUEST['sample'] : $_REQUEST['img'] ;
$height = $_REQUEST['height'];
$width = $_REQUEST['width'];
$ratio = isset($_REQUEST['ratio']) ? $_REQUEST['ratio'] : 0 ;
$blur = isset($_REQUEST['blur']) ? (double)$_REQUEST['blur'] : 0 ;
$crop = isset($_REQUEST['crop']) ? $_REQUEST['crop'] : 0;
$filter = $_REQUEST['crop'];

echo resizeImage($filePath, $width, $height, $filter, $blur, $ratio, $crop);

?>