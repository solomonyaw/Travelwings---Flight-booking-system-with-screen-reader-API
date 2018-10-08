<?php
include_once 'functions.php';
include_once 'header.php';


$amount = cancelbooking($_GET['bookingid']);
$balance = $user['balance'] + ($amount - 1000);
$mysqli->query(sprintf('UPDATE users SET balance = %d where id = %d', $balance, $user['id']));


header('Location: history.php');

?>
