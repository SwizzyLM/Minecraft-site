<?php
if (isset($_GET['server_id'])) {
	include('../../config.php');

	//print_r($donate[$_GET['server_id']]);
	//echo "<br><b>";
	//print_r($donate[$_GET['server_id']]['donates'][$_GET['pex']]['name_pex']);
	//echo "</b><br>";
	
	if($donate[$_GET['server_id']]['donates'][$_GET['pex']]['cost'] > 0){
		$get_finish = "$_GET[user]:$_GET[server_id]:".$donate[$_GET['server_id']]['donates'][$_GET['pex']]['name_pex'];
		$desc = "Покупка: ".$donate[$_GET['server_id']]['donates'][$_GET['pex']]['name'];
		$donate[$_GET['id']]['cost'] = $donate[$_GET['server_id']]['donates'][$_GET['pex']]['cost'];
	}
	
	$url = "https://unitpay.money/pay/".$config_engine['up_market']."?sum=".$donate[$_GET['id']]['cost']."&account=$get_finish&desc=$desc&signature=".getFormSignature($get_finish, $desc, $donate[$_GET['id']]['cost'], $config_engine['up_secret_key']);
	echo'<HTML>
	  <HEAD>
		<META HTTP-EQUIV="REFRESH" CONTENT="0; URL='.$url.' ">
	  </HEAD>
	  <BODY>
	  </BODY>
	</HTML>';
	exit();

}


function getFormSignature($account, $desc, $sum, $secretKey) {
    $hashStr = $account.'{up}'.$desc.'{up}'.$sum.'{up}'.$secretKey;
    return hash('sha256', $hashStr);
}

function getIp() {
  $keys = [
    'HTTP_CLIENT_IP',
    'HTTP_X_FORWARDED_FOR',
    'REMOTE_ADDR'
  ];
  foreach ($keys as $key) {
    if (!empty($_SERVER[$key])) {
      $ip = trim(end(explode(',', $_SERVER[$key])));
      if (filter_var($ip, FILTER_VALIDATE_IP)) {
        return $ip;
      }
    }
  }
}
?>