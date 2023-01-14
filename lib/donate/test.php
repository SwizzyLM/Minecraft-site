<?PHP
file_put_contents("atest.txt", "test");
include("../../config.php");
include("./../rcon/rcon.php");
use Thedudeguy\Rcon;
$rcon = new Rcon($config_engine['rcon_host'], $config_engine['rcon_port'], $config_engine['rcon_password'], 3);
if (!$rcon->connect()) {
	 die('Fail');
}
$command = "pex user $array[0] group set $array[1]";
$rcon->sendCommand($command);
?>