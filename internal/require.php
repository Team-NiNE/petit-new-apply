<?php
require_once '../LocalVariables.php';
require_once './Database.php';
$DB = new Database([
	'host' => $paDBHost,
	'user' => $paDBUser,
	'key' => $paDBPass,
	'name' => $paDBName
]);
