使用方式：

require 'vendor/autoload.php';

use Octopusz\Mipush\MiPush;

$payload = '{"status":1}';

$mipush = new MiPush();

$res = $mipush::sendMessage($secret, $package, $regId, $title, $desc, $payload, $num, $gid);

print_r($res) ;