<?php

class UnitPayModel {
    private $mysqli;

    static function getInstance() {
        return new self();
    }

    private function __construct() {
        $port = Config::DB_PORT;
        if (empty($port)) {
            $port = ini_get("mysqli.default_port");
        }
        $this->mysqli = @new mysqli (
            Config::DB_HOST, Config::DB_USER, Config::DB_PASS, Config::DB_NAME, $port
        );
		$this->mysqli->set_charset("utf8");
        /* проверка подключения */
        if (mysqli_connect_errno()) {
            throw new Exception('Не удалось подключиться к бд');
        }
    }

    function createPayment($unitpayId, $account, $sum, $itemsCount) {
        $query = '
            INSERT INTO
                unitpay_payments (unitpayId, account, sum, itemsCount, dateCreate, status)
            VALUES
                (
                    "'.$this->mysqli->real_escape_string($unitpayId).'",
                    "'.$this->mysqli->real_escape_string($account).'",
                    "'.$this->mysqli->real_escape_string($sum).'",
                    "'.$this->mysqli->real_escape_string($itemsCount).'",
                    NOW(),
                    0
                )
        ';

        return $this->mysqli->query($query);
    }

    function getPaymentByUnitpayId($unitpayId) {
        $query = '
                SELECT * FROM
                    unitpay_payments
                WHERE
                    unitpayId = "'.$this->mysqli->real_escape_string($unitpayId).'"
                LIMIT 1
            ';
            
        $result = $this->mysqli->query($query);

        if (!$result){
            throw new Exception($this->mysqli->error);
        }

        return $result->fetch_object();
    }

    function confirmPaymentByUnitpayId($unitpayId) {
        $query = '
                UPDATE
                    unitpay_payments
                SET
                    status = 1,
                    dateComplete = NOW()
                WHERE
                    unitpayId = "'.$this->mysqli->real_escape_string($unitpayId).'"
                LIMIT 1
            ';
        return $this->mysqli->query($query);
    }
    
    function getAccountByName($account) {
        $sql = "
            SELECT
                *
            FROM
               ".Config::TABLE_ACCOUNT."
            WHERE
               ".Config::TABLE_ACCOUNT_NAME." = '".$this->mysqli->real_escape_string($account)."'
            LIMIT 1
         ";
         
        $result = $this->mysqli
            ->query($sql);

        if (!$result){
            throw new Exception($this->mysqli->error);
        }

        return $result->fetch_object();
    }
    
    function donateForAccountLive($array, $params) {
		$this->mysqli->query($query);
		return $this->mysqli->query($query);
    }
	
	function getName($perm) {
		$query = "SELECT * FROM `donate` WHERE `group`='".$perm."'";
		
		$result = $this->mysqli->query($query);

        if (!$result){
            throw new Exception($this->mysqli->error);
        }
		
		while($obj = $result->fetch_object()){
			$lname = $obj->lname;
		}
		
		return $lname;
	}
	
    function getUserUUID($name) {
		$val = md5("OfflinePlayer:". $name, true);
		$byte = array_values(unpack('C16', $val));

		$tLo = ($byte[0] << 24) | ($byte[1] << 16) | ($byte[2] << 8) | $byte[3];
		$tMi = ($byte[4] << 8) | $byte[5];
		$tHi = ($byte[6] << 8) | $byte[7];
		$csLo = $byte[9];
		$csHi = $byte[8] & 0x3f | (1 << 7);

		if (pack('L', 0x6162797A) == pack('N', 0x6162797A)) {
			$tLo = (($tLo & 0x000000ff) << 24) | (($tLo & 0x0000ff00) << 8) | (($tLo & 0x00ff0000) >> 8) | (($tLo & 0xff000000) >> 24);
			$tMi = (($tMi & 0x00ff) << 8) | (($tMi & 0xff00) >> 8);
			$tHi = (($tHi & 0x00ff) << 8) | (($tHi & 0xff00) >> 8);
		}

		$tHi &= 0x0fff;
		$tHi |= (3 << 12);

		$uuid = sprintf(
			'%08x-%04x-%04x-%02x%02x-%02x%02x%02x%02x%02x%02x',
			$tLo, $tMi, $tHi, $csHi, $csLo,
			$byte[10], $byte[11], $byte[12], $byte[13], $byte[14], $byte[15]
		);
		return $uuid;
	}
}