<?php

include 'config.php';
include 'lib/UnitPay.php';

include 'lib/UnitPayModel.php';


class UnitPayEvent {
    public function check($params) {
        try {
            $unitPayModel = UnitPayModel::getInstance();
            return true;
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function pay($params) {
         $unitPayModel = UnitPayModel::getInstance();
         $countItems = floor($params['sum'] / Config::ITEM_PRICE);
		 $array = explode(":", $params['account']);
		 include("../../config.php");
		 
		 file_put_contents("array.txt", json_encode($array));
		 file_put_contents("params.txt", $params);
		 
		 $unitPayModel->donateForAccountLive($array, $params);

		 file_get_contents($config_engine['domen'].'lib/buy/buy-donate.php?cron_key='.$config_engine['cron_key'].'&user='.$array[0].'&server_id='.$array[1].'&pex='.$array[2]);
		 file_put_contents("A.TXT",$config_engine['domen'].'lib/buy/buy-donate.php?cron_key='.$config_engine['cron_key'].'&user='.$array[0].'&server_id='.$array[1].'&pex='.$array[2]);
    }
}

$payment = new UnitPay(
    new UnitPayEvent()
);

echo $payment->getResult();
