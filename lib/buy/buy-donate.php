<?PHP

	include("./../rcon/rcon.php");
	include("../../config.php");
	
	if($_GET['cron_key'] != $config_engine['cron_key']){
		exit('FAIL');
		return;
	}
	use Thedudeguy\Rcon;
	
	if($donate[$_GET['server_id']]['donates'][$_GET['pex']]['cost'] > 0){
		$cost = $donate[$_GET['server_id']]['donates'][$_GET['pex']]['cost'];
		$sendCommand = str_replace('[name]', $_GET['user'] , $donate[$_GET['server_id']]['donates'][$_GET['pex']]['command']);
		$sendCommand = str_replace('[name_pex]', $donate[$_GET['server_id']]['donates'][$_GET['pex']]['name_pex'] , $sendCommand);
	}
	
	$rcon = new Rcon($donate[$_GET['server_id']]['rcon_host'], $donate[$_GET['server_id']]['rcon_port'], $donate[$_GET['server_id']]['rcon_password'], 3);
	
    if (!$rcon->connect()) {
		die('Fail');
	}
	
	// Открываем новое соединение с  MySQL сервером
	$mysqli = new mysqli($config_engine['db_host'], $config_engine['db_user'], $config_engine['db_password'], $config_engine['db_name']);
	
	$mysqli->query("INSERT INTO `unitpay_log` (`id`, `username`, `sum`, `pex`, `server_id`, `pex_command`, `time_put`) VALUES (NULL, '$_GET[user]', '$cost', '$_GET[pex]', '$_GET[server_id]', '$sendCommand', '".time()."');");
	
	//Выводим любую ошибку соединения
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
	
	$rcon->sendCommand($sendCommand);
	
	echo "OK";
?>