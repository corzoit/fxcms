<?php
error_reporting(E_ERROR);

//echo('asdasd');


###############################################################
# Anti-spam Image Generator (CAPTCHA) 1.0
###############################################################
# For updates visit http://www.zubrag.com/scripts/
############################################################### 

// Font name to use. Make sure it is available on the server.
// You could upload it to the same folder with script if it cannot find font.
// By default it uses arial.ttf font.
$font = 'fonts/arial.ttf';

// list possible characters to include on the CAPTCHA
$charset = 'ABCDEFGHJKMNPQRSTUVWXYZ23456789';

// how many characters include in the CAPTCHA
$code_length = 4;

// antispam image height
$height = 40;

// antispam image width
$width = 140;

############################################################
#  END OF SETTINGS
############################################################

// this will start session if not started yet
@session_start();

$code = '';
for($i=0; $i < $code_length; $i++) {
  $code = $code . substr($charset, mt_rand(0, strlen($charset) - 1), 1);
}

$code = $_GET['r'] ? substr(base64_decode($_GET['r']), 0, 4):$code;

$font_size = $height * 0.7;
$image = @imagecreate($width, $height);
$background_color = @imagecolorallocate($image, 255, 255, 255);
$noise_color = @imagecolorallocate($image, 20, 40, 100);

/* add image noise */
for($i=0; $i < ($width * $height) / 4; $i++) {
  @imageellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
}
/* render text */
$text_color = @imagecolorallocate($image, 0, 0, 0);
@imagettftext($image, $font_size, 0, 7,34,
              $text_color, $font , $code)
  or die('Cannot render TTF text.');

/* output image to the browser */
header('Content-Type: image/png');
@imagepng($image) or die('imagepng error!');
@imagedestroy($image);
$_SESSION['AntiSpamImage'] = md5($code);
exit();

?>