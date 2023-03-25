<?php

class Config {

    public $host  ='localhost';
    public $user ='root';
    public $pass  = '';
    public $db  ='eespr';
    public $sms_api_code = 'GUBGMHVpwcTsPFvNNVdG5DKtpv6UwksAfzw5aULcGzgG';
}
$config = new Config();
$conn = new mysqli($config->host, $config->user, $config->pass, $config->db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>