<?php
// change the following paths if necessary
$website_dir = dirname(__FILE__);
$g_upfiles_dir = '/upfiles';
$atms_dave_dir = $website_dir.'/upfiles/';
$avts_dir = $website_dir.$g_upfiles_dir.'/avatars/';

define('WEBSITE_DIR',$website_dir);
define('ATMS_SAVE_DIR',$atms_dave_dir);
define('UPFILES_DIR', $g_upfiles_dir);
define('UPFILES_AVTS_DIR', $avts_dir);
define('THUMB_SIZE',  '160_120');
define('GAVATAR_SIZE','48_48');
define('LARGE_SIZE',  '800_600');
define('IHOST_STUDIO', 'http://www.google.com');

define("AVATAR_MAX_WIDTH", 600);
define("AVATAR_MAX_HEIGHT", 400);
define("AVATAR_WIDTH", 80);
define("AVATAR_HEIGHT", 80);
define("AVATAR_PREFIX", 'source_');

define("ADMIN_URL", "/index.php?r=admin/Dashboard/index");

$ATT_IMG_AUTO_SIZE = array( '160_120', '40_40', '600_400', '800_600' );
$img_ext = array("jpg", "jpeg", "png", "gif");