<?PHP
if(file_exists('data/LAST_DONATE.html')){
	$time_create = stat('data/LAST_DONATE.html');
	$time_create = time() - $time_create['mtime'];
	$time_create = $time_create / 60;
	if($time_create < 4){
		echo file_get_contents('data/LAST_DONATE.html');
		return;
	}
}

include('../../config.php');
include('../../function.php');

// Открываем новое соединение с  MySQL сервером
$mysqli = new mysqli($config_engine['db_host'], $config_engine['db_user'], $config_engine['db_password'], $config_engine['db_name']);

//Выводим любую ошибку соединения
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
/*Получаем уровень пользователя*/
$results = $mysqli->query("SELECT * FROM `unitpay_log` ORDER BY `id` DESC LIMIT 8");
while($data_user = $results->fetch_array()) {
	$buy_time = passed_time($data_user['time_put']);
	
	if(checkRemoteFile('https://minecraft-inside.ru/uploads/nick/'.$data_user['username'].'.png')){
		$avatar = 'https://minecraft-inside.ru/uploads/nick/'.$data_user['username'].'.png';
	}else{
		$avatar = 'img/no-face.png';
	}

		$last_donates .= 
					"<div class='block-last-buy'>
						<div style='background-image: url($avatar);' class='image-avatar'></div>
						<div class='info-user'>
							<div class='info-user-name'>$data_user[username]</div>
							<div class='info-user-buy-what'>Купил $data_user[pex]</div>
							<div class='info-user-buy-why'>$buy_time</div>
						</div>
					</div>
					";
					
}
unlink("data/LAST_DONATE.html");
file_put_contents("data/LAST_DONATE.html", $last_donates);
echo $last_donates;

?>