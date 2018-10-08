<?php
include_once 'functions.php';
include_once 'header.php';


$amount = cancelbooking($_GET['bookingid']);
$user['balance'] += ($amount - 1000);
$mysqli->query(sprintf('UPDATE users SET balance = %d where id = %d', $user['balance'], $user['id']));


header('Location: book.php');

?>
