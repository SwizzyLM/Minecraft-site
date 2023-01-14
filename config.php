<?PHP
	/*Общие настройки*/
	$config_engine = array(
		/*Название сайта*/
		'name_project' => 'SandPex',//Название сайта
		'domen' => 'http://new.sandpex.ru',//URL сайта / Пример: https://univix.ru
		/*Настройка обновления информации сайта (кеширования)*/
		'cron_key' => '70bc618au4176530866063hfbf6b127e27',
		/*Настройки базы данных*/
		'db_host' => 'localhost',//Хост базы данных
		'db_user' => 'root',//Имя пользователя в базе данных
		'db_password' => 'rvkt8gS140pbTG5W0N9nyA29ZNFi5yGAw9qR1Go3',//Пароль от базы данных
		'db_name' => 'sandpex',//Название базы данных
		'db_port' => 3306,//Порт базы данных
		/*Настройки UnitPay*/
		'up_secret_key' => '97616210746236f9d5008c84a485495d',//Секретный ключ UnitPay
		'up_market' => '157761-d4298'// ID магазина
	);
	/*Настройки мониторинга*/
	$confmon = array(
		array('name' => 'main', 'ip' => 'sandmc.ru' , 'port' => '25565')
	);
	/*Настройка доната*/
	$donate[] = array(
		'name_server' => 'Выживание #1',
		'rcon_host' => '46.105.245.75',
		'rcon_port' => 25570,
		'rcon_password' => 'G65uy56jhythty',
		'donates' => array(
			'moder' => array(
				'name' => '[ Модер ] - 20 руб.',
				'cost' => 20,
				'command' => 'pex user [name] group set [name_pex]',
				'name_pex' => 'moder'
			),
			'vip' => array(
				'name' => '[ VIP ] - 5 руб.',
				'cost' => 5,
				'command' => 'pex user [name] group set [name_pex]',
				'name_pex' => 'vip'
			),
			'op' => array(
				'name' => '[ OP ] - 1 руб.',
				'cost' => 1,
				'command' => 'op [name]',
				'name_pex' => 'op'
			)
		)
	);
	$donate[] = array(
		'name_server' => 'Выживание #2',
		'rcon_host' => '127.0.0.1',
		'rcon_port' => 25006,
		'rcon_password' => 'tewtewwef434',
		'donates' => array(
			'moder' => array(
				'name' => '[ Модер ] - 20 руб.',
				'cost' => 20,
				'command' => 'pex user [name] group set [name_pex]',
				'name_pex' => 'moder'
			),
			'vip' => array(
				'name' => '[ VIP ] - 25 руб.',
				'cost' => 25,
				'command' => 'pex user [name] group set [name_pex]',
				'name_pex' => 'vip'
			),
			'griffer' => array(
				'name' => '[ Griffer ] - 38 руб.',
				'cost' => 38,
				'command' => 'pex user [name] group set [name_pex]',
				'name_pex' => 'griffer'
			)
		)
	);
	$donate[] = array(
		'name_server' => 'GRIEF',
		'rcon_host' => '127.0.0.1',
		'rcon_port' => 25006,
		'rcon_password' => 'tewtewwef434',
		'donates' => array(
			'moder' => array(
				'name' => '[ Модер ] - 20 руб.',
				'cost' => 20,
				'command' => 'pex user [name] group set [name_pex]',
				'name_pex' => 'moder'
			),
			'vip' => array(
				'name' => '[ VIP ] - 25 руб.',
				'cost' => 25,
				'command' => 'pex user [name] group set [name_pex]',
				'name_pex' => 'vip'
			),
			'griffer' => array(
				'name' => '[ Griffer ] - 38 руб.',
				'cost' => 38,
				'command' => 'pex user [name] group set [name_pex]',
				'name_pex' => 'griffer'
			)
		)
	);
	$donate[] = array(
		'name_server' => 'SKYPVP',
		'rcon_host' => '127.0.0.1',
		'rcon_port' => 25006,
		'rcon_password' => 'tewtewwef434',
		'donates' => array(
			'moder' => array(
				'name' => '[ Модер ] - 20 руб.',
				'cost' => 20,
				'command' => 'pex user [name] group set [name_pex]',
				'name_pex' => 'moder'
			),
			'vip' => array(
				'name' => '[ CHEAT ] - 1 руб.',
				'cost' => 1,
				'command' => 'pex user [name] group set [name_pex]',
				'name_pex' => 'cheat'
			),
			'griffer' => array(
				'name' => '[ Griffer ] - 38 руб.',
				'cost' => 38,
				'command' => 'pex user [name] group set [name_pex]',
				'name_pex' => 'griffer'
			)
		)
	);
	$donate[] = array(
		'name_server' => 'MINIGAMES',
		'rcon_host' => '127.0.0.1',
		'rcon_port' => 25006,
		'rcon_password' => 'tewtewwef434',
		'donates' => array(
			'moder' => array(
				'name' => '[ Модер ] - 20 руб.',
				'cost' => 20,
				'command' => 'pex user [name] group set [name_pex]',
				'name_pex' => 'moder'
			),
			'vip' => array(
				'name' => '[ VIP ] - 25 руб.',
				'cost' => 25,
				'command' => 'pex user [name] group set [name_pex]',
				'name_pex' => 'vip'
			),
			'griffer' => array(
				'name' => '[ Griffer ] - 38 руб.',
				'cost' => 38,
				'command' => 'pex user [name] group set [name_pex]',
				'name_pex' => 'griffer'
			)
		)
	);
	
	$timeout = "10000"; //Частота обновления мониторинга в милисикундах 1000 = 1 сек.
?>