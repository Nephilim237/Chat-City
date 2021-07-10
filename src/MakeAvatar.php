<?php
namespace Chat;


class MakeAvatar
{
    public static function makeAvatar(string $character): string
    {
        $path = dirname(__DIR__) . "/public/img/" . time() . ".png";
        $image = imagecreate(200, 200);
        $red = mt_rand(0, 255);
        $green = mt_rand(0, 255);
        $blue = mt_rand(0, 255);
        imagecolorallocatealpha($image, 0, 0, 0,120);
        $textColor = imagecolorallocate($image,  $red, $green, $blue, );
        $font = dirname(__DIR__) . "/public/fonts/Ubuntu/Ubuntu-Regular.ttf";
        imagettftext($image, 100, 0, 55, 150, $textColor, $font, $character);
        imagepng($image, $path);
        imagedestroy($image);
        return $path;
    }
}