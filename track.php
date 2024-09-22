<?php
$log = '../logs/ip_addresses.txt'; // path for log file. requires you to create a /var/www/logs so you can't acccess the logs file as a user

$ipAddress = $_SERVER['REMOTE_ADDR']; // grabs ip

if (!file_exists($log)) { //create new file if doesn't exist
    file_put_contents($log, '');
}
$pastAddresses = file($log, FILE_IGNORE_NEW_LINES);

if (!in_array($ipAddress, $pastAddresses)) {
	file_put_contents($log, ($ipAddress . "\n"), FILE_APPEND);
	$pastAddresses[] = $ipAddress; //adds that you're a new ip address to the array for the array count
}

$ips = count($pastAddresses); //get total ips
echo $ips; // return total ips

?>
