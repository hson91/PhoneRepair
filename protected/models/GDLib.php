<?php
    class GDLib{
        function getProductDetailIcon($string){
            $font = 'resource/arial.ttf';
            list($left,, $right) = imageftbbox( 13, 0, $font, $string);
            $width = $right - $left;
            $height = $width + 10;
            $width = 30;
            $thumb = imagecreatetruecolor($width, $height);
            imagealphablending($thumb, false);
            imagesavealpha($thumb, true);
            $source = imagecreatefrompng('resource/temp.png');
            imagealphablending($source, true);
            $color = imagecolorallocate($source, 225,225,225);
            imagettftext($source,13,-270,20,$height - 5,$color,$font,$string);
            imagecopyresampled($thumb, $source, 0, 0, 0, 0, $width, $height, $width, $height);
            //header("Content-Type: image/png");
            imagepng($thumb, 'images/product_infos/'.md5($string).'.png');
            //imagepng($thumb);
            imagedestroy($thumb);
        }
    }